package playercommands;

import com.aionemu.gameserver.configs.main.*;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.services.events.*;
import com.aionemu.gameserver.utils.*;
import com.aionemu.gameserver.utils.chathandlers.PlayerCommand;

/**
 * Created by wanke on 12/02/2017.
 */

public class cmd_ffa extends PlayerCommand
{
    public cmd_ffa() {
        super("ffa");
    }
	
    @Override
    public void execute(Player player, String... params) {
		if (!PvPModConfig.FFA_ENABLED) {
            PacketSendUtility.sendSys3Message(player, "\uE005", "The <FFA> mod is disabled!!!");
			return;
        } if (player.getLevel() < 10) {
			PacketSendUtility.sendSys3Message(player, "\uE005", "You must reached lvl 10 for use <FFA> mod!!!");
            return;
        } if (player.isInInstance() && !FFAService.getInstance().isInArena(player) && !player.isFFA()) {
			PacketSendUtility.sendSys3Message(player, "\uE005", "You can't use <FFA> mod in instance!!!");
            return;
        } if (player.getBattleground() != null || LadderService.getInstance().isInQueue(player) || player.isSpectating()||player.getLifeStats().isAlreadyDead()) {
            PacketSendUtility.sendSys3Message(player, "\uE005", "You cannot enter <FFA> while in a battleground, in the queue, while spectating or being dead !!!");
            return;
        } if (FFAService.getInstance().isInArena(player)) {
            PacketSendUtility.sendSys3Message(player, "\uE005", "You will be leaving <FFA> in 10 seconds!");
            FFAService.getInstance().leaveArena(player);
        } else {
            if (player.getController().isInCombat()) {
                PacketSendUtility.sendSys3Message(player, "\uE005", "You cannot enter <FFA> while in combat.");
                return;
            }
            PacketSendUtility.sendSys3Message(player, "\uE005", "You will be entering <FFA> mod in 10 seconds. To leave <FFA> mod, writte .ffa!!!");
            FFAService.getInstance().enterArena(player, false);
        }
    }
}