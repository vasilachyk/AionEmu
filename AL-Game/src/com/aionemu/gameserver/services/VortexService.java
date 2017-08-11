package com.aionemu.gameserver.services;

import java.util.*;
import javolution.util.FastMap;

import com.aionemu.commons.services.CronService;
import com.aionemu.gameserver.configs.main.CustomConfig;
import com.aionemu.gameserver.configs.shedule.VortexSchedule;
import com.aionemu.gameserver.configs.shedule.VortexSchedule.Vortex;
import com.aionemu.gameserver.dataholders.DataManager;
import com.aionemu.gameserver.model.*;
import com.aionemu.gameserver.model.gameobjects.Npc;
import com.aionemu.gameserver.model.gameobjects.VisibleObject;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.model.templates.spawns.SpawnGroup2;
import com.aionemu.gameserver.model.templates.spawns.SpawnTemplate;
import com.aionemu.gameserver.model.templates.spawns.vortexspawns.*;
import com.aionemu.gameserver.model.vortex.*;
import com.aionemu.gameserver.services.rift.RiftInformer;
import com.aionemu.gameserver.services.vortexservice.*;
import com.aionemu.gameserver.services.rift.RiftManager;
import com.aionemu.gameserver.network.aion.serverpackets.*;
import com.aionemu.gameserver.spawnengine.SpawnEngine;
import com.aionemu.gameserver.utils.*;
import com.aionemu.gameserver.world.World;
import com.aionemu.gameserver.world.knownlist.Visitor;

public class VortexService
{
	private VortexSchedule vortexSchedule;
	private Map<Integer, VortexLocation> vortex;
	private static final int duration = CustomConfig.VORTEX_DURATION;
	private final Map<Integer, DimensionalVortex<?>> activeInvasions = new FastMap<Integer, DimensionalVortex<?>>().shared();
	
	public void initVortexLocations() {
		if (CustomConfig.VORTEX_ENABLED) {
			vortex = DataManager.VORTEX_DATA.getVortexLocations();
			for (VortexLocation loc: getVortexLocations().values()) {
				spawn(loc, VortexStateType.PEACE);
			}
		} else {
			vortex = Collections.emptyMap();
		}
	}
	
	public void initVortex() {
		if (CustomConfig.VORTEX_ENABLED) {
		    vortexSchedule = VortexSchedule.load();
		    for (Vortex vortex: vortexSchedule.getVortexsList()) {
			    for (String invasionTime: vortex.getInvasionTimes()) {
				    CronService.getInstance().schedule(new VortexStartRunnable(vortex.getId()), invasionTime);
			    }
			}
		}
	}
	
	public void startInvasion(final int id) {
		final DimensionalVortex<?> invasion;
		synchronized (this) {
			if (activeInvasions.containsKey(id)) {
				return;
			}
			invasion = new Invasion(vortex.get(id));
			activeInvasions.put(id, invasion);
		}
		invasion.start();
		theobomosVortexMsg(id);
		brusthoninVortexMsg(id);
		dimensionalVortexCountdownMsg(id);
		ThreadPoolManager.getInstance().schedule(new Runnable() {
			@Override
			public void run() {
				if (!invasion.isGeneratorDestroyed()) {
					stopInvasion(id);
				}
			}
		}, duration * 3600 * 1000);
	}
	
	public void stopInvasion(int id) {
		if (!isInvasionInProgress(id)) {
			return;
		}
		DimensionalVortex<?> invasion;
		synchronized (this) {
			invasion = activeInvasions.remove(id);
		} if (invasion == null || invasion.isFinished()) {
			return;
		}
		invasion.stop();
	}
	
	public void spawn(VortexLocation loc, VortexStateType state) {
		if (state.equals(VortexStateType.INVASION)) {
			RiftManager.getInstance().spawnVortex(loc);
			RiftInformer.sendRiftsInfo(loc.getHomeWorldId());
		}
		List<SpawnGroup2> locSpawns = DataManager.SPAWNS_DATA2.getVortexSpawnsByLocId(loc.getId());
		for (SpawnGroup2 group : locSpawns) {
			for (SpawnTemplate st : group.getSpawnTemplates()) {
				VortexSpawnTemplate vortextemplate = (VortexSpawnTemplate) st;
				if (vortextemplate.getStateType().equals(state)) {
					loc.getSpawned().add(SpawnEngine.spawnObject(vortextemplate, 1));
				}
			}
		}
	}
	
