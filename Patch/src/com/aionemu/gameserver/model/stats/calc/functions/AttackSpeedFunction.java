package com.aionemu.gameserver.model.stats.calc.functions;

import com.aionemu.gameserver.model.stats.calc.Stat2;
import com.aionemu.gameserver.model.stats.container.StatEnum;

class AttackSpeedFunction extends StatFunction
{
	private float modifier;
	
	AttackSpeedFunction(StatEnum stat, float modifier) {
		this.stat = stat;
		this.modifier = modifier;
	}
	
	@Override
	public void apply(Stat2 stat) {
		float attackSpeed = stat.getOwner().getGameStats().getAttackSpeed().getCurrent();
		stat.setBase(Math.round(stat.getBase() + stat.getBase() * (attackSpeed - 1500) * modifier / 1500f));
	}
	
	@Override
	public int getPriority() {
		return 30;
	}
}