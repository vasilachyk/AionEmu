package com.aionemu.gameserver.skillengine.effect;

import com.aionemu.gameserver.controllers.observer.ActionObserver;
import com.aionemu.gameserver.controllers.observer.ObserverType;
import com.aionemu.gameserver.model.gameobjects.Creature;
import com.aionemu.gameserver.model.stats.container.StatEnum;
import com.aionemu.gameserver.network.aion.serverpackets.SM_ATTACK_STATUS.LOG;
import com.aionemu.gameserver.network.aion.serverpackets.SM_ATTACK_STATUS.TYPE;
import com.aionemu.gameserver.skillengine.model.Effect;
import com.aionemu.gameserver.skillengine.model.HealType;
import javax.xml.bind.annotation.XmlAttribute;

public class CaseHealEffect extends AbstractHealEffect {

	@XmlAttribute(name = "cond_value")
	protected int condValue;

	@XmlAttribute
	protected HealType type;

	protected int getCurrentStatValue(Effect effect) {
		if (type == HealType.HP)
			return effect.getEffected().getLifeStats().getCurrentHp();
		if (type == HealType.MP) {
			return effect.getEffected().getLifeStats().getCurrentMp();
		}
		return 0;
	}

	protected int getMaxStatValue(Effect effect) {
		if (type == HealType.HP)
			return effect.getEffected().getGameStats().getMaxHp().getCurrent();
		if (type == HealType.MP) {
			return effect.getEffected().getGameStats().getMaxMp().getCurrent();
		}
		return 0;
	}

	public void applyEffect(Effect effect) {
		effect.addToEffectedController();
	}

	public void endEffect(Effect effect) {
		ActionObserver observer = effect.getActionObserver(position);
		if (observer != null)
			effect.getEffected().getObserveController().removeObserver(observer);
	}

	public void startEffect(final Effect effect) {
		ActionObserver observer = new ActionObserver(ObserverType.ATTACKED) {

			public void attacked(Creature creature) {
				int valueWithDelta = value + delta * effect.getSkillLevel();
				int currentValue = getCurrentStatValue(effect);
				int maxValue = getMaxStatValue(effect);
				int possibleHealValue = 0;

				if (currentValue <= maxValue * condValue / 100) {
					if (percent)
						possibleHealValue = maxValue * valueWithDelta / 100;
					else {
						possibleHealValue = valueWithDelta;
					}
					int finalHeal = effect.getEffected().getGameStats().getStat(StatEnum.HEAL_SKILL_BOOST, possibleHealValue).getCurrent();

					finalHeal = maxValue - currentValue < finalHeal ? maxValue - currentValue : finalHeal;

					if ((type == HealType.HP) && (effect.getEffected().getEffectController().isAbnormalSet(AbnormalState.DISEASE))) {
						finalHeal = 0;
					}

					if (type == HealType.HP)
						effect.getEffected().getLifeStats().increaseHp(TYPE.HP, finalHeal, effect.getSkillId(), LOG.REGULAR);
					else if (type == HealType.MP)
						effect.getEffected().getLifeStats().increaseMp(TYPE.MP, finalHeal, effect.getSkillId(), LOG.REGULAR);
					effect.endEffect();
				}
			}
		};
		effect.getEffected().getObserveController().addObserver(observer);
		effect.setActionObserver(observer, position);
	}
}
