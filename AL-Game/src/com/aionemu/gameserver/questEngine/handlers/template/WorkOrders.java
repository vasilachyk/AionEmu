package com.aionemu.gameserver.questEngine.handlers.template;

import java.util.Iterator;

import com.aionemu.gameserver.dataholders.DataManager;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.model.templates.*;
import com.aionemu.gameserver.model.templates.quest.*;
import com.aionemu.gameserver.network.aion.serverpackets.*;
import com.aionemu.gameserver.questEngine.handlers.*;
import com.aionemu.gameserver.questEngine.handlers.models.*;
import com.aionemu.gameserver.questEngine.model.*;
import com.aionemu.gameserver.services.*;
import com.aionemu.gameserver.services.item.*;
import com.aionemu.gameserver.utils.*;

public class WorkOrders extends QuestHandler
{
	private final WorkOrdersData workOrdersData;
	
	public WorkOrders(WorkOrdersData workOrdersData) {
		super(workOrdersData.getId());
		this.workOrdersData = workOrdersData;
	}
	
	@Override
	public void register() {
		Iterator<Integer> iterator = workOrdersData.getStartNpcIds().iterator();
		while (iterator.hasNext()) {
			int startNpc = iterator.next();
			qe.registerQuestNpc(startNpc).addOnQuestStart(workOrdersData.getId());
			qe.registerQuestNpc(startNpc).addOnTalkEvent(workOrdersData.getId());
		}
	}
	
	@Override
	public boolean onDialogEvent(QuestEnv env) {
		Player player = env.getPlayer();
		int targetId = env.getTargetId();
		if (workOrdersData.getStartNpcIds().contains(targetId)) {
			QuestState qs = player.getQuestStateList().getQuestState(workOrdersData.getId());
			if (qs == null || qs.getStatus() == QuestStatus.NONE || qs.canRepeat()) {
				switch (env.getDialog()) {
					case START_DIALOG: {
						return sendQuestDialog(env, 4);
					} case ACCEPT_QUEST: {
						if (RecipeService.validateNewRecipe(player, workOrdersData.getRecipeId()) != null) {
							if (QuestService.startQuest(env)) {
								if (ItemService.addQuestItems(player, workOrdersData.getGiveComponent())) {
									RecipeService.addRecipe(player, workOrdersData.getRecipeId(), false);
									PacketSendUtility.sendPacket(player, new SM_DIALOG_WINDOW(env.getVisibleObject().getObjectId(), 0));
								}
								return true;
							}
						}
					}
				}
			} else if (qs.getStatus() == QuestStatus.START) {
				if (env.getDialog() == QuestDialog.START_DIALOG) {
					int var = qs.getQuestVarById(0);
					if (QuestService.collectItemCheck(env, false)) {
						changeQuestStep(env, var, var, true);
						QuestWorkItems qwi = DataManager.QUEST_DATA.getQuestById(workOrdersData.getId()).getQuestWorkItems();
						if (qwi != null) {
							long count = 0;
							for (QuestItems qi : qwi.getQuestWorkItem()) {
								if (qi != null) {
									count = player.getInventory().getItemCountByItemId(qi.getItemId());
									if (count > 0) {
										player.getInventory().decreaseByItemId(qi.getItemId(), count);
									}
								}
							}
						}
						return sendQuestDialog(env, 5);
					} else {
						return sendQuestSelectionDialog(env);
					}
				}
			} else if (qs.getStatus() == QuestStatus.REWARD) {
				QuestTemplate template = DataManager.QUEST_DATA.getQuestById(workOrdersData.getId());
				CollectItems collectItems = template.getCollectItems();
				long count = 0;
				for (CollectItem collectItem : collectItems.getCollectItem()) {
					count = player.getInventory().getItemCountByItemId(collectItem.getItemId());
					if (count > 0) {
						player.getInventory().decreaseByItemId(collectItem.getItemId(), count);
					}
				}
				player.getRecipeList().deleteRecipe(player, workOrdersData.getRecipeId());
				if (env.getDialogId() == -1) {
					QuestService.finishQuest(env, 0);
					env.setQuestId(workOrdersData.getId());
					return sendQuestDialog(env, 1008);
				} else {
					return sendQuestEndDialog(env);
				}
			}
		}
		return false;
	}
}