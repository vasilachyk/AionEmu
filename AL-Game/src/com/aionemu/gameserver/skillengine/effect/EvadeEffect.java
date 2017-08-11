package com.aionemu.gameserver.skillengine.effect;

import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.skillengine.model.*;

import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlType;

@XmlAccessorType(XmlAccessType.FIELD)
@XmlType(name = "EvadeEffect")
public class EvadeEffect extends DispelEffect
{
	@Override
    public void calculate(Effect effect) {
        effect.setSkillMoveType(SkillMoveType.MOVEBEHIND);
        if (effect.getEffected().getState() == 3) {
            super.calculate(effect, null, null);
        } else {
            super.calculate(effect, null, SpellStatus.CLOSEAERIAL);
        }
        Player player = (Player) effect.getEffector();
        if (player.isFlying()) {
            player.setFlyState(0);
        }
    }
}