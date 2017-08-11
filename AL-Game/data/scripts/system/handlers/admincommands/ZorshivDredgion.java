package admincommands;

import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.services.ZorshivDredgionService;
import com.aionemu.gameserver.utils.PacketSendUtility;
import com.aionemu.gameserver.utils.chathandlers.AdminCommand;
import com.aionemu.gameserver.network.aion.serverpackets.*;
import com.aionemu.gameserver.world.World;
import com.aionemu.gameserver.world.knownlist.Visitor;
import org.apache.commons.lang.math.NumberUtils;

public class ZorshivDredgion extends AdminCommand
{
	private static final String COMMAND_START = "start";
	private static final String COMMAND_STOP = "stop";
	
	public ZorshivDredgion() {
		super("zorshiv");
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
		int zorshivDredgionId = NumberUtils.toInt(params[1]);
		if (!isValidZorshivDredgionLocationId(player, zorshivDredgionId)) {
			showHelp(player);
			return;
		} if (COMMAND_START.equalsIgnoreCase(params[0])) {
			if (ZorshivDredgionService.getInstance().isZorshivDredgionInProgress(zorshivDredgionId)) {
				PacketSendUtility.sendMessage(player, "<Zorshiv Dredgion> " + zorshivDredgionId + " is already start");
			} else {
				PacketSendUtility.sendMessage(player, "<Zorshiv Dredgion> " + zorshivDredgionId + " started!");
				World.getInstance().doOnAllPlayers(new Visitor<Player>() {
					@Override
					public void visit(Player player) {
						PacketSendUtility.sendSys3Message(player, "\uE050", "The <Zorshiv Dredgion> to lands at levinshor !!!");
					}
				});
				ZorshivDredgionService.getInstance().startZorshivDredgion(zorshivDredgionId);
			}
		} else if (COMMAND_STOP.equalsIgnoreCase(params[0])) {
			if (!ZorshivDredgionService.getInstance().isZorshivDredgionInProgress(zorshivDredgionId)) {
				PacketSendUtility.sendMessage(player, "<Zorshiv Dredgion> " + zorshivDredgionId + " is not start!");
			} else {
				PacketSendUtility.sendMessage(player, "<Zorshiv Dredgion> " + zorshivDredgionId + " stopped!");
				ZorshivDredgionService.getInstance().stopZorshivDredgion(zorshivDredgionId);
			}
		}
	}
	
	protected boolean isValidZorshivDredgionLocationId(Player player, int zorshivDredgionId) {
		if (!ZorshivDredgionService.getInstance().getZorshivDredgionLocations().keySet().contains(zorshivDredgionId)) {
			PacketSendUtility.sendMessage(player, "Id " + zorshivDredgionId + " is invalid");
			return false;
		}
		return true;
	}
	
	protected void showHelp(Player player) {
		PacketSendUtility.sendMessage(player, "AdminCommand //zorshiv start|stop <Id>");
	}
}