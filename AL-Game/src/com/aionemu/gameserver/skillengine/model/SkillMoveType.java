package com.aionemu.gameserver.skillengine.model;

public enum SkillMoveType
{
	RESIST(0),
	DEFAULT(16),
	PULL(18),
	OPENAERIAL(20),
	KNOCKBACK(28),
	MOVEBEHIND(48),
	STAGGER(112), //5.1
	STUMBLE(16), //5.1
	NEWPULL(54); //5.1
	
	private int id;
	
	private SkillMoveType(int id) {
		this.id = id;
	}
	
	public int getId() {
		return id;
	}
}