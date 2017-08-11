package mysql5;

import com.aionemu.commons.database.DB;
import com.aionemu.commons.database.DatabaseFactory;
import com.aionemu.commons.database.ParamReadStH;
import com.aionemu.gameserver.dao.*;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

public class MySQL5PlayerTransfoDAO extends PlayerTransformDAO
{
    private static final Logger log = LoggerFactory.getLogger(MySQL5PlayerTransfoDAO.class);
    public static final String INSERT_QUERY = "INSERT INTO `player_transform` (`player_id`, `panel_id`, `item_id`) VALUES (?,?,?)";
    public static final String SELECT_QUERY = "SELECT * FROM `player_transform` WHERE `player_id`=?";
    public static final String DELETE_QUERY = "DELETE FROM `player_transform` WHERE `player_id`=?";
	
    @Override
    public void loadPlTransfo(final Player player) {
        DB.select(SELECT_QUERY, new ParamReadStH() {
            @Override
            public void setParams(PreparedStatement stmt) throws SQLException {
                stmt.setInt(1, player.getObjectId());
            }
            @Override
            public void handleRead(ResultSet rset) throws SQLException {
                while (rset.next()) {
                    int panelId = rset.getInt("panel_id");
                    int itemId = rset.getInt("item_id");
                    player.getTransformModel().setPanelId(panelId);
                    player.getTransformModel().setItemId(itemId);
                }
            }
        });
    }
	
    @Override
    public boolean storePlTransfo(int playerId, int panelId, int itemId) {
        Connection con = null;
        try {
            con = DatabaseFactory.getConnection();
            PreparedStatement stmt = con.prepareStatement(INSERT_QUERY);
            stmt.setInt(1, playerId);
            stmt.setInt(2, panelId);
            stmt.setInt(3, itemId);
            stmt.execute();
            stmt.close();
        } catch (Exception e) {
            log.error("Could not store f2p for player " + playerId + " from DB: " + e.getMessage(), e);
            return false;
        } finally {
            DatabaseFactory.close(con);
        }
        return true;
    }
	
    @Override
    public boolean deletePlTransfo(int playerId) {
        Connection con = null;
        try {
            con = DatabaseFactory.getConnection();
            PreparedStatement stmt = con.prepareStatement(DELETE_QUERY);
            stmt.setInt(1, playerId);
            stmt.execute();
            stmt.close();
        } catch (Exception e) {
            log.error("Could not delete f2p for player " + playerId + " from DB: " + e.getMessage(), e);
            return false;
        } finally {
            DatabaseFactory.close(con);
        }
        return true;
    }
	
    @Override
    public boolean supports(String arg0, int arg1, int arg2) {
        return com.aionemu.gameserver.dao.MySQL5DAOUtils.supports(arg0, arg1, arg2);
    }
}