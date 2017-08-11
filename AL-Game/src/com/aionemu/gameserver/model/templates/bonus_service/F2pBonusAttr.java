package com.aionemu.gameserver.model.templates.bonus_service;

import com.aionemu.gameserver.model.stats.container.StatEnum;
import com.aionemu.gameserver.skillengine.change.Func;

import javax.xml.bind.annotation.*;
import java.util.ArrayList;
import java.util.List;

/**
 * Created by wanke on 12/02/2017.
 */

@XmlAccessorType(XmlAccessType.FIELD)
@XmlType(name = "F2pBonusAttr", propOrder = {"bonusAttr"})
public class F2pBonusAttr
{
    @XmlElement(name = "bonus_attr")
    protected List<F2pPenalityAttr> bonusAttr;

    @XmlAttribute(name = "buff_id", required = true)
    protected int buffId;

    public List<F2pPenalityAttr> getPenaltyAttr() {
        if (bonusAttr == null) {
            bonusAttr = new ArrayList<F2pPenalityAttr>();
        }
        return bonusAttr;
    }

    public int getBuffId() {
        return buffId;
    }

    public void setBuffId(int value) {
        buffId = value;
    }
}