   /**
	* Dimensional Vortex Msg.
	*/
	public boolean theobomosVortexMsg(int id) {
        switch (id) {
            case 1:
                World.getInstance().doOnAllPlayers(new Visitor<Player>() {
					@Override
					public void visit(Player player) {
						if (player.getCommonData().getRace() == Race.ASMODIANS) {
						    //A Dimensional Vortex leading to Theobomos has appeared.
							PacketSendUtility.sendPacket(player, SM_SYSTEM_MESSAGE.STR_MSG_LIGHT_SIDE_INVADE_DIRECT_PORTAL_OPEN);
						}
					}
				});
			    return true;
            default:
                return false;
        }
    }
	public boolean brusthoninVortexMsg(int id) {
        switch (id) {
            case 1:
                World.getInstance().doOnAllPlayers(new Visitor<Player>() {
					@Override
					public void visit(Player player) {
						if (player.getCommonData().getRace() == Race.ELYOS) {
						    //A Dimensional Vortex leading to Brusthonin has appeared.
							PacketSendUtility.sendPacket(player, SM_SYSTEM_MESSAGE.STR_MSG_DARK_SIDE_INVADE_DIRECT_PORTAL_OPEN);
						}
					}
				});
			    return true;
            default:
                return false;
        }
    }
	
   /**
	* Dimensional Vortex Countdown.
	*/
	public boolean dimensionalVortexCountdownMsg(int id) {
        switch (id) {
            case 1:
				World.getInstance().doOnAllPlayers(new Visitor<Player>() {
					@Override
					public void visit(Player player) {
						//The Dimensional Vortex will close in 90 minutes. When it closes, the alliance will be disbanded and all infiltrators will be returned home.
						PacketSendUtility.playerSendPacketTime(player, SM_SYSTEM_MESSAGE.STR_MSG_INVADE_DIRECT_PORTAL_CLOSE_TIMER_90M, 1800000);
						//The Dimensional Vortex will close in 60 minutes. When it closes, the alliance will be disbanded and all infiltrators will be returned home.
						PacketSendUtility.playerSendPacketTime(player, SM_SYSTEM_MESSAGE.STR_MSG_INVADE_DIRECT_PORTAL_CLOSE_TIMER_60M, 3600000);
						//The Dimensional Vortex will close in 30 minutes. When it closes, the alliance will be disbanded and all infiltrators will be returned home.
						PacketSendUtility.playerSendPacketTime(player, SM_SYSTEM_MESSAGE.STR_MSG_INVADE_DIRECT_PORTAL_CLOSE_TIMER_30M, 5400000);
						//The Dimensional Vortex will close in 15 minutes. When it closes, the alliance will be disbanded and all infiltrators will be returned home.
						PacketSendUtility.playerSendPacketTime(player, SM_SYSTEM_MESSAGE.STR_MSG_INVADE_DIRECT_PORTAL_CLOSE_TIMER_15M, 6300000);
						//The Dimensional Vortex will close in 10 minutes. When it closes, the alliance will be disbanded and all infiltrators will be returned home.
						PacketSendUtility.playerSendPacketTime(player, SM_SYSTEM_MESSAGE.STR_MSG_INVADE_DIRECT_PORTAL_CLOSE_TIMER_10M, 6600000);
						//The Dimensional Vortex will close in 5 minutes. When it closes, the alliance will be disbanded and all infiltrators will be returned home.
						PacketSendUtility.playerSendPacketTime(player, SM_SYSTEM_MESSAGE.STR_MSG_INVADE_DIRECT_PORTAL_CLOSE_TIMER_5M, 6900000);
						//The Dimensional Vortex will close in 3 minutes. When it closes, the alliance will be disbanded and all infiltrators will be returned home.
						PacketSendUtility.playerSendPacketTime(player, SM_SYSTEM_MESSAGE.STR_MSG_INVADE_DIRECT_PORTAL_CLOSE_TIMER_3M, 7020000);
						//The Dimensional Vortex will close in 2 minutes. When it closes, the alliance will be disbanded and all infiltrators will be returned home.
						PacketSendUtility.playerSendPacketTime(player, SM_SYSTEM_MESSAGE.STR_MSG_INVADE_DIRECT_PORTAL_CLOSE_TIMER_2M, 7080000);
						//The Dimensional Vortex will close in 1 minutes. When it closes, the alliance will be disbanded and all infiltrators will be returned home.
						PacketSendUtility.playerSendPacketTime(player, SM_SYSTEM_MESSAGE.STR_MSG_INVADE_DIRECT_PORTAL_CLOSE_TIMER_1M, 7140000);
						//The Dimensional Vortex has closed, and you will be returned to where you entered.
						PacketSendUtility.playerSendPacketTime(player, SM_SYSTEM_MESSAGE.STR_MSG_INVADE_DIRECT_PORTAL_CLOSE_COMPULSION_TELEPORT, 7200000);
					}
				});
			    return true;
            default:
                return false;
        }
    }
	
