package com.aionemu.gameserver.model.gameobjects.player;

import java.util.Collection;
import java.util.SortedMap;
import java.util.TreeMap;

import com.aionemu.gameserver.model.templates.event.AtreianPassport;

/**
 * 
 * @author Ranastic
 *
 */
public class PlayerPassports {
	
	private final SortedMap<Integer, AtreianPassport> passports = new TreeMap<Integer, AtreianPassport>();

	public synchronized boolean addPassport(int id, AtreianPassport ap) {
		if (passports.containsKey(id)) {
			return false;
		}
		passports.put(id, ap);
		return true;
	}

	public synchronized boolean removePassport(int id) {
		if (passports.containsKey(id)) {
			passports.remove(id);
			return true;
		}
		return false;
	}

	public Collection<AtreianPassport> getAllPassports() {
		return passports.values();
	}
}
