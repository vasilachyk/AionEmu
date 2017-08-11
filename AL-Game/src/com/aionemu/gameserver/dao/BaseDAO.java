package com.aionemu.gameserver.dao;

import com.aionemu.commons.database.dao.DAO;
import com.aionemu.gameserver.model.base.BaseLocation;

import java.util.Map;

public abstract class BaseDAO implements DAO
{
    public abstract boolean loadBaseLocations(Map<Integer, BaseLocation> locations);
    public abstract boolean updateBaseLocation(BaseLocation location);
    
	public void updateLocation(final BaseLocation location) {
        updateBaseLocation(location);
    }
	
    @Override
    public String getClassName() {
        return BaseDAO.class.getName();
    }
}