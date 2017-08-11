package com.aionemu.gameserver.model.templates.decomposable;

import java.util.List;

import javax.xml.bind.annotation.XmlAttribute;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlType;

@XmlType(name="DecomposableSelectItem")
public class DecomposableSelectItem
{

	@XmlAttribute(name="item_id")
	private int itemId;
	
	@XmlElement(name="items")
	private List<SelectItems> selectItems;

	public int getItemId() {
		return this.itemId;
	}
	
	public List<SelectItems> getItems() {
		return this.selectItems;
	}
}