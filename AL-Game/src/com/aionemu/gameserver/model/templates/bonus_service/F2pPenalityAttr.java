package com.aionemu.gameserver.model.templates.bonus_service;

import com.aionemu.gameserver.model.stats.container.StatEnum;
import com.aionemu.gameserver.skillengine.change.Func;

import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlAttribute;
import javax.xml.bind.annotation.XmlType;

/**
 * Created by wanke on 12/02/2017.
 */

@XmlAccessorType(XmlAccessType.FIELD)
@XmlType(name = "F2pPenalityAttr")
public class F2pPenalityAttr {

    @XmlAttribute(required = true)
    protected StatEnum stat;

    @XmlAttribute(required = true)
    protected Func func;

    @XmlAttribute(required = true)
    protected int value;

    public StatEnum getStat() {
        return stat;
    }

    public void setStat(StatEnum value) {
        stat = value;
    }

    public Func getFunc() {
        return func;
    }

    public void setFunc(Func value) {
        func = value;
    }

    public int getValue() {
        return value;
    }

    public void setValue(int value) {
        this.value = value;
    }
}
