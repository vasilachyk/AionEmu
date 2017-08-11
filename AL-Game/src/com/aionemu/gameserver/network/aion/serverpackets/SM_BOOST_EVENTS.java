package com.aionemu.gameserver.network.aion.serverpackets;

import com.aionemu.gameserver.network.aion.AionConnection;
import com.aionemu.gameserver.network.aion.AionServerPacket;

import java.util.Calendar;

/**
 * Created by wanke on 01/02/2017.
 */

public class SM_BOOST_EVENTS extends AionServerPacket {
    private int eventStartTime = (int)(Calendar.getInstance().getTimeInMillis() / 1000);
    private int eventEndTime;

    public SM_BOOST_EVENTS() {
        this.eventEndTime = this.eventStartTime + 6048;
    }

    protected void writeImpl(AionConnection con) {
        writeH(2);
        writeC(0);
        writeC(3);

        writeD(eventStartTime);
        writeD(0);
        writeD(eventEndTime);
        writeD(0);
        writeD(150);
        writeQ(-1);
        writeD(0);
        writeD(0);

        writeD(eventStartTime);
        writeD(0);
        writeD(eventEndTime);
        writeD(0);
        writeD(200);
        writeQ(-1);
        writeD(0);
        writeD(0);

        writeD(eventStartTime);
        writeD(0);
        writeD(eventEndTime);
        writeD(0);
        writeD(200);
        writeQ(-1);
        writeD(0);
        writeD(0);
        writeC(1);
        writeC(2);

        writeD(eventStartTime);
        writeD(0);
        writeD(eventEndTime);
        writeD(0);
        writeD(150);
        writeQ(-1);
        writeD(0);
        writeD(0);

        writeD(eventStartTime);
        writeD(0);
        writeD(eventEndTime);
        writeD(0);
        writeD(200);
        writeQ(-1);
        writeD(0);
        writeD(0);
    }
}