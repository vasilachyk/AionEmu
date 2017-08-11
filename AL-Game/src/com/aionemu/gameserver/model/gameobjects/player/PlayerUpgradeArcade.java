package com.aionemu.gameserver.model.gameobjects.player;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import com.aionemu.commons.database.dao.DAOManager;
import com.aionemu.gameserver.dao.PlayerUpgradeArcadeDAO;
import com.aionemu.gameserver.model.gameobjects.PersistentState;

/**
 * @author Ranastic
 */

public class PlayerUpgradeArcade
{
	Logger log = LoggerFactory.getLogger(PlayerUpgradeArcade.class);
	int frenzyMeter;
	int upgradeLvl;
	private PersistentState persistentState;
	
	public PlayerUpgradeArcade(int frenzyMeter, int upgradeLvl) {
		this.frenzyMeter = frenzyMeter;
		this.upgradeLvl = upgradeLvl;
		this.persistentState = PersistentState.NEW;
	}
	
	public void setFrenzyMeter(int meter) {
		this.frenzyMeter = meter;
	}
	
	public int getFrenzyMeter() {
		return frenzyMeter;
	}
	
	public void setUpgradeLvl(int upgradeLvl) {
		this.upgradeLvl = upgradeLvl;
	}

	public int getUpgradeLvl() {
		return upgradeLvl;
	}
	
	public PlayerUpgradeArcade() {
	}
	
	public void setFrenzyMeterByObjId(int playerId) {
		DAOManager.getDAO(PlayerUpgradeArcadeDAO.class).setFrenzyMeterByObjId(playerId, getFrenzyMeter());
	}
	
	public void setUpgradeLvlByObjId(int playerId) {
		DAOManager.getDAO(PlayerUpgradeArcadeDAO.class).setUpgradeLvlByObjId(playerId, getUpgradeLvl());
	}
	
	public PersistentState getPersistentState() {
		return persistentState;
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