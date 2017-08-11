package com.aionemu.gameserver.dao;

import com.aionemu.commons.database.dao.DAO;
import com.aionemu.gameserver.model.dorinerk_wardrobe.PlayerWardrobeList;
import com.aionemu.gameserver.model.gameobjects.player.Player;

public abstract class PlayerWardrobeDAO implements DAO {

	@Override
	public String getClassName() {
		return PlayerWardrobeDAO.class.getName();
	}

	public abstract PlayerWardrobeList load(Player paramPlayer);
	public abstract boolean store(int paramInt1, int paramInt2, int paramInt3, int reskin);
	public abstract boolean delete(int paramInt, int paramInt2);
	public abstract int getItemSize(int playerId);
	public abstract int getWardrobeItemBySlot(int playerObjId, int slot);
	public abstract int getReskinCountBySlot(int playerObjId, int slot);
	public abstract boolean setReskinCountBySlot(int playerObjId, int slot, int reskin_count);
}
