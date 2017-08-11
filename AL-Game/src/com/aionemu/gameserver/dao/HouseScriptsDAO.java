package com.aionemu.gameserver.dao;

import com.aionemu.commons.database.dao.DAO;
import com.aionemu.gameserver.model.gameobjects.player.PlayerScripts;

public abstract class HouseScriptsDAO implements DAO {

	@Override
	public final String getClassName() {
		return HouseScriptsDAO.class.getName();
	}

	public abstract PlayerScripts getPlayerScripts(int paramInt);

	public abstract void addScript(int paramInt1, int paramInt2, String paramString);

	public abstract void updateScript(int paramInt1, int paramInt2, String paramString);

	public abstract void deleteScript(int paramInt1, int paramInt2);
}
