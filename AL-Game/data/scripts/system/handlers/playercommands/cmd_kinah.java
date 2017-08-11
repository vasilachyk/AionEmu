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

import com.aionemu.gameserver.model.PlayerClass;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.services.item.ItemService;
import com.aionemu.gameserver.utils.PacketSendUtility;
import com.aionemu.gameserver.utils.ThreadPoolManager;
import com.aionemu.gameserver.utils.chathandlers.PlayerCommand;

/**
 * @author Maestross
 */
public class cmd_kinah extends PlayerCommand {

    public cmd_kinah() {
        super("givekinah");
    }

	@Override
	public void execute(final Player player, String... params) {
		if (player.getPlayerClass() == PlayerClass.ASSASSIN) {
			ItemService.addItem(player, 182400001, 999999999); //
		} else if (player.getPlayerClass() == PlayerClass.CHANTER) {
			ItemService.addItem(player, 182400001, 999999999); //
		} else if (player.getPlayerClass() == PlayerClass.CLERIC) {
			ItemService.addItem(player, 182400001, 999999999); //
		} else if (player.getPlayerClass() == PlayerClass.GLADIATOR) {
			ItemService.addItem(player, 182400001, 999999999); //
		} else if (player.getPlayerClass() == PlayerClass.RANGER) {
			ItemService.addItem(player, 182400001, 999999999); //
		} else if (player.getPlayerClass() == PlayerClass.SORCERER) {
			ItemService.addItem(player, 182400001, 999999999); //
		} else if (player.getPlayerClass() == PlayerClass.SPIRIT_MASTER) {
			ItemService.addItem(player, 182400001, 999999999); //
		} else if (player.getPlayerClass() == PlayerClass.TEMPLAR) {
			ItemService.addItem(player, 182400001, 999999999); //
		} else if (player.getPlayerClass() == PlayerClass.SONGWEAVER) {
			ItemService.addItem(player, 182400001, 999999999); //
		} else if (player.getPlayerClass() == PlayerClass.GUNSLINGER) {
			ItemService.addItem(player, 182400001, 999999999); //
		} else if (player.getPlayerClass() == PlayerClass.AETHERTECH) {
			ItemService.addItem(player, 182400001, 999999999); //
		}
		player.setCommandUsed(true);

		ThreadPoolManager.getInstance().schedule(new Runnable() {
			@Override
			public void run() {
				player.setCommandUsed(false);
			}
		}, 500 * 500 * 100000);
		PacketSendUtility.sendMessage(player, "Finish!!");
	}

	@Override
	public void onFail(Player player, String message) {
		PacketSendUtility.sendMessage(player, "Syntax: .givekinah ");
	}
}
