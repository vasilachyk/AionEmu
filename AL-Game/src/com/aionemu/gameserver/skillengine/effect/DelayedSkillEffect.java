package com.aionemu.gameserver.skillengine.effect;

import com.aionemu.gameserver.dataholders.DataManager;
import com.aionemu.gameserver.model.gameobjects.*;
import com.aionemu.gameserver.skillengine.*;
import com.aionemu.gameserver.skillengine.model.*;
import com.aionemu.gameserver.utils.*;
import com.aionemu.gameserver.world.*;
import com.aionemu.gameserver.world.knownlist.Visitor;

import javax.xml.bind.annotation.XmlAttribute;

public class DelayedSkillEffect extends EffectTemplate
{
	@XmlAttribute(name = "skill_id")
	protected int skillId;

	public void applyEffect(Effect effect) {
		effect.addToEffectedController();
	}
	
	@Override
    public void startEffect(final Effect effect) {
        ThreadPoolManager.getInstance().schedule(new Runnable() {
            @Override
            public void run() {
                if(effect.getEffected().getEffectController().hasAbnormalEffect(effect.getSkill().getSkillId())){
                    final SkillTemplate template = DataManager.SKILL_DATA.getSkillTemplate(skillId);
                    if (template.getProperties().getTargetMaxCount() > 1) {
                        final Effect e = new Effect(effect.getEffector(), effect.getEffected(), template, template.getLvl(), 0);
                        World.getInstance().doOnAllObjects(new Visitor<VisibleObject>() {
                            @Override
                            public void visit(VisibleObject object) {
                                if (MathUtil.getDistance(effect.getEffected(), object) <= template.getProperties().getRevisionDistance()) {
                                    SkillEngine.getInstance().applyEffectDirectly(template.getSkillId(), effect.getEffected(), (Creature) object, template.getDuration());
                                    e.applyEffect();
                                    e.initialize();
                                }
                            }
                        });
                    } else {
                        Effect e = new Effect(effect.getEffector(), effect.getEffected(), template, template.getLvl(), 0);
                        e.initialize();
                        e.applyEffect();
                    }
                }
            }
        }, effect.getEffectsDuration());
    }
	
	@Override
    public void endEffect(Effect effect){
    }
}