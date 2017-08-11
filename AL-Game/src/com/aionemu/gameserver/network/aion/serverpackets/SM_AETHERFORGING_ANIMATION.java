package com.aionemu.gameserver.network.aion.serverpackets;

import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.network.aion.AionConnection;
import com.aionemu.gameserver.network.aion.AionServerPacket;

/**
 * @author Ranastic
 */
public class SM_AETHERFORGING_ANIMATION extends AionServerPacket
{
	private int recipeId;
	private int barTime;
	private int type;
	
	public SM_AETHERFORGING_ANIMATION(Player player, int recipeId, int barTime, int type) {
		this.recipeId = recipeId;
		this.barTime = barTime;
		this.type = type;
	}
	
	@Override
	protected void writeImpl(AionConnection client) {
		writeC(type);
		writeD(recipeId);
		writeD(barTime);
	}
}
