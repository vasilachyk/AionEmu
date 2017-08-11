package com.aionemu.gameserver.configs.main;

import com.aionemu.commons.configuration.Property;

/**
 * Created by wanke on 12/02/2017.
 */

public class PvPModConfig
{
    @Property(key = "gameserver.pvp.mod.ffa.enabled", defaultValue = "true")
    public static boolean FFA_ENABLED;
    @Property(key = "gameserver.pvp.mod.bg.enabled", defaultValue = "true")
    public static boolean BG_ENABLED;
}