package com.aionemu.gameserver.model.templates.item.actions;

import com.aionemu.gameserver.model.gameobjects.Item;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import javax.xml.bind.annotation.XmlAttribute;

public class DecorateAction extends AbstractItemAction {

	@XmlAttribute(name = "id")
	private Integer partId;

	@Override
	public boolean canAct(Player player, Item parentItem, Item targetItem) {
		return false;
	}

	@Override
	public void act(Player player, Item parentItem, Item targetItem) {
	}

	public int getTemplateId() {
		if (partId == null)
			return 0;
		return partId;
	}
}
