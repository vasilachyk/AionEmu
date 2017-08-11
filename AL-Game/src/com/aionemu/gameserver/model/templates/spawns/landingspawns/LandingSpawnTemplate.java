package com.aionemu.gameserver.model.templates.spawns.landingspawns;

import com.aionemu.gameserver.model.landing.LandingStateType;
import com.aionemu.gameserver.model.templates.spawns.SpawnGroup2;
import com.aionemu.gameserver.model.templates.spawns.SpawnSpotTemplate;
import com.aionemu.gameserver.model.templates.spawns.SpawnTemplate;

public class LandingSpawnTemplate extends SpawnTemplate
{
    private int id;
    private LandingStateType landingType;
	
    public LandingSpawnTemplate(SpawnGroup2 spawnGroup, SpawnSpotTemplate spot) {
        super(spawnGroup, spot);
    }
	
    public LandingSpawnTemplate(SpawnGroup2 spawnGroup, float x, float y, float z, byte heading, int randWalk, String walkerId, int entityId, int fly) {
        super(spawnGroup, x, y, z, heading, randWalk, walkerId, entityId, fly);
    }
	
    public int getId() {
        return id;
    }
	
    public LandingStateType getEStateType() {
        return landingType;
    }
	
    public void setId(int id) {
        this.id = id;
    }
	
    public void setEStateType(LandingStateType landingLevel) {
        this.landingType = landingLevel;
    }
	
    public final boolean isLandingOpen() {
        return !landingType.equals(LandingStateType.NONE);
    }
	
    public final boolean isLandingClosed() {
        return landingType.equals(LandingStateType.NONE);
    }
}