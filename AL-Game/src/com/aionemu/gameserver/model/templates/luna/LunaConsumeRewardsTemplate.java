package com.aionemu.gameserver.model.templates.luna;

import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlAttribute;
import javax.xml.bind.annotation.XmlType;

/**
 * 
 * @author Ranastic
 *
 */
@XmlType(name = "luna_consume_reward")
@XmlAccessorType(XmlAccessType.NONE)
public class LunaConsumeRewardsTemplate
{
	@XmlAttribute(name = "id", required = true)
	protected int id;
	
	@XmlAttribute(name = "name")
	protected String name;
	
	@XmlAttribute(name = "luna_sum_count", required = true)
	protected int luna_sum_count;
	
	@XmlAttribute(name = "gacha_cost")
	protected int gacha_cost;
	
	@XmlAttribute(name = "create_1")
	protected int create_1;
	
	@XmlAttribute(name = "num_1")
	protected int num_1;
	
	public int getId() {
        return this.id;
    }
	public String getName() {
		return name;
	}
	public int getSumCount() {
		return luna_sum_count;
	}
	public int getGachaCost() {
		return gacha_cost;
	}
	public int getCreateItemId() {
		return create_1;
	}
	public int getCreateItemCount() {
		return num_1;
	}
}
