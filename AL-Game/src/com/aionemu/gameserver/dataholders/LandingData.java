package com.aionemu.gameserver.dataholders;

import com.aionemu.gameserver.model.landing.LandingLocation;
import com.aionemu.gameserver.model.templates.landing.LandingTemplate;
import javolution.util.FastMap;

import javax.xml.bind.Unmarshaller;
import javax.xml.bind.annotation.*;
import java.util.List;

@XmlAccessorType(XmlAccessType.FIELD)
@XmlRootElement(name = "landing")
public class LandingData
{
    @XmlElement(name = "landing_location")
    private List<LandingTemplate> landingTemplates;
	
    @XmlTransient
    private FastMap<Integer, LandingLocation> landing = new FastMap<Integer, LandingLocation>();
	
    void afterUnmarshal(Unmarshaller u, Object parent) {
        for (LandingTemplate template : landingTemplates) {
            landing.put(template.getId(), new LandingLocation(template));
        }
    }
	
    public int size() {
        return landing.size();
    }
	
    public FastMap<Integer, LandingLocation> getLandingLocations() {
        return landing;
    }
}