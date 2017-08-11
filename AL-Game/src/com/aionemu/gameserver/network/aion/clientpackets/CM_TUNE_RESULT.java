package com.aionemu.gameserver.network.aion.clientpackets;

import com.aionemu.gameserver.network.aion.AionClientPacket;
import com.aionemu.gameserver.network.aion.AionConnection.State;
import com.aionemu.gameserver.network.aion.serverpackets.SM_SYSTEM_MESSAGE;
import com.aionemu.gameserver.utils.PacketSendUtility;

public class CM_TUNE_RESULT extends AionClientPacket
{
    private int itemObjectId;
    private int unk;
    private int accept;
	
    public CM_TUNE_RESULT(int opcode, State state, State... restStates) {
        super(opcode, state, restStates);
    }
	
    @Override
    protected void readImpl() {
        itemObjectId = readD();
        unk = readC();
		switch (unk) {
        	case 0:
        		accept = 0;
        	break;
        	case 1:
        		accept = 1;
        	break;
        }
    }
	
    @Override
    protected void runImpl() {
    	if (accept > 0) {
    		//STR_MSG_ITEM_REIDENTIFY_APPLY_YES
    		//PacketSendUtility.sendPacket(player, new SM_SYSTEM_MESSAGE(1401910));
    	} else {
    		//STR_MSG_ITEM_REIDENTIFY_APPLY_NO
    		//PacketSendUtility.sendPacket(player, new SM_SYSTEM_MESSAGE(1401911));
    	}
    }
}