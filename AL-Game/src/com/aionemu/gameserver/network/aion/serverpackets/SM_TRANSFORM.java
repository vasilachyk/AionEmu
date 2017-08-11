package com.aionemu.gameserver.network.aion.serverpackets;

import com.aionemu.gameserver.dataholders.DataManager;
import com.aionemu.gameserver.model.gameobjects.Creature;
import com.aionemu.gameserver.model.templates.npc.NpcTemplate;
import com.aionemu.gameserver.network.aion.AionConnection;
import com.aionemu.gameserver.network.aion.AionServerPacket;
import com.aionemu.gameserver.skillengine.model.TransformType;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

public class SM_TRANSFORM extends AionServerPacket
{
	private Creature creature;
	private int state;
	private int modelId;
	private boolean applyEffect;
	private int panelId;
	private int itemId;
	
	public SM_TRANSFORM(Creature creature, boolean applyEffect) {
		this.creature = creature;
		this.state = creature.getState();
		modelId = creature.getTransformModel().getModelId();
		this.applyEffect = applyEffect;
	}
	
	public SM_TRANSFORM(Creature creature, int panelId, boolean applyEffect, int itemId) {
		this.creature = creature;
		this.state = creature.getState();
		modelId = creature.getTransformModel().getModelId();
		this.panelId = panelId;
		this.applyEffect = applyEffect;
		this.itemId = itemId;
	}
	
	@Override
	protected void writeImpl(AionConnection con) {
		NpcTemplate npcTemplate = DataManager.NPC_DATA.getNpcTemplate(modelId);
		writeD(creature.getObjectId());
		writeD(modelId);
		writeH(state);
		writeF(0.25f);
		writeF(2.0f);
		writeC(applyEffect && creature.getTransformModel().getType() == TransformType.NONE ? 1 : 0);
		writeD(creature.getTransformModel().getType().getId());
		writeC(0);
		writeC(0);
		writeC(0);
		writeC(0);
		writeC(0);
		writeC(0);
		writeD(panelId);
		writeD(itemId);
		writeC(0);
	}
}