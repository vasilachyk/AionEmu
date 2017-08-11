package com.aionemu.gameserver.model.templates.spawns.landingspecialspawns;

import com.aionemu.gameserver.model.landing_special.LandingSpecialStateType;
import com.aionemu.gameserver.model.templates.spawns.Spawn;

import javax.xml.bind.annotation.*;
import java.util.List;

@XmlAccessorType(XmlAccessType.FIELD)
@XmlType(name = "LandingSpecialSpawn")
public class LandingSpecialSpawn
{
    @XmlAttribute(name = "id")
    private int id;
	
    public int getId() {
        return id;
    }
	
    @XmlElement(name = "landing_special_type")
    private List<LandingSpecialSpawn.LandingSpStateTemplate> LandingSpStateTemplate;
	
    public List<LandingSpStateTemplate> getSiegeModTemplates() {
        return LandingSpStateTemplate;
    }
	
    @XmlAccessorType(XmlAccessType.FIELD)
    @XmlType(name = "LandingSpStateTemplate")
    public static class LandingSpStateTemplate {
		
        @XmlElement(name = "spawn")
        private List<Spawn> spawns;
		
        @XmlAttribute(name = "fstate")
        private LandingSpecialStateType landingSpecialType;
		
        public List<Spawn> getSpawns() {
            return spawns;
        }
		
        public LandingSpecialStateType getLandingSpecialType() {
            return landingSpecialType;
        }
    }
}