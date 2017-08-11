package com.aionemu.gameserver.model.dorinerk_wardrobe;

import com.aionemu.gameserver.model.gameobjects.PersistentState;

/**
 * 
 * @author Ranastic
 *
 */
public class PlayerWardrobeEntry extends WardrobeEntry{
	
	private PersistentState persistentState;
	
	public PlayerWardrobeEntry(int itemId, int slot, int reskin_count, PersistentState persistentState) {
		super(itemId, slot, reskin_count);
		this.persistentState = persistentState;
	}
	
	public PersistentState getPersistentState() {
		return persistentState;
	}
	
	public void setPersistentState(PersistentState persistentState) {
		switch (persistentState) {
			case DELETED:
				if (this.persistentState == PersistentState.NEW) {
					this.persistentState = PersistentState.NOACTION;
				} else {
					this.persistentState = PersistentState.DELETED;
				}
			break;
			case UPDATE_REQUIRED:
				if (this.persistentState != PersistentState.NEW) {
					this.persistentState = PersistentState.UPDATE_REQUIRED;
				}
			break;
			case NOACTION:
			break;
			default:
			this.persistentState = persistentState;
		}
	}
}
