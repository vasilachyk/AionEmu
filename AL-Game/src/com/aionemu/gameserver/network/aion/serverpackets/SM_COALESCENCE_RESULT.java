package com.aionemu.gameserver.network.aion.serverpackets;

import com.aionemu.gameserver.network.aion.AionConnection;
import com.aionemu.gameserver.network.aion.AionServerPacket;

/**
 * @author Ranastic
 */
public class SM_COALESCENCE_RESULT extends AionServerPacket
{
	private int itemTemplateId;
	private int itemObjId;
	
	public SM_COALESCENCE_RESULT(int itemTemplateId, int itemObjId) {
		this.itemTemplateId = itemTemplateId;
		this.itemObjId = itemObjId;
	}

	@Override
	protected void writeImpl(AionConnection client) {
		writeD(itemTemplateId);
		writeD(itemObjId);
		writeQ(0x00);//unk
		writeQ(0x00);//unk
		writeD(0x01);//unk
	}
}
