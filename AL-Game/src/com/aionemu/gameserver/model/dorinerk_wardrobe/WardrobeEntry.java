package com.aionemu.gameserver.model.dorinerk_wardrobe;

/**
 * 
 * @author Ranastic
 *
 */
public class WardrobeEntry {
	
	private int itemId;
	private int slot;
	private int reskin_count;
	
	public WardrobeEntry(int itemId, int slot, int reskin_count) {
		this.itemId = itemId;
		this.slot = slot;
		this.reskin_count = reskin_count;
	}
	
	public int getReskinCount() {
		return reskin_count;
	}
	
	public int getItemId() {
		return itemId;
	}
	
	public int getSlot() {
		return slot;
	}
}
