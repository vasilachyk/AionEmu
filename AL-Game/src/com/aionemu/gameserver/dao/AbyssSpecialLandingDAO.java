package com.aionemu.gameserver.dao;

import java.util.Map;

import com.aionemu.commons.database.dao.DAO;
import com.aionemu.gameserver.model.landing_special.LandingSpecialLocation;

public abstract class AbyssSpecialLandingDAO implements DAO
{
    public abstract boolean loadLandingSpecialLocations(Map<Integer, LandingSpecialLocation> locations);
    public abstract void store(LandingSpecialLocation location);
    public abstract boolean updateLandingSpecialLocation(LandingSpecialLocation location);
    
	public void updateLocation(final LandingSpecialLocation location) {
        updateLandingSpecialLocation(location);
    }
	
    @Override
    public String getClassName() {
        return AbyssSpecialLandingDAO.class.getName();
    }
}