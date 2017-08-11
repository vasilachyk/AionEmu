package com.aionemu.gameserver.dao;

import com.aionemu.commons.database.dao.DAO;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.model.skill.linked_skill.PlayerEquippedStigmaList;

public abstract class PlayerStigmasEquippedDAO implements DAO {

	@Override
	public final String getClassName() {
		return PlayerStigmasEquippedDAO.class.getName();
	}

	public abstract PlayerEquippedStigmaList loadItemsList(int playerId);

	public abstract boolean storeItems(Player player);

}
