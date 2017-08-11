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

import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.model.TeleportAnimation;
import com.aionemu.gameserver.questEngine.handlers.*;
import com.aionemu.gameserver.questEngine.model.*;
import com.aionemu.gameserver.services.QuestService;
import com.aionemu.gameserver.services.teleport.TeleportService2;

/****/
/** Author Rinzler (Encom)
/****/

public class _10033Petrified_Subside extends QuestHandler
{
	private final static int questId = 10033;
	
	public _10033Petrified_Subside() {
		super(questId);
	}
	
	@Override
	public void register() {
		int[] npcs = {798970, 798975, 798981, 730226, 730227, 730228};
		qe.registerOnLevelUp(questId);
		qe.registerOnEnterZoneMissionEnd(questId);
		for (int npc: npcs) {
			qe.registerQuestNpc(npc).addOnTalkEvent(questId);
		}
	}
	
	@Override
	public boolean onZoneMissionEndEvent(QuestEnv env) {
		return defaultOnZoneMissionEndEvent(env);
	}
	
	@Override
	public boolean onLvlUpEvent(QuestEnv env) {
		return defaultOnLvlUpEvent(env, 10032, true);
	}
	
	@Override
	public boolean onDialogEvent(final QuestEnv env) {
		Player player = env.getPlayer();
		QuestState qs = player.getQuestStateList().getQuestState(questId);
		if (qs == null) {
			return false;
		}
		QuestDialog dialog = env.getDialog();
		int var = qs.getQuestVarById(0);
		int targetId = env.getTargetId();
		if (qs.getStatus() == QuestStatus.START) {
			switch (targetId) {
				case 798970: {
					switch (dialog) {
						case START_DIALOG: {
							if (var == 0) {
								return sendQuestDialog(env, 1011);
							}
						} case STEP_TO_1: {
							return defaultCloseDialog(env, 0, 1);
						}
					}
					break;
				} case 798975: {
					switch (dialog) {
						case START_DIALOG: {
							if (var == 1) {
								return sendQuestDialog(env, 1352);
							} else if (var == 6) {
								return sendQuestDialog(env, 3057);
							}
						} case STEP_TO_2: {
							return defaultCloseDialog(env, 1, 2);
						} case SET_REWARD: {
							removeQuestItem(env, 182215625, 1);
							qs.setStatus(QuestStatus.REWARD);
							updateQuestStatus(env);
							return checkQuestItems(env, 6, 7, true, 10000, 10001);
                        }
					}
					break;
				} case 798981: {
					switch (dialog) {
						case START_DIALOG: {
							if (var == 2) {
								return sendQuestDialog(env, 1693);
							}
						} case STEP_TO_3: {
							giveQuestItem(env, 182215622, 1);
							return defaultCloseDialog(env, 2, 3);
						}
					}
				    break;
				} case 730226: {
					if (var == 3 && dialog == QuestDialog.USE_OBJECT) {
						removeQuestItem(env, 182215622, 1);
						giveQuestItem(env, 182215623, 1);
						return useQuestObject(env, 3, 4, false, 0);
					}
					break;
				} case 730227: {
					if (var == 4 && dialog == QuestDialog.USE_OBJECT) {
						removeQuestItem(env, 182215623, 1);
						giveQuestItem(env, 182215624, 1);
						return useQuestObject(env, 4, 5, false, 0);
					}
					break;
				} case 730228: {
					if (var == 5 && dialog == QuestDialog.USE_OBJECT) {
						removeQuestItem(env, 182215624, 1);
						giveQuestItem(env, 182215625, 1);
						return useQuestObject(env, 5, 6, false, 0);
					}
					break;
				}
			}
		} else if (qs.getStatus() == QuestStatus.REWARD) {
			if (targetId == 798970) {
				if (env.getDialog() == QuestDialog.USE_OBJECT) {
					return sendQuestDialog(env, 10002);
				} else {
					return sendQuestEndDialog(env);
				}
			}
		}
		return false;
	}
}