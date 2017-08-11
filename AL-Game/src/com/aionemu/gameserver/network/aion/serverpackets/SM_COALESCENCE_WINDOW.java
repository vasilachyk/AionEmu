package com.aionemu.gameserver.network.aion.serverpackets;

import com.aionemu.gameserver.network.aion.AionConnection;
import com.aionemu.gameserver.network.aion.AionServerPacket;

public class SM_COALESCENCE_WINDOW extends AionServerPacket {
	protected void writeImpl (AionConnection con) {
		writeD(0x00);
	}
}
