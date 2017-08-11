package com.aionemu.gameserver.model.templates.landing;

import com.aionemu.gameserver.model.Race;

import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlAttribute;
import javax.xml.bind.annotation.XmlType;

@XmlAccessorType(XmlAccessType.FIELD)
@XmlType(name = "landing")
public class LandingTemplate
{
    @XmlAttribute(name = "id")
    protected int id;
	
    @XmlAttribute(name = "name")
    protected String nameId;
	
    @XmlAttribute(name = "race")
    protected Race race;
	
    public int getId() {
        return this.id;
    }
	
    public String getName() {
        return nameId;
    }
	
    public Race getRace() {
        return race;
    }
}