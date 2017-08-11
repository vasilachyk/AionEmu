package com.aionemu.gameserver.model.templates.decomposable;

import java.util.ArrayList;
import java.util.List;

import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlAttribute;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlType;

import com.aionemu.gameserver.model.*;

@XmlAccessorType(XmlAccessType.FIELD)
@XmlType(name="SelectItems")
public class SelectItems
{
	@XmlAttribute(name="player_class")
	private PlayerClass playerClass = PlayerClass.ALL;
	
	@XmlElement(name="item")
	private List<SelectItem> items;
	
	public PlayerClass getPlayerClass() {
		return this.playerClass;
	}
	
	public List<SelectItem> getItems() {
		return this.items;
	}
	
	public void addItem(SelectItem newItem) {
        if(this.items == null)
            this.items = new ArrayList<SelectItem>();
        this.items.add(newItem);
    }
}