package com.aionemu.gameserver.network.aion.serverpackets;

import com.aionemu.gameserver.model.gameobjects.Item;
import com.aionemu.gameserver.model.gameobjects.player.Player;
//import com.aionemu.gameserver.model.items.ManaStone;
import com.aionemu.gameserver.network.aion.AionConnection;
import com.aionemu.gameserver.network.aion.AionServerPacket;

public class SM_TUNE_RESULT extends AionServerPacket
{
	private final Player player;
    private int itemObjectId;
	private int tuningScrollId;
	private int itemId;
	
    public SM_TUNE_RESULT(Player player, int itemObjectId, int tuningScrollId, int itemId) {
    	this.player = player;
    	this.itemObjectId = itemObjectId;
    	this.tuningScrollId = tuningScrollId;
    	this.itemId = itemId;
    }
	
    @Override
    protected void writeImpl(AionConnection con) {
    	Item item = player.getInventory().getItemByObjId(itemObjectId);
    	writeD(itemObjectId);
    	writeD(tuningScrollId);
    	switch (item.getEquipmentType()) {
    		case ARMOR:
    			writeH(5);
			break;
    		case WEAPON:
    			writeH(10);
    		break;
    	}
   		writeC(item.getEnchantLevel());
		writeD(itemId);
		writeH(0); // TODO found value 256,512,1024 (maybe slot ?)
//		int count = 0;
//		for (ManaStone manaStone : item.getItemStones()) {
//			writeD(manaStone.getItemId());
//			count++;
//		}
//
//		if (count < 6 ) {
//			for (int i = count; i < 6; i++) {
//				writeD(0);
//                count++;
//			}
//		}
		writeD(0);
		writeD(0);
		writeD(0);
		writeD(0);
		writeD(0);
		writeD(0);
    	if (item.getGodStone() != null) {
    		writeD(item.getGodStone().getItemId());
    	} else {
    		writeD(0);
    	}
    	writeB(new byte[13]); //Spacer
    	if (item.getIdianStone() != null) {
			writeD(item.getIdianStone().getItemId());
		} else {
			writeD(0);
		}
		writeC(2); // TODO found value 0 and 2
		writeB(new byte[120]); //Garbage
		if (tuningScrollId > 0) {
			writeC(1); //Show Window ?
			writeC(1); //Show Window ?
		} else {
			writeC(0);
			writeC(0);
		}
    }
}