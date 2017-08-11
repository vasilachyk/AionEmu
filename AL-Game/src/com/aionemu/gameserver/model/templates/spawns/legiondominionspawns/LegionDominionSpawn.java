package com.aionemu.gameserver.model.templates.spawns.legiondominionspawns;

import java.util.List;

import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlAttribute;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlType;

import com.aionemu.gameserver.model.legiondominion.LegionDominionModType;
import com.aionemu.gameserver.model.legiondominion.LegionDominionRace;
import com.aionemu.gameserver.model.templates.spawns.Spawn;

@XmlAccessorType(XmlAccessType.FIELD)
@XmlType(name = "LegionDominionSpawn")
public class LegionDominionSpawn
{
	@XmlElement(name = "legion_dominion_race")
	private List<LegionDominionRaceTemplate> legionDominionRaceTemplates;
	
	@XmlAttribute(name = "legion_id")
	private int legionDominionId;
	
	public int getLegionDominionId() {
		return legionDominionId;
	}
	
	public List<LegionDominionRaceTemplate> getLegionDominionRaceTemplates() {
		return legionDominionRaceTemplates;
	}
	
	@XmlAccessorType(XmlAccessType.FIELD)
	@XmlType(name = "LegionDominionRaceTemplate")
	public static class LegionDominionRaceTemplate {
	
		@XmlElement(name = "legion_mod")
		private List<LegionDominionModTemplate> LegionDominionModTemplates;
		
		@XmlAttribute(name = "race")
		private LegionDominionRace race;
		
		public LegionDominionRace getLegionDominionRace() {
			return race;
		}
		
		public List<LegionDominionModTemplate> getLegionDominionModTemplates() {
			return LegionDominionModTemplates;
		}
		
		@XmlAccessorType(XmlAccessType.FIELD)
		@XmlType(name = "LegionDominionModTemplate")
		public static class LegionDominionModTemplate {
			@XmlElement(name = "spawn")
			private List<Spawn> spawns;
			
			@XmlAttribute(name = "mod")
			private LegionDominionModType legionDominionMod;
			
			public List<Spawn> getSpawns() {
				return spawns;
			}
			
			public LegionDominionModType getLegionDominionModType() {
				return legionDominionMod;
			}
		}
	}
}