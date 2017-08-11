package com.aionemu.gameserver.services.abysslandingservice.landingspecialservice;

import com.aionemu.gameserver.model.landing_special.*;
import com.aionemu.gameserver.services.*;

import java.util.concurrent.atomic.AtomicBoolean;

public abstract class SpecialLanding <RL extends LandingSpecialLocation>
{
    private boolean started;
    private final RL spacialLandingLocation;
    private LandingSpecialStateType type;
    protected abstract void stopLanding();
    protected abstract void startLanding();
    private final AtomicBoolean closed = new AtomicBoolean();
	
    public SpecialLanding(RL specialLandingLocation) {
        this.spacialLandingLocation = specialLandingLocation;
    }
	
    public final void start() {
        boolean doubleStart = false;
        synchronized (this) {
            if (started) {
                doubleStart = true;
            } else {
                started = true;
            }
        } if (doubleStart) {
            return;
        }
        startLanding();
    }
	
    public final void stop() {
        stopLanding();
    }
	
    protected void spawn(LandingSpecialStateType type) {
        AbyssLandingSpecialService.spawn(getSpecialLandingLocation(), type);
    }
	
    protected void despawn() {
        AbyssLandingSpecialService.despawn(getSpecialLandingLocation());
    }
	
    public boolean isClosed() {
        return closed.get();
    }
	
    public RL getSpecialLandingLocation() {
        return spacialLandingLocation;
    }
	
    public int getSpecialLandingLocationId() {
        return spacialLandingLocation.getId();
    }
	
    public LandingSpecialStateType getType() {
        return this.type;
    }
	
    public void setType(LandingSpecialStateType tp) {
        this.type = tp;
    }
}