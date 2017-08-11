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
package quest.mission;

import com.aionemu.gameserver.model.gameobjects.*;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.network.aion.serverpackets.*;
import com.aionemu.gameserver.questEngine.handlers.*;
import com.aionemu.gameserver.questEngine.model.*;
import com.aionemu.gameserver.services.*;
import com.aionemu.gameserver.utils.*;

/****/
/** Author Rinzler (Encom)
/****/

public class _14025Cooking_Up_Disasters extends QuestHandler
{
    private final static int questId = 14025;
    private final static int[] npcs = {203989, 204020, 203901};
    private final static int[] mobs = {211776, 217090};
	
    public _14025Cooking_Up_Disasters() {
        super(questId);
    }
	
    @Override
    public void register() {
        for (int npc: npcs) {
            qe.registerQuestNpc(npc).addOnTalkEvent(questId);
        } for (int mob: mobs) {
            qe.registerQuestNpc(mob).addOnKillEvent(questId);
        }
		qe.registerOnLevelUp(questId);
		qe.registerOnEnterZoneMissionEnd(questId);
    }
	
    @Override
    public boolean onZoneMissionEndEvent(QuestEnv env) {
        return defaultOnZoneMissionEndEvent(env);
    }
	
    @Override
    public boolean onLvlUpEvent(QuestEnv env) {
        return defaultOnLvlUpEvent(env, 14024, true);
    }
	
    @Override
    public boolean onKillEvent(QuestEnv env) {
        Player player = env.getPlayer();
        QuestState qs = player.getQuestStateList().getQuestState(questId);
        int targetId = env.getTargetId();
        if (qs != null && qs.getStatus() == QuestStatus.START) {
            int var = qs.getQuestVarById(0);
            if (var == 5) {
                int[] KrallWarriorHK38Ae = {211776};
                int[] LF2KrallShaQnmd39An = {217090};
                switch (targetId) {
                    case 211776: { //Crack Kaidan Warmonger.
                        return defaultOnKillEvent(env, KrallWarriorHK38Ae, 0, 4, 1);
                    } case 217090: { //Shaman Kalabar.
                        return defaultOnKillEvent(env, LF2KrallShaQnmd39An, 0, 1, 2);
                    }
                }
            }
        }
        return false;
    }
	
    @Override
    public boolean onDialogEvent(QuestEnv env) {
        final Player player = env.getPlayer();
        final QuestState qs = player.getQuestStateList().getQuestState(questId);
		int targetId = env.getTargetId();
		int var = qs.getQuestVarById(0);
        int var1 = qs.getQuestVarById(1);
        int var2 = qs.getQuestVarById(2);
		if (qs == null) {
            return false;
        } if (env.getVisibleObject() instanceof Npc) {
            targetId = ((Npc) env.getVisibleObject()).getNpcId();
        } if (qs.getStatus() == QuestStatus.REWARD) {
            if (targetId == 203901) { //Telemachus.
                return sendQuestEndDialog(env);
            }
        } if (qs.getStatus() == QuestStatus.START) {
            if (targetId == 203989) { //Tumblusen.
                switch (env.getDialog()) {
                    case START_DIALOG: {
                        if (var == 0) {
                            return sendQuestDialog(env, 1011);
                        } else if (var == 1) {
                            return sendQuestDialog(env, 1352);
                        } else if (var == 4) {
                            return sendQuestDialog(env, 2034);
                        } else if (var == 5 && var1 == 4 && var2 == 1) {
                            return sendQuestDialog(env, 2716);
                        }
					} case CHECK_COLLECTED_ITEMS: {
                        if (var == 1) {
                            if (QuestService.collectItemCheck(env, true)) {
                                qs.setQuestVarById(0, var + 2);
                                updateQuestStatus(env);
                                PacketSendUtility.sendPacket(player, new SM_DIALOG_WINDOW(env.getVisibleObject().getObjectId(), 10));
                                return true;
                            }
                            return false;
                        }
					} case STEP_TO_1: {
                        if (var == 0) {
                            return defaultCloseDialog(env, 0, 1);
                        }
					} case STEP_TO_4: {
                        removeQuestItem(env, 182201005, 1);
                        return defaultCloseDialog(env, 4, 5);
					} case STEP_TO_6: {
                        return defaultCloseDialog(env, 5, 5, true, false);
					} case FINISH_DIALOG: {
                        return closeDialogWindow(env);
                    }
                }
            } if (targetId == 204020) { //Mabangtah.
                switch (env.getDialog()) {
                    case START_DIALOG: {
                        if (var == 3) {
                            return sendQuestDialog(env, 1693);
                        }
					} case SELECT_ACTION_1694: {
						if (var == 3) {
							return sendQuestDialog(env, 1694);
						}
					} case STEP_TO_3: {
                        giveQuestItem(env, 182201005, 1);
                        return defaultCloseDialog(env, 3, 4);
                    }
                }
            }
        }
        return false;
    }
}