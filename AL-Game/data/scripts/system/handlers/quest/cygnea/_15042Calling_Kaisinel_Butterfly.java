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
package quest.cygnea;

import com.aionemu.gameserver.model.gameobjects.*;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.questEngine.handlers.*;
import com.aionemu.gameserver.questEngine.model.*;
import com.aionemu.gameserver.world.zone.*;

/****/
/** Author Rinzler (Encom)
/****/

public class _15042Calling_Kaisinel_Butterfly extends QuestHandler
{
	private final static int questId = 15042;
	
	public _15042Calling_Kaisinel_Butterfly() {
		super(questId);
	}
	
	public void register() {
		qe.registerQuestNpc(804885).addOnQuestStart(questId); //Telos
		qe.registerQuestNpc(804885).addOnTalkEvent(questId); //Telos
		qe.registerQuestItem(182215676, questId);
		qe.registerQuestItem(182215753, questId);
	}
	
	@Override
	public boolean onDialogEvent(QuestEnv env) {
		Player player = env.getPlayer();
		QuestState qs = player.getQuestStateList().getQuestState(questId);
		QuestDialog dialog = env.getDialog();
		int targetId = env.getTargetId();
		if (qs == null || qs.getStatus() == QuestStatus.NONE) {
			if (targetId == 804885) { //Telos
				if (dialog == QuestDialog.START_DIALOG) {
					return sendQuestDialog(env, 4762);
				} else {
					return sendQuestStartDialog(env, 182215676, 1);
				}
			}
		} else if (qs.getStatus() == QuestStatus.REWARD) {
			if (targetId == 804885) { //Telos
				if (dialog == QuestDialog.START_DIALOG) {
					return sendQuestDialog(env, 10002);
				}
				removeQuestItem(env, 182215676, 1);
				return sendQuestEndDialog(env);
			}
		}
		return false;
	}
	
	@Override
    public HandlerResult onItemUseEvent(final QuestEnv env, Item item) {
        final Player player = env.getPlayer();
        final int id = item.getItemTemplate().getTemplateId();
        final QuestState qs = player.getQuestStateList().getQuestState(questId);
        if (id != 182215676 || qs.getStatus() == QuestStatus.COMPLETE) {
            return HandlerResult.UNKNOWN;
        } if (!player.isInsideZone(ZoneName.get("LF5_ItemUseArea_Q15042"))) {
            return HandlerResult.UNKNOWN;
        } if (qs != null && qs.getStatus() == QuestStatus.START) {
            int var = qs.getQuestVarById(0);
			int var1 = qs.getQuestVarById(1);
            if (var == 0) {
                if (var1 < 2) {
                    qs.setQuestVarById(1, var1 + 1);
					updateQuestStatus(env);
                } else if (var1 == 2) {
					giveQuestItem(env, 182215753, 1);
					removeQuestItem(env, 182215676, 1);
                    qs.setQuestVar(1);
					qs.setStatus(QuestStatus.REWARD);
					updateQuestStatus(env);
                    return HandlerResult.SUCCESS;
                }
			}
		}
		return HandlerResult.SUCCESS;
    }
}