package com.aionemu.gameserver.dataholders;

import java.util.List;

import javax.xml.bind.Unmarshaller;
import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlRootElement;
import javax.xml.bind.annotation.XmlTransient;
import javax.xml.bind.annotation.XmlType;

import com.aionemu.gameserver.model.templates.pet.PetBonusAttr;

import gnu.trove.map.hash.TIntObjectHashMap;

@XmlAccessorType(XmlAccessType.FIELD)
@XmlType(name = "", propOrder = {"petBonusattr"})
@XmlRootElement(name = "pet_bonusattrs")
public class PetBuffData {

	@XmlElement(name = "pet_bonusattr")
	protected List<PetBonusAttr> petBonusattr;

	@XmlTransient
	private TIntObjectHashMap<PetBonusAttr> templates = new TIntObjectHashMap<PetBonusAttr>();

	void afterUnmarshal(Unmarshaller u, Object parent) {
		for (PetBonusAttr template : petBonusattr) {
			templates.put(template.getBuffId(), template);
			templates.put(template.getFoodCount(), template);
		}
		petBonusattr.clear();
		petBonusattr = null;
	}

	public int size() {
		return templates.size();
	}

	public PetBonusAttr getPetBonusattr(int buffId) {
		return templates.get(buffId);
	}
	
	public PetBonusAttr getFoodCount(int count) {
		return templates.get(count);
	}
}
