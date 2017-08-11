package com.aionemu.gameserver.services.abysslandingservice.landingspecialservice;

import com.aionemu.gameserver.model.landing_special.*;
import com.aionemu.gameserver.services.*;

public class SPLanding  extends SpecialLanding<LandingSpecialLocation>
{
    public SPLanding(LandingSpecialLocation landing) {
        super(landing);
    }
	
    @Override
    public void startLanding() {
        getSpecialLandingLocation().setActiveLanding(this);
        if (!getSpecialLandingLocation().getSpawned().isEmpty()) {
            despawn();
        }
        spawn(LandingSpecialStateType.SPAWN);
    }
	
    @Override
    public void stopLanding() {
        getSpecialLandingLocation().setActiveLanding(null);
        despawn();
        spawn(LandingSpecialStateType.DESPAWN);
    }
}