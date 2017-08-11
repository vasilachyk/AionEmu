package admincommands;

import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.services.AnohaService;
import com.aionemu.gameserver.utils.PacketSendUtility;
import com.aionemu.gameserver.utils.chathandlers.AdminCommand;
import com.aionemu.gameserver.network.aion.serverpackets.*;
import com.aionemu.gameserver.world.World;
import com.aionemu.gameserver.world.knownlist.Visitor;
import org.apache.commons.lang.math.NumberUtils;

public class Anoha extends AdminCommand
{
	private static final String COMMAND_START = "start";
	private static final String COMMAND_STOP = "stop";
	
	public Anoha() {
		super("anoha");
	}
	
	@Override
	public void execute(Player player, String... params) {
		if (params.length == 0) {
			showHelp(player);
			return;
		} if (COMMAND_STOP.equalsIgnoreCase(params[0]) || COMMAND_START.equalsIgnoreCase(params[0])) {
			handleStartStop(player, params);
		}
	}
	
	protected void handleStartStop(Player player, String... params) {
		if (params.length != 2 || !NumberUtils.isDigits(params[1])) {
			showHelp(player);
			return;
		}
		int anohaId = NumberUtils.toInt(params[1]);
		if (!isValidAnohaLocationId(player, anohaId)) {
			showHelp(player);
			return;
		} if (COMMAND_START.equalsIgnoreCase(params[0])) {
			if (AnohaService.getInstance().isAnohaInProgress(anohaId)) {
				PacketSendUtility.sendMessage(player, "<Anoha> " + anohaId + " is already start");
			} else {
				PacketSendUtility.sendMessage(player, "<Anoha> " + anohaId + " started!");
				AnohaService.getInstance().startAnoha(anohaId);
			}
		} else if (COMMAND_STOP.equalsIgnoreCase(params[0])) {
			if (!AnohaService.getInstance().isAnohaInProgress(anohaId)) {
				PacketSendUtility.sendMessage(player, "<Anoha> " + anohaId + " is not start!");
			} else {
				PacketSendUtility.sendMessage(player, "<Anoha> " + anohaId + " stopped!");
				AnohaService.getInstance().stopAnoha(anohaId);
			}
		}
	}
	
	protected boolean isValidAnohaLocationId(Player player, int anohaId) {
		if (!AnohaService.getInstance().getAnohaLocations().keySet().contains(anohaId)) {
			PacketSendUtility.sendMessage(player, "Id " + anohaId + " is invalid");
			return false;
		}
		return true;
	}
	
	protected void showHelp(Player player) {
		PacketSendUtility.sendMessage(player, "AdminCommand //anoha start|stop <Id>");
	}
}