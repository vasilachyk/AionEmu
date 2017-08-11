package com.aionemu.gameserver.network.aion.clientpackets;

import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.network.aion.AionClientPacket;
import com.aionemu.gameserver.network.aion.AionConnection.State;
import com.aionemu.gameserver.services.BrokerService;

public class CM_BROKER_SETTLE_ACCOUNT extends AionClientPacket
{
    @SuppressWarnings("unused")
    private int npcId;
	
    public CM_BROKER_SETTLE_ACCOUNT(int opcode, State state, State... restStates) {
        super(opcode, state, restStates);
    }
	
    @Override
    protected void readImpl() {
        npcId = readD();
		readH();
    }
	
    @Override
    protected void runImpl() {
        Player player = getConnection().getActivePlayer();
		BrokerService.getInstance().showSettledItems(player);
    }
}