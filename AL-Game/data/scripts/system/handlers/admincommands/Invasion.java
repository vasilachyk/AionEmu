package admincommands;

import com.aionemu.gameserver.model.*;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.services.VortexService;
import com.aionemu.gameserver.utils.PacketSendUtility;
import com.aionemu.gameserver.utils.chathandlers.AdminCommand;
import com.aionemu.gameserver.network.aion.serverpackets.*;
import com.aionemu.gameserver.world.World;
import com.aionemu.gameserver.world.knownlist.Visitor;
import org.apache.commons.lang.math.NumberUtils;

public class Invasion extends AdminCommand
{
	private static final String COMMAND_START = "start";
	private static final String COMMAND_STOP = "stop";
	
	public Invasion() {
		super("invasion");
	}
	
	@Override
	public void execute(Player player, String... params) {
		if (params.length == 0) {
			showHelp(player);
			return;
		} if (COMMAND_STOP.equalsIgnoreCase(params[0]) || COMMAND_START.equalsIgnoreCase(params[0])) {
			handleStartStopInvasion(player, params);
		}
	}
	
	protected void handleStartStopInvasion(Player player, String... params) {
		if (params.length != 2 || !NumberUtils.isDigits(params[1])) {
			showHelp(player);
			return;
		}
		int vortexId = NumberUtils.toInt(params[1]);
		if (!isValidVortexLocationId(player, vortexId)) {
			showHelp(player);
			return;
		} if (COMMAND_START.equalsIgnoreCase(params[0])) {
			if (VortexService.getInstance().isInvasionInProgress(vortexId)) {
				PacketSendUtility.sendMessage(player, "<Vortex Location> " + vortexId + " is already start");
			} else {
				PacketSendUtility.sendMessage(player, "<Vortex Location> " + vortexId + " started!");
				World.getInstance().doOnAllPlayers(new Visitor<Player>() {
					@Override
					public void visit(Player player) {
						if (player.getCommonData().getRace() == Race.ELYOS) {
						    //A Dimensional Vortex leading to Brusthonin has appeared.
						    PacketSendUtility.sendPacket(player, SM_SYSTEM_MESSAGE.STR_MSG_DARK_SIDE_INVADE_DIRECT_PORTAL_OPEN);
						}
					}
				});
				World.getInstance().doOnAllPlayers(new Visitor<Player>() {
					@Override
					public void visit(Player player) {
						if (player.getCommonData().getRace() == Race.ASMODIANS) {
						    //A Dimensional Vortex leading to Theobomos has appeared.
						    PacketSendUtility.sendPacket(player, SM_SYSTEM_MESSAGE.STR_MSG_LIGHT_SIDE_INVADE_DIRECT_PORTAL_OPEN);
						}
					}
				});
				VortexService.getInstance().startInvasion(vortexId);
			}
		} else if (COMMAND_STOP.equalsIgnoreCase(params[0])) {
			if (!VortexService.getInstance().isInvasionInProgress(vortexId)) {
				PacketSendUtility.sendMessage(player, "<Vortex Location> " + vortexId + " is not start!");
			} else {
				PacketSendUtility.sendMessage(player, "<Vortex Location> " + vortexId + " stopped!");
				VortexService.getInstance().stopInvasion(vortexId);
			}
		}
	}
	
	protected boolean isValidVortexLocationId(Player player, int vortexId) {
		if (!VortexService.getInstance().getVortexLocations().keySet().contains(vortexId)) {
			PacketSendUtility.sendMessage(player, "Id " + vortexId + " is invalid");
			return false;
		}
		return true;
	}
	
	protected void showHelp(Player player) {
		PacketSendUtility.sendMessage(player, "AdminCommand //invasion start|stop <Id>");
	}
}