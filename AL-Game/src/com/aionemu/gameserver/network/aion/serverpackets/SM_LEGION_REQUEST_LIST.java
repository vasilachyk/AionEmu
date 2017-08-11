package com.aionemu.gameserver.network.aion.serverpackets;

import java.util.Collection;

import com.aionemu.gameserver.model.team.legion.LegionJoinRequest;
import com.aionemu.gameserver.network.aion.AionConnection;
import com.aionemu.gameserver.network.aion.AionServerPacket;

public class SM_LEGION_REQUEST_LIST extends AionServerPacket
{
    private Collection<LegionJoinRequest> ljrList;
	
	public SM_LEGION_REQUEST_LIST(Collection<LegionJoinRequest> ljrList) {
    	this.ljrList = ljrList;
    }
	
	@Override
    protected void writeImpl(AionConnection con) {
		writeH(-ljrList.size());
		for (LegionJoinRequest ljr : ljrList) {
			writeD(ljr.getPlayerId());
	    	writeS(ljr.getPlayerName());
	    	writeC(ljr.getPlayerClass());
	    	writeC(ljr.getGenderId());
	    	writeH(ljr.getLevel());
	    	writeS(ljr.getMsg());
	    	writeD((int) ljr.getDate().getTime());
		}
    }
}