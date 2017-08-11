package com.aionemu.gameserver.network.aion.serverpackets;

import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.network.aion.AionConnection;
import com.aionemu.gameserver.network.aion.AionServerPacket;

/**
 * @author Ranastic
 */
public class SM_USE_ROBOT extends AionServerPacket {

	private Player player;
	private int robotInfo;

	public SM_USE_ROBOT(Player player, int robotInfo) {
		this.player = player;
		this.robotInfo = robotInfo;
	}

	@Override
	protected void writeImpl(AionConnection con) {
		writeD(player.getObjectId());
		writeD(robotInfo);
	}
}
