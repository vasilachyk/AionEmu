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
package com.aionemu.gameserver.services;

import java.util.Collections;
import java.util.List;
import java.util.Map;
import javolution.util.FastMap;

import com.aionemu.commons.services.CronService;
import com.aionemu.gameserver.configs.main.CustomConfig;
import com.aionemu.gameserver.configs.shedule.AgentSchedule;
import com.aionemu.gameserver.configs.shedule.AgentSchedule.Agent;
import com.aionemu.gameserver.dataholders.DataManager;
import com.aionemu.gameserver.model.*;
import com.aionemu.gameserver.model.gameobjects.Npc;
import com.aionemu.gameserver.model.gameobjects.VisibleObject;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.model.templates.spawns.SpawnGroup2;
import com.aionemu.gameserver.model.templates.spawns.SpawnTemplate;
import com.aionemu.gameserver.model.templates.spawns.agentspawns.*;
import com.aionemu.gameserver.model.agent.*;
import com.aionemu.gameserver.services.agentservice.*;
import com.aionemu.gameserver.network.aion.serverpackets.*;
import com.aionemu.gameserver.spawnengine.SpawnEngine;
import com.aionemu.gameserver.utils.PacketSendUtility;
import com.aionemu.gameserver.utils.ThreadPoolManager;
import com.aionemu.gameserver.world.World;
import com.aionemu.gameserver.world.knownlist.Visitor;

/**
 * @author Rinzler (Encom)
 */

public class AgentService
{
	private AgentSchedule agentSchedule;
	private Map<Integer, AgentLocation> agent;
	private static final int duration = CustomConfig.AGENT_DURATION;
	private final Map<Integer, AgentFight<?>> activeFights = new FastMap<Integer, AgentFight<?>>().shared();
	
	public void initAgentLocations() {
		if (CustomConfig.AGENT_ENABLED) {
			agent = DataManager.AGENT_DATA.getAgentLocations();
			for (AgentLocation loc: getAgentLocations().values()) {
				spawn(loc, AgentStateType.PEACE);
			}
		} else {
			agent = Collections.emptyMap();
		}
	}
	
	public void initAgent() {
		if (CustomConfig.AGENT_ENABLED) {
		    agentSchedule = AgentSchedule.load();
		    for (Agent agent: agentSchedule.getAgentsList()) {
			    for (String fightTime: agent.getFightTimes()) {
				    CronService.getInstance().schedule(new AgentStartRunnable(agent.getId()), fightTime);
			    }
			}
		}
	}
	
	public void startAgentFight(final int id) {
		final AgentFight<?> fight;
		synchronized (this) {
			if (activeFights.containsKey(id)) {
				return;
			}
			fight = new Fight(agent.get(id));
			activeFights.put(id, fight);
		}
		fight.start();
		empyreanLordCountdownMsg(id);
		ThreadPoolManager.getInstance().schedule(new Runnable() {
			@Override
			public void run() {
				stopAgentFight(id);
			}
		}, duration * 3600 * 1000);
	}
	
	public void stopAgentFight(int id) {
		if (!isFightInProgress(id)) {
			return;
		}
		AgentFight<?> fight;
		synchronized (this) {
			fight = activeFights.remove(id);
		} if (fight == null || fight.isFinished()) {
			return;
		}
		fight.stop();
	}
	
	public void spawn(AgentLocation loc, AgentStateType astate) {
		if (astate.equals(AgentStateType.FIGHT)) {
		}
		List<SpawnGroup2> locSpawns = DataManager.SPAWNS_DATA2.getAgentSpawnsByLocId(loc.getId());
		for (SpawnGroup2 group : locSpawns) {
			for (SpawnTemplate st : group.getSpawnTemplates()) {
				AgentSpawnTemplate agenttemplate = (AgentSpawnTemplate) st;
				if (agenttemplate.getAStateType().equals(astate)) {
					loc.getSpawned().add(SpawnEngine.spawnObject(agenttemplate, 1));
				}
			}
		}
	}
	
   /**
	* The Empyrean Lord's Agent Countdown.
	*/
	public boolean empyreanLordCountdownMsg(int id) {
        switch (id) {
            case 1:
                World.getInstance().doOnAllPlayers(new Visitor<Player>() {
					@Override
					public void visit(Player player) {
						//The Empyrean Lord's Agent will end the battle in 30 minutes.
						PacketSendUtility.playerSendPacketTime(player, SM_SYSTEM_MESSAGE.STR_MSG_GODELITE_TimeAttack_Start, 5400000);
						//The Empyrean Lord's Agent has disappeared.
						PacketSendUtility.playerSendPacketTime(player, SM_SYSTEM_MESSAGE.STR_MSG_GODELITE_TimeAttack_Fail, 7200000);
					}
				});
			    return true;
            default:
                return false;
        }
    }
	
	public boolean agentBattleMsg1(int id) {
        switch (id) {
            case 1:
                World.getInstance().doOnAllPlayers(new Visitor<Player>() {
					@Override
					public void visit(Player player) {
						//The Agent battle will start in 10 minutes.
						PacketSendUtility.playerSendPacketTime(player, SM_SYSTEM_MESSAGE.STR_MSG_LDF4_Advance_GodElite_time_01, 0);
					}
				});
			    return true;
            default:
                return false;
        }
    }
	public boolean agentBattleMsg2(int id) {
        switch (id) {
            case 1:
                World.getInstance().doOnAllPlayers(new Visitor<Player>() {
					@Override
					public void visit(Player player) {
						//The Agent battle will start in 5 minutes.
						PacketSendUtility.playerSendPacketTime(player, SM_SYSTEM_MESSAGE.STR_MSG_LDF4_Advance_GodElite_time_02, 0);
					}
				});
			    return true;
            default:
                return false;
        }
    }
	
	public void despawn(AgentLocation loc) {
		for (VisibleObject npc : loc.getSpawned()) {
			((Npc) npc).getController().cancelTask(TaskId.RESPAWN);
			npc.getController().onDelete();
		}
		loc.getSpawned().clear();
	}
	
	public boolean isFightInProgress(int id) {
		return activeFights.containsKey(id);
	}
	
	public Map<Integer, AgentFight<?>> getActiveFights() {
		return activeFights;
	}
	
	public int getDuration() {
		return duration;
	}
	
	public AgentLocation getAgentLocation(int id) {
		return agent.get(id);
	}
	
	public Map<Integer, AgentLocation> getAgentLocations() {
		return agent;
	}
	
	public static AgentService getInstance() {
		return AgentServiceHolder.INSTANCE;
	}
	
	private static class AgentServiceHolder {
		private static final AgentService INSTANCE = new AgentService();
	}
}