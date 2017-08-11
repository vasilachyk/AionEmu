package com.aionemu.gameserver.model.landing_special;

import com.aionemu.gameserver.model.gameobjects.VisibleObject;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.model.templates.landing_special.LandingSpecialTemplate;
import com.aionemu.gameserver.services.abysslandingservice.landingspecialservice.SpecialLanding;
import javolution.util.FastMap;

import java.util.*;

public class LandingSpecialLocation
{
    protected int id;
	protected boolean isActive;
	protected LandingSpecialStateType type;
    protected LandingSpecialTemplate template;
    protected SpecialLanding<LandingSpecialLocation> activeLandingSpecial;
    protected FastMap<Integer, Player> players = new FastMap<Integer, Player>();
    private final List<VisibleObject> spawned = new ArrayList<VisibleObject>();
	
    public LandingSpecialLocation() {
    }
	
    public LandingSpecialLocation(LandingSpecialTemplate template) {
        this.template = template;
        this.id = template.getId();
    }
	
    public boolean isActive() {
        return isActive;
    }
	
    public void setActiveLanding(SpecialLanding<LandingSpecialLocation> landingSpecial) {
        isActive = landingSpecial != null;
        this.activeLandingSpecial = landingSpecial;
    }
	
    public SpecialLanding<LandingSpecialLocation> getActiveLandingSpecial() {
        return activeLandingSpecial;
    }
	
    public final LandingSpecialTemplate getTemplate() {
        return template;
    }
	
    public int getId() {
        return id;
    }
	
    public List<VisibleObject> getSpawned() {
        return spawned;
    }
	
    public FastMap<Integer, Player> getPlayers() {
        return players;
    }
	
	public void setType(LandingSpecialStateType type) {
        this.type = type;
    }
	
    public LandingSpecialStateType getType() {
        return this.type;
    }
}