package com.aionemu.gameserver.network.aion.clientpackets;

import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.network.aion.AionClientPacket;
import com.aionemu.gameserver.network.aion.AionConnection;
import com.aionemu.gameserver.services.territory.TerritoryService;

public class CM_STONESPEAR_SIEGE extends AionClientPacket
{
    public CM_STONESPEAR_SIEGE(int opcode, AionConnection.State state, AionConnection.State... restStates) {
        super(opcode, state, restStates);
    }
	
    @Override
    protected void readImpl() {
        readD();
    }
	
    @Override
    protected void runImpl() {
        Player player = getConnection().getActivePlayer();
        if (player.getLegion() != null && player.getLegion().getTerritory().getId() > 0) {
            TerritoryService.getInstance().sendStoneSpearPacket(getConnection().getActivePlayer());
		}
    }
}