package com.aionemu.gameserver.network.aion.serverpackets;

import com.aionemu.gameserver.model.team.legion.Legion;
import com.aionemu.gameserver.network.aion.AionConnection;
import com.aionemu.gameserver.network.aion.AionServerPacket;

public class SM_STONESPEAR_SIEGE extends AionServerPacket
{
    Legion legion;
    int type = 0;
	
    public SM_STONESPEAR_SIEGE(Legion legion, int type) {
        this.legion = legion;
        this.type = type;
    }
	
    @Override
    protected void writeImpl(AionConnection con) {
        writeD(legion.getTerritory().getId());
        writeC(type);
        writeH(0);
    }
}