package com.aionemu.gameserver.configs.main;

import com.aionemu.commons.configuration.Property;

public class EnchantsConfig
{
	/**
	 * Enable Cap Enchantment +25
	 */

	@Property(key = "gameserver.supplement.lesser", defaultValue = "1.0")
    public static float LESSER_SUP;
	
    @Property(key = "gameserver.supplement.regular", defaultValue = "1.0")
    public static float REGULAR_SUP;
	
    @Property(key = "gameserver.supplement.greater", defaultValue = "1.0")
    public static float GREATER_SUP;
	
	@Property(key = "gameserver.socket.manastone", defaultValue = "50")
	public static float SOCKET_MANASTONE;
	
	@Property(key = "gameserver.enchant.item", defaultValue = "50")
	public static float ENCHANT_ITEM;
	
	@Property(key = "gameserver.manastone.clean", defaultValue = "false")
	public static boolean CLEAN_STONE;
	
	@Property(key = "gameserver.enchant.cast.speed", defaultValue = "4000")
	public static int ENCHANT_SPEED;

	@Property(key = "gameserver.enchant.skill", defaultValue = "true")
	public static boolean ENCHANT_SKILL_ENABLE;

	@Property(key = "gameserver.enchant.item.broke", defaultValue = "true")
	public static boolean ENCHANT_ITEM_BROKE;

	/***
     * Tempering (Authorize) Rates
     */
    @Property(key = "gameserver.rate.tempering", defaultValue = "5")
    public static float TEMPERING_RATE;
    
  //Destroy Item ArchDaeva
  	@Property(key = "gameserver.archdaeva.item.destroy", defaultValue = "true")
  	public static boolean ENABLE_ARCHDAEVA_DESTROY_ITEM;
}