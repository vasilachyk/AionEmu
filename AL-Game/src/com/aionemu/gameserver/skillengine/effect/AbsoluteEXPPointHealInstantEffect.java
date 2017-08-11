package com.aionemu.gameserver.skillengine.effect;

import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.skillengine.model.*;
import com.aionemu.gameserver.network.aion.serverpackets.*;
import com.aionemu.gameserver.utils.*;

import javax.xml.bind.annotation.*;

public class AbsoluteEXPPointHealInstantEffect extends EffectTemplate
{
	@XmlAttribute(required = true)
	protected int points;
	
	public void applyEffect(Effect effect) {
		if ((effect.getEffected() instanceof Player)) {
			Player player = (Player) effect.getEffected();
			player.getCommonData().addGoldenStarEnergy(3150000); //0.5%
			PacketSendUtility.sendPacket(player, new SM_STATS_INFO(player));
		}
	}
}