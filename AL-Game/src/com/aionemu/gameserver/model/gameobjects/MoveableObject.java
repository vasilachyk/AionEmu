package com.aionemu.gameserver.model.gameobjects;

import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.model.house.House;
import com.aionemu.gameserver.model.templates.housing.HousingMoveableItem;

public class MoveableObject extends HouseObject<HousingMoveableItem> {

	public MoveableObject(House owner, int objId, int templateId) {
		super(owner, objId, templateId);
	}

	public void onUse(Player player) {
	}

	@Override
	public boolean canExpireNow() {
		return true;
	}
}
