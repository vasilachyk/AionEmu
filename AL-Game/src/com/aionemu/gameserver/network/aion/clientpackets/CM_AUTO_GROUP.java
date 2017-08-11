package com.aionemu.gameserver.network.aion.clientpackets;

import com.aionemu.gameserver.configs.main.*;
import com.aionemu.gameserver.model.autogroup.EntryRequestType;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.network.aion.AionClientPacket;
import com.aionemu.gameserver.network.aion.AionConnection.State;
import com.aionemu.gameserver.services.AutoGroupService;
import com.aionemu.gameserver.services.instance.*;
import com.aionemu.gameserver.services.events.*;
import com.aionemu.gameserver.utils.PacketSendUtility;

public class CM_AUTO_GROUP extends AionClientPacket
{
	private byte instanceMaskId;
	private byte windowId;
	private byte entryRequestId;
	
	public CM_AUTO_GROUP(int opcode, State state, State... restStates) {
		super(opcode, state, restStates);
	}
	
	@Override
	protected void readImpl() {
		instanceMaskId = (byte) readD();
		windowId = (byte) readC();
		entryRequestId = (byte) readC();
	}
	
	@Override
	protected void runImpl() {
		Player player = getConnection().getActivePlayer();
		if (!AutoGroupConfig.AUTO_GROUP_ENABLED) {
			PacketSendUtility.sendMessage(player, "Auto Group is disabled");
			return;
		} switch (windowId) {
			case 100:
				EntryRequestType ert = EntryRequestType.getTypeById(entryRequestId);
				if (ert == null) {
					return;
				}
				AutoGroupService.getInstance().startLooking(player, instanceMaskId, ert);
			break;
			case 101:
				AutoGroupService.getInstance().unregisterLooking(player, instanceMaskId);
			break;
			case 102:
				AutoGroupService.getInstance().pressEnter(player, instanceMaskId);
			break;
			case 103:
				AutoGroupService.getInstance().cancelEnter(player, instanceMaskId);
			break;
			case 104:
                AsyunatarService.getInstance().showWindow(player, instanceMaskId);
                DredgionService2.getInstance().showWindow(player, instanceMaskId);
                KamarBattlefieldService.getInstance().showWindow(player, instanceMaskId);
			    EngulfedOphidanBridgeService.getInstance().showWindow(player, instanceMaskId);
				SuspiciousOphidanBridgeService.getInstance().showWindow(player, instanceMaskId);
				IronWallWarfrontService.getInstance().showWindow(player, instanceMaskId);
				IdgelDomeService.getInstance().showWindow(player, instanceMaskId);
				IdgelDomeLandmarkService.getInstance().showWindow(player, instanceMaskId);
			break;
			case 105:
			break;
		} if (PvPModConfig.BG_ENABLED) {
			LadderService.getInstance().handleWindow(player, windowId, entryRequestId);
		}
	}
}