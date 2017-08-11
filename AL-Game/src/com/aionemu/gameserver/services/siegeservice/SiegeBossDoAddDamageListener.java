package com.aionemu.gameserver.services.siegeservice;

import com.aionemu.gameserver.controllers.attack.AggroList.AddDamageValueCallback;
import com.aionemu.gameserver.model.gameobjects.Creature;

public class SiegeBossDoAddDamageListener extends AddDamageValueCallback {

	private final Siege siege;

	public SiegeBossDoAddDamageListener(Siege siege) {
		this.siege = siege;
	}

	@Override
	public void onDamageAdded(Creature creature, int hate) {
		siege.addBossDamage(creature, hate);
	}
}
