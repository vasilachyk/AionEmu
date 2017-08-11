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
package com.aionemu.gameserver.services.events;

import com.aionemu.gameserver.ai2.AI2Engine;
import com.aionemu.gameserver.ai2.AIState;
import com.aionemu.gameserver.ai2.AbstractAI;
import com.aionemu.gameserver.dataholders.DataManager;
import com.aionemu.gameserver.eventEngine.EventScheduler;
import com.aionemu.gameserver.eventEngine.events.BattlegroundEvent;
import com.aionemu.gameserver.model.gameobjects.Creature;
import com.aionemu.gameserver.model.gameobjects.Npc;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.model.templates.event.EventTemplate;
import com.aionemu.gameserver.model.templates.spawns.SpawnTemplate;
import com.aionemu.gameserver.services.EventService;
import com.aionemu.gameserver.spawnengine.SpawnEngine;
import gnu.trove.map.hash.TIntObjectHashMap;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import java.util.ArrayList;
import java.util.Collections;
import java.util.List;
import java.util.concurrent.Future;
import java.util.concurrent.ScheduledFuture;

/**
 * Created by wanke on 12/02/2017.
 */

public class BGService
{
    Logger log = LoggerFactory.getLogger(EventService.class);
    private static final int DELAY = 60 * 100;
    private List<ScheduledFuture<?>> futures = new ArrayList<ScheduledFuture<?>>();
	
    private BGService() {
        register(DELAY);
        log.info("<Battleground> initialized!");
    }
	
    public void register(int delay) {
        if (futures.isEmpty()) {
            BattlegroundEvent bgEvent = new BattlegroundEvent();
            bgEvent.setPriority(1);
            futures.add(EventScheduler.getInstance().scheduleAtFixedRate(bgEvent, delay, 6 * 60 * 1000));
        }
    }
	
    private static class SingletonHolder {
        protected static final BGService instance = new BGService();
    }
	
    public static final BGService getInstance() {
        return SingletonHolder.instance;
    }
}
