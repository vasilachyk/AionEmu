package com.aionemu.gameserver.network.aion.serverpackets;

import java.util.List;

import com.aionemu.gameserver.model.challenge.ChallengeQuest;
import com.aionemu.gameserver.model.challenge.ChallengeTask;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.model.templates.challenge.ChallengeType;
import com.aionemu.gameserver.network.aion.AionConnection;
import com.aionemu.gameserver.network.aion.AionServerPacket;

public class SM_CHALLENGE_LIST extends AionServerPacket
{
	int action;
	int ownerId;
	ChallengeType ownerType;
	List<ChallengeTask> tasks;
	ChallengeTask task;
	
	public SM_CHALLENGE_LIST(int action, int ownerId, ChallengeType ownerType, List<ChallengeTask> tasks) {
		this.action = action;
		this.ownerId = ownerId;
		this.ownerType = ownerType;
		this.tasks = tasks;
	}
	
	public SM_CHALLENGE_LIST(int action, int ownerId, ChallengeType ownerType, ChallengeTask task) {
		this.action = action;
		this.ownerId = ownerId;
		this.ownerType = ownerType;
		this.task = task;
	}
	
	@Override
	protected void writeImpl(AionConnection con) {
		Player player = con.getActivePlayer();
		writeC(action);
		writeD(ownerId);
		writeC(ownerType.getId());
		writeD(player.getObjectId());
		switch (action) {
			case 2:
				writeD((int) (System.currentTimeMillis() / 1000));
				writeH(tasks.size());
				for (ChallengeTask task : tasks) {
					writeD(32);
					writeD(task.getTaskId());
					writeC(1);
					writeC(21);
					writeC(0);
					writeD((int) (task.getCompleteTime().getTime() / 1000));
				}
			break;
			case 7:
				writeD(32);
				writeD(task.getTaskId());
				writeH(task.getQuestsCount());
				for (ChallengeQuest quest : task.getQuests().values()) {
					writeD(quest.getQuestId());
					writeH(quest.getMaxRepeats());
					writeD(quest.getScorePerQuest());
					writeH(quest.getCompleteCount());
				}
			break;
		}
	}
}