package com.aionemu.gameserver.model.skill.linked_skill;

import com.aionemu.gameserver.dataholders.DataManager;
import com.aionemu.gameserver.model.templates.item.ItemTemplate;

/**
 * 
 * @author DrNism
 *
 */
public abstract class StigmaEntry {

	protected final int itemId;
	protected final String itemName;
	

	StigmaEntry(int itemId, String itemName) {
		this.itemId = itemId;
		this.itemName = itemName;
	}

	public final int getItemId() {
		return itemId;
	}
	
	public final String getItemName() {
		return DataManager.ITEM_DATA.getItemTemplate(itemId).getName();
	}

	public final ItemTemplate getSkillTemplate() {
		return DataManager.ITEM_DATA.getItemTemplate(getItemId());
	}
}
