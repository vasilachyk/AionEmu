package com.aionemu.gameserver.dataholders;

import java.util.HashMap;
import java.util.List;
import java.util.Map;

import javax.xml.bind.Unmarshaller;
import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlRootElement;
import javax.xml.bind.annotation.XmlTransient;

import com.aionemu.gameserver.model.templates.luna.LunaConsumeRewardsTemplate;

import gnu.trove.map.hash.TIntObjectHashMap;

/**
 * 
 * @author Ranastic
 *
 */
@XmlRootElement(name = "luna_consume_rewards")
@XmlAccessorType(XmlAccessType.FIELD)
public class LunaConsumeRewardsData {

	@XmlElement(name="luna_consume_reward")
	private List<LunaConsumeRewardsTemplate> lunaList;
	
	@XmlTransient
	private TIntObjectHashMap<LunaConsumeRewardsTemplate> lunaData = new TIntObjectHashMap<LunaConsumeRewardsTemplate>();
	
	@XmlTransient
	private TIntObjectHashMap<LunaConsumeRewardsTemplate> lunaConsumeCountData = new TIntObjectHashMap<LunaConsumeRewardsTemplate>();
	
	@XmlTransient
	private Map<Integer, LunaConsumeRewardsTemplate> lunaDataMap = new HashMap<Integer, LunaConsumeRewardsTemplate>(1);
	
	void afterUnmarshal(Unmarshaller paramUnmarshaller, Object paramObject) {
		for (LunaConsumeRewardsTemplate lunaConsume: lunaList) {
			lunaData.put(lunaConsume.getId(), lunaConsume);
			lunaConsumeCountData.put(lunaConsume.getSumCount(), lunaConsume);
			lunaDataMap.put(lunaConsume.getId(), lunaConsume);
		}
	}
	
	public int size() {
		return lunaData.size();
	}
	
	public LunaConsumeRewardsTemplate getLunaConsumeRewardsId(int id) {
		return lunaData.get(id);
	}
	
	public LunaConsumeRewardsTemplate getLunaConsumeRewardsBypoint(int point) {
		return lunaConsumeCountData.get(point);
	}
	
	public Map<Integer, LunaConsumeRewardsTemplate> getAll() {
		return lunaDataMap;
	}
}
