package com.aionemu.gameserver.network.aion.serverpackets;

import com.aionemu.gameserver.model.templates.tradelist.TradeListTemplate;
import com.aionemu.gameserver.model.templates.tradelist.TradeNpcType;
import com.aionemu.gameserver.model.templates.tradelist.TradeListTemplate.TradeTab;
import com.aionemu.gameserver.network.aion.AionConnection;
import com.aionemu.gameserver.network.aion.AionServerPacket;

public class SM_SELL_ITEM extends AionServerPacket
{
	private int targetObjectId;
	private int sellPercentage;
	private byte action = 0x01;
	private TradeListTemplate tradeListTemplate = null;
	
	public SM_SELL_ITEM(int targetObjectId, int sellPercentage) {
		this.sellPercentage = sellPercentage;
		this.targetObjectId = targetObjectId;
	}
	
	public SM_SELL_ITEM(int targetObjectId, TradeListTemplate tradeListTemplate) {
		this.sellPercentage = tradeListTemplate.getBuyPriceRate();
		this.targetObjectId = targetObjectId;
		this.tradeListTemplate = tradeListTemplate;
		if (tradeListTemplate.getTradeNpcType() == TradeNpcType.ABYSS) {
			this.action = 0x02;
		}
	}
	
	@Override
	protected void writeImpl(AionConnection con) {
		writeD(targetObjectId);
		writeC(action);
		writeD(sellPercentage);
		writeC(tradeListTemplate == null ? 0x01 : 0x00);
		writeC(0x01);
		if (tradeListTemplate != null) {
			writeH(tradeListTemplate.getCount());
			for (TradeTab tradeTabl : tradeListTemplate.getTradeTablist()) {
				writeD(tradeTabl.getId());
			}
		} else {
			writeH(0x00);
		}
	}
}