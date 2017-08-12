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
package quest.archdaeva;

import com.aionemu.gameserver.model.*;
import com.aionemu.gameserver.model.gameobjects.*;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.questEngine.*;
import com.aionemu.gameserver.questEngine.handlers.*;
import com.aionemu.gameserver.questEngine.model.*;
import com.aionemu.gameserver.services.*;
import com.aionemu.gameserver.services.instance.*;
import com.aionemu.gameserver.services.teleport.*;
import com.aionemu.gameserver.services.mail.*;
import com.aionemu.gameserver.utils.*;
import com.aionemu.gameserver.world.*;
import com.aionemu.gameserver.world.zone.*;

/****/
/** Author Rinzler (Encom)
/** Source KOR: https://www.youtube.com/watch?v=8Qt-ZODwhoA
/****/

public class _10520Covert_Communiques extends QuestHandler
{
	public static final int questId = 10520;
	private final static int[] npcs = {203726, 806073, 806076};
	
	public _10520Covert_Communiques() {
		super(questId);
	}
	
    @Override
    public void register() {
        for (int npc: npcs) {
            qe.registerQuestNpc(npc).addOnTalkEvent(questId);
        }
		qe.registerOnLogOut(questId);
		qe.registerOnEnterWorld(questId);
		qe.registerQuestItem(182215973, questId);
		qe.registerOnEnterZone(ZoneName.get("LF6_SENSORY_AREA_Q10520_210100000"), questId);
    }
	
	@Override
    public boolean onEnterWorldEvent(QuestEnv env) {
        Player player = env.getPlayer();
        String title = "[ArchDaeva]";
        int itemId = 182215973;
        String name = env.getPlayer().getName();
        String messages = "Please check the letter included as soon as possible, as it contains important information" + " \n \n \n \n I sent you a sealed letter in an important matter. Read it as fast as possible";
        if (player.getRace() == Race.ELYOS && player.getWorldId() == 110010000 && player.getLevel() == 65 && player.getInventory().getItemCountByItemId(itemId) == 0) { // get Item by Level and Check Item if item is null.
        	QuestService.startQuest(env);
        	SystemMailService.getInstance().sendMail("Pernos", name, title, messages, itemId, 1, 0, LetterType.NORMAL);
            
        	return true;
        }
        return false;
    }
	
    @Override
	public boolean onDialogEvent(QuestEnv env) {
		final Player player = env.getPlayer();
        final QuestState qs = player.getQuestStateList().getQuestState(questId);
        if (qs == null) {
            return false;
        }
        int var = qs.getQuestVarById(0);
        int targetId = 0;
        if (env.getVisibleObject() instanceof Npc) {
            targetId = ((Npc) env.getVisibleObject()).getNpcId();
        } if (qs.getStatus() == QuestStatus.START) {
			if (targetId == 806073) { //Felen.
				switch (env.getDialog()) {
					case START_DIALOG: {
						if (var == 1) {
							return sendQuestDialog(env, 1352);
						}
					} case SELECT_ACTION_1353: {
						if (var == 1) {
							return sendQuestDialog(env, 1353);
						}
					} case STEP_TO_1: {
						changeQuestStep(env, 1, 2, false);
						return closeDialogWindow(env);
					}
				default:
					break;
				}
			} if (targetId == 203726) { //Polyidus.
				switch (env.getDialog()) {
					case START_DIALOG: {
						if (var == 2) {
							return sendQuestDialog(env, 1693);
						}
					} case SELECT_ACTION_1694: {
						if (var == 2) {
							return sendQuestDialog(env, 1694);
						}
					} case STEP_TO_2: {
						TeleportService2.teleportTo(env.getPlayer(), 210100000, 1456.6283f, 1299.3306f, 336.49023f, (byte) 8, TeleportAnimation.BEAM_ANIMATION);
						removeQuestItem(env, 182215973, 1);
						changeQuestStep(env, 2, 3, false);
						return closeDialogWindow(env);
					}
				default:
					break;
				}
			} if (targetId == 806076) { //Weatha.
				switch (env.getDialog()) {
					case START_DIALOG: {
						if (var == 4) {
							return sendQuestDialog(env, 2375);
						}
					} case SET_REWARD: {
						qs.setStatus(QuestStatus.REWARD);
						updateQuestStatus(env);
						return closeDialogWindow(env);
					}
				default:
					break;
				}
			}
		} else if (qs.getStatus() == QuestStatus.REWARD) {
            if (targetId == 806076) { //Weatha.
                if (env.getDialog() == QuestDialog.START_DIALOG) {
                    return sendQuestDialog(env, 10002);
                } else {
                    int[] ilumaMission = {10521, 10522, 10523, 10524, 10525, 10526, 10527, 10528, 10529};
                    for (int quest: ilumaMission) {
                        QuestEngine.getInstance().onEnterZoneMissionEnd(new QuestEnv(env.getVisibleObject(), env.getPlayer(), quest, env.getDialogId()));
                    }
                    return sendQuestEndDialog(env);
                }
            }
        }
		return false;
	}
	
	@Override
    public boolean onEnterZoneEvent(QuestEnv env, ZoneName zoneName) {
        final Player player = env.getPlayer();
        final QuestState qs = player.getQuestStateList().getQuestState(questId);
        if (qs != null && qs.getStatus() == QuestStatus.START) {
            int var = qs.getQuestVarById(0);
			if (zoneName == ZoneName.get("LF6_SENSORY_AREA_Q10520_210100000")) {
				if (var == 3) {
					playQuestMovie(env, 995);
					changeQuestStep(env, 3, 4, false);
					ThreadPoolManager.getInstance().schedule(new Runnable() {
						@Override
						public void run() {
							if (player != null) {
							    WorldMapInstance SanctuaryDungeon = InstanceService.getNextAvailableInstance(301580000);
							    InstanceService.registerPlayerWithInstance(SanctuaryDungeon, player);
							    TeleportService2.teleportTo(player, 301580000, SanctuaryDungeon.getInstanceId(), 431, 491, 99);
							}
						}
					}, 43000);
					return true;
				}
			}
		}
		return false;
	}
	
	@Override
    public HandlerResult onItemUseEvent(final QuestEnv env, Item item) {
        final Player player = env.getPlayer();
        final QuestState qs = player.getQuestStateList().getQuestState(questId);
        if (qs != null && qs.getStatus() == QuestStatus.START) {
            int var = qs.getQuestVarById(0);
            if (var == 0) {
                return HandlerResult.fromBoolean(useQuestItem(env, item, 0, 1, false));
            }
        }
        return HandlerResult.FAILED;
    }
	
	@Override
    public boolean onLogOutEvent(QuestEnv env) {
        final Player player = env.getPlayer();
        final QuestState qs = player.getQuestStateList().getQuestState(questId);
        if (qs != null && qs.getStatus() == QuestStatus.START) {
            int var = qs.getQuestVarById(0);
            if (var == 4) {
                qs.setQuestVar(1);
                updateQuestStatus(env);
                return true;
            }
        }
        return false;
    }
}