package playercommands;

import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.services.events.*;
import com.aionemu.gameserver.utils.*;
import com.aionemu.gameserver.utils.chathandlers.PlayerCommand;

/**
 * Created by wanke on 13/02/2017.
 */

public class cmd_pk extends PlayerCommand
{
    public cmd_pk() {
        super("pk");
    }
	
    @Override
    public void execute(Player player, String... params) {
        if (!player.isBandit()) {
            BanditService.getInstance().startBandit(player);
            PacketSendUtility.sendSys3Message(player, "\uE005", "<[PK] Bandit> started !!!");
        } else {
            BanditService.getInstance().stopBandit(player);
            PacketSendUtility.sendSys3Message(player, "\uE005", "<[PK] Bandit> stop !!!");
        }
    }
}