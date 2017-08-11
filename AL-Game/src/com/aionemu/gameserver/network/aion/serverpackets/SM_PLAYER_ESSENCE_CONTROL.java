/*
 * This file is part of Encom. **ENCOM FUCK OTHER SVN**
 *
 *  Encom is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Lesser Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  Encom is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Lesser Public License for more details.
 *
 *  You should have received a copy of the GNU Lesser Public License
 *  along with Encom.  If not, see <http://www.gnu.org/licenses/>.
 */
package com.aionemu.gameserver.network.aion.serverpackets;

import org.slf4j.*;

import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.network.aion.AionConnection;
import com.aionemu.gameserver.network.aion.AionServerPacket;
import com.aionemu.gameserver.services.player.CreativityPanel.*;
import com.aionemu.gameserver.utils.*;

/**
 * @author Ranastic (Encom)
 */

public class SM_PLAYER_ESSENCE_CONTROL extends AionServerPacket
{
    Logger log = LoggerFactory.getLogger(SM_PLAYER_ESSENCE_CONTROL.class);
	
    private int type;
    private int size;
    private int id;
    private int slotPoint;
	
    public SM_PLAYER_ESSENCE_CONTROL(int type, int size) {
        this.type = type;
        this.size = size;
    }
	
    public SM_PLAYER_ESSENCE_CONTROL(int type) {
        this.type = type;
    }
	
    public SM_PLAYER_ESSENCE_CONTROL(int type, int id, int slotPoint) {
        this.id = id;
        this.slotPoint = slotPoint;
    }
	
    public SM_PLAYER_ESSENCE_CONTROL(int type, int size, int id, int slotPoint) {
        this.type = type;
        this.size = size;
        this.id = id;
        this.slotPoint = slotPoint;
    }
	
    @Override
    protected void writeImpl(AionConnection con) {
        writeC(0x01);
        writeC(type);
        writeH(size);
        switch(type) {
            case 0:
                writeD(id);
                writeH(slotPoint);
            break;
            case 1:
                writeD(id);
                writeH(slotPoint);
            break;
        }
    }
}