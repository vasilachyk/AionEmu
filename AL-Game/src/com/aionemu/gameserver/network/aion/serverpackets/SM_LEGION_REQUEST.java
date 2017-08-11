package com.aionemu.gameserver.network.aion.serverpackets;

import com.aionemu.gameserver.network.aion.AionConnection;
import com.aionemu.gameserver.network.aion.AionServerPacket;

public class SM_LEGION_REQUEST extends AionServerPacket
{
    private int requesterId;
    private boolean allowed;
	
	public SM_LEGION_REQUEST(int requesterId, boolean allowed) {
    	this.requesterId = requesterId;
    	this.allowed = allowed;
    }
	
	@Override
    protected void writeImpl(AionConnection con) {
    	writeD(requesterId);
    	writeC(allowed ? 1 : 0);
    }
}