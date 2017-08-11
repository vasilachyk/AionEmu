package com.aionemu.gameserver.dao;

import com.aionemu.commons.database.dao.DAO;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.model.gameobjects.player.PlayerPassports;

/**
 * @author Ranastic
 */

public abstract class PlayerPassportsDAO implements DAO
{
	@Override
	public String getClassName() {
		return PlayerPassportsDAO.class.getName();
	}

	public abstract PlayerPassports load(Player player);

	public abstract void store(Player player);
}