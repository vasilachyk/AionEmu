package com.aionemu.gameserver.services.player;

import com.aionemu.gameserver.configs.main.EventsConfig;
import com.aionemu.gameserver.model.*;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.network.aion.serverpackets.*;
import com.aionemu.gameserver.services.*;
import com.aionemu.gameserver.services.item.ItemService;
import com.aionemu.gameserver.utils.*;
import com.aionemu.gameserver.world.World;
import com.aionemu.gameserver.world.knownlist.Visitor;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

public class PlayerEventService
{
	private static final Logger log = LoggerFactory.getLogger(PlayerEventService.class);
	
	private PlayerEventService() {
	   /**
		* Event Awake [Event JAP] http://event2.ncsoft.jp/1.0/aion/1503awake/
	    */
		final EventAwake awake = new EventAwake();
		ThreadPoolManager.getInstance().scheduleAtFixedRate(new Runnable() {
			@Override
			public void run() {
				World.getInstance().doOnAllPlayers(awake);
			}
		}, EventsConfig.SEED_TRANSFORMATION_PERIOD * 60000, EventsConfig.SEED_TRANSFORMATION_PERIOD * 60000);
	   /**
		* VIP Tickets.
	    */
		final AnnounceVIPTickets vipTickets = new AnnounceVIPTickets();
		ThreadPoolManager.getInstance().scheduleAtFixedRate(new Runnable() {
			@Override
			public void run() {
				World.getInstance().doOnAllPlayers(vipTickets);
			}
		}, EventsConfig.VIP_TICKETS_PERIOD * 60000, EventsConfig.VIP_TICKETS_PERIOD * 60000);
	}
	
	private static final class AnnounceVIPTickets implements Visitor<Player> {
		@Override
		public void visit(Player player) {
			if (EventsConfig.ENABLE_VIP_TICKETS) {
			    if (player.getLevel() >= 1 && player.getLevel() <= 65) {
				    HTMLService.sendGuideHtml(player, "VIP_Benefits");
				    //You can become stronger with the VIP benefits.\n See the VIP Tickets in the in-game shop.
				    PacketSendUtility.sendPacket(player, new SM_QUESTION_WINDOW(SM_QUESTION_WINDOW.STR_VIP_LOBBY_NOTICE_CASE12_POPUP_01, 0, 0));
				} if (player.getLevel() >= 66 && player.getLevel() <= 83) {
				    HTMLService.sendGuideHtml(player, "ArchDaeva_Benefits");
				    //You can become stronger with the VIP benefits.\n See the VIP Tickets in the in-game shop.
				    PacketSendUtility.sendPacket(player, new SM_QUESTION_WINDOW(SM_QUESTION_WINDOW.STR_VIP_LOBBY_NOTICE_CASE12_POPUP_01, 0, 0));
				}
			}
		}
	};
	
	private static final class EventAwake implements Visitor<Player> {
		@Override
		public void visit(Player player) {
			if (EventsConfig.ENABLE_AWAKE_EVENT) {
				if (player.getLevel() >= 10 && player.getLevel() <= 64) {
				    HTMLService.sendGuideHtml(player, "Event_Awake_10");
				} if (player.getLevel() >= 65 && player.getLevel() <= 83) {
				    HTMLService.sendGuideHtml(player, "Event_Awake_65");
				}
			}
		}
	};
	
	public static PlayerEventService getInstance() {
		return SingletonHolder.instance;
	}
	
	private static class SingletonHolder {
		protected static final PlayerEventService instance = new PlayerEventService();
	}
}