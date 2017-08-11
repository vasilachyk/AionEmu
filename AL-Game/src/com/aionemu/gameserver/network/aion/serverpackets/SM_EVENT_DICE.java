package com.aionemu.gameserver.network.aion.serverpackets;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.network.aion.AionConnection;
import com.aionemu.gameserver.network.aion.AionServerPacket;

public class SM_EVENT_DICE  extends AionServerPacket {

	private int tableId = 3;
	private int currentStep;
	private int diceLeft;
	private int diceGolden;
	private int unkButton;
	private int moveStep;
	
	private static final Logger log = LoggerFactory.getLogger(SM_EVENT_DICE.class);
	
	public SM_EVENT_DICE(int tableId, int currentStep, int diceLeft, int diceGolden, int unkButton, int moveStep) {
		this.tableId = tableId;
		this.currentStep = currentStep;
		this.diceLeft = diceLeft;
		this.diceGolden = diceGolden;
		this.unkButton = unkButton;
		this.moveStep = moveStep;
	}
	
	@Override
    protected void writeImpl(AionConnection con) {
		Player player = con.getActivePlayer();
		writeD(tableId);//table id
		writeD(currentStep);//current step
		writeD(0);
		writeD(0);
		writeD(diceLeft);//dice left
		writeD(diceGolden);//dice golden
		writeD(unkButton);//button near dice left
		writeD(379322);
		writeD(0);
		writeD(379322);
		writeD(0);
		writeD(moveStep);//move step
	}

}
