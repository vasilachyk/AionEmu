package com.aionemu.gameserver.model.templates.portal;

import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlAttribute;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlType;

@XmlAccessorType(XmlAccessType.FIELD)
@XmlType(name = "PortalScroll", propOrder = { "portalPath" })
public class PortalScroll {

	@XmlElement(name = "portal_path")
	protected PortalPath portalPath;

	@XmlAttribute
	protected String name;

	public PortalPath getPortalPath() {
		return portalPath;
	}

	public String getName() {
		return name;
	}

	public void setName(String value) {
		name = value;
	}
}
