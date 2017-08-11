package com.aionemu.gameserver.model.templates.vortex;

import com.aionemu.gameserver.model.Race;
import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlAttribute;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlType;

@XmlAccessorType(XmlAccessType.FIELD)
@XmlType(name = "Vortex")
public class VortexTemplate
{
	@XmlAttribute(name = "id")
	protected int id;
	
	@XmlAttribute(name = "defends_race")
	protected Race dRace;
	
	@XmlAttribute(name = "offence_race")
	protected Race oRace;
	
	@XmlElement(name = "home_point")
	protected HomePoint home;
	
	@XmlElement(name = "resurrection_point")
	protected ResurrectionPoint resurrection;
	
	@XmlElement(name = "start_point")
	protected StartPoint start;
	
	public int getId() {
		return this.id;
	}
	
	public Race getDefendersRace() {
		return this.dRace;
	}
	
	public Race getInvadersRace() {
		return this.oRace;
	}
	
	public HomePoint getHomePoint() {
		return home;
	}
	
	public ResurrectionPoint getResurrectionPoint() {
		return resurrection;
	}
	
	public StartPoint getStartPoint() {
		return start;
	}
}