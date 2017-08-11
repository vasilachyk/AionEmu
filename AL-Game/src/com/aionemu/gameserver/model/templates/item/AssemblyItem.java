package com.aionemu.gameserver.model.templates.item;

import java.util.ArrayList;
import java.util.List;
import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlAttribute;
import javax.xml.bind.annotation.XmlType;

@XmlAccessorType(XmlAccessType.FIELD)
@XmlType(name = "AssemblyItem")
public class AssemblyItem
{
	@XmlAttribute(required = true)
	protected int id;
	
	@XmlAttribute(name = "parts_num")
	protected int partsNum;
	
	@XmlAttribute(required = true)
	protected List<Integer> parts;
	
	public List<Integer> getParts() {
		if (parts == null) {
			parts = new ArrayList<Integer>();
		}
		return parts;
	}
	
	public int getId() {
		return id;
	}
	
	public void setId(int value) {
		id = value;
	}
	
	public int getPartsNum() {
		return partsNum;
	}
	
	public void setPartsNum(int value) {
		partsNum = value;
	}
}