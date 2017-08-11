package com.aionemu.gameserver.dao;

import com.aionemu.commons.database.dao.DAO;
import com.aionemu.gameserver.model.gameobjects.player.Player;

/**
 * Created by wanke on 13/02/2017.
 */

public abstract class PlayerLunaShopDAO implements DAO
{
    @Override
    public String getClassName() {
        return PlayerLunaShopDAO.class.getName();
    }
	
    public abstract void load(Player player);
    public abstract boolean add(final int playerId, boolean freeUnderpath, boolean freeFactory, boolean freeChest);
    public abstract boolean delete();
    public abstract boolean store(Player player);
    public abstract boolean setLunaShopByObjId(final int obj, boolean freeUnderpath, boolean freeFactory, boolean freeChest);
}