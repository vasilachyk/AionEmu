package com.aionemu.gameserver.network.aion.serverpackets;

import com.aionemu.gameserver.model.team.legion.*;
import com.aionemu.gameserver.network.aion.AionConnection;
import com.aionemu.gameserver.network.aion.AionServerPacket;
import com.aionemu.gameserver.services.*;

import javolution.util.FastList;

public class SM_LEGION_SEARCH extends AionServerPacket
{
    private FastList<Legion> legions;
	
	public SM_LEGION_SEARCH(FastList<Legion> legions) {
    	this.legions = legions;
    }
	
	@Override
    protected void writeImpl(AionConnection con) {
    	writeH(-legions.size());
		for (Legion legion : legions) {
			writeD(legion.getLegionId());
			writeS(legion.getLegionName());
			writeS(LegionService.getInstance().getBrigadeGeneralName(legion));
			writeC(legion.getLegionLevel());
			writeD(legion.getLegionMembers().size());
			writeS(legion.getLegionDescription());
			writeC(legion.getLegionJoinType());
			writeH(legion.getMinLevel());
    	}
    }
}