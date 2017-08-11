package com.aionemu.gameserver.model.landing;

import java.util.*;
import java.sql.Timestamp;
import javolution.util.FastMap;

import com.aionemu.gameserver.model.*;
import com.aionemu.gameserver.model.gameobjects.*;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.model.templates.landing.LandingTemplate;
import com.aionemu.gameserver.services.abysslandingservice.Landing;

public class LandingLocation
{
    protected int siege;
    protected int commander;
    protected int artifact;
    protected int base;
    protected int monuments;
    protected int quest;
    protected int facility;
    protected Timestamp levelUpDate;
    protected int id;
    protected int level;
    protected int points;
    protected boolean isActive;
    protected Race race;
    protected LandingTemplate template;
    protected Landing<LandingLocation> activeLanding;
    protected FastMap<Integer, Player> players = new FastMap<Integer, Player>();
    private final List<VisibleObject> spawned = new ArrayList<VisibleObject>();
    private PersistentState persistentState;
	
    public LandingLocation() {
    }
	
    public LandingLocation(LandingTemplate template) {
        this.template = template;
        this.id = template.getId();
    }
	
    public boolean isActive() {
        return isActive;
    }
	
    public void setActiveLanding(Landing<LandingLocation> landing) {
        isActive = landing != null;
        this.activeLanding = landing;
    }
	
    public Landing<LandingLocation> getActiveLanding() {
        return activeLanding;
    }
	
    public final LandingTemplate getTemplate() {
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
	
    public int getLevel() {
        if (this.level == 0) {
            return this.level + 1;
        } else {
            return this.level;
        }
    }
	
    public void setLevel(int level) {
        this.level = level;
    }
	
    public int getPoints() {
        return this.points;
    }
	
    public void setPoints(int pts) {
        this.points = pts;
    }
	
    public int getSiegePoints() {
        return this.siege;
    }
	
    public void setSiegePoints(int pts) {
        this.siege = pts;
    }
	
    public int getCommanderPoints() {
        return this.commander;
    }
	
    public void setCommanderPoints(int pts) {
        this.commander = pts;
    }
	
    public int getArtifactPoints() {
        return this.artifact;
    }
	
    public void setArtifactPoints(int pts) {
        this.artifact = pts;
    }
	
    public int getBasePoints() {
        return this.base;
    }
	
    public void setBasePoints(int pts) {
        this.base = pts;
    }
	
    public int getQuestPoints() {
        return this.quest;
    }
	
    public void setQuestPoints(int pts) {
        this.quest = pts;
    }
	
    public int getFacilityPoints() {
        return this.facility;
    }
	
    public void setFacilityPoints(int pts) {
        this.facility = pts;
    }
	
    public int getMonumentsPoints() {
        return this.monuments;
    }
	
    public void setMonumentsPoints(int pts) {
        this.monuments = pts;
    }
	
    public Timestamp getLevelUpDate() {
        return levelUpDate;
    }
	
    public Timestamp setLevelUpDate(Timestamp timestamp) {
        return levelUpDate = timestamp;
    }
	
    public PersistentState getPersistentState() {
        return persistentState;
    }
	
    public void setPersistentState(PersistentState state) {
        if (this.persistentState == PersistentState.NEW && state == PersistentState.UPDATE_REQUIRED) {
            return;
        } else {
            this.persistentState = state;
        }
    }
	
    public Race getRace() {
        return this.race;
    }
	
    public Race setRace(Race race) {
        return this.race = race;
    }
}