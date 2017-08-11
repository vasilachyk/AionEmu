package mysql5;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import com.aionemu.commons.database.DB;
import com.aionemu.commons.database.DatabaseFactory;
import com.aionemu.commons.database.IUStH;
import com.aionemu.gameserver.dao.PlayerUpgradeArcadeDAO;
import com.aionemu.gameserver.model.gameobjects.PersistentState;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.model.gameobjects.player.PlayerUpgradeArcade;

/**
 * @author Ranastic
 */

public class MySQL5PlayerUpgradeArcadeDAO extends PlayerUpgradeArcadeDAO
{
	private static final Logger log = LoggerFactory.getLogger(MySQL5PlayerUpgradeArcadeDAO.class);
	public static final String ADD_QUERY = "INSERT INTO `player_upgrade_arcade` (`player_id`, `frenzy_meter`, `upgrade_lvl`) VALUES (?,?,?)";
	public static final String SELECT_QUERY = "SELECT `frenzy_meter`, `upgrade_lvl` FROM `player_upgrade_arcade` WHERE `player_id`=?";
	public static final String DELETE_QUERY = "DELETE FROM `player_upgrade_arcade` WHERE `player_id`=? AND `frenzy_meter`=? AND `upgrade_lvl`=?";
	public static final String UPDATE_QUERY = "UPDATE player_upgrade_arcade set `frenzy_meter`=?, `upgrade_lvl`=? WHERE `player_id`=?";
	public static final String UPDATE_METER_QUERY = "UPDATE player_upgrade_arcade set `frenzy_meter`=? WHERE `player_id`=?";
	public static final String UPDATE_LEVEL_QUERY = "UPDATE player_upgrade_arcade set `upgrade_lvl`=? WHERE `player_id`=?";
	
	@Override
	public boolean supports(String databaseName, int majorVersion, int minorVersion) {
		return MySQL5DAOUtils.supports(databaseName, majorVersion, minorVersion);
	}
	
	@Override
	public void load(Player player) {
		Connection con = null;
		try {
			con = DatabaseFactory.getConnection();
			PreparedStatement stmt = con.prepareStatement(SELECT_QUERY);
			stmt.setInt(1, player.getObjectId());
			ResultSet rset = stmt.executeQuery();
			if (rset.next()) {
				int meter = rset.getInt("frenzy_meter");
				int level = rset.getInt("upgrade_lvl");
				PlayerUpgradeArcade pua = new PlayerUpgradeArcade(meter, level);
				pua.setPersistentState(PersistentState.UPDATED);
				player.setPlayerUpgradeArcade(pua);
			}
			rset.close();
			stmt.close();
		}
		catch (Exception e) {
			log.error("Could not restore PlayerUpgradeArcade data for playerObjId: " + player.getObjectId() + " from DB: " + e.getMessage(), e);
		}
		finally {
			DatabaseFactory.close(con);
		}
	}
	
	@Override
	public boolean addUpgradeArcade(final int playerId, final int frenzy_meter, final int upgrade_lvl) {
		return DB.insertUpdate(ADD_QUERY, new IUStH() {
			@Override
			public void handleInsertUpdate(PreparedStatement ps) throws SQLException {
				ps.setInt(1, playerId);
				ps.setInt(2, frenzy_meter);
				ps.setInt(3, upgrade_lvl);
				ps.execute();
				ps.close();
			}
		});
	}
	
	@Override
	public boolean delUpgradeArcade(final int playerId, final int frenzy_meter, final int upgrade_lvl) {
		return DB.insertUpdate(DELETE_QUERY, new IUStH() {
			@Override
			public void handleInsertUpdate(PreparedStatement ps) throws SQLException {
				ps.setInt(1, playerId);
				ps.setInt(2, frenzy_meter);
				ps.setInt(3, upgrade_lvl);
				ps.execute();
				ps.close();
			}
		});
	}
	
