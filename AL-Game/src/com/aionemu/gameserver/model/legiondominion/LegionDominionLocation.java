package com.aionemu.gameserver.model.legiondominion;

import java.util.*;

import com.aionemu.gameserver.model.templates.legiondominion.LegionDominionTemplate;

public class LegionDominionLocation
{
	protected LegionDominionTemplate template;
	protected LegionDominionRace legionDominionRace = LegionDominionRace.BALAUR;
	
	public LegionDominionLocation() {
	}
	
	public LegionDominionLocation(LegionDominionTemplate template) {
		this.template = template;
	}
	
	public LegionDominionTemplate getTemplate() {
		return template;
	}
	
	public int getLegionDominionId() {
		return template.getLegionDominionId();
	}
	
	public String getName() {
		return template.getName();
	}
	
	public int getWorldId() {
		return template.getWorldId();
	}
	
	public LegionDominionRace getRace() {
		return this.legionDominionRace;
	}
	
	public void setRace(LegionDominionRace legionDominionRace) {
		this.legionDominionRace = legionDominionRace;
	}
}