package com.aionemu.gameserver.network.aion.serverpackets;

import java.util.List;

import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.model.gameobjects.player.PlayerCommonData;
import com.aionemu.gameserver.model.stats.container.PlayerLifeStats;
import com.aionemu.gameserver.model.team2.common.legacy.GroupEvent;
import com.aionemu.gameserver.model.team2.group.PlayerGroup;
import com.aionemu.gameserver.network.aion.AionConnection;
import com.aionemu.gameserver.network.aion.AionServerPacket;
import com.aionemu.gameserver.skillengine.model.Effect;
import com.aionemu.gameserver.world.WorldPosition;

public class SM_GROUP_MEMBER_INFO extends AionServerPacket
{
	private int groupId;
	private Player player;
	private GroupEvent event;
	
	public SM_GROUP_MEMBER_INFO(PlayerGroup group, Player player, GroupEvent event) {
		this.groupId = group.getTeamId();
		this.player = player;
		this.event = event;
	}
	
	@Override
	protected void writeImpl(AionConnection con) {
		PlayerLifeStats pls = player.getLifeStats();
		PlayerCommonData pcd = player.getCommonData();
		WorldPosition wp = pcd.getPosition();
		if (event == GroupEvent.ENTER && !player.isOnline()) {
			event = GroupEvent.ENTER_OFFLINE;
		}
		writeD(groupId);
		writeD(player.getObjectId());
		if (player.isOnline()) {
			writeD(pls.getMaxHp());
			writeD(pls.getCurrentHp());
			writeD(pls.getMaxMp());
			writeD(pls.getCurrentMp());
			writeD(pls.getMaxFp());
			writeD(pls.getCurrentFp());
		} else {
			writeD(0);
			writeD(0);
			writeD(0);
			writeD(0);
			writeD(0);
			writeD(0);
		}
		writeD(0);
		writeD(wp.getMapId());
		writeD(wp.getMapId());
		writeF(wp.getX());
		writeF(wp.getY());
		writeF(wp.getZ());
		writeC(pcd.getPlayerClass().getClassId());
		writeC(pcd.getGender().getGenderId());
		writeC(pcd.getLevel());
		writeC(event.getId());
		writeH(player.isOnline() ? 1 : 0);
		writeC(player.isMentor() ? 0x01 : 0x00);
		writeC(0x00);//unk 5.1
		switch (event) {
			case MOVEMENT:
			case DISCONNECTED:
			break;
			case LEAVE:
				writeH(0x00);
				writeC(0x00);
			break;
			case ENTER_OFFLINE:
			case JOIN:
				writeS(pcd.getName());
			break;
			default:
				writeS(pcd.getName());
				writeD(0x00);
				writeD(0x00);
				writeC(0x7F);
				List<Effect> abnormalEffects = player.getEffectController().getAbnormalEffects();
				writeH(abnormalEffects.size());
				for (Effect effect: abnormalEffects) {
					writeD(effect.getEffectorId());
					writeH(effect.getSkillId());
					writeC(effect.getSkillLevel());
					writeC(effect.getTargetSlot());
					writeD(effect.getRemainingTime());
				}
				writeB(new byte[32]);
			break;
			case UPDATE:
                writeS(pcd.getName());
                writeD(0x00);
                writeD(0x00);
                writeC(0x7F);
                List<Effect> abnormalEffects1 = this.player.getEffectController().getAbnormalEffects();
                writeH(abnormalEffects1.size());
                for (Effect effect: abnormalEffects1) {
                    writeD(effect.getEffectorId());
                    writeH(effect.getSkillId());
                    writeC(effect.getSkillLevel());
                    writeC(effect.getTargetSlot());
                    writeD(effect.getRemainingTime());
                }
				writeB(new byte[32]);
			break;
		}
	}
}