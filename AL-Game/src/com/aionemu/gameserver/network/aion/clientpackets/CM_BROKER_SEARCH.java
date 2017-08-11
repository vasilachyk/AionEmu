package com.aionemu.gameserver.network.aion.clientpackets;

import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.network.aion.AionClientPacket;
import com.aionemu.gameserver.network.aion.AionConnection.State;
import com.aionemu.gameserver.services.BrokerService;

import java.util.ArrayList;
import java.util.List;

public class CM_BROKER_SEARCH extends AionClientPacket
{
    @SuppressWarnings("unused")
    private int brokerId;
    private int sortType;
    private int page;
    private int mask;
    private int itemCount;
    private List<Integer> itemList;
	
    public CM_BROKER_SEARCH(int opcode, State state, State... restStates) {
        super(opcode, state, restStates);
    }
	
    @Override
    protected void readImpl() {
        this.brokerId = readD();
        this.sortType = readC();
        this.page = readH();
        this.mask = readH();
        this.itemCount = readH();
        this.itemList = new ArrayList<Integer>();
        for (int index = 0; index < this.itemCount; index++) {
            this.itemList.add(readD());
        }
    }
	
    @Override
    protected void runImpl() {
        Player player = getConnection().getActivePlayer();
        BrokerService.getInstance().showRequestedItems(player, mask, sortType, page, itemList);
    }
}