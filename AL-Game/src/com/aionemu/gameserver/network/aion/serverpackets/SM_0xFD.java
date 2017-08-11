package com.aionemu.gameserver.network.aion.serverpackets;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import com.aionemu.gameserver.network.aion.AionConnection;
import com.aionemu.gameserver.network.aion.AionServerPacket;

public class SM_0xFD extends AionServerPacket {

	private int unk;
	private static final Logger log = LoggerFactory.getLogger(SM_0xFD.class);
	
	public SM_0xFD(int unk) {
		this.unk = unk;
	}
	
	@Override
    protected void writeImpl(AionConnection con) {
		// This H 1~2 Random what Packet?
		writeH(unk);
		log.info("SM_0xFD : "+unk);
		writeC(0);
	}
}