	@Override
	public int getFrenzyMeterByObjId(final int obj) {
		Connection con = null;
		int frenzy_meter = 0;
		try {
			con = DatabaseFactory.getConnection();
			PreparedStatement s = con.prepareStatement("SELECT `frenzy_meter` FROM `player_upgrade_arcade` WHERE `player_id` = ?");
			s.setInt(1, obj);
			ResultSet rs = s.executeQuery();
			rs.next();
			frenzy_meter = rs.getInt("frenzy_meter");
			rs.close();
			s.close();
		}
		catch (Exception e) {
			return 0;
		}
		finally {
			DatabaseFactory.close(con);
		}
		return frenzy_meter;
	}
	
	@Override
	public int getUpgradeLvlByObjId(final int obj) {
		Connection con = null;
		int upgrade_lvl;
		try {
			con = DatabaseFactory.getConnection();
			PreparedStatement s = con.prepareStatement("SELECT `upgrade_lvl` FROM `player_upgrade_arcade` WHERE `player_id` = ?");
			s.setInt(1, obj);
			ResultSet rs = s.executeQuery();
			rs.next();
			upgrade_lvl = rs.getInt("upgrade_lvl");
			rs.close();
			s.close();
		}
		catch (Exception e) {
			return 0;
		}
		finally {
			DatabaseFactory.close(con);
		}
		return upgrade_lvl;
	}
	
	public boolean updateUpgradeArcade(Connection con, Player player) {
		PreparedStatement stmt = null;
		try {
			stmt = con.prepareStatement(UPDATE_QUERY);
			PlayerUpgradeArcade lr = player.getPlayerUpgradeArcade();
			stmt.setInt(1, lr.getFrenzyMeter());
			stmt.setInt(2, lr.getUpgradeLvl());
			stmt.setInt(3, player.getObjectId());
			stmt.addBatch();
			stmt.executeBatch();
			con.commit();
		}
		catch (Exception e) {
			log.error("Could not update PlayerUpgradeArcade data for player " + player.getObjectId() + " from DB: " + e.getMessage(), e);
			return false;
		}
		finally {
			DatabaseFactory.close(stmt);
		}
		return true;
	}
	
	@Override
	public boolean store(final Player player) {
		Connection con = null;
		boolean insert = false;
		try {
			con = DatabaseFactory.getConnection();
			con.setAutoCommit(false);
			PlayerUpgradeArcade bind = player.getPlayerUpgradeArcade();
			switch (bind.getPersistentState()) {
			case UPDATE_REQUIRED:
				insert = updateUpgradeArcade(con, player);
				log.info("DB updated.");
				break;
			default:
				break;
			}
			bind.setPersistentState(PersistentState.UPDATED);
		}
		catch (SQLException e) {
			log.error("Can't open connection to save player updateUpgradeArcade: " + player.getObjectId());
		}
		finally {
			DatabaseFactory.close(con);
		}
		return insert;
	}
	
	@Override
	public boolean setFrenzyMeterByObjId(int obj, int frenzy_meter) {
		Connection con = null;
		try {
			con = DatabaseFactory.getConnection();
			PreparedStatement stmt = con.prepareStatement(UPDATE_METER_QUERY);
			stmt.setInt(1, frenzy_meter);
			stmt.setInt(2, obj);
			stmt.execute();
			stmt.close();
		}
		catch (Exception e) {
			return false;
		}
		finally {
			DatabaseFactory.close(con);
		}
		return true;
	}
	
	@Override
	public boolean setUpgradeLvlByObjId(int obj, int upgrade_lvl) {
		Connection con = null;
		try {
			con = DatabaseFactory.getConnection();
			PreparedStatement stmt = con.prepareStatement(UPDATE_LEVEL_QUERY);
			stmt.setInt(1, upgrade_lvl);
			stmt.setInt(2, obj);
			stmt.execute();
			stmt.close();
		}
		catch (Exception e) {
			return false;
		}
		finally {
			DatabaseFactory.close(con);
		}
		return true;
	}
}