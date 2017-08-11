package com.aionemu.gameserver.services;

import java.util.*;
import org.slf4j.*;

import com.aionemu.commons.utils.Rnd;

import com.aionemu.gameserver.configs.main.*;
import com.aionemu.gameserver.dataholders.DataManager;
import com.aionemu.gameserver.model.PlayerClass;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.model.templates.item.ItemTemplate;

public class PvPRewardService
{
	private static final Logger log = LoggerFactory.getLogger("PVP_LOG");
	
	private static final String plate = "188055157,188055160";
	private static final String chain = "188055157,188055162";
	private static final String leather = "188055157,188055164";
	private static final String cloth = "188055157,188055166";
	
	private static List<Integer> getRewardList(PlayerClass pc) {
		List<Integer> rewardList = new ArrayList<Integer>();
		String rewardString = "";
		switch (pc) {
			case TEMPLAR:
			case GLADIATOR:
				rewardString = plate;
			break;
			case CLERIC:
			case CHANTER:
			case AETHERTECH:
				rewardString = chain;
			break;
			case RANGER:
			case ASSASSIN:
			case GUNSLINGER:
				rewardString = leather;
			break;
			case SORCERER:
			case SONGWEAVER:
			case SPIRIT_MASTER:
				rewardString = cloth;
			break;
			default:
			rewardString = null;
		} if (rewardString != null) {
			String[] parts = rewardString.split(",");
			for (int i = 0; i < parts.length; i++) {
				rewardList.add(Integer.valueOf(Integer.parseInt(parts[i])));
			}
		} else {
			log.warn("[PvP][Reward] There is no reward list for the {PlayerClass: " + pc.toString() + "}");
		}
		return rewardList;
	}
	
	public static int getRewardId(Player winner, Player victim, boolean isAdvanced) {
		int itemId = 0;
		if (victim.getSpreeLevel() > 2) {
			isAdvanced = true;
		} if (!isAdvanced) {
			int lvl = victim.getLevel();
			if (lvl >= 25 && lvl <= 44) {
				itemId = 186000031; //Silver Medal.
			} if (lvl >= 45 && lvl <= 50) {
				itemId = 186000030; //Gold Medal.
			} if (lvl >= 51 && lvl <= 55) {
				itemId = 186000096; //Platinum Medal.
			} if (lvl >= 56 && lvl <= 60) {
				itemId = 186000147; //Mithril Medal.
			} if (lvl >= 61 && lvl <= 65) {
				itemId = 186000223; //Honorable Mithril Medal.
			} if (lvl >= 66 && lvl <= 83) {
				itemId = 186000414; //Blood Medal.
			}
		} else {
			List<Integer> abyssItemsList = getAdvancedReward(winner);
			itemId = ((Integer) abyssItemsList.get(Rnd.get(abyssItemsList.size()))).intValue();
		}
		return itemId;
	}
	
	public static float getMedalRewardChance(Player winner, Player victim) {
		float chance = PvPConfig.MEDAL_REWARD_CHANCE;
		chance += 1.5F * winner.getRawKillCount();
		int diff = victim.getLevel() - winner.getLevel();
		if (diff * diff > 100) {
			if (diff < 0) {
				diff = -10;
			} else {
				diff = 10;
			}
		}
		chance += 2.0F * diff;
		if ((victim.getSpreeLevel() > 0) || (chance > 100.0F)) {
			chance = 100.0F;
		}
		return chance;
	}
	
	public static int getRewardQuantity(Player winner, Player victim) {
		int rewardQuantity = winner.getSpreeLevel() + 1;
		switch (victim.getSpreeLevel()) {
			case 1:
				rewardQuantity += 5;
			break;
			case 2:
				rewardQuantity += 10;
			break;
			case 3:
				rewardQuantity += 15;
			break;
		}
		return rewardQuantity;
	}
	
	public static float getTollRewardChance(Player winner, Player victim) {
		float chance = PvPConfig.TOLL_REWARD_CHANCE;
		chance += 1.5F * winner.getRawKillCount();
		int diff = victim.getLevel() - winner.getLevel();
		if (diff * diff > 100) {
			if (diff < 0) {
				diff = -10;
			} else {
				diff = 10;
			}
		}
		chance += 2.0F * diff;
		if ((victim.getSpreeLevel() > 0) || (chance > 100.0F)) {
			chance = 100.0F;
		}
		return chance;
	}
	
	public static int getTollQuantity(Player winner, Player victim) {
		int tollQuantity = winner.getSpreeLevel() + 1;
		switch (victim.getSpreeLevel()) {
			case 1:
				tollQuantity += 5;
			break;
			case 2:
				tollQuantity += 10;
			break;
			case 3:
				tollQuantity += 15;
			break;
		}
		return tollQuantity;
	}
	
	private static List<Integer> getAdvancedReward(Player winner) {
		int lvl = winner.getLevel();
		PlayerClass pc = winner.getPlayerClass();
		List<Integer> rewardList = new ArrayList<Integer>();
		if (lvl >= 25 && lvl <= 83) {
			rewardList.addAll(getFilteredRewardList(pc, 25, 83));
		}
		return rewardList;
	}
	
	private static List<Integer> getFilteredRewardList(PlayerClass pc, int minLevel, int maxLevel) {
		List<Integer> filteredRewardList = new ArrayList<Integer>();
		List<Integer> rewardList = getRewardList(pc);
		for (Iterator<Integer> i = rewardList.iterator(); i.hasNext();) {
			int id = i.next();
			ItemTemplate itemTemp = DataManager.ITEM_DATA.getItemTemplate(id);
			if (itemTemp == null) {
				log.warn("[PvP][Reward] Incorrect {Item ID: " + id + "} reward for {PlayerClass: " + pc.toString() + "}");
			}
			int itemLevel = itemTemp.getLevel();
			if (itemLevel >= minLevel && itemLevel < maxLevel) {
				filteredRewardList.add(id);
			}
		}
		return filteredRewardList.size() > 0 ? filteredRewardList : new ArrayList<Integer>();
	}
}