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
package ai.siege;

import com.aionemu.gameserver.ai2.*;
import com.aionemu.gameserver.model.*;
import com.aionemu.gameserver.model.gameobjects.*;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.model.gameobjects.player.RequestResponseHandler;
import com.aionemu.gameserver.network.aion.serverpackets.*;
import com.aionemu.gameserver.utils.*;
import com.aionemu.gameserver.world.*;
import com.aionemu.gameserver.world.knownlist.Visitor;

/****/
/** Author Rinzler (Encom)
/****/

@AIName("siege_gate_repair")
public class GateGuardianStoneAI2 extends NpcAI2
{
	@Override
	protected void handleDialogStart(final Player player) {
		RequestResponseHandler gaterepair = new RequestResponseHandler(player) {
			@Override
			public void acceptRequest(Creature requester, Player responder) {
				RequestResponseHandler repairstone = new RequestResponseHandler(player) {
					@Override
					public void acceptRequest(Creature requester, Player responder) {
						onActivate(player);
					}
					@Override
					public void denyRequest(Creature requester, Player responder) {
					}
				};
				if (player.getResponseRequester().putRequest(SM_QUESTION_WINDOW.STR_ASK_DOOR_REPAIR_DO_YOU_ACCEPT_REPAIR, repairstone)) {
					PacketSendUtility.sendPacket(player, new SM_QUESTION_WINDOW(SM_QUESTION_WINDOW.STR_ASK_DOOR_REPAIR_DO_YOU_ACCEPT_REPAIR, player.getObjectId(), 5, new DescriptionId(2 * 716568 + 1)));
				}
			}
			
			@Override
			public void denyRequest(Creature requester, Player responder) {
			}
		};
		if (player.getResponseRequester().putRequest(SM_QUESTION_WINDOW.STR_ASK_DOOR_REPAIR_POPUPDIALOG, gaterepair)) {
			PacketSendUtility.sendPacket(player, new SM_QUESTION_WINDOW(SM_QUESTION_WINDOW.STR_ASK_DOOR_REPAIR_POPUPDIALOG, player.getObjectId(), 5));
		}
	}
	
	@Override
    protected void handleDied() {
        final Player destroyer;
        Creature lastAttacker = (Creature) getOwner().getAggroList().getMostDamage();
        if (lastAttacker instanceof Player) {
            destroyer = (Player) lastAttacker;
        } else if (lastAttacker instanceof Trap) {
            destroyer = (Player) ((Trap) lastAttacker).getMaster();
        } else if (lastAttacker instanceof Summon) {
            destroyer = ((Summon) lastAttacker).getMaster();
        } else {
            destroyer = null;
        } if (destroyer != null) {
            getOwner().getKnownList().doOnAllPlayers(new Visitor<Player>() {
                @Override
                public void visit(Player object) {
                    //"Player Name" of the "Race" destroyed the Gate Guardian Stone.
					PacketSendUtility.sendPacket(object, new SM_SYSTEM_MESSAGE(1301054, destroyer.getRace().getRaceDescriptionId(), destroyer.getName()));
                }
            });
        }
        super.handleDied();
    }
	
	@Override
	protected void handleDialogFinish(Player player) {
	}
	
	public void onActivate(Player player) {
	}
}