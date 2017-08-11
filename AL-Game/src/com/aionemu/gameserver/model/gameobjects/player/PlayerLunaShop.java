package com.aionemu.gameserver.model.gameobjects.player;

import com.aionemu.commons.database.dao.DAOManager;
import com.aionemu.gameserver.dao.PlayerLunaShopDAO;
import com.aionemu.gameserver.dao.PlayerUpgradeArcadeDAO;
import com.aionemu.gameserver.model.gameobjects.PersistentState;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

/**
 * Created by wanke on 13/02/2017.
 */

public class PlayerLunaShop
{
    Logger log = LoggerFactory.getLogger(PlayerLunaShop.class);
    private PersistentState persistentState;
	
    private boolean FreeUnderpath;
    private boolean FreeFactory;
    private boolean FreeChest;
	
    public PlayerLunaShop(boolean freeUnderpath, boolean freeFactory, boolean freeChest) {
        this.FreeUnderpath = freeUnderpath;
        this.FreeFactory = freeFactory;
        this.FreeChest = freeChest;
        this.persistentState = PersistentState.NEW;
    }
	
    public PlayerLunaShop() {
    }
	
    public boolean isFreeUnderpath() {
        return FreeUnderpath;
    }
	
    public void setFreeUnderpath(boolean free) {
        this.FreeUnderpath = free;
    }
	
    public boolean isFreeFactory() {
        return FreeFactory;
    }
	
    public void setFreeFactory(boolean free) {
        this.FreeFactory = free;
    }
	
    public boolean isFreeChest() {
        return FreeChest;
    }
	
    public void setFreeChest(boolean free) {
        this.FreeChest = free;
    }
	
    public PersistentState getPersistentState() {
        return persistentState;
    }
	
    public void setLunaShopByObjId(int playerId) {
        DAOManager.getDAO(PlayerLunaShopDAO.class).setLunaShopByObjId(playerId, isFreeUnderpath(), isFreeFactory(), isFreeChest());
    }
	
    public void setPersistentState(PersistentState persistentState) {
        switch (persistentState) {
            case UPDATE_REQUIRED:
                if (this.persistentState == PersistentState.NEW)
                    break;
            default:
                this.persistentState = persistentState;
        }
    }
}