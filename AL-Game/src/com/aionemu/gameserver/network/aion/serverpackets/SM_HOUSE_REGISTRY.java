package com.aionemu.gameserver.network.aion.serverpackets;

import com.aionemu.gameserver.model.gameobjects.HouseDecoration;
import com.aionemu.gameserver.model.gameobjects.HouseObject;
import com.aionemu.gameserver.model.gameobjects.UseableItemObject;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.network.aion.AionConnection;
import com.aionemu.gameserver.network.aion.AionServerPacket;

public class SM_HOUSE_REGISTRY extends AionServerPacket
{
	int action;
	
	public SM_HOUSE_REGISTRY(int action) {
		this.action = action;
	}
	
	@Override
	protected void writeImpl(AionConnection con) {
		Player player = con.getActivePlayer();
		if (player == null)
			return;
		writeC(action);
		if (action == 1) {
			if (player.getHouseRegistry() == null) {
				writeH(0);
				return;
			}
			writeH(player.getHouseRegistry().getNotSpawnedObjects().size());
			for (HouseObject<?> obj : player.getHouseRegistry().getNotSpawnedObjects()) {
				writeD(obj.getObjectId());
				int templateId = obj.getObjectTemplate().getTemplateId();
				writeD(templateId);
				writeD(player.getHouseObjectCooldownList().getReuseDelay(obj.getObjectId()));
				if (obj.getUseSecondsLeft() > 0)
					writeD(obj.getUseSecondsLeft());
				else
					writeD(0);
				Integer color = null;
				if (obj != null)
					color = obj.getColor();
				if (color != null && color > 0 ) {
					writeC(1);
					writeC((color & 0xFF0000) >> 16);
					writeC((color & 0xFF00) >> 8);
					writeC((color & 0xFF));
				} else {
					writeC(0);
					writeC(0);
					writeC(0);
					writeC(0);
				}
				writeD(0);
				writeC(obj.getObjectTemplate().getTypeId());
				if (obj instanceof UseableItemObject) {
					((UseableItemObject) obj).writeUsageData(getBuf());
				}
			}
		} else if (action == 2) {
			writeH(player.getHouseRegistry().getDefaultParts().size() + player.getHouseRegistry().getCustomParts().size());
			for (HouseDecoration deco : player.getHouseRegistry().getDefaultParts()) {
				writeD(0);
				writeD(deco.getTemplate().getId());
			} for (HouseDecoration houseDecor : player.getHouseRegistry().getCustomParts()) {
				writeD(houseDecor.getObjectId());
				writeD(houseDecor.getTemplate().getId());
			}
		}
	}
}