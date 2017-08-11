package com.aionemu.gameserver.dataholders;

import com.aionemu.gameserver.model.landing_special.LandingSpecialLocation;
import com.aionemu.gameserver.model.templates.landing_special.LandingSpecialTemplate;
import javolution.util.FastMap;

import javax.xml.bind.Unmarshaller;
import javax.xml.bind.annotation.*;
import java.util.List;

@XmlAccessorType(XmlAccessType.FIELD)
@XmlRootElement(name = "landing_special")
public class LandingSpecialData
{
    @XmlElement(name = "landing_special_location")
    private List<LandingSpecialTemplate> landingSpecialTemplates;
	
    @XmlTransient
    private FastMap<Integer, LandingSpecialLocation> landingSpecial = new FastMap<Integer, LandingSpecialLocation>();
	
    void afterUnmarshal(Unmarshaller u, Object parent) {
        for (LandingSpecialTemplate template: landingSpecialTemplates) {
            landingSpecial.put(template.getId(), new LandingSpecialLocation(template));
        }
    }
	
    public int size() {
        return landingSpecial.size();
    }
	
    public FastMap<Integer, LandingSpecialLocation> getLandingSpecialLocations() {
        return landingSpecial;
    }
}