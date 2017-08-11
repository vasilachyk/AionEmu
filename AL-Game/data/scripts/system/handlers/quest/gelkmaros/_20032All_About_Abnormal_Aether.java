/*
 * This file is part of Encom. **ENCOM FUCK OTHER SVN**
 *
 *  Encom is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Lesser Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  Encom is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Lesser Public License for more details.
 *
 *  You should have received a copy of the GNU Lesser Public License
 *  along with Encom.  If not, see <http://www.gnu.org/licenses/>.
 */
package quest.gelkmaros;

import com.aionemu.gameserver.model.*;
import com.aionemu.gameserver.model.gameobjects.*;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.network.aion.serverpackets.*;
import com.aionemu.gameserver.questEngine.handlers.*;
import com.aionemu.gameserver.questEngine.model.*;
import com.aionemu.gameserver.services.instance.*;
import com.aionemu.gameserver.services.QuestService;
import com.aionemu.gameserver.services.teleport.*;
import com.aionemu.gameserver.utils.*;
import com.aionemu.gameserver.world.*;

/****/
/** Author Rinzler (Encom)
/****/

public class _20032All_About_Abnormal_Aether extends QuestHandler
{
	private final static int questId = 20032;
	private final static int[] npc_ids = {799247, 799250, 799325, 799503, 799258, 799239};
	
	public _20032All_About_Abnormal_Aether() {
		super(questId);
	}
	
	@Override
	public void register() {
		qe.registerQuestNpc(215488).addOnKillEvent(questId);
		for (int npc_id: npc_ids) {
			qe.registerQuestNpc(npc_id).addOnTalkEvent(questId);
		}
		qe.registerOnDie(questId);
		qe.registerOnLogOut(questId);
		qe.registerOnLevelUp(questId);
		qe.registerOnEnterWorld(questId);
		qe.registerQuestItem(182215592, questId);
		qe.registerQuestItem(182215593, questId);
		qe.registerOnEnterZoneMissionEnd(questId);
	}
	
	@Override
	public boolean onZoneMissionEndEvent(QuestEnv env) {
		return defaultOnZoneMissionEndEvent(env);
	}
	
	@Override
	public boolean onLvlUpEvent(QuestEnv env) {
		return defaultOnLvlUpEvent(env, 20031, true);
	}
	
	@Override
	public boolean onDialogEvent(final QuestEnv env) {
		final Player player = env.getPlayer();
		final QuestState qs = player.getQuestStateList().getQuestState(questId);
		if (qs == null) {
			return false;
		}
		int var = qs.getQuestVarById(0);
		int targetId = 0;
		QuestDialog dialog = env.getDialog();
		if (env.getVisibleObject() instanceof Npc) {
			targetId = ((Npc) env.getVisibleObject()).getNpcId();
		} if (qs.getStatus() == QuestStatus.REWARD) {
			if (targetId == 799247) {
				if (env.getDialog() == QuestDialog.START_DIALOG) {
					return sendQuestDialog(env, 10002);
				} else {
					return sendQuestEndDialog(env);
				}
			}
			return false;
		} else if (qs.getStatus() != QuestStatus.START) {
			return false;
		} if (targetId == 799247) {
			switch (env.getDialog()) {
				case START_DIALOG: {
					if (var == 0) {
						return sendQuestDialog(env, 1011);					
					}
				} case SELECT_ACTION_1012: {
					if (var == 0) {
						return sendQuestDialog(env, 1012);
					}
				} case STEP_TO_1: {
					return defaultCloseDialog(env, 0, 1);
				}
			}
		} else if (targetId == 799250) {
			switch (env.getDialog()) {
				case START_DIALOG: {
					if (var == 1) {
						return sendQuestDialog(env, 1352);					
					}
				} case SELECT_ACTION_1353: {
					if (var == 1) {
						return sendQuestDialog(env, 1353);
					}
				} case STEP_TO_2: {
					return defaultCloseDialog(env, 1, 2);
				}
			}
		} else if (targetId == 799325) {
			switch (env.getDialog()) {
				case START_DIALOG: {
					if (var == 2) {
						return sendQuestDialog(env, 1693);
					}
				} case SELECT_ACTION_1694: {
					if (var == 2) {
						return sendQuestDialog(env, 1694);
					}
				} case STEP_TO_3: {
					if (player.isInGroup2()) {
						PacketSendUtility.broadcastPacket(player, new SM_MESSAGE(player,
						"You must leave your group or alliance to enter <Taloc Hollow>", ChatType.BRIGHT_YELLOW_CENTER), true);
						return true;
					} else {
						if (giveQuestItem(env, 182215592, 1) && giveQuestItem(env, 182215593, 1)) {
							WorldMapInstance talocHollow = InstanceService.getNextAvailableInstance(300190000);
							InstanceService.registerPlayerWithInstance(talocHollow, player);
							TeleportService2.teleportTo(player, 300190000, talocHollow.getInstanceId(), 202.26694f, 226.0532f, 1098.236f, (byte) 30);
							changeQuestStep(env, 2, 3, false);
							return closeDialogWindow(env);
						} else {
							PacketSendUtility.sendPacket(player, SM_SYSTEM_MESSAGE.STR_WAREHOUSE_FULL_INVENTORY);
							return sendQuestSelectionDialog(env);
						}
					}
				} case FINISH_DIALOG: {
					return sendQuestSelectionDialog(env);
				}
			}
		}
		return false;
	}
	
