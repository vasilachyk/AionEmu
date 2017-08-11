package com.aionemu.gameserver.model.bonus_service;

import com.aionemu.gameserver.dataholders.DataManager;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.model.stats.calc.StatOwner;
import com.aionemu.gameserver.model.stats.calc.functions.IStatFunction;
import com.aionemu.gameserver.model.stats.calc.functions.StatAddFunction;
import com.aionemu.gameserver.model.stats.calc.functions.StatRateFunction;
import com.aionemu.gameserver.model.templates.bonus_service.F2pBonusAttr;
import com.aionemu.gameserver.model.templates.bonus_service.F2pPenalityAttr;
import com.aionemu.gameserver.skillengine.change.Func;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by wanke on 12/02/2017.
 */

public class F2pBonus implements StatOwner
{
    private static final Logger log = LoggerFactory.getLogger(F2pBonus.class);
    private List<IStatFunction> functions = new ArrayList<IStatFunction>();
    private F2pBonusAttr f2pBonusattr;
	
    public F2pBonus(int buffId) {
        f2pBonusattr = DataManager.F2P_BONUS_DATA.getInstanceBonusattr(buffId);
    }
	
    public void applyEffect(Player player, int buffId) {
        if (f2pBonusattr == null) {
            return;
        } for (F2pPenalityAttr f2pBonusPenaltyAttr: f2pBonusattr.getPenaltyAttr()) {
            if (f2pBonusPenaltyAttr.getFunc().equals(Func.PERCENT)) {
                functions.add(new StatRateFunction(f2pBonusPenaltyAttr.getStat(), f2pBonusPenaltyAttr.getValue(), true));
            } else {
                functions.add(new StatAddFunction(f2pBonusPenaltyAttr.getStat(), f2pBonusPenaltyAttr.getValue(), true));
            }
        }
        player.getGameStats().addEffect(this, functions);
    }
	
    public void endEffect(Player player, int buffId) {
        functions.clear();
        player.getGameStats().endEffect(this);
    }
}