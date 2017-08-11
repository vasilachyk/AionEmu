/**
 * 
 */
package com.aionemu.gameserver.configs.administration;

import com.aionemu.commons.configuration.Property;

/**
 * @author Hoo
 *
 */
public class PanelConfig {
	
	@Property(key = "gameserver.administration.skilpanel", defaultValue = "3")
    public static int SKILL_PANEL_LEVEL;
	
	@Property(key = "gameserver.administration.changeclasspanel", defaultValue = "3")
    public static int CHANGECLASS_PANEL_LEVEL;
	
	@Property(key = "gameserver.administration.delquestpanel", defaultValue = "3")
    public static int DELQUEST_PANEL_LEVEL;
	
	@Property(key = "gameserver.administration.endquestpanel", defaultValue = "3")
    public static int ENDQUEST_PANEL_LEVEL;
	
	@Property(key = "gameserver.administration.givetitlepanel", defaultValue = "3")
    public static int GIVETITLE_PANEL_LEVEL;
	
	@Property(key = "gameserver.administration.startquestpanel", defaultValue = "3")
    public static int STARTQUEST_PANEL_LEVEL;
	
	@Property(key = "gameserver.administration.wishitempanel", defaultValue = "3")
    public static int WISHITEM_PANEL_LEVEL;
	
	@Property(key = "gameserver.administration.wishitemidpanel", defaultValue = "3")
    public static int WISHITEMID_PANEL_LEVEL;
}