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
package quest.inggison;

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
 
public class _10032Help_In_The_Hollow extends QuestHandler
{
	private final static int questId = 10032;

	public _10032Help_In_The_Hollow() {
		super(questId);
	}
	
	@Override
	public void register() {
		int[] npc_ids = {798952, 798954, 799022, 799503};
		for (int npc_id: npc_ids) {
			qe.registerQuestNpc(npc_id).addOnTalkEvent(questId);
		}
		qe.registerOnDie(questId);
		qe.registerOnLogOut(questId);
		qe.registerOnLevelUp(questId);
		qe.registerOnEnterWorld(questId);
		qe.registerQuestItem(182215618, questId);
		qe.registerQuestItem(182215619, questId);
		qe.registerOnEnterZoneMissionEnd(questId);
	}
	
	@Override
	public boolean onZoneMissionEndEvent(QuestEnv env) {
		return defaultOnZoneMissionEndEvent(env);
	}
	
	@Override
	public boolean onLvlUpEvent(QuestEnv env) {
		return defaultOnLvlUpEvent(env, 10031, true);
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
			if (targetId == 798952) {
				if (env.getDialog() == QuestDialog.START_DIALOG) {
					return sendQuestDialog(env, 10002);
				} else {
					return sendQuestEndDialog(env);
				}
			}
			return false;
		} else if (qs.getStatus() != QuestStatus.START) {
			return false;
		} if (targetId == 798952) { 
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
		} else if (targetId == 798954) {
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
		} else if (targetId == 799503) { 
			switch (env.getDialog()) {
				case START_DIALOG: {
					if (var == 6) {
					    removeQuestItem(env, 182215618, 1);
					    removeQuestItem(env, 182215619, 1);
					    TeleportService2.teleportTo(env.getPlayer(), 210050000, 2649, 340, 511, (byte) 92, TeleportAnimation.JUMP_ANIMATION);
                        return checkQuestItems(env, 6, 7, false, 10000, 10001);
                    }
				} case FINISH_DIALOG: {
                    return sendQuestSelectionDialog(env);
                }
			}
		} else if (targetId == 799022) {
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
						if (giveQuestItem(env, 182215618, 1) && giveQuestItem(env, 182215619, 1)) {
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
				}
			}
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
				if (itemId == 182215618) {
					changeQuestStep(env, 4, 5, false);
					return HandlerResult.SUCCESS;
				} else if (itemId == 182215619) {
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
		if (player.getWorldId() != 300190000) {
			if (qs != null && qs.getStatus() == QuestStatus.START) {
				int var = qs.getQuestVarById(0);
				if (var >= 4 && var < 6) {
					removeQuestItem(env, 182215618, 1);
					removeQuestItem(env, 182215619, 1);
					qs.setQuestVar(2);
					updateQuestStatus(env);
					return true;
				} else if (var == 7) {
					qs.setQuestVar(8);
					qs.setStatus(QuestStatus.REWARD);
					updateQuestStatus(env);
					return true;
				}
			}
		} else if (player.getWorldId() != 300190000) {
			if (qs != null && qs.getStatus() == QuestStatus.START) {
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
				removeQuestItem(env, 182215618, 1);
				removeQuestItem(env, 182215619, 1);
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
				removeQuestItem(env, 182215618, 1);
				removeQuestItem(env, 182215619, 1);
				qs.setQuestVar(2);
				updateQuestStatus(env);
				return true;
			}
		}
		return false;
	}
}