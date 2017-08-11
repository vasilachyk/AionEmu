package com.aionemu.gameserver.services.rift;

import java.util.Map;

import com.aionemu.gameserver.model.rift.RiftLocation;
import com.aionemu.gameserver.services.RiftService;

public class RiftOpenRunnable implements Runnable
{
	private final int worldId;
	
	public RiftOpenRunnable(int worldId) {
		this.worldId = worldId;
	}
	
	@Override
	public void run() {
		Map<Integer, RiftLocation> locations = RiftService.getInstance().getRiftLocations();
		for (final RiftLocation loc: locations.values()) {
			if (loc.getWorldId() == worldId) {
				RiftService.getInstance().openRifts(loc);
			}
		}
		RiftInformer.sendRiftsInfo(worldId);
	}
}