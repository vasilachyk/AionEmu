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
package quest.quest_specialize;

import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.questEngine.handlers.*;
import com.aionemu.gameserver.questEngine.model.*;
import com.aionemu.gameserver.services.*;

/****/
/** Author Rinzler (Encom)
/****/

public class _24155Leather_Wing_And_Shiny_Things extends QuestHandler
{
    private final static int questId = 24155;
	
    public _24155Leather_Wing_And_Shiny_Things() {
        super(questId);
    }
	
	@Override
	public boolean onLvlUpEvent(QuestEnv env) {
		return defaultOnLvlUpEvent(env);
	}
	
    @Override
    public void register() {
		qe.registerOnLevelUp(questId);
    	qe.registerQuestItem(182204318, questId);
		qe.registerQuestNpc(204701).addOnQuestStart(questId); //Hod
    	qe.registerQuestNpc(204701).addOnTalkEvent(questId); //Hod
    	qe.registerQuestNpc(204785).addOnTalkEvent(questId); //Gwendolin
        qe.registerQuestNpc(700290).addOnKillEvent(questId); //Field Suppressor
    }
	
    @Override
    public boolean onDialogEvent(final QuestEnv env) {
        final Player player = env.getPlayer();
        final QuestState qs = player.getQuestStateList().getQuestState(questId);
        int targetId = env.getTargetId();
        if (qs == null || qs.getStatus() == QuestStatus.NONE) {
            if (targetId == 204701) { //Hod
            	switch (env.getDialog()) {
        			case START_DIALOG: {
        				return sendQuestDialog(env, 1011);
        			} case ASK_ACCEPTION: {
        				return sendQuestDialog(env, 4);
        			} case ACCEPT_QUEST: {
        				QuestService.startQuest(env);
                        qs.setQuestVarById(5, 1);
                        updateQuestStatus(env);
                        return closeDialogWindow(env);
        			} case REFUSE_QUEST: {
        				return sendQuestDialog(env, 1004);
        			}
            	}
            }
        } else if (qs.getStatus() == QuestStatus.START) {
        	switch (targetId) {
                case 204785: { //Gwendolin
                    switch (env.getDialog()) {
                        case START_DIALOG: {
                            return sendQuestDialog(env, 1352);
                        } case STEP_TO_2: {
                        	qs.setQuestVar(0);
        					updateQuestStatus(env);
                            return closeDialogWindow(env);
                        }
                    }
                } case 204701: { //Hod
                    switch (env.getDialog()) {
                        case START_DIALOG: {
                        	return sendQuestDialog(env, 2375);
                        } case SELECT_REWARD: {
                        	qs.setStatus(QuestStatus.REWARD);
                            updateQuestStatus(env);
    						return sendQuestDialog(env, 5);
                        }
                    }
                    break;
                }
            }
        } else if (qs.getStatus() == QuestStatus.REWARD) {
            if (targetId == 204701) { //Hod
            	if (env.getDialog() == QuestDialog.SELECT_REWARD) {
            		return sendQuestDialog(env, 5);
            	} else {
            		return sendQuestEndDialog(env);
            	}
            }
        }
        return false;
    }
	
    @Override
    public boolean onKillEvent(QuestEnv env) {
        final Player player = env.getPlayer();
        final QuestState qs = player.getQuestStateList().getQuestState(questId);
		int var = qs.getQuestVarById(0);
        if (qs == null || qs.getStatus() != QuestStatus.START) {
            return false;
        } if (var < 3) {
            return defaultOnKillEvent(env, 700290, var, var + 1);
        }
        return false;
    }
}