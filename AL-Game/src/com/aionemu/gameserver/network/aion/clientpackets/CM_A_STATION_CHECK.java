package com.aionemu.gameserver.network.aion.clientpackets;

import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.network.aion.AionClientPacket;
import com.aionemu.gameserver.network.aion.AionConnection.State;
import com.aionemu.gameserver.services.AStationService;

public class CM_A_STATION_CHECK extends AionClientPacket
{
    private int accountId;
	
    public CM_A_STATION_CHECK(int opcode, State state, State... restStates) {
        super(opcode, state, restStates);
    }
	
    @Override
    protected void readImpl() {
        accountId = readD();
    }
	
    @Override
    protected void runImpl() {
        final Player player = this.getConnection().getActivePlayer();
        if (player.isOnAStation()) {
            AStationService.getInstance().checkAStationMove(player, accountId, true);
        } else {
            AStationService.getInstance().checkAStationMove(player, accountId, false);
        }
    }
}