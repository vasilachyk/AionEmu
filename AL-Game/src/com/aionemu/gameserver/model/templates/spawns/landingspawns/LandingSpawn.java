package com.aionemu.gameserver.model.templates.spawns.landingspawns;

import com.aionemu.gameserver.model.landing.LandingStateType;
import com.aionemu.gameserver.model.templates.spawns.Spawn;

import javax.xml.bind.annotation.*;
import java.util.List;

@XmlAccessorType(XmlAccessType.FIELD)
@XmlType(name = "LandingSpawn")
public class LandingSpawn
{
    @XmlAttribute(name = "id")
    private int id;
	
    public int getId() {
        return id;
    }
	
    @XmlElement(name = "landing_level")
    private List<LandingSpawn.LandingStateTemplate> LandingStateTemplate;
	
    public List<LandingStateTemplate> getSiegeModTemplates() {
        return LandingStateTemplate;
    }
	
    @XmlAccessorType(XmlAccessType.FIELD)
    @XmlType(name = "LandingStateTemplate")
    public static class LandingStateTemplate {
		
        @XmlElement(name = "spawn")
        private List<Spawn> spawns;
		
        @XmlAttribute(name = "level")
        private LandingStateType landingType;
		
        public List<Spawn> getSpawns() {
            return spawns;
        }
		
        public LandingStateType getLandingType() {
            return landingType;
        }
    }
}