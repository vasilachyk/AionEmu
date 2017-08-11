package playercommands;

import com.aionemu.commons.database.dao.DAOManager;
import com.aionemu.gameserver.dao.PlayerAppearanceDAO;
import com.aionemu.gameserver.model.gameobjects.player.Player;
import com.aionemu.gameserver.model.gameobjects.player.PlayerAppearance;
import com.aionemu.gameserver.network.aion.serverpackets.SM_PLAYER_INFO;
import com.aionemu.gameserver.services.item.ItemService;
import com.aionemu.gameserver.services.teleport.TeleportService2;
import com.aionemu.gameserver.utils.PacketSendUtility;
import com.aionemu.gameserver.utils.chathandlers.PlayerCommand;

public class cmd_repair extends PlayerCommand
{
    public cmd_repair() {
        super("repair");
    }
	
    @Override
    public void execute(Player player, String... params) {
        PlayerAppearance appearance = player.getPlayerAppearance();
        appearance.setVoice(0);
        appearance.setSkinRGB(9220070);
        appearance.setHairRGB(9229820);
        appearance.setEyeRGB(7129770);
        appearance.setLipRGB(14264063);
        appearance.setFace(0);
        appearance.setHair(75);
        appearance.setDeco(0);
        appearance.setTattoo(0);
        appearance.setFaceContour(0);
        appearance.setExpression(0);
        appearance.setPupilShape(24);
        appearance.setRemoveMane(1);
        appearance.setRightEyeRGB(16431242);
        appearance.setEyeLashShape(7);
        appearance.setJawLine(135);
        appearance.setForehead(1);
        appearance.setEyeHeight(144);
        appearance.setEyeSpace(129);
        appearance.setEyeWidth(170);
        appearance.setEyeSize(146);
        appearance.setEyeShape(3);
        appearance.setEyeAngle(8);
        appearance.setBrowHeight(1);
        appearance.setBrowAngle(14);
        appearance.setBrowShape(41);
        appearance.setNose(35);
        appearance.setNoseBridge(6);
        appearance.setNoseWidth(129);
        appearance.setNoseTip(139);
        appearance.setCheek(129);
        appearance.setLipHeight(186);
        appearance.setMouthSize(12);
        appearance.setLipSize(139);
        appearance.setSmile(68);
        appearance.setLipShape(2);
        appearance.setJawHeigh(2);
        appearance.setChinJut(135);
        appearance.setEarShape(3);
        appearance.setHeadSize(251);
        appearance.setNeck(255);
        appearance.setNeckLength(247);
        appearance.setShoulderSize(243);
        appearance.setTorso(254);
        appearance.setChest(0);
        appearance.setWaist(0);
        appearance.setHips(0);
        appearance.setArmThickness(0);
        appearance.setHandSize(0);
        appearance.setLegThickness(236);
        appearance.setFacialRate(1);
        appearance.setFootSize(164);
        appearance.setArmLength(254);
        appearance.setLegLength(228);
        appearance.setShoulders(249);
        appearance.setFaceShape(3);
        appearance.setPupilSize(13);
        appearance.setUpperTorso(0);
        appearance.setForeArmThickness(0);
        appearance.setHandSpan(0);
        appearance.setCalfThickness(0);
        appearance.setHeight(1);
        ItemService.addItem(player, 169650000, 1);
        DAOManager.getDAO(PlayerAppearanceDAO.class).store(player.getObjectId(), player.getPlayerAppearance());
        PacketSendUtility.sendPacket(player, new SM_PLAYER_INFO(player, false));
        TeleportService2.moveToBindLocation(player, true);
    }
	
    @Override
    public void onFail(Player player, String message) {
        PacketSendUtility.sendMessage(player, "Syntax: .repair");
    }
}