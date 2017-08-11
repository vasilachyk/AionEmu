package com.aionemu.gameserver.model.legiondominion;

import com.aionemu.gameserver.model.*;

public enum LegionDominionRace
{
	ELYOS(0, 1800481),
	ASMODIANS(1, 1800483),
	BALAUR(2, 1800485);
	
	private int raceId;
	private DescriptionId descriptionId;
	
	private LegionDominionRace(int id, int descriptionId) {
		this.raceId = id;
		this.descriptionId = new DescriptionId(descriptionId);
	}
	
	public int getRaceId() {
		return this.raceId;
	}
	
	public static LegionDominionRace getByRace(Race race) {
		switch (race){
			case ASMODIANS:
				return LegionDominionRace.ASMODIANS;
			case ELYOS:
				return LegionDominionRace.ELYOS;
			default:
				return LegionDominionRace.BALAUR;
		}
	}
	
	public DescriptionId getDescriptionId() {
		return descriptionId;
	}
}