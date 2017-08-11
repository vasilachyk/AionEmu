package com.aionemu.gameserver.dataholders;

import gnu.trove.map.hash.TIntObjectHashMap;

import java.util.List;

import javax.xml.bind.Unmarshaller;
import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlRootElement;

import com.aionemu.gameserver.skillengine.model.ChargeSkillTemplate;

/**
 * @author Dr.Nism
 */
@XmlRootElement(name = "charge_skills")
@XmlAccessorType(XmlAccessType.FIELD)
public class ChargeSkillData {
    @XmlElement(name = "charge_skill")
    private List<ChargeSkillTemplate> chargeSkills;

    private TIntObjectHashMap<ChargeSkillTemplate> templates;

    void afterUnmarshal(Unmarshaller u, Object parent) {
        templates = new TIntObjectHashMap<ChargeSkillTemplate>();

        for (ChargeSkillTemplate chargeSkill : chargeSkills)
            templates.put(chargeSkill.getId(), chargeSkill);

        chargeSkills = null;
    }

    public int size() {
        return templates.size();
    }

    public ChargeSkillTemplate getChargeSkillTemplate(int skillId) {
        return templates.get(skillId);
    }
}
