package com.aionemu.gameserver.utils.audit;

import java.util.*;

import javolution.util.FastMap;

import com.aionemu.commons.database.dao.DAOManager;
import com.aionemu.gameserver.configs.administration.AdminConfig;
import com.aionemu.gameserver.configs.main.MembershipConfig;
import com.aionemu.gameserver.dao.PlayerDAO;
import com.aionemu.gameserver.model.ChatType;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.network.aion.serverpackets.SM_MESSAGE;
import com.aionemu.gameserver.utils.PacketSendUtility;
import com.aionemu.gameserver.world.World;

public class GMService
{
	public static final GMService getInstance() {
		return SingletonHolder.instance;
	}
	
	private Map<Integer, Player> gms = new FastMap<Integer, Player>();
	private boolean announceAny = false;
	private List<Byte> announceList;
	private GMService() {
		announceList = new ArrayList<Byte>();
		announceAny = AdminConfig.ANNOUNCE_LEVEL_LIST.equals("*");
		if (!announceAny) {
			try {
				for (String level : AdminConfig.ANNOUNCE_LEVEL_LIST.split(","))
				announceList.add(Byte.parseByte(level));
			} catch (Exception e) {
				announceAny = true;
			}
		}
	}
	
	public Collection<Player> getGMs(){
		return gms.values();
	}
	
	public void onPlayerLogin(Player player){
		if (player.isGM()){
			gms.put(player.getObjectId(), player);
			if (announceAny) 
			   PacketSendUtility.broadcastPacket(player, new SM_MESSAGE(player, "Announce: " + player.getCustomTag(true) + player.getName() + " appear !!", ChatType.BRIGHT_YELLOW_CENTER), true);
            else if (announceList.contains(Byte.valueOf(player.getAccessLevel())))
			   PacketSendUtility.broadcastPacket(player, new SM_MESSAGE(player, "Announce: " + player.getCustomTag(true) + player.getName() + " appear !!", ChatType.BRIGHT_YELLOW_CENTER), true);
		}
	}
	
	public void onPlayerLogedOut(Player player){
		gms.remove(player.getObjectId());
	}
	
	public void onPlayerAvailable(Player player) {
        if (player.isGM()) {
            gms.put(player.getObjectId(), player);
            String adminTag = "%s";
            StringBuilder sb = new StringBuilder(adminTag);
            
            // * = Premium & VIP Membership
            if (MembershipConfig.PREMIUM_TAG_DISPLAY) {
            	switch (player.getClientConnection().getAccount().getMembership()) {
            		case 1:
            			adminTag = sb.replace(0, sb.length(), MembershipConfig.TAG_PREMIUM).toString();
            			break;
            		case 2:
            			adminTag = sb.replace(0, sb.length(), MembershipConfig.TAG_VIP).toString();
            			break;
            	}
            }
         			
            // * = Wedding
            if (player.isMarried()) {
            	String partnerName = DAOManager.getDAO(PlayerDAO.class).getPlayerNameByObjId(player.getPartnerId());
            	adminTag += "\uE020"+ partnerName;
            }
         			
            // * = Server Staff Access Level
            if (AdminConfig.ADMIN_TAG_ENABLE && player.isGmMode()) {
            	switch (player.getClientConnection().getAccount().getAccessLevel()) {
            		case 1:
            			adminTag = AdminConfig.ADMIN_TAG_1.replace("%s", sb.toString());
            			break;
            		case 2:
            			adminTag = AdminConfig.ADMIN_TAG_2.replace("%s", sb.toString());
            			break;
            		case 3:
            			adminTag = AdminConfig.ADMIN_TAG_3.replace("%s", sb.toString());
            			break;
            		case 4:
            			adminTag = AdminConfig.ADMIN_TAG_4.replace("%s", sb.toString());
            			break;
            		case 5:
            			adminTag = AdminConfig.ADMIN_TAG_5.replace("%s", sb.toString());
            			break;
            		case 6:
                    	adminTag = AdminConfig.ADMIN_TAG_6.replace("%s", sb.toString());
                    	break;
            		case 7:
                    	adminTag = AdminConfig.ADMIN_TAG_7.replace("%s", sb.toString());
                    	break;
            		case 8:
                    	adminTag = AdminConfig.ADMIN_TAG_8.replace("%s", sb.toString());
                    	break;
            		case 9:
                    	adminTag = AdminConfig.ADMIN_TAG_9.replace("%s", sb.toString());
                    	break;
            		case 10:
                    	adminTag = AdminConfig.ADMIN_TAG_10.replace("%s", sb.toString());
                    	break;
            	}
            }
            
            Iterator<Player> iter = World.getInstance().getPlayersIterator();
            while (iter.hasNext()) {
                PacketSendUtility.sendBrightYellowMessageOnCenter(iter.next(), "Information : " + String.format(adminTag, player.getName()) + " is now available for support!");
            }
        }
	}
	
