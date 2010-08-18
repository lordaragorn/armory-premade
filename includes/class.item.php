<?php

/**
 * Copy existed character directly from Retail WoW Armory to MaNGOS DB
 * @author Shadez
 * @copyright 2010
 */

Class Item {
    private $m_values;
    public  $m_valuesCount;
    private $m_slot;
    private $uState;
    private $owner;
    private $itemGuid;
    private $entry;
    private $pProto = false;
    
    /**
     * Create class
     **/
    public function Item() {
        $this->m_valuesCount = ITEM_END;
        $this->m_slot = -1;
        $this->uState = 'ITEM_NEW';
        $this->InitValues();
        return true;
    }
    
    /**
     * Create item
     * @param int itemID
     * @param int itemGUID
     * @param int itemOwner
     * @param int itemPropId = 0
     **/
    public function Create($itemID, $itemGUID, $itemOwner, $slot, $itemPropId = 0) {
        $this->entry    = (int) $itemID;
        $this->itemGuid = (int) $itemGUID;
        $this->owner    = (int) $itemOwner;
        $this->m_slot   = (int) $slot;
        $itemData = GetWorldDB()->selectRow("SELECT `Flags`, `Duration`, `MaxDurability` FROM `item_template` WHERE `entry`=%d", $this->entry);
        if(!$itemData) {
            GetLog()->writeError('%s : unable to find item #%d', __METHOD__, $this->entry);
            return false;
        }
        for($i = 0; $i < $this->m_valuesCount; $i++) {
            $this->SetUInt32Value($i, 0);
        }
        $this->SetUInt32Value(0, $this->itemGuid);
        $this->SetUInt32Value(1, 1191182336);
        $this->SetUInt32Value(3, $this->entry);
        $this->SetUInt32Value(4, 1065353216);
        $this->SetUInt32Value(ITEM_FIELD_OWNER, $this->owner);
        $this->SetUInt32Value(ITEM_FIELD_CONTAINED, $this->owner);
        $this->SetUInt32Value(ITEM_FIELD_STACK_COUNT, 1);
        $this->SetUInt32Value(ITEM_FIELD_MAXDURABILITY, $itemData['MaxDurability']);
        $this->SetUInt32Value(ITEM_FIELD_DURABILITY, $itemData['MaxDurability']);
        $this->SetUInt32Value(ITEM_FIELD_DURATION, $itemData['Duration']);
        $this->SetUInt32Value(ITEM_FIELD_FLAGS, $itemData['Flags']);
        $this->SetUInt32Value(ITEM_FIELD_RANDOM_PROPERTIES_ID, $itemPropId);
    }
    
    private function InitValues() {
        for($i = 0; $i < $this->m_valuesCount; $i++) {
            $this->SetUInt32Value($i, 0);
        }
    }
    
    /**
     * Set item enchantment
     * @param int id
     **/
    public function SetEnchantment($id) {
        $this->SetUInt32Value(ITEM_FIELD_ENCHANTMENT_1_1+0*3+0, $id);
        $this->SetUInt32Value(ITEM_FIELD_ENCHANTMENT_1_1+0*3+1, 0);
        $this->SetUInt32Value(ITEM_FIELD_ENCHANTMENT_1_1+0*3+2, 0);
    }
    
    public function GetItemFields() {
        return $this->m_values;
    }
    
    /**
     * Set item gem
     * @param int slotId
     * @param int id
     **/
    public function SetGem($slotId, $id) {
        $socketSlots = array(
            0 => ITEM_FIELD_ENCHANTMENT_3_1,
            1 => ITEM_FIELD_ENCHANTMENT_4_1,
            2 => ITEM_FIELD_ENCHANTMENT_5_1
        );
        if(!isset($socketSlots[$slotId])) {
            GetLog()->writeError('%s : unknown socket slot %d', __METHOD__, $slotId);
            return false;
        }
        $this->SetUInt32Value($socketSlots[$slotId], $id);
    }
    
    /**
     * Assign $this->m_values[$index] value to $value
     * @param int index
     * @param int value
     **/
    public function SetUInt32Value($index, $value) {
        $this->m_values[$index] = $value;
    }
    
    /**
     * Returns $this->m_values[$index] value (if exists)
     * @param int index
     **/
    public function GetUInt32Value($index) {
        if(isset($this->m_values[$index])) {
            return $this->m_values[$index];
        }
        return false;
    }
    
    /**
     * Save item to DB
     **/
    public function SaveToDB() {
        if(!$this->IsCorrect()) {
            GetLog()->writeError('%s : class corrupted!', __METHOD__);
            return false;
        }
        // Write to item_instance
        GetCharactersDB()->query("DELETE FROM item_instance WHERE guid = '%u'", $this->itemGuid);
        $sql = "INSERT INTO item_instance (guid,owner_guid,data) VALUES ('" . $this->itemGuid . "', '" . $this->owner ."', '";
        for($i = 0; $i < ITEM_END; $i++) {
            $sql .= $this->GetUInt32Value($i) . ' ';
        }
        $sql .= "')";
        GetCharactersDB()->query($sql);
        return $this->EquipItem();
    }
    
    /**
     * Delete item from DB
     **/
    public function DeleteFromDB() {
        GetCharactersDB()->query("DELETE FROM `item_instance` WHERE `guid`=%d AND `owner_guid`=%d", $this->itemGuid, $this->owner);
        GetCharactersDB()->query("DELETE FROM `character_inventory` WHERE `guid`=%d AND `item`=%d LIMIT 1", $this->owner, $this->itemGuid);
        return true;
    }
    
    private function EquipItem() {
        if(!$this->IsCorrect()) {
            GetLog()->writeError('%s : class corrupted!', __METHOD__);
            return false;
        }
        // Write to character_inventory
        $equip = GetCharactersDB()->query("REPLACE INTO `character_inventory` (`guid`, `bag`, `slot`, `item`, `item_template`) VALUES (%d, 0, %d, %d, %d)", $this->owner, $this->m_slot, $this->itemGuid, $this->entry);
        return $equip;
    }
    
    /**
     * Class checker
     **/
    private function IsCorrect() {
        if(is_array($this->m_values) && $this->m_valuesCount > 0 && $this->itemGuid > 0 && $this->owner > 0 && $this->m_slot >= 0) {
            return true;
        }
        return false;
    }
    
    /**
     * Returns ItemProto class for $this->entry item.
     **/
    public function GetProto() {
        if($this->pProto != false) {
            return $this->pProto;
        }
        elseif(!class_exists('ItemPrototype')) {
            GetLog()->writeError('%s : class ItemProto doesn\'t exists.', __METHOD__);
            return false;
        }
        $this->pProto = new ItemPrototype($this->entry);
        return $this->pProto;
    }
}

?>