	@Override
	public boolean onKillEvent(QuestEnv env) {
		Player player = env.getPlayer();
		QuestState qs = player.getQuestStateList().getQuestState(questId);
		if (qs == null || qs.getStatus() != QuestStatus.START) {
			return false;
		}
		int targetId = 0;
		if (env.getVisibleObject() instanceof Npc) {
			targetId = ((Npc) env.getVisibleObject()).getNpcId();
		} switch (targetId) {
			case 215488:
				if (qs.getQuestVarById(0) == 6) {
					return defaultOnKillEvent(env, 215488, 6, 7);
				}
			break;
		}
		return false;
	}
	
	@Override
	public HandlerResult onItemUseEvent(final QuestEnv env, Item item) {
		Player player = env.getPlayer();
		QuestState qs = player.getQuestStateList().getQuestState(questId);
		if (qs != null && qs.getStatus() == QuestStatus.START) {
			if (player.getWorldId() == 300190000) {
				int itemId = item.getItemId();
				int var = qs.getQuestVarById(0);
				int var1 = qs.getQuestVarById(1);
				if (itemId == 182215593) {
					changeQuestStep(env, 4, 5, false);
					return HandlerResult.SUCCESS;
				} else if (itemId == 182215592) {
					if (var == 5) {
						if (var1 >= 0 && var1 < 19) {
							changeQuestStep(env, var1, var1 + 1, false, 1);
							return HandlerResult.SUCCESS;
						} else if (var1 == 19) {
							qs.setQuestVar(6);
							updateQuestStatus(env);
							return HandlerResult.SUCCESS;
						}
					}
				}
			}
		}
		return HandlerResult.UNKNOWN;
	}
	
	@Override
	public boolean onEnterWorldEvent(QuestEnv env) {
		Player player = env.getPlayer();
		QuestState qs = player.getQuestStateList().getQuestState(questId);
		if (qs != null && qs.getStatus() == QuestStatus.START) {
			if (player.getWorldId() != 300190000) {
				int var = qs.getQuestVarById(0);
				if (var >= 4 && var < 6) {
					removeQuestItem(env, 182215592, 1);
					removeQuestItem(env, 182215593, 1);
					qs.setQuestVar(2);
					updateQuestStatus(env);
					return true;
				} else if (var == 7) {
					removeQuestItem(env, 182215592, 1);
					removeQuestItem(env, 182215593, 1);
					qs.setQuestVar(8);
					qs.setStatus(QuestStatus.REWARD);
					updateQuestStatus(env);
					return true;
				}
			} else if (player.getWorldId() == 300190000) {
				int var = qs.getQuestVarById(0);
				if (var == 3) {
					qs.setQuestVar(4);
					updateQuestStatus(env);
					return true;
				}
			}
		}
		return false;
	}
	
	@Override
	public boolean onDieEvent(QuestEnv env) {
		Player player = env.getPlayer();
		QuestState qs = player.getQuestStateList().getQuestState(questId);
		if (qs != null && qs.getStatus() == QuestStatus.START) {
			int var = qs.getQuestVarById(0);
			if (var >= 4 && var < 6) {
				removeQuestItem(env, 182215592, 1);
				removeQuestItem(env, 182215593, 1);
				qs.setQuestVar(2);
				updateQuestStatus(env);
				return true;
			}
		}
		return false;
	}
	
	@Override
	public boolean onLogOutEvent(QuestEnv env) {
		Player player = env.getPlayer();
		QuestState qs = player.getQuestStateList().getQuestState(questId);
		if (qs != null && qs.getStatus() == QuestStatus.START) {
			int var = qs.getQuestVarById(0);
			if (var >= 4 && var < 6) {
				removeQuestItem(env, 182215592, 1);
				removeQuestItem(env, 182215593, 1);
				qs.setQuestVar(2);
				updateQuestStatus(env);
				return true;
			}
		}
		return false;
	}
}