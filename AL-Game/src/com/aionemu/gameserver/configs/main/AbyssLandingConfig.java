package com.aionemu.gameserver.configs.main;

import com.aionemu.commons.configuration.Property;

public class AbyssLandingConfig
{
	@Property(key = "gameserver.landing.quest.reset.enable", defaultValue = "true")
	public static boolean ABYSS_LANDING_QUEST_RESET_ENABLED;
	@Property(key = "gameserver.landing.points.reset.enable", defaultValue = "true")
	public static boolean ABYSS_LANDING_POINTS_RESET_ENABLED;
	@Property(key = "gameserver.landing.quest.reset.time", defaultValue = "0 0 12 ? * MON *")
	public static String ABYSS_LANDING_QUEST_RESET_TIME;
	@Property(key = "gameserver.landing.points.reset.time", defaultValue = "0 0 0 ? * MON *")
	public static String ABYSS_LANDING_POINTS_RESET_TIME;
	@Property(key = "gameserver.landing.quest.rate", defaultValue = "1")
    public static int ABYSS_LANDING_QUEST_RATE;
}