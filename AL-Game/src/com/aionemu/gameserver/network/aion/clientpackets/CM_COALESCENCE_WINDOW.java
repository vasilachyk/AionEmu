package com.aionemu.gameserver.network.aion.clientpackets;

import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.network.aion.AionClientPacket;
import com.aionemu.gameserver.network.aion.AionConnection.State;
import com.aionemu.gameserver.network.aion.serverpackets.SM_COALESCENCE_WINDOW;
import com.aionemu.gameserver.utils.PacketSendUtility;

public class CM_COALESCENCE_WINDOW extends AionClientPacket {
	
	public CM_COALESCENCE_WINDOW (int opcode, State state, State... restStates) {
		super (opcode, state, restStates);
	}

	@Override
	protected void readImpl() {
		// TODO Auto-generated method stub
	}

	@Override
	protected void runImpl() {
		Player player = getConnection().getActivePlayer();
		if(player != null) {
			PacketSendUtility.sendPacket(player, new SM_COALESCENCE_WINDOW());
		} else {}
	}
	
}
