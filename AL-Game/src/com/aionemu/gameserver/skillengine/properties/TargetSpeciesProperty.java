package com.aionemu.gameserver.skillengine.properties;

import com.aionemu.gameserver.model.gameobjects.Creature;
import com.aionemu.gameserver.model.gameobjects.Npc;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.skillengine.model.Skill;
import java.util.Iterator;
import java.util.List;

public class TargetSpeciesProperty {

	public static boolean set(Skill skill, Properties properties) {
		TargetSpeciesAttribute value = properties.getTargetSpecies();

		List<Creature> effectedList = skill.getEffectedList();
		switch (value) {
			case NPC:
				for (Iterator<Creature> iter = effectedList.iterator(); iter.hasNext();) {
					Creature nextEffected = (Creature) iter.next();

					if (!(nextEffected instanceof Npc)) {
						iter.remove();
					}
				}
				break;
			case PC:
				for (Iterator<Creature> iter = effectedList.iterator(); iter.hasNext();) {
					Creature nextEffected = (Creature) iter.next();

					if (!(nextEffected instanceof Player)) {
						iter.remove();
					}
				}
		default:
			break;
		}
		return true;
	}
}
