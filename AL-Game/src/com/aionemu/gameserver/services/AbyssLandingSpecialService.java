package com.aionemu.gameserver.services;

import com.aionemu.commons.database.dao.DAOManager;
import com.aionemu.gameserver.dao.AbyssSpecialLandingDAO;
import com.aionemu.gameserver.dataholders.DataManager;
import com.aionemu.gameserver.model.TaskId;
import com.aionemu.gameserver.model.gameobjects.Npc;
import com.aionemu.gameserver.model.gameobjects.VisibleObject;
import com.aionemu.gameserver.model.landing_special.LandingSpecialLocation;
import com.aionemu.gameserver.model.landing_special.LandingSpecialStateType;
import com.aionemu.gameserver.model.templates.spawns.SpawnGroup2;
import com.aionemu.gameserver.model.templates.spawns.SpawnTemplate;
import com.aionemu.gameserver.model.templates.spawns.landingspecialspawns.LandingSpecialSpawnTemplate;
import com.aionemu.gameserver.services.abysslandingservice.landingspecialservice.SPLanding;
import com.aionemu.gameserver.services.abysslandingservice.landingspecialservice.SpecialLanding;
import com.aionemu.gameserver.spawnengine.SpawnEngine;
import javolution.util.FastMap;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import java.util.*;

public class AbyssLandingSpecialService
{
    private static Logger log = LoggerFactory.getLogger(AbyssLandingService.class);
    private static Map<Integer, LandingSpecialLocation> abyssSpecialLanding;
    private final Map<Integer, SpecialLanding<?>> activeSpecialLanding = new FastMap<Integer, SpecialLanding<?>>().shared();
	
    public void initLandingSpecialLocations() {
        abyssSpecialLanding = DataManager.LANDING_SPECIAL_LOCATION_DATA.getLandingSpecialLocations();
        for (LandingSpecialLocation loc: getLandingSpecialLocations().values()) {
            spawn(loc, LandingSpecialStateType.DESPAWN);
        }
        log.info("[Abyss Landing Monument] Loaded " + abyssSpecialLanding.size() + " Locations");
    }
	
    public void startLanding(final int id) {
        final SpecialLanding<?> land;
        synchronized (this) {
            if (activeSpecialLanding.containsKey(id)) {
                return;
            }
            land = new SPLanding(abyssSpecialLanding.get(id));
            activeSpecialLanding.put(id, land);
        }
        land.start();
    }
	
    public void stopLanding(int id) {
        if (!activeSpecialLanding.containsKey(id)) {
            return;
        }
        SpecialLanding<?> landing;
        synchronized (this) {
            landing = activeSpecialLanding.remove(id);
        } if (landing == null) {
            return;
        }
        landing.stop();
    }
	
    public static void spawn(LandingSpecialLocation loc, LandingSpecialStateType fstate) {
        if (fstate.equals(LandingSpecialStateType.SPAWN)) {
        }
        List<SpawnGroup2> locSpawns = DataManager.SPAWNS_DATA2.getLandingSpecialSpawnsByLocId(loc.getId());
        for (SpawnGroup2 group: locSpawns) {
            for (SpawnTemplate st: group.getSpawnTemplates()) {
                LandingSpecialSpawnTemplate landingtTemplate = (LandingSpecialSpawnTemplate) st;
                if (landingtTemplate.getFStateType().equals(fstate)) {
                    loc.getSpawned().add(SpawnEngine.spawnObject(landingtTemplate, 1));
                }
            }
        }
    }
	
    public static void onSave(LandingSpecialLocation loc) {
        getDAO().updateLocation(loc);
    }
	
    public static void despawn(LandingSpecialLocation loc) {
        for (VisibleObject npc : loc.getSpawned()) {
            ((Npc) npc).getController().cancelTask(TaskId.RESPAWN);
            npc.getController().onDelete();
        }
        loc.getSpawned().clear();
    }
	
    public static AbyssLandingSpecialService getInstance() {
        return AbyssLandingSpecialService.SingletonHolder.instance;
    }
	
    private static class SingletonHolder {
        protected static final AbyssLandingSpecialService instance = new AbyssLandingSpecialService();
    }
	
    public LandingSpecialLocation getLandingSpecialLocation(int id) {
        return abyssSpecialLanding.get(id);
    }
	
    public static Map<Integer, LandingSpecialLocation> getLandingSpecialLocations() {
        return abyssSpecialLanding;
    }
	
    public static AbyssSpecialLandingDAO getDAO() {
        return DAOManager.getDAO(AbyssSpecialLandingDAO.class);
    }
}