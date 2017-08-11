package com.aionemu.gameserver.network.aion.serverpackets;

import com.aionemu.gameserver.network.aion.AionConnection;
import com.aionemu.gameserver.network.aion.AionServerPacket;

/**
 * @author KorLightNing
 */

public class SM_CASH_BUFF extends AionServerPacket
{
	@Override
	protected void writeImpl(AionConnection con) {
		writeC(2); //버프 시작
		writeH(1); //버프 갯수
		writeC(2); //버프 시작
		writeH(1102); //버프 아이디
		writeH(0); // 0x00
		writeD(388306); //시간
	}
}