package quest.hidden_truth;

import com.aionemu.gameserver.model.gameobjects.Npc;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.network.aion.serverpackets.SM_DIALOG_WINDOW;
import com.aionemu.gameserver.questEngine.handlers.QuestHandler;
import com.aionemu.gameserver.questEngine.model.QuestEnv;
import com.aionemu.gameserver.questEngine.model.QuestState;
import com.aionemu.gameserver.questEngine.model.QuestStatus;
import com.aionemu.gameserver.questEngine.model.QuestDialog;
import com.aionemu.gameserver.services.QuestService;
import com.aionemu.gameserver.utils.PacketSendUtility;

public class _1097Sword_Of_Transcendence extends QuestHandler
{
	private final static int questId = 1097;
	private final static int[] npc_ids = {790001, 798316, 279034, 700509, 700510};
	
	public _1097Sword_Of_Transcendence() {
		super(questId);
	}
	
	@Override
	public void register() {
		qe.registerOnLevelUp(questId);
		for (int npc_id: npc_ids) {
			qe.registerQuestNpc(npc_id).addOnTalkEvent(questId);
		}
	}
	
	@Override
	public boolean onLvlUpEvent(QuestEnv env) {
		return defaultOnLvlUpEvent(env, 1096);
	}
	
	@Override
	public boolean onDialogEvent(QuestEnv env) {
		final Player player = env.getPlayer();
		final QuestState qs = player.getQuestStateList().getQuestState(questId);
		if (qs == null)
			return false;
		int var = qs.getQuestVarById(0);
		int targetId = 0;
		QuestDialog dialog = env.getDialog();
		if (env.getVisibleObject() instanceof Npc)
			targetId = ((Npc) env.getVisibleObject()).getNpcId();
		if (qs.getStatus() == QuestStatus.START) {
			switch (targetId) {
				case 790001:
					switch (env.getDialog()) {
						case START_DIALOG:
						if (var == 0) {
							return sendQuestDialog(env, 1011);
						}
						case STEP_TO_1:
						if (var == 0) {
							qs.setQuestVarById(0, var + 1);
							updateQuestStatus(env);
							PacketSendUtility.sendPacket(player, new SM_DIALOG_WINDOW(env.getVisibleObject().getObjectId(), 10));
							return true;
						}
					}
				break;
				case 798316:
					switch (env.getDialog()) {
						case START_DIALOG:
						if (var == 1) {
							return sendQuestDialog(env, 1352);
						}
						case STEP_TO_2:
						if (var == 1) {
							qs.setQuestVarById(0, var + 1);
							updateQuestStatus(env);
							PacketSendUtility.sendPacket(player, new SM_DIALOG_WINDOW(env.getVisibleObject().getObjectId(), 10));
							return true;
						}
					}
				break;
				case 279034:
					switch (env.getDialog()) {
						case START_DIALOG:
						if (var == 2) {
							return sendQuestDialog(env, 1693);
						}
						case STEP_TO_3:
						if (var == 2) {
							PacketSendUtility.sendPacket(player, new SM_DIALOG_WINDOW(env.getVisibleObject().getObjectId(), 10));
							return true;
						}
						case CHECK_COLLECTED_ITEMS:
						if (var == 2) {
							if (QuestService.collectItemCheck(env, true)) {
								if (!giveQuestItem(env, 182206058, 1))
									return true;
								qs.setStatus(QuestStatus.REWARD);
								updateQuestStatus(env);
								return sendQuestDialog(env, 10000);
							} else {
								return sendQuestDialog(env, 10001);
							}
						}
					}
				break;
				case 700509:
				    if (dialog == QuestDialog.USE_OBJECT) {
					    giveQuestItem(env, 182206059, 1);
						return true;
				    }
				break;
				case 700510:
				    if (dialog == QuestDialog.USE_OBJECT) {
					    giveQuestItem(env, 182206060, 1);
						return true;
				    }
				break;
			}
		} else if (qs.getStatus() == QuestStatus.REWARD) {
			if (targetId == 790001) {
				if (env.getDialog() == QuestDialog.USE_OBJECT) {
					return sendQuestDialog(env, 10002);
				} else {
					removeQuestItem(env, 182206058, 1);
					return sendQuestEndDialog(env);
				}
			}
		}
		return false;
	}
}