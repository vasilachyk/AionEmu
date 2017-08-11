package com.aionemu.gameserver.questEngine.handlers.template;

import java.util.*;

import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.network.aion.serverpackets.*;
import com.aionemu.gameserver.questEngine.handlers.*;
import com.aionemu.gameserver.questEngine.model.*;
import com.aionemu.gameserver.services.*;
import com.aionemu.gameserver.utils.*;

public class FountainRewards extends QuestHandler
{
	private final int questId;
	private final Set<Integer> startNpcs = new HashSet<Integer>();
	
	public FountainRewards(int questId, List<Integer> startNpcIds) {
		super(questId);
		this.questId = questId;
		this.startNpcs.addAll(startNpcIds);
		this.startNpcs.remove(0);
	}
	
	@Override
	public void register() {
		Iterator<Integer> iterator = startNpcs.iterator();
		while (iterator.hasNext()) {
			int startNpc = iterator.next();
			qe.registerQuestNpc(startNpc).addOnQuestStart(getQuestId());
			qe.registerQuestNpc(startNpc).addOnTalkEvent(getQuestId());
		}
	}
	
	@Override
	public boolean onDialogEvent(QuestEnv env) {
		Player player = env.getPlayer();
		int targetId = env.getTargetId();
		QuestState qs = player.getQuestStateList().getQuestState(questId);
		QuestDialog dialog = env.getDialog();
		if (qs == null || qs.getStatus() == QuestStatus.NONE || qs.canRepeat()) {
			if (startNpcs.contains(targetId)) {
				switch (dialog) {
					case USE_OBJECT: {
                        if (!QuestService.inventoryItemCheck(env, true)) {
                            return true;
                        } else {
                            if (targetId == 730142 || //Teminon Coin Fountain.
							    targetId == 730143 || //Primum Coin Fountain.
								targetId == 730241 || //Inggison Coin Fountain.
								targetId == 730242 || //Gelkmaros Coin Fountain.
								targetId == 701429 || //Oriel Coin Fountain.
								targetId == 701430 || //Pernon Coin Fountain.
								targetId == 804759 || //Enshar Coin Fountain.
								targetId == 804788 || //Cygnea Coin Fountain.
								targetId == 805778 || //Iluma Coin Fountain.
								targetId == 805753) { //Norsvold Coin Fountain.
                                return sendQuestDialog(env, 1011);
                            } else {
                                return sendQuestSelectionDialog(env);
                            }
                        }
                    } case STEP_TO_1: {
						if (QuestService.collectItemCheck(env, false)) {
							if (!player.getInventory().isFullSpecialCube()) {
								if (QuestService.startQuest(env)) {
									changeQuestStep(env, 0, 0, true);
									return sendQuestDialog(env, 5);
								}
							} else {
								PacketSendUtility.sendPacket(player, SM_SYSTEM_MESSAGE.STR_MSG_FULL_INVENTORY);
								return sendQuestSelectionDialog(env);
							}
						} else {
							return sendQuestSelectionDialog(env);
						}
					}
				}
			}
		} else if (qs != null && qs.getStatus() == QuestStatus.REWARD) {
			if (startNpcs.contains(targetId)) {
				if (dialog == QuestDialog.SELECT_NO_REWARD) {
					if (QuestService.collectItemCheck(env, true))
						return sendQuestEndDialog(env);
				} else {
					return QuestService.abandonQuest(player, questId);
				}
			}
		}
		return false;
	}
	
	@Override
    public boolean onCanAct(QuestEnv env, QuestActionType questEventType, Object... objects) {
        if (startNpcs.contains(env.getTargetId())) {
            return true;
        }
        return false;
    }
}