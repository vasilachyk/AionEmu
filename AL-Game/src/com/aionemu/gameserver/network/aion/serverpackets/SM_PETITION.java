package com.aionemu.gameserver.network.aion.serverpackets;

import com.aionemu.gameserver.model.Petition;
import com.aionemu.gameserver.network.aion.AionConnection;
import com.aionemu.gameserver.network.aion.AionServerPacket;
import com.aionemu.gameserver.services.PetitionService;

public class SM_PETITION extends AionServerPacket
{
	private Petition petition;
	
	public SM_PETITION() {
		this.petition = null;
	}
	
	public SM_PETITION(Petition petition) {
		this.petition = petition;
	}
	
	@Override
	protected void writeImpl(AionConnection con) {
		if (petition == null) {
			writeD(0x00);
			writeD(0x00);
			writeD(0x00);
			writeD(0x00);
			writeH(0x00);
			writeC(0x00);
		} else {
			writeC(0x01);
			writeD(100);
			writeH(PetitionService.getInstance().getWaitingPlayers(con.getActivePlayer().getObjectId()));
			writeS(Integer.toString(petition.getPetitionId()));
			writeH(0x00);
			writeC(50);
			writeC(49);
			writeH(PetitionService.getInstance().calculateWaitTime(petition.getPlayerObjId()));
			writeD(0x00);
		}
	}
}