	public void despawn(VortexLocation loc) {
		loc.setVortexController(null);
		for (VisibleObject npc : loc.getSpawned()) {
			((Npc) npc).getController().cancelTask(TaskId.RESPAWN);
			npc.getController().onDelete();
		}
		loc.getSpawned().clear();
	}
	
	public boolean isInvasionInProgress(int id) {
		return activeInvasions.containsKey(id);
	}
	
	public Map<Integer, DimensionalVortex<?>> getActiveInvasions() {
		return activeInvasions;
	}
	
	public int getDuration() {
		return duration;
	}
	
	public void removeDefenderPlayer(Player player) {
		for (DimensionalVortex<?> invasion : activeInvasions.values()) {
			if (invasion.getDefenders().containsKey(player.getObjectId())) {
				invasion.kickPlayer(player, false);
				return;
			}
		}
	}
	
	public void removeInvaderPlayer(Player player) {
		for (DimensionalVortex<?> invasion : activeInvasions.values()) {
			if (invasion.getInvaders().containsKey(player.getObjectId())) {
				invasion.kickPlayer(player, true);
				return;
			}
		}
	}
	
	public boolean isInvaderPlayer(Player player) {
		for (DimensionalVortex<?> invasion : activeInvasions.values()) {
			if (invasion.getInvaders().containsKey(player.getObjectId())) {
				return true;
			}
		}
		return false;
	}
	
	public boolean isInsideVortexZone(Player player) {
		int playerWorldId = player.getWorldId();
		if (playerWorldId == 210060000 || playerWorldId == 220050000) {
			VortexLocation loc = getLocationByWorld(playerWorldId);
			if (loc != null) {
				return loc.getPlayers().containsKey(player.getObjectId());
			}
		}
		return false;
	}
	
	public VortexLocation getLocationByRift(int npcId) {
		return getVortexLocation(npcId == 831073 ? 2 : 1); //Dimensional Vortex.
	}
	
	public VortexLocation getLocationByWorld(int worldId) {
		if (worldId == 210060000) { //Theobomos.
			return getVortexLocation(1);
		} else if (worldId == 220050000) { //Brusthonin.
			return getVortexLocation(2);
		} else {
			return null;
		}
	}
	
	public VortexLocation getVortexLocation(int id) {
		return vortex.get(id);
	}
	
	public Map<Integer, VortexLocation> getVortexLocations() {
		return vortex;
	}
	
	public void validateLoginZone(Player player) {
		VortexLocation loc = getLocationByWorld(player.getWorldId());
		if (loc != null && player.getRace().equals(loc.getInvadersRace())) {
			if (loc.isInsideLocation(player) && loc.isActive() && loc.getVortexController().getPassedPlayers().containsKey(player.getObjectId())) {
				return;
			}
			int mapId = loc.getHomeWorldId();
			float x = loc.getHomePoint().getX();
			float y = loc.getHomePoint().getY();
			float z = loc.getHomePoint().getZ();
			byte h = loc.getHomePoint().getHeading();
			World.getInstance().setPosition(player, mapId, x, y, z, h);
		}
	}
	
	public static VortexService getInstance() {
		return VortexServiceHolder.INSTANCE;
	}
	
	private static class VortexServiceHolder {
		private static final VortexService INSTANCE = new VortexService();
	}
}