package com.aionemu.gameserver.services.siegeservice;

import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.model.siege.SiegeLocation;
import com.aionemu.gameserver.services.abyss.AbyssPointsService;

public class GloryPointsListener extends AbyssPointsService.AddGPGlobalCallback
{
	private final Siege<?> siege;
	
	public GloryPointsListener(Siege<?> siege) {
		this.siege = siege;
	}
	
	public void onGloryPointsAdded(Player player, int gloryPoints) {
		SiegeLocation fortress = siege.getSiegeLocation();
		if (fortress.isInsideLocation(player)) {
			siege.addGloryPoints(player, gloryPoints);
		}
	}
}