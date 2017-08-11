package com.aionemu.gameserver.dataholders;

import gnu.trove.map.hash.TIntObjectHashMap;

import java.util.List;

import javax.xml.bind.Unmarshaller;
import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlRootElement;
import javax.xml.bind.annotation.XmlTransient;
import javax.xml.bind.annotation.XmlType;

import com.aionemu.gameserver.model.templates.serial_guard.*;

@XmlAccessorType(XmlAccessType.FIELD)
@XmlType(name = "", propOrder = {"guardRankRestriction", "guardTypeRestriction"})
@XmlRootElement(name = "serial_guards")
public class SerialGuardData
{
    @XmlElement(name = "guard_rank_restriction")
    protected List<GuardRankRestriction> guardRankRestriction;
	
	@XmlElement(name = "guard_type_restriction")
    protected List<GuardTypeRestriction> guardTypeRestriction;
	
    @XmlTransient
    private TIntObjectHashMap<GuardRankRestriction> templates = new TIntObjectHashMap<GuardRankRestriction>();
    
	@XmlTransient
	private TIntObjectHashMap<GuardTypeRestriction> templatesType = new TIntObjectHashMap<GuardTypeRestriction>();
	
    void afterUnmarshal(Unmarshaller u, Object parent) {
    	for (GuardRankRestriction template : guardRankRestriction) {
            templates.put(template.getRankNum(), template);
    	}
    	guardRankRestriction.clear();
    	guardRankRestriction = null;
		////////////////////////////
		for (GuardTypeRestriction template : guardTypeRestriction) {
            templatesType.put(template.getTypeNum(), template);
    	}
		guardTypeRestriction.clear();
    	guardTypeRestriction = null;
    }
	
    public int size() {
        return templates.size() + templatesType.size();
    }
	
    public GuardRankRestriction getGuardRankRestriction(int rank) {
        return templates.get(rank);
    }
	
	public GuardTypeRestriction getGuardTypeRestriction(int type) {
        return templatesType.get(type);
    }
}