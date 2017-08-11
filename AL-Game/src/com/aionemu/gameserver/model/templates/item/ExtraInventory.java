package com.aionemu.gameserver.model.templates.item;

import javax.xml.bind.annotation.*;

@XmlAccessorType(XmlAccessType.FIELD)
@XmlType(name = "ExtraInventory")
public class ExtraInventory
{
	@XmlAttribute(required = true)
	protected int id;
	
	public int getId() {
		return id;
	}
}