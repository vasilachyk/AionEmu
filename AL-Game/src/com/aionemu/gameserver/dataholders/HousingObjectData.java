package com.aionemu.gameserver.dataholders;

import gnu.trove.map.hash.TIntObjectHashMap;

import java.util.List;

import javax.xml.bind.Unmarshaller;
import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlElements;
import javax.xml.bind.annotation.XmlRootElement;
import javax.xml.bind.annotation.XmlTransient;
import javax.xml.bind.annotation.XmlType;

import com.aionemu.gameserver.model.templates.housing.PlaceableHouseObject;

@XmlAccessorType(XmlAccessType.FIELD)
@XmlType(name = "", propOrder = { "housingObjects" })
@XmlRootElement(name = "housing_objects")
public class HousingObjectData
{
	@XmlElements({ 
		@XmlElement(name = "postbox", type = com.aionemu.gameserver.model.templates.housing.HousingPostbox.class),
		@XmlElement(name = "use_item", type = com.aionemu.gameserver.model.templates.housing.HousingUseableItem.class),
		@XmlElement(name = "move_item", type = com.aionemu.gameserver.model.templates.housing.HousingMoveableItem.class),
		@XmlElement(name = "chair", type = com.aionemu.gameserver.model.templates.housing.HousingChair.class),
		@XmlElement(name = "picture", type = com.aionemu.gameserver.model.templates.housing.HousingPicture.class),
		@XmlElement(name = "passive", type = com.aionemu.gameserver.model.templates.housing.HousingPassiveItem.class),
		@XmlElement(name = "npc", type = com.aionemu.gameserver.model.templates.housing.HousingNpc.class),
		@XmlElement(name = "storage", type = com.aionemu.gameserver.model.templates.housing.HousingStorage.class),
		@XmlElement(name = "jukebox", type = com.aionemu.gameserver.model.templates.housing.HousingJukeBox.class),
		@XmlElement(name = "moviejukebox", type = com.aionemu.gameserver.model.templates.housing.HousingMovieJukeBox.class),
		@XmlElement(name = "emblem", type = com.aionemu.gameserver.model.templates.housing.HousingEmblem.class) })
	protected List<PlaceableHouseObject> housingObjects;
	
	@XmlTransient
	protected TIntObjectHashMap<PlaceableHouseObject> objectTemplatesById = new TIntObjectHashMap<PlaceableHouseObject>();
	
	void afterUnmarshal(Unmarshaller u, Object parent) {
		if (housingObjects == null)
			return;
		for (PlaceableHouseObject obj : housingObjects) {
			objectTemplatesById.put(obj.getTemplateId(), obj);
		}
		housingObjects.clear();
		housingObjects = null;
	}
	
	public int size() {
		return objectTemplatesById.size();
	}
	
	public PlaceableHouseObject getTemplateById(int templateId) {
		return objectTemplatesById.get(templateId);
	}
}