/*
 * This file is part Of Encom. **ENCOM FUCK OTHER SVN**
 *
 *  Encom is free sOftware: you can redistribute it and/or modify
 *  it under the terms Of the GNU Lesser Public License as published by
 *  the Free SOftware Foundation, either version 3 Of the License, or
 *  (at your option) any later version.
 *
 *  Encom is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty Of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Lesser Public License for more details.
 *
 *  You should have received a copy Of the GNU Lesser Public License
 *  along with Encom.  If not, see <http://www.gnu.org/licenses/>.
 */
package quest.gelkmaros;

import com.aionemu.gameserver.model.gameobjects.*;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.questEngine.handlers.*;
import com.aionemu.gameserver.questEngine.model.*;

/****/
/** Author Rinzler (Encom)
/****/

public class _21291Mastarius_Gift extends QuestHandler
{
	private final static int questId = 21291;
	
	public _21291Mastarius_Gift() {
		super(questId);
	}
	
	@Override
	public void register() {
		qe.registerQuestNpc(799340).addOnTalkEvent(questId); //Athana.
		qe.registerQuestItem(182213148, questId); //A Letter From Mastarius.
	}
	
	@Override
	public boolean onDialogEvent(final QuestEnv env) {
		Player player = env.getPlayer();
		int targetId = env.getTargetId();
		QuestDialog dialog = env.getDialog();
		QuestState qs = player.getQuestStateList().getQuestState(questId);
		if (qs == null || qs.getStatus() == QuestStatus.NONE) {
			if (dialog == QuestDialog.START_DIALOG) {
				return sendQuestDialog(env, 4);
			} else {
				return sendQuestStartDialog(env);
			}
		} else if (qs != null && qs.getStatus() == QuestStatus.START) {
			if(targetId == 799340) { //Athana.
				if(dialog == QuestDialog.START_DIALOG){
					if(checkItemExistence(env, 182213148, 1, true)) { //A Letter From Mastarius.
						changeQuestStep(env, 0, 0, true);
						return sendQuestDialog(env, 2375);
					}
				}
			}
		} else if (qs != null && qs.getStatus() == QuestStatus.REWARD) {
			if (targetId == 799340) { //Athana.
				switch (dialog) {
					case USE_OBJECT: {
						return sendQuestDialog(env, 2375);
					} case SELECT_REWARD: {
						return sendQuestDialog(env, 5);
					} default: {
						return sendQuestEndDialog(env);
					}
				}
			}
		}
		return false;
	}
	
	@Override
	public HandlerResult onItemUseEvent(QuestEnv env, Item item) {
		Player player = env.getPlayer();
		QuestState qs = player.getQuestStateList().getQuestState(questId);
		if (qs == null || qs.getStatus() == QuestStatus.NONE) {
			return HandlerResult.fromBoolean(sendQuestDialog(env, 4));
		}
		return HandlerResult.FAILED;
	}
}