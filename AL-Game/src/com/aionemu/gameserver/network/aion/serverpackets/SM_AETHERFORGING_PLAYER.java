package com.aionemu.gameserver.network.aion.serverpackets;

import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.network.aion.AionConnection;
import com.aionemu.gameserver.network.aion.AionServerPacket;

/**
 * @author Ranastic
 */
public class SM_AETHERFORGING_PLAYER extends AionServerPacket
{
	private int playerObjId;
	private int type;
	
	public SM_AETHERFORGING_PLAYER(Player player, int type) {
		this.playerObjId = player.getObjectId();
		this.type = type;
	}
	
	@Override
	protected void writeImpl(AionConnection client) {
		writeD(playerObjId);
		writeC(type);
	}
}
