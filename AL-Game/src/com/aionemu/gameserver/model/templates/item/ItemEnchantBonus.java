package com.aionemu.gameserver.model.templates.item;

import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlAttribute;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlRootElement;

import com.aionemu.gameserver.model.templates.stats.ModifiersTemplate;

@XmlAccessorType(XmlAccessType.FIELD)
@XmlRootElement(name="ItemEnchantBouns")
public class ItemEnchantBonus
{
	@XmlElement(name="modifiers", required=false)
	private ModifiersTemplate modifiers;
	@XmlAttribute(name="level")
	private int level;

	public ItemEnchantBonus() {}

	public ModifiersTemplate getModifiers()
	{
		return modifiers;
	}

	public int getLevel()
	{
		return level;
	}
}