package com.aionemu.gameserver.network.aion.clientpackets;

import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.network.aion.AionClientPacket;
import com.aionemu.gameserver.network.aion.AionConnection.State;
import com.aionemu.gameserver.services.*;

public class CM_SHOW_MAP extends AionClientPacket
{
	public CM_SHOW_MAP(int opcode, State state, State... restStates) {
	    super(opcode, state, restStates);
	}
	
	@Override
	protected void readImpl() {
	}
	
	@Override
	protected void runImpl() {
	    Player player = getConnection().getActivePlayer();
		ProtectorConquerorService.getInstance().updateIcons(player);
	}
}