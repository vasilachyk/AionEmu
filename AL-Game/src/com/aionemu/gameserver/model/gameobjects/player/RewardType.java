package com.aionemu.gameserver.model.gameobjects.player;

import com.aionemu.gameserver.configs.main.*;
import com.aionemu.gameserver.model.stats.container.StatEnum;

public enum RewardType
{
	AP_PLAYER {
		@Override
		public long calcReward(Player player, long reward) {
			float statRate = player.getGameStats().getStat(StatEnum.AP_BOOST, 100).getCurrent() / 100f;
			if (CustomConfig.ENABLE_EXP_PROGRESSIVE_AP_PLAYER) {
				if (player.getLevel() >= 25 && player.getLevel() <= 40) {
				    return (long) (reward * 2 * player.getRates().getApPlayerGainRate() * statRate);
			    } else if (player.getLevel() >= 41 && player.getLevel() <= 55) {
				    return (long) (reward * 3 * player.getRates().getApPlayerGainRate() * statRate);
			    } else if (player.getLevel() >= 56 && player.getLevel() <= 65) {
				    return (long) (reward * 4 * player.getRates().getApPlayerGainRate() * statRate);
			    } else if (player.getLevel() >= 66 && player.getLevel() <= 75) {
				    return (long) (reward * 5 * player.getRates().getApPlayerGainRate() * statRate);
			    } else if (player.getLevel() >= 76 && player.getLevel() <= 83) {
				    return (long) (reward * 6 * player.getRates().getApPlayerGainRate() * statRate);
			    }
			}
			return (long) (reward * player.getRates().getApPlayerGainRate() * statRate);
		}
	},
	GP_PLAYER {
        @Override
        public long calcReward(Player player, long reward) {
            return (long) (reward * player.getRates().getGpPlayerGainRate());
        }
    },
	AP_NPC {
		@Override
		public long calcReward(Player player, long reward) {
			float statRate = player.getGameStats().getStat(StatEnum.AP_BOOST, 100).getCurrent() / 100f;
			if (CustomConfig.ENABLE_EXP_PROGRESSIVE_AP_NPC) {
				if (player.getLevel() >= 25 && player.getLevel() <= 40) {
				    return (long) (reward * 2 * player.getRates().getApNpcRate() * statRate);
			    } else if (player.getLevel() >= 41 && player.getLevel() <= 55) {
				    return (long) (reward * 3 * player.getRates().getApNpcRate() * statRate);
			    } else if (player.getLevel() >= 56 && player.getLevel() <= 65) {
				    return (long) (reward * 4 * player.getRates().getApNpcRate() * statRate);
			    } else if (player.getLevel() >= 66 && player.getLevel() <= 75) {
				    return (long) (reward * 5 * player.getRates().getApNpcRate() * statRate);
			    } else if (player.getLevel() >= 76 && player.getLevel() <= 83) {
				    return (long) (reward * 6 * player.getRates().getApNpcRate() * statRate);
			    }
			}
			return (long) (reward * player.getRates().getApNpcRate() * statRate);
		}
	},
	HUNTING {
		@Override
		public long calcReward(Player player, long reward) {
			float statRate = player.getGameStats().getStat(StatEnum.BOOST_HUNTING_XP_RATE, 100).getCurrent() / 100f;
			if (CustomConfig.ENABLE_EXP_PROGRESSIVE_HUNTING) {
			    if (player.getLevel() >= 1 && player.getLevel() <= 65) {
				    return (long) (reward * 5 * player.getRates().getXpRate() * statRate);
			    } else if (player.getLevel() >= 66 && player.getLevel() <= 75) {
				    return (long) (reward * 6 * player.getRates().getXpRate() * statRate);
			    } else if (player.getLevel() >= 76 && player.getLevel() <= 83) {
				    return (long) (reward * 7 * player.getRates().getXpRate() * statRate);
			    }
			}
			return (long) (reward * player.getRates().getXpRate() * statRate);
		}
	},
	GROUP_HUNTING {
		@Override
		public long calcReward(Player player, long reward) {
			float statRate = player.getGameStats().getStat(StatEnum.BOOST_GROUP_HUNTING_XP_RATE, 100).getCurrent() / 100f;
			if (CustomConfig.ENABLE_EXP_PROGRESSIVE_GROUP_HUNTING) {
			    if (player.getLevel() >= 1 && player.getLevel() <= 65) {
				    return (long) (reward * 5 * player.getRates().getGroupXpRate() * statRate);
			    } else if (player.getLevel() >= 66 && player.getLevel() <= 75) {
				    return (long) (reward * 6 * player.getRates().getGroupXpRate() * statRate);
			    } else if (player.getLevel() >= 76 && player.getLevel() <= 83) {
				    return (long) (reward * 7 * player.getRates().getGroupXpRate() * statRate);
			    }
			}
			return (long) (reward * player.getRates().getGroupXpRate() * statRate);
		}
	},
	PVP_KILL {
		@Override
		public long calcReward(Player player, long reward) {
			return (reward);
		}
	},
	QUEST {
		@Override
		public long calcReward(Player player, long reward) {
			float statRate = player.getGameStats().getStat(StatEnum.BOOST_QUEST_XP_RATE, 100).getCurrent() / 100f;
			if (CustomConfig.ENABLE_EXP_PROGRESSIVE_QUEST) {
			    if (player.getLevel() >= 1 && player.getLevel() <= 65) {
				    return (long) (reward * 5 * player.getRates().getQuestXpRate() * statRate);
			    } else if (player.getLevel() >= 66 && player.getLevel() <= 75) {
				    return (long) (reward * 6 * player.getRates().getQuestXpRate() * statRate);
			    } else if (player.getLevel() >= 76 && player.getLevel() <= 83) {
				    return (long) (reward * 7 * player.getRates().getQuestXpRate() * statRate);
			    }
			}
			return (long) (reward * player.getRates().getQuestXpRate() * statRate);
		}
	},
	CRAFTING {
		@Override
		public long calcReward(Player player, long reward) {
			float statRate = player.getGameStats().getStat(StatEnum.BOOST_CRAFTING_XP_RATE, 100).getCurrent() / 100f;
			return (long) (reward * player.getRates().getCraftingXPRate() * statRate);
		}
	},
	GATHERING {
		@Override
		public long calcReward(Player player, long reward) {
			float statRate = player.getGameStats().getStat(StatEnum.BOOST_GATHERING_XP_RATE, 100).getCurrent() / 100f;
			return (long) (reward * player.getRates().getGatheringXPRate() * statRate);
		}
	};
	public abstract long calcReward(Player player, long reward);
}