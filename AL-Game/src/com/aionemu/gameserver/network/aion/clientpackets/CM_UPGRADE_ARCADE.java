package com.aionemu.gameserver.network.aion.clientpackets;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import com.aionemu.gameserver.model.gameobjects.Item;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.network.aion.AionClientPacket;
import com.aionemu.gameserver.network.aion.AionConnection.State;
import com.aionemu.gameserver.network.aion.serverpackets.SM_UPGRADE_ARCADE;
import com.aionemu.gameserver.services.player.UpgradeArcadeService;
import com.aionemu.gameserver.utils.PacketSendUtility;

/**
 * @author Ranastic
 */

public class CM_UPGRADE_ARCADE extends AionClientPacket
{
	private int type;
	private int wtfPoint;
	
	private static final Logger log = LoggerFactory.getLogger(CM_UPGRADE_ARCADE.class);
	
	public CM_UPGRADE_ARCADE(int opcode, State state, State... restStates) {
		super(opcode, state, restStates);
	}
	
	@Override
	protected void readImpl() {
		type = readC();
		wtfPoint= readD();
	}
	
	@Override
	protected void runImpl() {
		Player player = getConnection().getActivePlayer();
		if (player == null) {
			return;
		} if (type == 0 && wtfPoint == 1) {
			UpgradeArcadeService.getInstance().updateTypeOne(player);
		} else if (type == 1) {
			UpgradeArcadeService.getInstance().upgradeTypeTwo(player);
		} else if (type == 2) {
			UpgradeArcadeService.getInstance().upgradeTypeThree(player);
		} else if (type == 3) {
			UpgradeArcadeService.getInstance().upgradeTypeSix(player);
		} else if (type == 5) {
			PacketSendUtility.sendPacket(player, new SM_UPGRADE_ARCADE(10));
		}
	}
}