package com.aionemu.gameserver.dao;

import com.aionemu.commons.database.dao.DAO;
import com.aionemu.gameserver.model.landing.LandingLocation;

import java.util.Map;

public abstract class AbyssLandingDAO implements DAO
{
    public abstract boolean loadLandingLocations(Map<Integer, LandingLocation> locations);
    public abstract void store(LandingLocation location);
    public abstract boolean updateLandingLocation(LandingLocation location);
    
	public void updateLocation(final LandingLocation location) {
        updateLandingLocation(location);
    }
	
    @Override
    public String getClassName() {
        return AbyssLandingDAO.class.getName();
    }
}