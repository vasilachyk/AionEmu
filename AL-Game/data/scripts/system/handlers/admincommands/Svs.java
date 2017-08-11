package admincommands;

import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.services.SvsService;
import com.aionemu.gameserver.utils.PacketSendUtility;
import com.aionemu.gameserver.utils.chathandlers.AdminCommand;
import org.apache.commons.lang.math.NumberUtils;

public class Svs extends AdminCommand
{
	private static final String COMMAND_START = "start";
	private static final String COMMAND_STOP = "stop";
	
	public Svs() {
		super("svs");
	}
	
	@Override
	public void execute(Player player, String... params) {
		if (params.length == 0) {
			showHelp(player);
			return;
		} if (COMMAND_STOP.equalsIgnoreCase(params[0]) || COMMAND_START.equalsIgnoreCase(params[0])) {
			handleStartStopSvs(player, params);
		}
	}
	
	protected void handleStartStopSvs(Player player, String... params) {
		if (params.length != 2 || !NumberUtils.isDigits(params[1])) {
			showHelp(player);
			return;
		}
		int svsId = NumberUtils.toInt(params[1]);
		if (!isValidSvsLocationId(player, svsId)) {
			showHelp(player);
			return;
		} if (COMMAND_START.equalsIgnoreCase(params[0])) {
			if (SvsService.getInstance().isSvsInProgress(svsId)) {
				PacketSendUtility.sendMessage(player, "<S.v.s> " + svsId + " is already start");
			} else {
				PacketSendUtility.sendMessage(player, "<S.v.s> " + svsId + " started!");
				SvsService.getInstance().startSvs(svsId);
			}
		} else if (COMMAND_STOP.equalsIgnoreCase(params[0])) {
			if (!SvsService.getInstance().isSvsInProgress(svsId)) {
				PacketSendUtility.sendMessage(player, "<S.v.s> " + svsId + " is not start!");
			} else {
				PacketSendUtility.sendMessage(player, "<S.v.s> " + svsId + " stopped!");
				SvsService.getInstance().stopSvs(svsId);
			}
		}
	}
	
	protected boolean isValidSvsLocationId(Player player, int svsId) {
		if (!SvsService.getInstance().getSvsLocations().keySet().contains(svsId)) {
			PacketSendUtility.sendMessage(player, "Id " + svsId + " is invalid");
			return false;
		}
		return true;
	}
	
	protected void showHelp(Player player) {
		PacketSendUtility.sendMessage(player, "AdminCommand //svs start|stop <Id>");
	}
}