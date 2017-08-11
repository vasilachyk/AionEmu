package com.aionemu.gameserver.dataholders;

import com.aionemu.gameserver.model.templates.bonus_service.F2pBonusAttr;
import gnu.trove.map.hash.TIntObjectHashMap;

import javax.xml.bind.Unmarshaller;
import javax.xml.bind.annotation.*;
import java.util.List;

/**
 * Created by wanke on 12/02/2017.
 */

@XmlAccessorType(XmlAccessType.FIELD)
@XmlType(name = "", propOrder = {"f2pBonusattr"})
@XmlRootElement(name = "f2p_bonus")
public class F2PBonusData {

    @XmlElement(name = "f2p")
    protected List<F2pBonusAttr> f2pBonusattr;

    @XmlTransient
    private TIntObjectHashMap<F2pBonusAttr> templates = new TIntObjectHashMap<F2pBonusAttr>();

    void afterUnmarshal(Unmarshaller u, Object parent) {
        for (F2pBonusAttr template : f2pBonusattr) {
            templates.put(template.getBuffId(), template);
        }
        f2pBonusattr.clear();
        f2pBonusattr = null;
    }

    public int size() {
        return templates.size();
    }

    public F2pBonusAttr getInstanceBonusattr(int buffId) {
        return templates.get(buffId);
    }
}
