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
package quest.reshanta;

import com.aionemu.gameserver.model.gameobjects.*;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.network.aion.serverpackets.*;
import com.aionemu.gameserver.questEngine.handlers.*;
import com.aionemu.gameserver.questEngine.model.*;
import com.aionemu.gameserver.utils.*;

/****/
/** Author Rinzler (Encom)
/****/

public class _1851Dispatched_Shugo_Craftsmen extends QuestHandler
{
	private final static int questId = 1851;
	
	public _1851Dispatched_Shugo_Craftsmen() {
		super(questId);
	}
	
	@Override
	public void register() {
		qe.registerQuestNpc(278533).addOnQuestStart(questId); //Rentia.
		qe.registerQuestNpc(278533).addOnTalkEvent(questId); //Rentia.
		qe.registerQuestNpc(279025).addOnTalkEvent(questId); //Guuminerk.
		qe.registerQuestNpc(279036).addOnTalkEvent(questId); //Muirunerk.
	}
	
	@Override
	public boolean onDialogEvent(QuestEnv env) {
		final Player player = env.getPlayer();
		final QuestState qs = player.getQuestStateList().getQuestState(questId);
		int targetId = env.getTargetId();
		if (env.getVisibleObject() instanceof Npc) {
			targetId = ((Npc) env.getVisibleObject()).getNpcId();
		} if (qs == null || qs.getStatus() == QuestStatus.NONE) {
			if (targetId == 278533) { //Rentia
            	switch (env.getDialog()) {
            		case START_DIALOG: {
            			return sendQuestDialog(env, 1011);
            		} case ASK_ACCEPTION: {
            			return sendQuestDialog(env, 4);
            		} case ACCEPT_QUEST: {
            			return sendQuestStartDialog(env);
            		} case REFUSE_QUEST: {
            			return sendQuestDialog(env, 1004);
            		}
            	}
            }
		} if (qs.getStatus() == QuestStatus.START) {
			switch (targetId) {
				case 279025: { //Guuminerk
					switch (env.getDialog()) {
						case START_DIALOG: {
							return sendQuestDialog(env, 1352);
						} case STEP_TO_1: {
							qs.setQuestVar(1);
            				updateQuestStatus(env);
            				return closeDialogWindow(env);
						}
					}
				} case 279036: { //Muirunerk
					switch (env.getDialog()) {
						case START_DIALOG: {
							return sendQuestDialog(env, 1693);
						} case STEP_TO_2: {
							qs.setQuestVar(2);
        					qs.setStatus(QuestStatus.REWARD);
                            updateQuestStatus(env);
        					return closeDialogWindow(env);
						}
					}
				}
			}
		} else if (qs.getStatus() == QuestStatus.REWARD) {
            if (targetId == 278533) { //Rentia
            	switch (env.getDialog()) {
					case START_DIALOG: {
						return sendQuestDialog(env, 2375);
					} case SELECT_REWARD: {
						return sendQuestDialog(env, 5);
					} default:
					    return sendQuestEndDialog(env);
            	}
            }
        }
		return false;
	}
}