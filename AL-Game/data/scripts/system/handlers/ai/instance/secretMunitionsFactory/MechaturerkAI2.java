/*
 * This file is part of Encom. **ENCOM FUCK OTHER SVN**
 *
 *  Encom is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Lesser Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  Encom is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Lesser Public License for more details.
 *
 *  You should have received a copy of the GNU Lesser Public License
 *  along with Encom.  If not, see <http://www.gnu.org/licenses/>.
 */
package ai.instance.secretMunitionsFactory;

import java.util.*;

import ai.AggressiveNpcAI2;

import com.aionemu.gameserver.ai2.*;
import com.aionemu.gameserver.model.gameobjects.*;
import com.aionemu.gameserver.world.*;

/****/
/** Author Rinzler, Ranastic (Encom)
/****/

@AIName("Mechaturerk")
public class MechaturerkAI2 extends AggressiveNpcAI2
{
	@Override
	protected void handleDied() {
		final WorldPosition p = getPosition();
		if (p != null) {
			deleteNpcs(p.getWorldMapInstance().getNpcs(243853)); //Mechaturerk Maintenance Soldier.
			deleteNpcs(p.getWorldMapInstance().getNpcs(244135)); //Melee Support Destruction Golem.
			deleteNpcs(p.getWorldMapInstance().getNpcs(244136)); //Ranged Support Destruction Golem.
			deleteNpcs(p.getWorldMapInstance().getNpcs(243661)); //Azure Living Bomb.
			deleteNpcs(p.getWorldMapInstance().getNpcs(243662)); //Golden Living Bomb.
		}
		spawn(703381, 138.86005f, 253.14404f, 191.8727f, (byte) 0); //Mechaturerk’s Footlocker.
		spawn(703382, 138.84244f, 249.96141f, 191.8727f, (byte) 0); //Mechaturerk’s Core.
		spawn(703383, 138.83214f, 246.4382f, 191.8727f, (byte) 0); //Destruction Golem’s Footlocker.
		spawn(833998, 152.87827f, 268.53104f, 191.8727f, (byte) 106); //Corridor To Atreia.
		spawn(834167, 149.93068f, 255.50876f, 191.8727f, (byte) 6); //Jay.
		super.handleDied();
	}
	
	private void deleteNpcs(List<Npc> npcs) {
		for (Npc npc: npcs) {
			if (npc != null) {
				npc.getController().onDelete();
			}
		}
	}
}