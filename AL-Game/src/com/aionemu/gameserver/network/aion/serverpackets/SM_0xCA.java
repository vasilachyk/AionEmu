package com.aionemu.gameserver.network.aion.serverpackets;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import com.aionemu.gameserver.network.aion.AionConnection;
import com.aionemu.gameserver.network.aion.AionServerPacket;

public class SM_0xCA extends AionServerPacket {

	private int unk;
	private int unk1;
	private static final Logger log = LoggerFactory.getLogger(SM_0xCA.class);
	
	public SM_0xCA(int unk, int unk1) {
		this.unk = unk;
		this.unk1 = unk1;
	}
	
	@Override
    protected void writeImpl(AionConnection con) {
		// this 256~257 random
		writeD(unk);
		writeH(unk1);
		log.info("SM_0xCA unk : "+unk);
	}
}
