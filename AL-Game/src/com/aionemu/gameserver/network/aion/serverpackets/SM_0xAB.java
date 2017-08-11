package com.aionemu.gameserver.network.aion.serverpackets;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import com.aionemu.gameserver.network.aion.AionConnection;
import com.aionemu.gameserver.network.aion.AionServerPacket;

public class SM_0xAB extends AionServerPacket {

	private int unk;
	private int unk1;
	private static final Logger log = LoggerFactory.getLogger(SM_0xAB.class);
	
	public SM_0xAB(int unk, int unk1) {
		this.unk = unk;
		this.unk1 = unk1;
	}
	
	@Override
    protected void writeImpl(AionConnection con) {
		// This H 0~1 Random what Packet?
		writeH(unk);
		log.info("SM_0xAB unk : "+unk+ " unk1 "+unk1);
		writeC(unk1);
	}
}
