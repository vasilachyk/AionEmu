package com.aionemu.gameserver.model.templates.pet;

import java.util.ArrayList;
import java.util.List;

import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlAttribute;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlType;

@XmlAccessorType(XmlAccessType.FIELD)
@XmlType(name = "PetBonusAttr", propOrder = {"penaltyAttr"})
public class PetBonusAttr {

	@XmlElement(name = "penalty_attr")
    protected List<PetPenaltyAttr> penaltyAttr;
	
    @XmlAttribute(name = "buff_id", required = true)
    protected int buffId;
    
    @XmlAttribute(name = "food_count", required = true)
    protected int foodCount;
	
    public List<PetPenaltyAttr> getPenaltyAttr() {
        if (penaltyAttr == null) {
            penaltyAttr = new ArrayList<PetPenaltyAttr>();
        }
        return this.penaltyAttr;
    }
	
    public int getBuffId() {
        return buffId;
    }
	
    public void setBuffId(int value) {
        this.buffId = value;
    }
    
    public int getFoodCount() {
        return foodCount;
    }
}
