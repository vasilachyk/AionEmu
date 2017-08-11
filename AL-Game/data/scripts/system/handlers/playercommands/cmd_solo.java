package playercommands;

import java.util.Map;

import javolution.util.FastMap;

import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.services.events.*;
import com.aionemu.gameserver.utils.*;
import com.aionemu.gameserver.utils.chathandlers.PlayerCommand;

public class cmd_solo extends PlayerCommand
{
    private static Map<Integer, Long> nextUse = new FastMap<Integer, Long>();
    private static final int REGISTRATION_DELAY = 8 * 60 * 1000;
    
	public cmd_solo() {
        super("vs");
    }
	
    @Override
    public void execute(Player player, String... params) {
        if (!LadderService.getInstance().isInQueue(player)) {
            if (LadderService.getInstance().registerForSolo(player)) {
                PacketSendUtility.sendSys3Message(player, "\uE005", "You are now registered in queue <1Vs1>");
            } else {
                PacketSendUtility.sendSys3Message(player, "\uE005", "Failed to save in queue <1Vs1>");
            }
        } else {
            LadderService.getInstance().unregisterFromQueue(player);
            PacketSendUtility.sendSys3Message(player, "\uE005", "You are now unsubscribed from queue <1Vs1>");
        }
    }
}