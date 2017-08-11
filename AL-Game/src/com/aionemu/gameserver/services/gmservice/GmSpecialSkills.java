package com.aionemu.gameserver.services.gmservice;

import com.aionemu.gameserver.configs.administration.AdminConfig;
import com.aionemu.gameserver.model.gameobjects.player.Player;

public enum GmSpecialSkills {
	AccessLevel1(1, AdminConfig.ADMIN_TAG_1, "\ue042GM\ue043", new int[]{240, 241, 282}),
    AccessLevel2(2, AdminConfig.ADMIN_TAG_1, "\ue042HEAD-GM\ue043", new int[]{240, 241, 282}),
    AccessLevel3(3, AdminConfig.ADMIN_TAG_1, "\ue042Admin\ue043", new int[]{240, 241, 282}),
    AccessLevel4(4, AdminConfig.ADMIN_TAG_1, "\ue042Unity-Master\ue043", new int[]{240, 241, 282}),
    AccessLevel5(5, AdminConfig.ADMIN_TAG_1, "\ue042Unity-Management\ue043", new int[]{240, 241, 277, 282, 376, 377, 378, 379, 380, 381, 382, 383, 384, 385, 386, 387, 388, 389, 390, 391, 392, 393, 394, 395, 395, 396}),
    AccessLevel6(6, AdminConfig.ADMIN_TAG_1, "\ue042Unity-Developer\ue043", new int[]{240, 241, 277, 282, 376, 377, 378, 379, 380, 381, 382, 383, 384, 385, 386, 387, 388, 389, 390, 391, 392, 393, 394, 395, 395, 396}),
	AccessLevel7(7, AdminConfig.ADMIN_TAG_1, "\ue042Unity-Developer\ue043", new int[]{240, 241, 277, 282, 376, 377, 378, 379, 380, 381, 382, 383, 384, 385, 386, 387, 388, 389, 390, 391, 392, 393, 394, 395, 395, 396}),
	AccessLevel8(8, AdminConfig.ADMIN_TAG_1, "\ue042Unity-Developer\ue043", new int[]{240, 241, 277, 282, 376, 377, 378, 379, 380, 381, 382, 383, 384, 385, 386, 387, 388, 389, 390, 391, 392, 393, 394, 395, 395, 396}),
	AccessLevel9(9, AdminConfig.ADMIN_TAG_1, "\ue042Unity-Developer\ue043", new int[]{240, 241, 277, 282, 376, 377, 378, 379, 380, 381, 382, 383, 384, 385, 386, 387, 388, 389, 390, 391, 392, 393, 394, 395, 395, 396}),
	AccessLevel10(10, AdminConfig.ADMIN_TAG_1, "\ue042Unity-Developer\ue043", new int[]{240, 241, 277, 282, 376, 377, 378, 379, 380, 381, 382, 383, 384, 385, 386, 387, 388, 389, 390, 391, 392, 393, 394, 395, 395, 396});
    
    private final int level;
    private final String nameLevel;
    private String status;
    private int[] skills;

    GmSpecialSkills(int id, String name, String status, int[] skills) {
        this.level = id;
        this.nameLevel = name;
        this.status = status;
        this.skills = skills;
    }

    public String getName() {
        return nameLevel;
    }

    public int getLevel() {
        return level;
    }

    public String getStatusName() {
        return status;
    }

    public int[] getSkills() {
        return skills;
    }

    public static GmSpecialSkills getAlType(int level) {
        for (GmSpecialSkills al : GmSpecialSkills.values()) {
            if (level == al.getLevel()) {
                return al;
            }
        }
        return null;
    }

    public static String getAlName(int level) {
        for (GmSpecialSkills al : GmSpecialSkills.values()) {
            if (level == al.getLevel()) {
                return al.getName();
            }
        }
        return "%s";
    }

    public static String getStatusName(Player player) {
        return player.getAccessLevel() > 0 ? GmSpecialSkills.getAlType(player.getAccessLevel()).getStatusName() : player.getLegion().getLegionName();
    }

}
