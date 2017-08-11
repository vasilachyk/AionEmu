package com.aionemu.gameserver.model.templates.spawns.landingspecialspawns;

import com.aionemu.gameserver.model.landing_special.LandingSpecialStateType;
import com.aionemu.gameserver.model.templates.spawns.SpawnGroup2;
import com.aionemu.gameserver.model.templates.spawns.SpawnSpotTemplate;
import com.aionemu.gameserver.model.templates.spawns.SpawnTemplate;

public class LandingSpecialSpawnTemplate extends SpawnTemplate
{
    private int id;
    private LandingSpecialStateType landingSpecialType;
	
    public LandingSpecialSpawnTemplate(SpawnGroup2 spawnGroup, SpawnSpotTemplate spot) {
        super(spawnGroup, spot);
    }
	
    public LandingSpecialSpawnTemplate(SpawnGroup2 spawnGroup, float x, float y, float z, byte heading, int randWalk, String walkerId, int entityId, int fly) {
        super(spawnGroup, x, y, z, heading, randWalk, walkerId, entityId, fly);
    }
	
    public int getId() {
        return id;
    }
	
    public LandingSpecialStateType getFStateType() {
        return landingSpecialType;
    }
	
    public void setId(int id) {
        this.id = id;
    }
	
    public void setFStateType(LandingSpecialStateType landingSpecialType) {
        this.landingSpecialType = landingSpecialType;
    }
	
    public final boolean isSpecialLandingSpawn() {
        return landingSpecialType.equals(LandingSpecialStateType.SPAWN);
    }
	
    public final boolean isSpecialLandingDespawn() {
        return landingSpecialType.equals(LandingSpecialStateType.DESPAWN);
    }
}