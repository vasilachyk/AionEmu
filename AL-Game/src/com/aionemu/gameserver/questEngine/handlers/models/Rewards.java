package com.aionemu.gameserver.questEngine.handlers.models;

import java.util.ArrayList;
import java.util.List;
import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlRootElement;
import javax.xml.bind.annotation.XmlType;

@XmlAccessorType(XmlAccessType.FIELD)
@XmlType(name = "", propOrder = {"reward"})
@XmlRootElement(name = "rewards")
public class Rewards
{
    @XmlElement(required = true)
    protected List<Reward> reward;
	
    public List<Reward> getReward() {
        if (reward == null) {
            reward = new ArrayList<Reward>();
        }
        return this.reward;
    }
}