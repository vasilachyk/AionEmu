package com.aionemu.gameserver.network.aion.serverpackets;

import com.aionemu.gameserver.network.aion.AionConnection;
import com.aionemu.gameserver.network.aion.AionServerPacket;

public class SM_STATUPDATE_EXP extends AionServerPacket
{
	private long currentExp;
	private long recoverableExp;
	private long maxExp;
	private long curBoostExp = 0;
	private long maxBoostExp = 0;
	private long goldenStar;
	private long auraGrowth;
	
	public SM_STATUPDATE_EXP(long currentExp, long recoverableExp, long maxExp, long curBoostExp, long maxBoostExp) {
		this.currentExp = currentExp;
		this.recoverableExp = recoverableExp;
		this.maxExp = maxExp;
		this.curBoostExp = curBoostExp;
		this.maxBoostExp = maxBoostExp;
	}
	
	public SM_STATUPDATE_EXP(long currentExp, long recoverableExp, long maxExp, long curBoostExp, long maxBoostExp, long goldenStar, long auraGrowth) {
		this.currentExp = currentExp;
		this.recoverableExp = recoverableExp;
		this.maxExp = maxExp;
		this.curBoostExp = curBoostExp;
		this.maxBoostExp = maxBoostExp;
		this.goldenStar = goldenStar;
		this.auraGrowth = auraGrowth;
	}
	
	@Override
	protected void writeImpl(AionConnection con) {
		writeQ(currentExp);
		writeQ(recoverableExp);
		writeQ(maxExp);
		writeQ(curBoostExp);
		writeQ(maxBoostExp);
		writeQ(goldenStar);
		writeQ(auraGrowth);
	}
}