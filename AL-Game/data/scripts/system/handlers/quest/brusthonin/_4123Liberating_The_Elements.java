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
package quest.brusthonin;

import com.aionemu.gameserver.model.*;
import com.aionemu.gameserver.model.gameobjects.*;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.questEngine.handlers.*;
import com.aionemu.gameserver.questEngine.model.*;
import com.aionemu.gameserver.utils.*;
import com.aionemu.gameserver.world.zone.*;

/****/
/** Author Rinzler (Encom)
/****/

public class _4123Liberating_The_Elements extends QuestHandler
{
	private final static int questId = 4123;
	
	public _4123Liberating_The_Elements() {
		super(questId);
	}
	
	@Override
	public boolean onEnterZoneEvent(QuestEnv env, ZoneName zoneName) {
		return defaultOnEnterZoneEvent(env, zoneName, ZoneName.get("THEOBOMOS_LAB_INTERIOR_310110000"));
	}
	
	@Override
	public void register() {
		qe.registerQuestNpc(237258).addOnTalkEvent(questId);
		qe.registerQuestNpc(237253).addOnKillEvent(questId); //Fiery Sealing Stone.
		qe.registerQuestNpc(237246).addOnKillEvent(questId); //Watcher Queen Arachne.
		qe.registerQuestNpc(237248).addOnKillEvent(questId); //Watcher Silikor Of Memory.
		qe.registerQuestNpc(237249).addOnKillEvent(questId); //Watcher Jilitia.
		qe.registerQuestNpc(237250).addOnKillEvent(questId); //Sealed Unstable Triroan.
		qe.registerQuestNpc(237251).addOnKillEvent(questId); //Corrupted Ifrit.
		qe.registerOnEnterZone(ZoneName.get("THEOBOMOS_LAB_INTERIOR_310110000"), questId);
	}
	
	@Override
	public boolean onDialogEvent(QuestEnv env) {
		Player player = env.getPlayer();
		QuestState qs = player.getQuestStateList().getQuestState(questId);
		QuestDialog dialog = env.getDialog();
		int targetId = env.getTargetId();
		if (env.getVisibleObject() instanceof Npc) {
			targetId = ((Npc) env.getVisibleObject()).getNpcId();
		} if (qs == null || qs.getStatus() == QuestStatus.NONE || qs.canRepeat()) {
			if (targetId == 0) {
				switch (dialog) {
					case START_DIALOG:
						return sendQuestDialog(env, 4762);
					case ACCEPT_QUEST:
					case ACCEPT_QUEST_SIMPLE:
						return sendQuestStartDialog(env);
					case REFUSE_QUEST_SIMPLE:
				        return closeDialogWindow(env);
				}
			}
		} else if (qs.getStatus() == QuestStatus.START) {
			switch (targetId) {
				case 237258: {
					switch (dialog) {
						case START_DIALOG: {
							return sendQuestDialog(env, 10002);
						} case SELECT_REWARD: {
							return sendQuestEndDialog(env);
						} default:
							return sendQuestEndDialog(env);
					}
				}
			}
		} else if (qs.getStatus() == QuestStatus.REWARD) {
		    if (targetId == 237258) {
			    switch (dialog) {
					case SELECT_REWARD: {
						return sendQuestDialog(env, 5);
					} default:
						return sendQuestEndDialog(env);
				}
		    }
		}
		return false;
	}
	
	@Override
	public boolean onKillEvent(QuestEnv env) {
		Player player = env.getPlayer();
		QuestState qs = player.getQuestStateList().getQuestState(questId);
		if (qs != null && qs.getStatus() == QuestStatus.START) {
			int var = qs.getQuestVarById(0);
			if (var == 0) { //Fiery Sealing Stone.
				return defaultOnKillEvent(env, 237253, 0, 1);
			} else if(var == 1) { //Watcher Queen Arachne.
				return defaultOnKillEvent(env, 237246, 1, 2);
			} else if(var == 2) { //Watcher Silikor Of Memory.
				return defaultOnKillEvent(env, 237248, 2, 3);
			} else if(var == 3) { //Watcher Jilitia.
				return defaultOnKillEvent(env, 237249, 3, 4);
			} else if(var == 4) { //Sealed Unstable Triroan.
				return defaultOnKillEvent(env, 237250, 4, 5);
			} else if(var == 5) { //Corrupted Ifrit.
				return defaultOnKillEvent(env, 237251, 5, true);
			}
		}
		return false;
	}
}