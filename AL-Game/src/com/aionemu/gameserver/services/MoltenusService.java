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

import java.util.*;
import javolution.util.FastMap;

import com.aionemu.commons.utils.Rnd;

import com.aionemu.commons.services.CronService;
import com.aionemu.gameserver.configs.main.CustomConfig;
import com.aionemu.gameserver.configs.shedule.MoltenusSchedule;
import com.aionemu.gameserver.configs.shedule.MoltenusSchedule.Moltenus;
import com.aionemu.gameserver.dataholders.DataManager;
import com.aionemu.gameserver.model.*;
import com.aionemu.gameserver.model.gameobjects.Npc;
import com.aionemu.gameserver.model.gameobjects.VisibleObject;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.model.templates.spawns.SpawnGroup2;
import com.aionemu.gameserver.model.templates.spawns.SpawnTemplate;
import com.aionemu.gameserver.model.templates.spawns.moltenusspawns.*;
import com.aionemu.gameserver.model.moltenus.*;
import com.aionemu.gameserver.services.moltenusservice.*;
import com.aionemu.gameserver.network.aion.serverpackets.*;
import com.aionemu.gameserver.spawnengine.SpawnEngine;
import com.aionemu.gameserver.utils.*;
import com.aionemu.gameserver.world.World;
import com.aionemu.gameserver.world.knownlist.Visitor;

/**
 * @author Rinzler (Encom)
 * http://aion.power.plaync.com/wiki/%EB%B6%84%EB%85%B8%EC%9D%98+%ED%8C%8C%ED%8E%B8+%EB%A9%94%EB%85%B8%ED%8B%B0%EC%98%A4%EC%8A%A4
 */

public class MoltenusService
{
	private MoltenusSchedule moltenusSchedule;
	private Map<Integer, MoltenusLocation> moltenus;
	private static final int duration = CustomConfig.MOLTENUS_DURATION;
	private final Map<Integer, MoltenusFight<?>> activeMoltenus = new FastMap<Integer, MoltenusFight<?>>().shared();
	
	public void initMoltenusLocations() {
		if (CustomConfig.MOLTENUS_ENABLED) {
			moltenus = DataManager.MOLTENUS_DATA.getMoltenusLocations();
			for (MoltenusLocation loc: getMoltenusLocations().values()) {
				spawn(loc, MoltenusStateType.PEACE);
			}
		} else {
			moltenus = Collections.emptyMap();
		}
	}
	
	public void initMoltenus() {
		if (CustomConfig.MOLTENUS_ENABLED) {
		    moltenusSchedule = MoltenusSchedule.load();
		    for (Moltenus moltenus: moltenusSchedule.getMoltenussList()) {
			    for (String fightTime: moltenus.getFightTimes()) {
				    CronService.getInstance().schedule(new MoltenusStartRunnable(moltenus.getId()), fightTime);
			    }
			}
		}
	}
	
	public void startMoltenus(final int id) {
		final MoltenusFight<?> boss;
		synchronized (this) {
			if (activeMoltenus.containsKey(id)) {
				return;
			}
			boss = new Boss(moltenus.get(id));
			activeMoltenus.put(id, boss);
		}
		boss.start();
		moltenusMsg(id);
		ThreadPoolManager.getInstance().schedule(new Runnable() {
			@Override
			public void run() {
				stopMoltenus(id);
			}
		}, duration * 3600 * 1000);
	}
	
	public void stopMoltenus(int id) {
		if (!isMoltenusInProgress(id)) {
			return;
		}
		MoltenusFight<?> boss;
		synchronized (this) {
			boss = activeMoltenus.remove(id);
		} if (boss == null || boss.isFinished()) {
			return;
		}
		boss.stop();
	}
	
	public void spawn(MoltenusLocation loc, MoltenusStateType mstate) {
		if (mstate.equals(MoltenusStateType.FIGHT)) {
		}
		List<SpawnGroup2> locSpawns = DataManager.SPAWNS_DATA2.getMoltenusSpawnsByLocId(loc.getId());
		for (SpawnGroup2 group : locSpawns) {
			for (SpawnTemplate st : group.getSpawnTemplates()) {
				MoltenusSpawnTemplate moltenustemplate = (MoltenusSpawnTemplate) st;
				if (moltenustemplate.getMStateType().equals(mstate)) {
					loc.getSpawned().add(SpawnEngine.spawnObject(moltenustemplate, 1));
				}
			}
		}
	}
	
	public boolean moltenusMsg(int id) {
        switch (id) {
            case 1:
                World.getInstance().doOnAllPlayers(new Visitor<Player>() {
					@Override
					public void visit(Player player) {
						PacketSendUtility.sendSys3Message(player, "\uE005", "<Resurrected Moltenus> appear in the abyss !!!");
					}
				});
			    return true;
            default:
                return false;
        }
    }
	
	public void despawn(MoltenusLocation loc) {
		for (VisibleObject npc : loc.getSpawned()) {
			((Npc) npc).getController().cancelTask(TaskId.RESPAWN);
			npc.getController().onDelete();
		}
		loc.getSpawned().clear();
	}
	
	public boolean isMoltenusInProgress(int id) {
		return activeMoltenus.containsKey(id);
	}
	
	public Map<Integer, MoltenusFight<?>> getActiveMoltenus() {
		return activeMoltenus;
	}
	
	public int getDuration() {
		return duration;
	}
	
	public MoltenusLocation getMoltenusLocation(int id) {
		return moltenus.get(id);
	}
	
	public Map<Integer, MoltenusLocation> getMoltenusLocations() {
		return moltenus;
	}
	
	public static MoltenusService getInstance() {
		return MoltenusServiceHolder.INSTANCE;
	}
	
	private static class MoltenusServiceHolder {
		private static final MoltenusService INSTANCE = new MoltenusService();
	}
}