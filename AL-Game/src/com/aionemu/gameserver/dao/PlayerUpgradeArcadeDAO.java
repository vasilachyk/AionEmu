package com.aionemu.gameserver.dao;

import com.aionemu.commons.database.dao.DAO;
import com.aionemu.gameserver.model.gameobjects.player.Player;

/**
*
* @author Ranastic
*/
public abstract class PlayerUpgradeArcadeDAO implements DAO {
	
	@Override
	public String getClassName() {
		return PlayerUpgradeArcadeDAO.class.getName();
	}
	
	public abstract void load(Player player);
	
	public abstract boolean addUpgradeArcade(final int playerId, final int frenzy_meter, final int upgrade_lvl);
	
	public abstract boolean delUpgradeArcade(final int playerId, final int frenzy_meter, final int upgrade_lvl);
	
	public abstract boolean store(Player player);
	
	public abstract boolean setFrenzyMeterByObjId(final int obj, final int frenzy_meter);
	
	public abstract boolean setUpgradeLvlByObjId(final int obj, final int upgrade_lvl);
	
	public abstract int getFrenzyMeterByObjId(final int obj);
	
	public abstract int getUpgradeLvlByObjId(final int obj);
}
