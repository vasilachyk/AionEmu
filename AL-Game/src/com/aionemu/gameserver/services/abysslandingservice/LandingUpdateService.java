package com.aionemu.gameserver.services.abysslandingservice;

import com.aionemu.commons.database.dao.DAOManager;
import com.aionemu.commons.services.CronService;
import com.aionemu.gameserver.configs.main.*;
import com.aionemu.gameserver.dao.*;
import com.aionemu.gameserver.model.landing.*;
import com.aionemu.gameserver.services.*;

import org.slf4j.*;

public class LandingUpdateService
{
    private static final Logger log = LoggerFactory.getLogger(LandingUpdateService.class);
	
    final LandingLocation redemptionLanding = AbyssLandingService.getInstance().redemptionLanding();
    final LandingLocation harbingerLanding = AbyssLandingService.getInstance().harbingerLanding();
	
	//Quest Points.
    final int redemptionPts = redemptionLanding.getQuestPoints() - redemptionLanding.getQuestPoints();
    final int harbingerPts = harbingerLanding.getQuestPoints() - harbingerLanding.getQuestPoints();
	
	//Monument Points.
	final int redemptionPts1 = redemptionLanding.getMonumentsPoints() - redemptionLanding.getMonumentsPoints();
    final int harbingerPts1 = harbingerLanding.getMonumentsPoints() - harbingerLanding.getMonumentsPoints();
	
	//Facility Points.
	final int redemptionPts2 = redemptionLanding.getFacilityPoints() - redemptionLanding.getFacilityPoints();
    final int harbingerPts2 = harbingerLanding.getFacilityPoints() - harbingerLanding.getFacilityPoints();
	
	//Commander Points.
	final int redemptionPts3 = redemptionLanding.getCommanderPoints() - redemptionLanding.getCommanderPoints();
    final int harbingerPts3 = harbingerLanding.getCommanderPoints() - harbingerLanding.getCommanderPoints();
	
    private LandingUpdateService() {
    }
	
    public void initResetQuestPoints() {
        if (AbyssLandingConfig.ABYSS_LANDING_QUEST_RESET_ENABLED) {
            CronService.getInstance().schedule(new Runnable() {
                @Override
                public void run() {
                    resetQuestPoints();
                }
            }, AbyssLandingConfig.ABYSS_LANDING_QUEST_RESET_TIME);
        }
    }
	
	public void initResetAbyssLandingPoints() {
        if (AbyssLandingConfig.ABYSS_LANDING_POINTS_RESET_ENABLED) {
            CronService.getInstance().schedule(new Runnable() {
                @Override
                public void run() {
					resetMonumentPoints();
					resetFacilityPoints();
					resetCommanderPoints();
                }
            }, AbyssLandingConfig.ABYSS_LANDING_POINTS_RESET_TIME);
        }
    }
	
    public void resetQuestPoints() {
        log.debug("##### Abyss Landing Reset Quest Points #####");
        long startTime = System.currentTimeMillis();
        //Redemption's Landing.
        redemptionLanding.setPoints(redemptionPts);
        redemptionLanding.setQuestPoints(0);
        AbyssLandingService.getInstance().checkRedemptionLanding(redemptionLanding.getPoints(), false);
        //Harbinger's Landing.
        harbingerLanding.setPoints(harbingerPts);
        harbingerLanding.setQuestPoints(0);
        AbyssLandingService.getInstance().checkHarbingerLanding(harbingerLanding.getPoints(), false);
        //Update All Landing.
        AbyssLandingService.getInstance().onUpdate();
    }
	
	public void resetMonumentPoints() {
		log.debug("##### Abyss Landing Reset Monuments Points #####");
        long startTime = System.currentTimeMillis();
        //Redemption's Landing.
        redemptionLanding.setPoints(redemptionPts1);
        redemptionLanding.setMonumentsPoints(0);
        AbyssLandingService.getInstance().checkRedemptionLanding(redemptionLanding.getPoints(), false);
        //Harbinger's Landing.
        harbingerLanding.setPoints(harbingerPts1);
        harbingerLanding.setMonumentsPoints(0);
        AbyssLandingService.getInstance().checkHarbingerLanding(harbingerLanding.getPoints(), false);
        //Update All Landing.
        AbyssLandingService.getInstance().onUpdate();
    }
	
	public void resetFacilityPoints() {
		log.debug("##### Abyss Landing Reset Facility Points #####");
        long startTime = System.currentTimeMillis();
        //Redemption's Landing.
        redemptionLanding.setPoints(redemptionPts2);
        redemptionLanding.setFacilityPoints(0);
        AbyssLandingService.getInstance().checkRedemptionLanding(redemptionLanding.getPoints(), false);
        //Harbinger's Landing.
        harbingerLanding.setPoints(harbingerPts2);
        harbingerLanding.setFacilityPoints(0);
        AbyssLandingService.getInstance().checkHarbingerLanding(harbingerLanding.getPoints(), false);
        //Update All Landing.
        AbyssLandingService.getInstance().onUpdate();
    }
	
	public void resetCommanderPoints() {
		log.debug("##### Abyss Landing Reset Commander Points #####");
        long startTime = System.currentTimeMillis();
        //Redemption's Landing.
        redemptionLanding.setPoints(redemptionPts3);
        redemptionLanding.setCommanderPoints(0);
        AbyssLandingService.getInstance().checkRedemptionLanding(redemptionLanding.getPoints(), false);
        //Harbinger's Landing.
        harbingerLanding.setPoints(harbingerPts3);
        harbingerLanding.setCommanderPoints(0);
        AbyssLandingService.getInstance().checkHarbingerLanding(harbingerLanding.getPoints(), false);
        //Update All Landing.
        AbyssLandingService.getInstance().onUpdate();
    }
	
    public static LandingUpdateService getInstance() {
        return SingletonHolder.instance;
    }
	
    private static class SingletonHolder {
        protected static final LandingUpdateService instance = new LandingUpdateService();
    }
}