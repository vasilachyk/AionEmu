package com.aionemu.gameserver.services.territory;

import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.model.stats.calc.StatOwner;
import com.aionemu.gameserver.model.stats.calc.functions.IStatFunction;
import com.aionemu.gameserver.model.stats.calc.functions.StatAddFunction;
import com.aionemu.gameserver.model.stats.container.StatEnum;

import java.util.ArrayList;
import java.util.List;

public class TerritoryBuff implements StatOwner
{
    private List<IStatFunction> functions = new ArrayList<IStatFunction>();
	
    public void applyEffect(Player player) {
        int addvalue = 60;
        if (hasBuff()) {
            endEffect(player);
		}
        functions.add(new StatAddFunction(StatEnum.PVP_DEFEND_RATIO, addvalue, true));
        player.getGameStats().addEffect(this, functions);
    }
	
    public boolean hasBuff() {
        return !functions.isEmpty();
    }
	
    public void endEffect(Player player) {
        functions.clear();
        player.getGameStats().endEffect(this);
    }
}