package com.aionemu.gameserver.dataholders;

import java.util.HashMap;
import java.util.Iterator;
import java.util.List;

import javax.xml.bind.Unmarshaller;
import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlElement;
import javax.xml.bind.annotation.XmlRootElement;

import com.aionemu.gameserver.model.*;
import com.aionemu.gameserver.model.templates.decomposable.DecomposableSelectItem;
import com.aionemu.gameserver.model.templates.decomposable.SelectItem;
import com.aionemu.gameserver.model.templates.decomposable.SelectItems;

@XmlRootElement(name="decomposable_select_items")
@XmlAccessorType(XmlAccessType.FIELD)
public class DecomposableSelectItemsData
{
	@XmlElement(name="decomposable_select_item", required=true)
	protected List<DecomposableSelectItem> selectItems;
	
	@SuppressWarnings({"unchecked", "rawtypes"})
	private HashMap<Integer, HashMap<PlayerClass, SelectItems>> selectItemData = new HashMap();
	
	@SuppressWarnings({"unchecked", "rawtypes"})
	void afterUnmarshal(Unmarshaller u, Object parent) {
		for (Iterator i$ = this.selectItems.iterator(); i$.hasNext();) {
			DecomposableSelectItem item;
			item = (DecomposableSelectItem)i$.next();
			if (item.getItems() != null) {
				if (!this.selectItemData.containsKey(Integer.valueOf(item.getItemId()))) {
					this.selectItemData.put(Integer.valueOf(item.getItemId()), new HashMap());
				} for (SelectItems its : item.getItems()) {
					((HashMap)this.selectItemData.get(Integer.valueOf(item.getItemId()))).put(its.getPlayerClass(), its);
				}
			}
		}
		this.selectItems.clear();
		this.selectItems = null;
	}
	
	@SuppressWarnings("rawtypes")
	public SelectItems getSelectItem(PlayerClass playerClass, Race race, int itemid) {
        if (this.selectItemData.containsKey(Integer.valueOf(itemid))) {
            if (((HashMap) this.selectItemData.get(Integer.valueOf(itemid))).containsKey(playerClass)) {
                SelectItems filtered = new SelectItems();
                for(SelectItem si : this.selectItemData.get(itemid).get(playerClass).getItems()) {
                    if(si.getRace() == Race.PC_ALL || si.getRace() == race)
                        filtered.addItem(si);
                }
                return filtered;
            }
            if (((HashMap) this.selectItemData.get(Integer.valueOf(itemid))).containsKey(PlayerClass.ALL)) {
                SelectItems filtered = new SelectItems();
                for(SelectItem si : this.selectItemData.get(itemid).get(PlayerClass.ALL).getItems()) {
                    if(si.getRace() == Race.PC_ALL || si.getRace() == race)
                        filtered.addItem(si);
                }
                return filtered;
            }
            return null;
        }
        return null;
    }

    public int size() {
        return selectItemData.size();
    }
}