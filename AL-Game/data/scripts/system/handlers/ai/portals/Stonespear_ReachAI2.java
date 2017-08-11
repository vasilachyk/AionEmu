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
package ai.portals;

import com.aionemu.gameserver.ai2.*;
import com.aionemu.gameserver.model.*;
import com.aionemu.gameserver.model.team2.group.PlayerGroup;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.services.instance.InstanceService;
import com.aionemu.gameserver.services.teleport.TeleportService2;
import com.aionemu.gameserver.network.aion.serverpackets.*;
import com.aionemu.gameserver.utils.*;

/****/
/** Author Rinzler (Encom)
/****/

@AIName("stonespear_reach")
public class Stonespear_ReachAI2 extends NpcAI2
{
	@Override
    protected void handleDialogStart(Player player) {
        if (player.getInventory().getFirstItemByItemId(185000230) != null) { //Stonespear Key.
            PacketSendUtility.sendPacket(player, new SM_DIALOG_WINDOW(getObjectId(), 10));
        } else {
            PacketSendUtility.sendPacket(player, new SM_DIALOG_WINDOW(getObjectId(), 1011));
        }
    }
	
	@Override
    public boolean onDialogSelect(final Player player, int dialogId, int questId, int extendedRewardIndex) {
		PlayerGroup group = player.getPlayerGroup2();
		if (player.getPlayerGroup2() == null) {
			//Unavailable to use when you're alone.
			PacketSendUtility.sendPacket(player, SM_SYSTEM_MESSAGE.STR_MSG_Ab1_Fortress_Entrance_In02);
			return true;
		} if (dialogId == 10000 && player.getInventory().decreaseByItemId(185000230, 1)) { //Stonespear Key.
		    switch (getNpcId()) {
		        case 833024: //Stonespear Reach Elyos [Elyos]
			    case 833025: //Stonespear Reach Elyos [Asmodians]
				case 833043: //Stonespear Reach Elyos [Elyos]
				case 833044: //Stonespear Reach Elyos [Asmodians]
				case 833045: //Stonespear Reach Elyos [Elyos]
				case 833046: //Stonespear Reach Elyos [Asmodians]
					//To Do...
					PacketSendUtility.broadcastPacket(player, new SM_MESSAGE(player, "This feature dont exist yet!!!", ChatType.BRIGHT_YELLOW_CENTER), true);
				break;
			}
		}
		return true;
	}
}