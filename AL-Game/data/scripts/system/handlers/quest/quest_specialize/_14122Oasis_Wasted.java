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

import com.aionemu.gameserver.model.*;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.questEngine.handlers.*;
import com.aionemu.gameserver.questEngine.model.*;

/****/
/** Author Rinzler (Encom)
/****/

public class _14122Oasis_Wasted extends QuestHandler
{
    private final static int questId = 14122;
	
    public _14122Oasis_Wasted() {
        super(questId);
    }
	
    @Override
    public void register() {
        qe.registerQuestNpc(203917).addOnQuestStart(questId); //Gaia
        qe.registerQuestNpc(203917).addOnTalkEvent(questId); //Gaia
		qe.registerQuestNpc(203992).addOnTalkEvent(questId); //Ophelos
		qe.registerQuestNpc(203987).addOnTalkEvent(questId); //Heratos
		qe.registerQuestNpc(203934).addOnTalkEvent(questId); //Sirink
    }
	
	@Override
    public boolean onDialogEvent(final QuestEnv env) {
        final Player player = env.getPlayer();
		final QuestState qs = player.getQuestStateList().getQuestState(questId);
        int targetId = env.getTargetId();
		if (qs == null || qs.getStatus() == QuestStatus.NONE) {
			if (targetId == 203917) { //Gaia
			    if (env.getDialog() == QuestDialog.START_DIALOG) {
				   return sendQuestDialog(env, 1011);
			    } else {
				   return sendQuestStartDialog(env, 182215480, 1);
			    }
			}
		} else if (qs.getStatus() == QuestStatus.START) {
			if (targetId == 203992) { //Ophelos
			    if (env.getDialog() == QuestDialog.START_DIALOG) {
					return sendQuestDialog(env, 1352);
				} else if (env.getDialog() == QuestDialog.STEP_TO_1) {
					return defaultCloseDialog(env, 0, 1);
				}
			} else if (targetId == 203987) { //Heratos
				if (env.getDialog() == QuestDialog.START_DIALOG) {
					return sendQuestDialog(env, 1693);
				} else if (env.getDialog() == QuestDialog.STEP_TO_2) {
					return defaultCloseDialog(env, 1, 2);
				}
			} else if (targetId == 203934) { //Sirink
				if (env.getDialog() == QuestDialog.START_DIALOG) {
					return sendQuestDialog(env, 2375);
				} else if (env.getDialog() == QuestDialog.SELECT_REWARD) {
					return checkQuestItems(env, 2, 2, true, 5, 2716);
				} else if (env.getDialog() == QuestDialog.FINISH_DIALOG) {
					return sendQuestEndDialog(env);
				}
			}
        } else if (qs.getStatus() == QuestStatus.REWARD) {
			if (targetId == 203934) { //Sirink
                return sendQuestEndDialog(env);
			}
		}
        return false;
    }
}