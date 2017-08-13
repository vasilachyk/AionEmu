/**
 * This file is part of Aion-Lightning <aion-lightning.org>.
 *
 *  Aion-Lightning is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  Aion-Lightning is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details. *
 *  You should have received a copy of the GNU General Public License
 *  along with Aion-Lightning.
 *  If not, see <http://www.gnu.org/licenses/>.
 */
package playercommands;

import java.util.concurrent.Future;

import com.aionemu.gameserver.configs.main.SecurityConfig;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.services.PunishmentService;
import com.aionemu.gameserver.services.item.ItemRemodelService;
import com.aionemu.gameserver.utils.PacketSendUtility;
import com.aionemu.gameserver.utils.ThreadPoolManager;
import com.aionemu.gameserver.utils.chathandlers.PlayerCommand;
import com.aionemu.gameserver.world.World;

/**
 * @author Kashim
 * @rework Carbone13
 */
public class cmd_preview extends PlayerCommand {
	private Future<?> messageCount;

    private static final int REMODEL_PREVIEW_DURATION = 5;
	
	public cmd_preview() {
        super("preview");
    }
	
	public static boolean isFlooding(Player player)
	{
		player.setLastMessageTime();
		if (player.floodMsgCount() > SecurityConfig.FLOOD_MSG_PREVIEW) {
			//30 menit
			int delayInMinutes = 5;
			boolean state = true;
			String reason = "Flood Preview" ;
			PunishmentService.setIsInPrison(player, state, delayInMinutes, reason);
			PacketSendUtility.sendMessage(player, "Anda telah melakukan flood preview , kirim ke prison untuk " + delayInMinutes + " menit(s) karena " + reason + ".");
			//player.setGagged(true);
			
			return true;
		}
		return false;
	}
	
	public void isCantUse(final Player player) {
		final int delay = 5;
		messageCount = ThreadPoolManager.getInstance().schedule(new Runnable() {

			@Override
			public void run() {
				PacketSendUtility.sendMessage(player, "You Cant Use This Commands After" + delay);
			}
			
		}, delay);
		
	}

    public void executeCommand(Player admin, String[] params) {

        if (params.length < 1 || params[0] == "") {
            PacketSendUtility.sendMessage(admin, "Syntax: .preview <itemid>");
            return;
        }

        int itemId = 0;
        try {
            itemId = Integer.parseInt(params[0]);
        } catch (Exception e) {
            PacketSendUtility.sendMessage(admin,
                    "Error! Item id's harus nomor seperti 187000090 atau link [item:187000090]!");
            return;
        }
        ItemRemodelService.commandViewRemodelItem(admin, itemId, REMODEL_PREVIEW_DURATION);
    }

    @Override
    public void execute(Player player, String... params) {
		if (isFlooding(player)) {
        }
		if (player.getWorldId() == 510010000 || player.getWorldId() == 520010000) {
            PacketSendUtility.sendMessage(player, "Maaf anda tidak dapat melakukan perintah di dalama Prison");
		}
        executeCommand(player, params);
    }
}