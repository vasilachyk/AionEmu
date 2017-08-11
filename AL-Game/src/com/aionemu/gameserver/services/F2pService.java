package com.aionemu.gameserver.services;

import com.aionemu.gameserver.configs.administration.*;
import com.aionemu.gameserver.model.bonus_service.*;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.model.gameobjects.player.f2p.*;
import com.aionemu.gameserver.network.aion.serverpackets.*;
import com.aionemu.gameserver.taskmanager.tasks.ExpireTimerTask;
import com.aionemu.gameserver.utils.*;

/**
 * Created by wanke on 11/02/2017.
 */

public class F2pService
{
    private static F2pBonus f2p;
	private static ServiceBuff boost;
    
	public void onEnterWorld(Player player) {
		boolean isGM = player.getAccessLevel() >= AdminConfig.GM_PANEL;
        if (player.getF2p().getF2pAccount()!= null) {
            playerBoostPack(player);
            ExpireTimerTask.getInstance().addTask(player.getF2p().getF2pAccount(), player);
            PacketSendUtility.sendPacket(player, new SM_ACCOUNT_PROPERTIES(isGM, 0, 8, player.getF2p().getF2pAccount().getRemainingTime()));
            PacketSendUtility.sendPacket(player, new SM_PACKAGE_INFO_NOTIFY(1, 3, player.getF2p().getF2pAccount().getRemainingTime()));
        } else {
            PacketSendUtility.sendPacket(player, new SM_ACCOUNT_PROPERTIES(isGM, 4, 0, 0));
            PacketSendUtility.sendPacket(player, new SM_PACKAGE_INFO_NOTIFY(1, 0, 0));
        }
    }
	
    public void playerBoostPack(Player player) {
		//MEMBERSHIP_BASE_TW_07
        boost = new ServiceBuff(2000007);
        boost.applyEffect(player, 2000007);
		//MEMBERSHIP_PK_A_TW_07
        boost = new ServiceBuff(2000014);
        boost.applyEffect(player, 2000014);
		//MEMBERSHIP_PK_B_TW_04
        boost = new ServiceBuff(2000018);
        boost.applyEffect(player, 2000018);
		//Gold Pack.
        f2p = new F2pBonus(1);
        f2p.applyEffect(player, 1);
    }
	
    public void onAddF2p(Player player, Integer minutes) {
        boolean isGM = player.getAccessLevel() >= AdminConfig.GM_PANEL;
        F2pAccount f2pAccount = new F2pAccount(minutes == null ? 0 : (int)(System.currentTimeMillis() / 1000 + minutes.intValue() * 60));
        player.getF2p().add(f2pAccount, true);
        PacketSendUtility.sendPacket(player, new SM_ACCOUNT_PROPERTIES(isGM, 0, 8, player.getF2p().getF2pAccount().getRemainingTime()));
        ExpireTimerTask.getInstance().addTask(player.getF2p().getF2pAccount(), player);
        playerBoostPack(player);
    }
	
    public static F2pService getInstance() {
        return SingletonHolder.instance;
    }
	
    private static class SingletonHolder {
        protected static final F2pService instance = new F2pService();
    }
}