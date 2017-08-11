package com.aionemu.gameserver.network.aion.serverpackets;

import com.aionemu.gameserver.model.gameobjects.player.PlayerScripts;
import com.aionemu.gameserver.model.house.PlayerScript;
import com.aionemu.gameserver.network.aion.AionConnection;
import com.aionemu.gameserver.network.aion.AionServerPacket;
import java.util.Map;

public class SM_HOUSE_SCRIPTS extends AionServerPacket {

	private int address;
	private PlayerScripts scripts;
	int from;
	int to;

	public SM_HOUSE_SCRIPTS(int address, PlayerScripts scripts, int from, int to) {
		this.address = address;
		this.scripts = scripts;
		this.from = from;
		this.to = to;
	}

	@Override
	protected void writeImpl(AionConnection con) {
		writeD(address);
		writeH(to - from + 1);
		Map<Integer, PlayerScript> scriptMap = scripts.getScripts();
		for (int position = from; position <= to; position++) {
			writeC(position);
			PlayerScript script = scriptMap.get(position);
			byte[] bytes = script.getCompressedBytes();
			if (bytes == null) {
				writeH(-1);
			}
			else if (bytes.length == 0) {
				writeH(0);
			}
			else {
				writeH(bytes.length + 8);
				writeD(bytes.length);
				writeD(script.getUncompressedSize());
				writeB(bytes);
			}
		}
	}
}
