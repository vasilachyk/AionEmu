package com.aionemu.gameserver.network.aion.clientpackets;

import com.aionemu.gameserver.configs.main.CustomConfig;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.network.aion.AionClientPacket;
import com.aionemu.gameserver.network.aion.AionConnection.State;
import com.aionemu.gameserver.services.reward.RewardService;

public class CM_PLAYER_LISTENER extends AionClientPacket {

	public CM_PLAYER_LISTENER(int opcode, State state, State... restStates) {
		super(opcode, state, restStates);
	}

	protected void readImpl() {
	}

	protected void runImpl() {
		Player player = getConnection().getActivePlayer();

		if (CustomConfig.ENABLE_REWARD_SERVICE)
			RewardService.getInstance().verify(player);
	}
}
