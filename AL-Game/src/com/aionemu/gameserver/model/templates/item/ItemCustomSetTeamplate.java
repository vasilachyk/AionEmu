package com.aionemu.gameserver.model.templates.item;

import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlAttribute;
import javax.xml.bind.annotation.XmlRootElement;

@XmlAccessorType(XmlAccessType.FIELD)
@XmlRootElement(name="ItemCustomSetTeamplate")
public class ItemCustomSetTeamplate
{
    @XmlAttribute(name = "id")
    private int id;
	
    @XmlAttribute(name = "name")
    private String name;
	
    @XmlAttribute(name = "custom_enchant_value")
    private int custom_enchant_value;
	
    public int getId() {
        return this.id;
    }
	
    public String getName() {
        return this.name;
    }
	
    public int getCustomEnchantValue() {
        return this.custom_enchant_value;
    }
}