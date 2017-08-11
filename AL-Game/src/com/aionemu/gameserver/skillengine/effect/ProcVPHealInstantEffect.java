package com.aionemu.gameserver.skillengine.effect;

import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.model.gameobjects.player.PlayerCommonData;
import com.aionemu.gameserver.network.aion.serverpackets.SM_STATUPDATE_EXP;
import com.aionemu.gameserver.skillengine.model.Effect;
import com.aionemu.gameserver.utils.PacketSendUtility;
import javax.xml.bind.annotation.XmlAttribute;

public class ProcVPHealInstantEffect extends EffectTemplate
{
	@XmlAttribute(required = true)
	protected int value2;
	
	@XmlAttribute
	protected boolean percent;
	
	public void applyEffect(Effect effect) {
		if ((effect.getEffected() instanceof Player)) {
			Player player = (Player) effect.getEffected();
			PlayerCommonData pcd = player.getCommonData();
			long cap = pcd.getMaxReposteEnergy() * value2 / 100;
			if (pcd.getCurrentReposteEnergy() < cap) {
				int valueWithDelta = value + delta * effect.getSkillLevel();
				long addEnergy = 0;
				if (percent) {
                    addEnergy = (int) (pcd.getMaxReposteEnergy() * valueWithDelta * 0.001);
                } else {
                    addEnergy = valueWithDelta;
                }
				pcd.addReposteEnergy(addEnergy);
                PacketSendUtility.sendPacket(player, new SM_STATUPDATE_EXP(pcd.getExpShown(), pcd.getExpRecoverable(), pcd.getExpNeed(), pcd.getCurrentReposteEnergy(), pcd.getMaxReposteEnergy()));
			}
		}
	}
}