	public void onPlayerUnavailable(Player player) {
        gms.remove(player.getObjectId());
        String adminTag = "%s";
        StringBuilder sb = new StringBuilder(adminTag);
        
     // * = Premium & VIP Membership
        if (MembershipConfig.PREMIUM_TAG_DISPLAY) {
        	switch (player.getClientConnection().getAccount().getMembership()) {
        		case 1:
        			adminTag = sb.replace(0, sb.length(), MembershipConfig.TAG_PREMIUM).toString();
        			break;
        		case 2:
        			adminTag = sb.replace(0, sb.length(), MembershipConfig.TAG_VIP).toString();
        			break;
        	}
        }
     			
        // * = Wedding
        if (player.isMarried()) {
        	String partnerName = DAOManager.getDAO(PlayerDAO.class).getPlayerNameByObjId(player.getPartnerId());
        	adminTag += "\uE020"+ partnerName;
        }
     			
        // * = Server Staff Access Level
        if (AdminConfig.ADMIN_TAG_ENABLE && player.isGmMode()) {
        	switch (player.getClientConnection().getAccount().getAccessLevel()) {
        		case 1:
        			adminTag = AdminConfig.ADMIN_TAG_1.replace("%s", sb.toString());
        			break;
        		case 2:
        			adminTag = AdminConfig.ADMIN_TAG_2.replace("%s", sb.toString());
        			break;
        		case 3:
        			adminTag = AdminConfig.ADMIN_TAG_3.replace("%s", sb.toString());
        			break;
        		case 4:
        			adminTag = AdminConfig.ADMIN_TAG_4.replace("%s", sb.toString());
        			break;
        		case 5:
        			adminTag = AdminConfig.ADMIN_TAG_5.replace("%s", sb.toString());
        			break;
        		case 6:
                	adminTag = AdminConfig.ADMIN_TAG_6.replace("%s", sb.toString());
                	break;
        		case 7:
                	adminTag = AdminConfig.ADMIN_TAG_7.replace("%s", sb.toString());
                	break;
        		case 8:
                	adminTag = AdminConfig.ADMIN_TAG_8.replace("%s", sb.toString());
                	break;
        		case 9:
                	adminTag = AdminConfig.ADMIN_TAG_9.replace("%s", sb.toString());
                	break;
        		case 10:
                	adminTag = AdminConfig.ADMIN_TAG_10.replace("%s", sb.toString());
                	break;
        	}
        }
        
        Iterator<Player> iter = World.getInstance().getPlayersIterator();
        while (iter.hasNext()) {
            PacketSendUtility.sendBrightYellowMessageOnCenter(iter.next(), "Information : " + String.format(adminTag, player.getName()) + " is now unavailable for support!");
        }
	}
	
	public void broadcastMesage(String message){
		SM_MESSAGE packet = new SM_MESSAGE(0, null, message, ChatType.BRIGHT_YELLOW_CENTER);
		for (Player player: gms.values()){
			PacketSendUtility.sendPacket(player, packet);
		}
	}
	
	@SuppressWarnings("synthetic-access")
	private static class SingletonHolder {
		protected static final GMService instance = new GMService();
	}
}