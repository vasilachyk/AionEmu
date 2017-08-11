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
package ai.worlds.reshanta.worldBoss.kysis;

import ai.AggressiveNpcAI2;

import com.aionemu.gameserver.ai2.*;
import com.aionemu.gameserver.model.gameobjects.*;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.network.aion.serverpackets.*;
import com.aionemu.gameserver.utils.*;
import com.aionemu.gameserver.world.*;
import com.aionemu.gameserver.world.knownlist.Visitor;

/****/
/** Author Rinzler (Encom)
/****/

@AIName("unsealed_kysis")
public class Kysis_OverlordAI2 extends AggressiveNpcAI2
{
	@Override
	protected void handleAttack(Creature creature) {
		super.handleAttack(creature);
	}
	
	@Override
    protected void handleSpawned() {
        super.handleSpawned();
		announceUnsealedKysis();
    }
	
	@Override
	protected void handleDied() {
		switch (getNpcId()) {
			//Kysis Fortress.
			case 279349:
			case 279643:
			case 279935:
				treasureChest();
				ThreadPoolManager.getInstance().schedule(new Runnable() {
			        @Override
			        public void run() {
						spawn(701481, 2485.3538f, 2111.3738f, 3004.3726f, (byte) 76);
			            spawn(701481, 2482.2014f, 2115.991f, 3004.3726f, (byte) 68);
			            spawn(701481, 2488.5947f, 2108.648f, 3004.3726f, (byte) 79);
			            spawn(701481, 2493.666f, 2106.146f, 3004.3726f, (byte) 83);
			            spawn(701481, 2498.6328f, 2104.8926f, 3004.3726f, (byte) 85);
			            spawn(701481, 2480.5835f, 2120.1895f, 3004.3726f, (byte) 65);
			        }
		        }, 10000);
			break;
		}
		super.handleDied();
	}
	
	private void treasureChest() {
		getPosition().getWorldMapInstance().doOnAllPlayers(new Visitor<Player>() {
			@Override
			public void visit(Player player) {
				//A treasure chest has appeared.
				PacketSendUtility.sendPacket(player, SM_SYSTEM_MESSAGE.STR_MSG_IDAbRe_Core_NmdC_BoxSpawn);
			}
		});
	}
	
	private void announceUnsealedKysis() {
		World.getInstance().doOnAllPlayers(new Visitor<Player>() {
			@Override
			public void visit(Player player) {
				//Unsealed Kysis.
				PacketSendUtility.sendPacket(player, SM_SYSTEM_MESSAGE.STR_MSG_Ab1_Dkisas_Named_Spawn);
			}
		});
	}
}