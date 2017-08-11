package com.aionemu.gameserver.dataholders;

import gnu.trove.map.hash.TIntObjectHashMap;

import java.util.HashMap;
import java.util.List;
import java.util.Map;

import javax.xml.bind.Unmarshaller;
import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlRootElement;
import javax.xml.bind.annotation.XmlTransient;

import com.aionemu.gameserver.model.templates.event.AtreianPassport;

/**
 * 
 * @author Ranastic
 *
 */
@XmlRootElement(name = "login_events")
@XmlAccessorType(XmlAccessType.FIELD)
public class AreianPassportData {
	
	@XmlElement(name="login_event")
	private List<AtreianPassport> tlist;
	
	@XmlTransient
	private TIntObjectHashMap<AtreianPassport> passportData = new TIntObjectHashMap<AtreianPassport>();
	
	@XmlTransient
	private Map<Integer, AtreianPassport> passportDataMap = new HashMap<Integer, AtreianPassport>(1);

	void afterUnmarshal(Unmarshaller paramUnmarshaller, Object paramObject) {
		for (AtreianPassport atreianPassport : tlist) {
			passportData.put(atreianPassport.getId(), atreianPassport);
			passportDataMap.put(atreianPassport.getId(), atreianPassport);
		}
	}

	public int size() {
		return passportData.size();
	}

	public AtreianPassport getAtreianPassportId(int id) {
		return passportData.get(id);
	}

	public Map<Integer, AtreianPassport> getAll() {
		return passportDataMap;
	}
}