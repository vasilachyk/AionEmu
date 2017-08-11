package com.aionemu.gameserver.model.templates.spawns.legiondominionspawns;

import com.aionemu.gameserver.model.legiondominion.LegionDominionModType;
import com.aionemu.gameserver.model.legiondominion.LegionDominionRace;
import com.aionemu.gameserver.model.templates.spawns.SpawnGroup2;
import com.aionemu.gameserver.model.templates.spawns.SpawnSpotTemplate;
import com.aionemu.gameserver.model.templates.spawns.SpawnTemplate;

public class LegionDominionSpawnTemplate extends SpawnTemplate
{
	private int legionDominionId;
	private LegionDominionRace legionDominionRace;
	private LegionDominionModType legionDominionModType;
	
	public LegionDominionSpawnTemplate(SpawnGroup2 spawnGroup, SpawnSpotTemplate spot) {
		super(spawnGroup, spot);
	}
	
	public LegionDominionSpawnTemplate(SpawnGroup2 spawnGroup, float x, float y, float z, byte heading, int randWalk, String walkerId, int entityId, int fly) {
		super(spawnGroup, x, y, z, heading, randWalk, walkerId, entityId, fly);
	}
	
	public int getLegionDominionId() {
		return legionDominionId;
	}
	
	public LegionDominionRace getLegionDominionRace() {
		return legionDominionRace;
	}
	
	public LegionDominionModType getLegionDominionModType() {
		return legionDominionModType;
	}
	
	public void setLegionDominionId(int legionDominionId) {
		this.legionDominionId = legionDominionId;
	}
	
	public void setLegionDominionRace(LegionDominionRace legionDominionRace) {
		this.legionDominionRace = legionDominionRace;
	}
	
	public void setLegionDominionModType(LegionDominionModType legionDominionModType) {
		this.legionDominionModType = legionDominionModType;
	}
	
	public final boolean isPeace() {
		return legionDominionModType.equals(LegionDominionModType.PEACE);
	}
	
	public final boolean isDominion() {
		return legionDominionModType.equals(LegionDominionModType.DOMINION);
	}
}