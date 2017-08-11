package com.aionemu.gameserver.network.aion.serverpackets;

import com.aionemu.gameserver.network.aion.AionConnection;
import com.aionemu.gameserver.network.aion.AionServerPacket;

public class SM_LEGION_REQUEST_INFO extends AionServerPacket {

    private int legionId;
    private String legionName;
	
	public SM_LEGION_REQUEST_INFO(int legionId, String legionName) {
    	this.legionId = legionId;
    	this.legionName = legionName;
    }
	
	@Override
    protected void writeImpl(AionConnection con) {
    	writeD(legionId);
    	writeS(legionName);
    }
}