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
package ai.instance.illuminaryObelisk;

import java.util.*;
import javolution.util.FastMap;

import java.util.concurrent.atomic.AtomicBoolean;
import com.aionemu.commons.network.util.ThreadPoolManager;

import com.aionemu.gameserver.ai2.*;
import com.aionemu.gameserver.model.*;
import com.aionemu.gameserver.model.gameobjects.*;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.model.templates.spawns.SpawnTemplate;
import com.aionemu.gameserver.spawnengine.SpawnEngine;
import com.aionemu.gameserver.network.aion.serverpackets.*;
import com.aionemu.gameserver.utils.*;
import com.aionemu.gameserver.world.*;
import com.aionemu.gameserver.world.knownlist.Visitor;

/****/
/** Author Rinzler (Encom)
/****/

@AIName("northern_shield_generator")
public class Northern_Shield_GeneratorAI2 extends NpcAI2
{
	private boolean isInstanceDestroyed;
	private AtomicBoolean isAggred = new AtomicBoolean(false);
	private FastMap<Integer, VisibleObject> objects = new FastMap<Integer, VisibleObject>();
	
	@Override
    protected void handleDialogStart(Player player) {
        if (player.getInventory().getFirstItemByItemId(164000289) != null) {
            PacketSendUtility.sendPacket(player, new SM_DIALOG_WINDOW(getObjectId(), 1011));
        } else {
            PacketSendUtility.sendPacket(player, new SM_SYSTEM_MESSAGE(1402211));
        }
    }
	
	@Override
	protected void handleAttack(Creature creature) {
		super.handleAttack(creature);
		if (isAggred.compareAndSet(false, true)) {
			switch (getNpcId()) {
				case 702013: //Northern Shield Generator.
				    announceIDF5U3Defence04();
				break;
			}
		}
	}
	
	private void announceIDF5U3Defence04() {
		getPosition().getWorldMapInstance().doOnAllPlayers(new Visitor<Player>() {
			@Override
			public void visit(Player player) {
				if (player.isOnline()) {
					PacketSendUtility.sendPacket(player, SM_SYSTEM_MESSAGE.STR_MSG_IDF5_U3_DEFENCE_04_ATTACKED);
				}
			}
		});
	}
	
	@Override
    public boolean onDialogSelect(final Player player, int dialogId, int questId, int extendedRewardIndex) {
		int instanceId = getPosition().getInstanceId();
		switch (getNpcId()) {
		    case 702013: //Northern Shield Generator.
		        switch (player.getWorldId()) {
		            case 301230000: //Illuminary Obelisk 4.5
				        if (dialogId == 10000 && player.getInventory().decreaseByItemId(164000289, 3)) {
			                startWNSG1();
					        PacketSendUtility.sendPacket(player, new SM_SYSTEM_MESSAGE(1402227));
					        SpawnTemplate CastShadowPLSM = SpawnEngine.addNewSingleTimeSpawn(301230000, 702017, 169.55626f, 254.52907f, 293.04276f, (byte) 0);
					        CastShadowPLSM.setEntityId(17);
					        objects.put(702017, SpawnEngine.spawnObject(CastShadowPLSM, instanceId));
					    }
				    break;
			    } switch (player.getWorldId()) {
				    case 301370000: //[Infernal] Illuminary Obelisk 4.7
					    if (dialogId == 10000 && player.getInventory().decreaseByItemId(164000289, 3)) {
					        startIWNSG1();
					        PacketSendUtility.sendPacket(player, new SM_SYSTEM_MESSAGE(1402227));
					        SpawnTemplate CastShadowPLSM = SpawnEngine.addNewSingleTimeSpawn(301370000, 702017, 169.55626f, 254.52907f, 293.04276f, (byte) 0);
						    CastShadowPLSM.setEntityId(17);
						    objects.put(702017, SpawnEngine.spawnObject(CastShadowPLSM, instanceId));
						}
					break;
				}
			break;
		}
		PacketSendUtility.sendPacket(player, new SM_DIALOG_WINDOW(getObjectId(), 0));
		return true;
	}
	
	private void startWNSG1() {
		ThreadPoolManager.getInstance().schedule(new Runnable() {
			@Override
			public void run() {
				attackGenerator((Npc)spawn(233720, 174.50981f, 251.38982f, 292.43088f, (byte) 0), 211.6748f, 252.11331f, 295.82132f, false);
				attackGenerator((Npc)spawn(233721, 174.9973f, 254.4739f, 292.3325f, (byte) 0), 211.53903f, 254.39848f, 295.99915f, false);
				attackGenerator((Npc)spawn(233722, 174.84029f, 257.80832f, 292.4389f, (byte) 0), 211.44466f, 257.45963f, 295.74582f, false);
			}
		}, 1000);
	}
	
	private void startIWNSG1() {
		ThreadPoolManager.getInstance().schedule(new Runnable() {
			@Override
			public void run() {
				attackGenerator((Npc)spawn(234720, 174.50981f, 251.38982f, 292.43088f, (byte) 0), 211.6748f, 252.11331f, 295.82132f, false);
				attackGenerator((Npc)spawn(234721, 174.9973f, 254.4739f, 292.3325f, (byte) 0), 211.53903f, 254.39848f, 295.99915f, false);
				attackGenerator((Npc)spawn(234722, 174.84029f, 257.80832f, 292.4389f, (byte) 0), 211.44466f, 257.45963f, 295.74582f, false);
			}
		}, 1000);
	}
	
	private void attackGenerator(final Npc npc, float x, float y, float z, boolean despawn) {
		((AbstractAI) npc.getAi2()).setStateIfNot(AIState.WALKING);
		npc.setState(1);
		npc.getMoveController().moveToPoint(x, y, z);
		PacketSendUtility.broadcastPacket(npc, new SM_EMOTION(npc, EmotionType.START_EMOTE2, 0, npc.getObjectId()));
	}
	
	public void onInstanceDestroy() {
		isInstanceDestroyed = true;
	}
}