package com.aionemu.gameserver.services.abysslandingservice;

import com.aionemu.commons.database.dao.DAOManager;
import com.aionemu.gameserver.dao.AbyssLandingDAO;
import com.aionemu.gameserver.model.landing.*;

public class AbyssLanding extends Landing<LandingLocation>
{
    public AbyssLanding(LandingLocation landing) {
        super(landing);
    }
	
    @Override
    public void startLanding(int level) {
        getLandingLocation().setActiveLanding(this);
        if (!getLandingLocation().getSpawned().isEmpty()) {
            despawn();
        } switch (level) {
            case 1:
                spawn(LandingStateType.LVL1);
            break;
            case 2:
                spawn(LandingStateType.LVL2);
            break;
            case 3:
                spawn(LandingStateType.LVL3);
            break;
            case 4:
                spawn(LandingStateType.LVL4);
            break;
            case 5:
                spawn(LandingStateType.LVL5);
            break;
            case 6:
                spawn(LandingStateType.LVL6);
            break;
            case 7:
                spawn(LandingStateType.LVL7);
            break;
            case 8:
                spawn(LandingStateType.LVL8);
            break;
            default:
                spawn(LandingStateType.LVL1);
            break;
        }
    }
	
    public void saveLanding() {
        DAOManager.getDAO(AbyssLandingDAO.class).updateLocation(getLandingLocation());
    }
	
    @Override
    public void stopLanding() {
        getLandingLocation().setActiveLanding(null);
        despawn();
        spawn(LandingStateType.NONE);
    }
}