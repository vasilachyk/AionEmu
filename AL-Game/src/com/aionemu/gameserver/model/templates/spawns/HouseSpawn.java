package com.aionemu.gameserver.model.templates.spawns;

import javax.xml.bind.annotation.XmlAccessType;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.XmlAttribute;
import javax.xml.bind.annotation.XmlType;

@XmlAccessorType(XmlAccessType.FIELD)
@XmlType(name="HouseSpawn")
public class HouseSpawn
{
    @XmlAttribute(name = "x", required = true)
    protected float x;
	
    @XmlAttribute(name = "y", required = true)
    protected float y;
	
    @XmlAttribute(name = "z", required = true)
    protected float z;
	
    @XmlAttribute(name = "h")
    protected Byte h;
	
    @XmlAttribute(name = "entity_id")
    private int entityId;
	
    @XmlAttribute(name = "type", required = true)
    protected SpawnType type;
	
    public float getX() {
        return x;
    }
	
    public void setX(float value) {
        x = value;
    }
	
    public float getY() {
        return y;
    }
	
    public void setY(float value) {
        y = value;
    }
	
    public float getZ() {
        return z;
	}
	
    public void setZ(float value) {
        z = value;
    }
	
    public byte getH() {
        if (h == null) {
            return 0;
        }
        return h.byteValue();
    }
	
    public void setH(Byte value) {
        h = value;
    }
	
    public SpawnType getType() {
        return type;
    }
	
    public void setType(SpawnType value) {
        type = value;
    }
	
    public int getEntityId() {
        return entityId;
    }
	
    public void setEntityId(int entityId) {
        this.entityId = entityId;
    }
}