<?php

/**
 * Copy existed character directly from Retail WoW Armory to MaNGOS DB
 * @author Shadez
 * @copyright 2010
 * @revision 3
 */

if(!defined('__MANGOS__')) {
    die('Direct access to this file is not allowed!');
}

Class Character {
    private $armory;
    private $realm;
    private $name;
    private $zone;
    private $characterBasicData;
    private $characterAchievementsData;
    private $characterReputationData;
    private $characterStatisticsData;
    private $characterTalentsData;
    private $sqlData = false;
    private $maxItemGuid;
    private $maxCharGuid;
    private $guid;
    private $equipmentCache;
    private $inventory = array();
    private $proto = array();
    private $class;
    private $activeSpec = -1;
    private $accountId;
    private $level;
    
    public function Character($name, $realm, $zone = 'eu', $locale = 'en', $account = 1, $rewrite_character = true) {
        if(!class_exists('phpArmory5')) {
            GetLog()->writeLog('%s : unable to find phpArmory5 class!', __METHOD__);
            return false;
        }
        $this->name = $name;
        $this->realm = $realm;
        $this->zone = $zone;
        $this->accountId = $account; 
        $this->armory = new phpArmory5($this->zone);
        $this->armory->setLocale($locale);
        $this->characterBasicData = $this->armory->getCharacterData($this->name, $this->realm);
        if(!$this->characterBasicData) {
            GetLog()->writeError('%s : unable to get data from Armory for character %s (realm: %s, zone: %s)', __METHOD__, $this->name, $this->realm, $this->zone);
        }
        $achievements_group = array('general', 'quests', 'exploration', 'player vs. player', 'dungeons & raids', 'professions', 'reputation', 'world events', 'feats of strength');
        foreach($achievements_group as $category) {
            $this->characterAchievementsData[$category] = $this->armory->getAchievementData($this->name, $this->realm, $category);
        }
        $this->characterTalentsData = $this->armory->getCharacterPage($this->name, $this->realm, 'talents');
        $this->characterReputationData = $this->armory->getCharacterPage($this->name, $this->realm, 'reputation');
        if($this->guid = GetCharactersDB()->selectCell("SELECT guid FROM characters WHERE name='%s' LIMIT 1", $this->name)) {
            if($rewrite_character == true) {
                $this->DropCharacter();
                $this->PerfomDatabaseCleanup();
                $this->guid = false;
            }
            else {
                $this->name .= '_'.rand(); // All required info were already loaded.
            }
        }
        $this->InitMaxGUIDs();
        $this->HandleInventoryData();
        $this->GenerateEquipmentCache();
        $this->HandleCharacterBasicData();
        $this->HandleAchievementsData();
        $this->HandleCharacterTalentsData();
        //$this->HandleGlyphsData();
        $this->HandleCharacterReputationData();
        $this->HandleCharacterEquipment();
        $this->HandleCharacterProfessionsData();
        return true;
    }
    
    private function DropCharacter() {
        $db = GetCharactersDB();
        $db->query("DELETE FROM characters WHERE guid=%d", $this->guid);
        $db->query("DELETE FROM character_account_data WHERE guid=%d", $this->guid);
        $db->query("DELETE FROM character_achievement WHERE guid=%d", $this->guid);
        $db->query("DELETE FROM character_achievement_progress WHERE guid=%d", $this->guid);
        $db->query("DELETE FROM character_action WHERE guid=%d", $this->guid);
        $db->query("DELETE FROM character_aura WHERE guid=%d", $this->guid);
        $db->query("DELETE FROM character_battleground_data WHERE guid=%d", $this->guid);
        $db->query("DELETE FROM character_battleground_random WHERE guid=%d", $this->guid);
        $db->query("DELETE FROM character_declinedname WHERE guid=%d", $this->guid);
        $db->query("DELETE FROM character_equipmentsets WHERE guid=%d", $this->guid);
        $db->query("DELETE FROM character_gifts WHERE guid=%d", $this->guid);
        $db->query("DELETE FROM character_glyphs WHERE guid=%d", $this->guid);
        $db->query("DELETE FROM character_homebind WHERE guid=%d", $this->guid);
        $db->query("DELETE FROM character_instance WHERE guid=%d", $this->guid);
        $db->query("DELETE FROM character_inventory WHERE guid=%d", $this->guid);
        $db->query("DELETE FROM character_pet WHERE owner=%d", $this->guid);
        $db->query("DELETE FROM character_pet_declinedname WHERE owner=%d", $this->guid);
        $db->query("DELETE FROM character_queststatus WHERE guid=%d", $this->guid);
        $db->query("DELETE FROM character_queststatus_daily WHERE guid=%d", $this->guid);
        $db->query("DELETE FROM character_queststatus_weekly WHERE guid=%d", $this->guid);
        $db->query("DELETE FROM character_reputation WHERE guid=%d", $this->guid);
        $db->query("DELETE FROM character_skills WHERE guid=%d", $this->guid);
        $db->query("DELETE FROM character_social WHERE guid=%d", $this->guid);
        $db->query("DELETE FROM character_spell WHERE guid=%d", $this->guid);
        $db->query("DELETE FROM character_spell_cooldown WHERE guid=%d", $this->guid);
        $db->query("DELETE FROM character_stats WHERE guid=%d", $this->guid);
        $db->query("DELETE FROM character_talent WHERE guid=%d", $this->guid);
        $db->query("DELETE FROM character_ticket WHERE guid=%d", $this->guid);
        $db->query("DELETE FROM corpse WHERE guid=%d", $this->guid);
        $db->query("DELETE FROM group_instance WHERE leaderguid=%d", $this->guid);
        $db->query("DELETE FROM group_member WHERE memberguid=%d", $this->guid);
        $db->query("DELETE FROM groups WHERE leaderguid=%d", $this->guid);
        $db->query("DELETE FROM guild_member WHERE guid=%d", $this->guid);
        $db->query("DELETE FROM item_instance WHERE owner_guid=%d", $this->guid);
        $db->query("DELETE FROM mail WHERE sender=%d", $this->guid);
        $db->query("DELETE FROM mail WHERE receiver=%d", $this->guid);
        $db->query("DELETE FROM mail_items WHERE mail_id NOT IN (SELECT id FROM mail)");
        $db->query("DELETE FROM pet_aura WHERE guid NOT IN (SELECT id FROM character_pet WHERE owner=%d)", $this->guid);
        $db->query("DELETE FROM pet_spell WHERE guid NOT IN (SELECT id FROM character_pet WHERE owner=%d)", $this->guid);
        $db->query("DELETE FROM pet_spell_cooldown WHERE guid NOT IN (SELECT id FROM character_pet)");
        $db->query("DELETE FROM petition WHERE ownerguid=%d", $this->guid);
        $db->query("DELETE FROM petition_sign WHERE playerguid=%d", $this->guid);
    }
    
    private function PerfomDatabaseCleanup() {
        $db = GetCharactersDB();
        $db->query("DELETE FROM character_account_data WHERE guid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM character_achievement WHERE guid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM character_achievement_progress WHERE guid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM character_action WHERE guid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM character_aura WHERE guid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM character_battleground_data WHERE guid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM character_battleground_random WHERE guid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM character_declinedname WHERE guid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM character_equipmentsets WHERE guid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM character_gifts WHERE guid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM character_glyphs WHERE guid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM character_homebind WHERE guid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM character_instance WHERE guid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM character_inventory WHERE guid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM character_pet WHERE owner NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM character_pet_declinedname WHERE owner NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM character_queststatus WHERE guid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM character_queststatus_daily WHERE guid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM character_queststatus_weekly WHERE guid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM character_reputation WHERE guid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM character_skills WHERE guid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM character_social WHERE guid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM character_spell WHERE guid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM character_spell_cooldown WHERE guid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM character_stats WHERE guid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM character_talent WHERE guid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM character_ticket WHERE guid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM corpse WHERE guid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM group_instance WHERE leaderGuid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM group_member WHERE memberGuid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM groups WHERE leaderGuid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM guild_member WHERE guid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM item_instance WHERE owner_guid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM mail WHERE sender NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM mail WHERE receiver NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM mail_items WHERE mail_id NOT IN (SELECT id FROM mail)");
        $db->query("DELETE FROM pet_aura WHERE guid NOT IN (SELECT id FROM character_pet)");
        $db->query("DELETE FROM pet_spell WHERE guid NOT IN (SELECT id FROM character_pet)");
        $db->query("DELETE FROM pet_spell_cooldown WHERE guid NOT IN (SELECT id FROM character_pet)");
        $db->query("DELETE FROM petition WHERE ownerguid NOT IN (SELECT guid FROM characters)");
        $db->query("DELETE FROM petition_sign WHERE playerguid NOT IN (SELECT guid FROM characters)");
    }
    
    public function GetBasicData() {
        return $this->characterBasicData;
    }
    
    public function GetAchievementsData() {
        return $this->characterAchievementsData;
    }
    
    public function GetTalentsData() {
        return $this->characterTalentsData;
    }
    
    public function GetReputationData() {
        return $this->characterReputationData;
    }
    
    public function GetGUID() {
        return $this->guid;
    }
    
    public function GetAccountID() {
        return $this->accountId;
    }
    
    private function HandleCharacterBasicData() {
        if(!$this->characterBasicData || !is_array($this->characterBasicData)) {
            GetLog()->writeError('%s : characterBasicData is not defined or have wrong structure!', __METHOD__);
            return false;
        }
        $character_data = $this->characterBasicData['characterinfo']['character'];
        $this->guid = $this->GetNextCharGUID(true);
        GetCharactersDB()->query("
        REPLACE INTO `characters`
        (`guid`, `name`, `account`, `race`, `class`, `gender`, `level`, `at_login`, `totalKills`, `arenaPoints`, `specCount`, `activeSpec`, `chosenTitle`,
         `health`, `power%d`, `equipmentCache`, `taximask`
        )
        VALUES
        (  %d,    '%s',     %d,        %d,      %d,     %d,       %d,        %d,          %d,           %d,            %d,           %d,          %d,
           %d,        %d,           '%s',          '%s'
        )
        ",
        (in_array($character_data['classid'], array(2, 3, 5, 8, 9, 11))) ? 1 : 2, //powerX
        $this->guid,
        $character_data['name'],
        1,
        $character_data['raceid'],
        $character_data['classid'],
        $character_data['genderid'],
        $character_data['level'],
        0x08,
        $this->characterBasicData['characterinfo']['charactertab']['pvp']['lifetimehonorablekills']['value'],
        $this->characterBasicData['characterinfo']['charactertab']['pvp']['arenacurrency']['value'],
        count($this->characterBasicData['characterinfo']['charactertab']['talentspecs']['talentspec']),
        (isset($this->characterBasicData['characterinfo']['charactertab']['talentspecs']['talentspec'][0]['active'])) ? 0 : 1,
        0,//$character_data['titleid'],
        $this->characterBasicData['characterinfo']['charactertab']['characterbars']['health']['effective'],
        $this->characterBasicData['characterinfo']['charactertab']['characterbars']['secondbar']['effective'],
        $this->equipmentCache,
        ($character_data['factionid'] == 1) ? '2097152 0 0 4 0 0 0 0 0 0 0 0 ' : '2 0 0 8 0 0 0 0 0 0 0 0 ' // HACK!
        );
        $this->activeSpec = (isset($this->characterBasicData['characterinfo']['charactertab']['talentspecs']['talentspec'][0]['active'])) ? 0 : 1;
        $this->class = $character_data['classid'];
        $this->level = $character_data['level'];
        $this->LearnWeaponSpells();
        if($character_data['factionid'] == 1) {
            // Horde
            $this->TeleportTo(1632.255859, -4440.156250, 15.760118, 0, 1, 1637, true);
        }
        else {
            $this->TeleportTo(-8868.124023, 673.902954, 97.903175, 0, 0, 1519, true);
        }
    }
    
    private function GenerateEquipmentCache() {
        for($i = 0; $i < 19; $i++) {
            if(isset($this->inventory[$i])) {
                $this->equipmentCache .= $this->inventory[$i]['itemID'] . ' ' . $this->inventory[$i]['enchID'].' ';
            }
            else {
                $this->equipmentCache .= '0 0 ';
            }
        }
    }
    
    private function HandleInventoryData() {
        if(!$this->characterBasicData) {
            GetLog()->writeError('%s : charactersBasicData not defined!', __METHOD__);
            return false;
        }
        $itemsStore = $this->characterBasicData['characterinfo']['charactertab']['items']['item'];
        if(!is_array($itemsStore)) {
            GetLog()->writeError('%s : item storage must be array (%s given)!', __METHOD__, gettype($itemsStore));
            return false;
        }
        $i = 0;
        foreach($itemsStore as $item) {
            $this->inventory[$i] = array(
                'guid'   => $this->GetNextItemGUID(true),
                'itemID' => $item['id'],
                'enchID' => $item['permanentenchant'],
                'gem0'   => $item['gem0id'],
                'gem1'   => $item['gem1id'],
                'gem2'   => $item['gem2id'],
                'slot'   => $item['slot'], //NOTE: Slot from wowarmory is correct.
                'mCount' => $i
            );
            $i++;
        }
        return true;
    }
    
    private function HandleGlyphsData() {
        if(!$this->characterTalentsData) {
            GetLog()->writeError('%s : characterTalentsData not defined!', __METHOD__);
            return false;
        }
        $glyphsStorage = $this->characterBasicData['characterinfo']['charactertab']['glyphs']['glyph'];
        if(!is_array($glyphsStorage)) {
            GetLog()->writeError('%s : glyphsStorage must be array (%s given)!', __METHOD__, gettype($glyphsStorage));
            return false;
        }
        $spec1_max = 5;
        $spec2_max = 11;
        $mjr = 0;
        $mnr = 0;
        $major_glyph_slots = array(0, 3, 5);
        $minor_glyph_slots = array(1, 2, 4);
        $i = 0;
        foreach($glyphsStorage as $glyph) {
            switch($glyph['type']) {
                case 'major':
                    $slot = $major_glyph_slots[$mjr];
                    $mjr++;
                    break;
                case 'minor':
                    $slot = $minor_glyph_slots[$mnr];
                    $mnr++;
                    break;
            }
            if($i < $spec1_max) {
                $spec = 1;
            }
            elseif($i <= $spec1_max) {
                $spec = 0 ;
            }
            GetCharactersDB()->query("INSERT INTO `character_glyphs` (`guid`, `spec`, `slot`, `glyph`) VALUES (%d, %d, %d, %d)", $this->guid, $this->activeSpec, $slot, $glyph['id']);
            $i++;
        }
        return true;
    }
    
    private function HandleCharacterProfessionsData() {
        if(!$this->characterBasicData) {
            GetLog()->writeError('%s : characterBasicData not defined!', __METHOD__);
        }
        $proffesions = $this->characterBasicData['characterinfo']['charactertab']['professions']['skill'];
        for($i = 0; $i < 2; $i++) {
            if(isset($proffesions[$i])) {
                GetCharactersDB()->query("REPLACE INTO `character_skills` (`guid`, `skill`, `value`, `max`) VALUES (%d, %d, %d, %d)", $this->guid, $proffesions[$i]['id'], $proffesions[$i]['value'], $proffesions[$i]['max']);
            }
        }
        return true;
    }
    
    private function HandleCharacterEquipment() {
        if(!$this->characterBasicData) {
            GetLog()->writeError('%s : characterBasicData not defined!', __METHOD__);
            return false;
        }
        elseif(!$this->inventory) {
            GetLog()->writeError('%s : inventory not defined!', __METHOD__);
            return false;
        }
        foreach($this->inventory as $item) {
            $pItem = $this->GetItem($item['itemID'], $item['guid'], $item['slot'], (isset($item['randompropertiesid'])) ? $item['randompropertiesid'] : 0);
            if(!$pItem) {
                GetLog()->writeLog('%s : unable to get pItem for item #%d (guid: %d; owner:%d)', __METHOD__, $item['itemID'], $item['guid'], $this->guid);
                continue;
            }
            // Set enchantment
            $pItem->SetEnchantment($item['enchID']);
            // Set gems
            for($i = 0; $i < 3; $i++) {
                if($item['gem' . $i] > 0) {
                    $gemProp = GetCharactersDB()->selectCell("SELECT `id` FROM `enchantment_data` WHERE `gem`=%d", $item['gem'.$i]);
                    $pItem->SetGem($i, $gemProp);
                }
            }
            if(!$pItem->SaveToDB()) {
                GetLog()->writeError('%s : item #%d (guid: %d; owner: %d) was not saved to DB!', __METHOD__, $item['guid'], $item['itemID'], $this->guid);
                $pItem->DeleteFromDB(); // Cleanup
            }
            unset($pItem);
        }
        return true;
    }
    
    private function GetItem($item, $iGuid, $slot, $itemPropId) {
        if(!class_exists('Item')) {
            GetLog()->writeError('%s : unable to find class "Item"', __METHOD__);
            return false;
        }
        $pItem = new Item();
        $pItem->Create($item, $iGuid, $this->guid, $slot, $itemPropId);
        if($pItem) {
            return $pItem;
        }
        GetLog()->writeError('%s : unable to create item #%d (GUID: %d, owner GUID: %d)', $item, $iGuid, $this->guid);
        unset($pItem);
        return false;
    }
    
    private function InitMaxGUIDs() {
        $this->maxItemGuid = GetCharactersDB()->selectCell("SELECT MAX(`guid`) FROM `item_instance`");
        $this->maxCharGuid = GetCharactersDB()->selectCell("SELECT MAX(`guid`) FROM `characters`");
        $this->maxCharGuid++;
        $this->maxItemGuid++;
    }
    
    private function GetNextItemGUID($autoUpdate = false) {
        $next = $this->maxItemGuid;
        if($autoUpdate == true) {
            $this->UpdateMaxItemGUID();
            return $next;
        }
        return $next;
    }
    
    private function GetNextCharGUID($autoUpdate = false) {
        $next = $this->maxCharGuid;
        if($autoUpdate == true) {
            $this->UpdateMaxCharGUID();
            return $next;
        }
        return $next;
    }
    
    private function UpdateMaxCharGUID() {
        $this->maxCharGuid++;
    }
    
    private function UpdateMaxItemGUID() {
        $this->maxItemGuid++;
    }
    
    private function LearnSpell($spellID) {
        if(!$this->guid) {
            GetLog()->writeError('%s : guid not defined, ignore.', __METHOD__);
            return false;
        }
        GetCharactersDB()->query("REPLACE INTO `character_spell` VALUES (%d,%d,1,0)", $this->guid, (int) $spellID);
    }
    
    private function LearnSkill($skillId, $value, $maxSkillForLevel = false) {
        if(!$this->guid) {
            GetLog()->writeError('%s : guid not defined, ignore.', __METHOD__);
            return false;
        }
        GetCharactersDB()->query("INSERT INTO character_skills VALUES (%d,%d,%d,450)", $this->guid, $skillId, $value);
    }
    
    private function HandleAchievementsData() {
        if(!$this->characterAchievementsData) {
            GetLog()->writeError('%s : characterAchievementsData not defined!', __METHOD__);
            return false;
        }
        GetCharactersDB()->query("DELETE FROM `character_achievement` WHERE `guid`=%d", $this->guid);
        $achievementsStorage = $this->characterAchievementsData;
        foreach($achievementsStorage as $cat_name => $category) {
            GetLog()->writeLog('%s : handle %s category.', __METHOD__, $cat_name);
            $currentCat = $category['category']['achievement'];
            if(!is_array($currentCat)) {
                continue;
            }
            foreach($currentCat as $key => $ach) {
                if($key == 'achievement' || $key == 'category') {
                    // Parent
                    foreach($ach as $row => $m_ach) {
                        if(!is_numeric($row) || $row == 'criteria') {
                            continue;
                        }
                        elseif($row == 'achievement') {
                            foreach($m_ach as $row_a => $ach_a) {
                                if(isset($ach_a['datecompleted']) && $ach_a['datecompleted'] != null) {
                                    GetCharactersDB()->query("INSERT INTO `character_achievement` (`guid`, `date`, `achievement`) VALUES (%d, %d, %d)", $this->guid, strtotime($ach_a['datecompleted']), $ach_a['id']);
                                }
                            }
                        }
                        elseif($row == 'category' && isset($m_ach['achievement'])) {
                            foreach($m_ach['achievement'] as $row_a => $ach_a) {
                                if(isset($ach_a['datecompleted']) && $ach_a['datecompleted'] != null) {
                                    GetCharactersDB()->query("INSERT INTO `character_achievement` (`guid`, `date`, `achievement`) VALUES (%d, %d, %d)", $this->guid, strtotime($ach_a['datecompleted']), $ach_a['id']);
                                }
                            }
                        }
                        if(isset($m_ach['datecompleted']) && $m_ach['datecompleted'] != null) {
                            GetCharactersDB()->query("INSERT INTO `character_achievement` (`guid`, `date`, `achievement`) VALUES (%d, %d, %d)", $this->guid, strtotime($m_ach['datecompleted']), $m_ach['id']);
                        }
                    }
                }
                if(isset($ach['datecompleted']) && $ach['datecompleted'] != null) {
                    GetCharactersDB()->query("INSERT INTO `character_achievement` (`guid`, `date`, `achievement`) VALUES (%d, %d, %d)", $this->guid, strtotime($ach['datecompleted']), $ach['id']);
                }
            }
        }
        return true;
    }
    
    private function HandleCharacterTalentsData() {
        if(!$this->characterTalentsData) {
            GetLog()->writeError('%s : characterTalentsData not defined!', __METHOD__);
            return false;
        }
        $talentsStorage = $this->characterTalentsData['talents']['talentgroup'];
        $specsStorage = $talentsStorage['talentspec'];
        $value1 = $specsStorage[0];
        $value2 = (isset($specsStorage[1]['value'])) ? $specsStorage[1] : null;
        $talent_tab = $this->GetTalentTab($this->class);
        $class_talents = GetCharactersDB()->select("SELECT `TalentID` FROM `premade_talents` WHERE `TalentTab` IN (%s) ORDER BY `TalentTab`, `Row`, `Col`", $talent_tab);
        if(!is_array($talent_tab)) {
            GetLog()->writeError('%s : talent_tab must be array (%s given, wrong class ID?)!', __METHOD__, gettype($talent_tab));
            return false;
        }
        if(!is_array($class_talents)) {
            GetLog()->writeError('%s : unable to get class_talents from `premade_talents` table!', __METHOD__);
            return false;
        }
        GetCharactersDB()->query("DELETE FROM `character_talent` WHERE `guid`=%d", $this->guid);
        $tStorage = array();
        foreach($class_talents as $m_talent) {
            $tStorage[] = array('talent_id' => $m_talent['TalentID']);
        }
        for($spec = 1; $spec < 3; $spec++) {
            $current = ${'value'.$spec}['value'];
            if($current == null) {
                continue;
            }
            $length = strlen($current);
            for($start = 0; $start < $length; $start++) {
                $rank = substr($current, $start, 1);
                if(isset($tStorage[$start]) && $rank != 0) {
                    GetCharactersDB()->query("INSERT INTO `character_talent` (`guid`, `talent_id`, `current_rank`, `spec`) VALUES (%d, %d, %d, %d)", $this->guid, $tStorage[$start]['talent_id'], $rank-1, $spec-1);
                }
            }
        }
    }
    
    private function HandleCharacterReputationData() {
        if(!$this->characterReputationData) {
            GetLog()->writeError('%s : characterReputationData is not defined!');
            return false;
        }
        $reputationStorage = $this->characterReputationData['reputationtab']['faction']['faction'];
        GetCharactersDB()->query("DELETE FROM `character_reputation` WHERE `guid`=%d", $this->guid);
        foreach($reputationStorage as $key => $rep) {
            if(is_array($rep) && isset($rep['reputation'])) {
                GetCharactersDB()->query("INSERT INTO `character_reputation` (`guid`, `faction`, `standing`, `flags`) VALUES (%d, %d, %d, 1)", $this->guid, $rep['id'], $rep['reputation']);
            }
            elseif(is_array($rep) && isset($rep[0]) && $key == 'faction') {
                foreach($rep as $s_key => $s_rep) {
                    if(is_array($s_rep) && isset($s_rep['reputation'])) {
                        GetCharactersDB()->query("INSERT INTO `character_reputation` (`guid`, `faction`, `standing`, `flags`) VALUES (%d, %d, %d, 1)", $this->guid, $s_rep['id'], $s_rep['reputation']);
                    }
                }
            }
        }
        return true;
    }
    
    private function GetTalentTab($class, $tab_count = -1) {
        $talentTabId = array(
            1 => array(161,164,163), // Warior
            2 => array(382,383,381), // Paladin
            3 => array(361,363,362), // Hunter
            4 => array(182,181,183), // Rogue
            5 => array(201,202,203), // Priest
            6 => array(398,399,400), // Death Knight
            7 => array(261,263,262), // Shaman
            8 => array( 81, 41, 61), // Mage
            9 => array(302,303,301), // Warlock
            11=> array(283,281,282), // Druid
        );
        if(!isset($talentTabId[$class])) {
            return false;
        }
        $tab_class = $talentTabId[$class];
        if($tab_count >= 0) {
            $values = array_values($tab_class);
            return $values[$tab_count];
        }
        return $tab_class;
    }
    
    /*
    private function InitTaxiNodesForLevel() {
        if($this->class == CLASS_DK) {
            for($i = 0; $i < 12; $i++) {
                
            }
        }
    }
    */
    
    private function LearnWeaponSpells() {
        switch($this->class) {
            case CLASS_WARRIOR:
                $allowed_weapon_spells = array(
                    264, //Bows
                    5011, //Crossbows
                    1180, //Daggers
                    15590, //Fist weapons
                    266, //Guns
                    196, //One-handed axes
                    198, //One-handed maces
                    201, //One-handed swords
                    200, //Polearms
                    227, //Staves
                    2567, //Thrown
                    197, //Two-handed axes
                    199, //Two-handed maces
                    202, //Tow-handed swords
                );
                if($this->level >= 40) {
                    $allowed_weapon_spells[] = 750; // Plate
                }
                break;
            case CLASS_PALADIN:
                $allowed_weapon_spells = array(
                    196, //One-handed axes
                    198, //One-handed maces
                    201, //One-handed swords
                    200, //Polearms
                    197, //Two-handed axes
                    199, //Two-handed maces
                    202, //Tow-handed swords
                );
                if($this->level >= 40) {
                    $allowed_weapon_spells[] = 750; // Plate
                }
                break;
            case CLASS_HUNTER:
                $allowed_weapon_spells = array(
                    264, //Bows
                    5011, //Crossbows
                    1180, //Daggers
                    15590, //Fist weapons
                    266, //Guns
                    196, //One-handed axes
                    201, //One-handed swords
                    200, //Polearms
                    227, //Staves
                    2567, //Thrown
                    197, //Two-handed axes
                    202, //Tow-handed swords
                );
                if($this->level >= 40) {
                    $allowed_weapon_spells[] = 8737; // Mail
                }
                break;
            case CLASS_ROGUE:
                $allowed_weapon_spells = array(
                    264, //Bows
                    5011, //Crossbows
                    1180, //Daggers
                    15590, //Fist weapons
                    266, //Guns
                    196, //One-handed axes
                    201, //One-handed swords
                    2567, //Thrown
                );
                break;
            case CLASS_PRIEST:
                $allowed_weapon_spells = array(
                    1180, //Daggers
                    199, //Two-handed maces
                    227, //Staves
                    5009, //Wands
                );
                break;
            case CLASS_DK:
                $allowed_weapon_spells = array(
                    196, //One-handed axes
                    198, //One-handed maces
                    201, //One-handed swords
                    200, //Polearms
                    197, //Two-handed axes
                    199, //Two-handed maces
                    202, //Tow-handed swords
                );
                break;
            case CLASS_SHAMAN:
                $allowed_weapon_spells = array(
                    1180, //Daggers
                    15590, //Fist weapons
                    196, //One-handed axes
                    198, //One-handed maces
                    227, //Staves
                    197, //Two-handed axes
                    199, //Two-handed maces
                );
                if($this->level >= 40) {
                    $allowed_weapon_spells[] = 8737; // Mail
                }
                break;
            case CLASS_MAGE:
            case CLASS_WARLOCK:
                $allowed_weapon_spells = array(
                    1180, //Daggers
                    201, //One-handed swords
                    227, //Staves
                    5009, //Wands
                );
                break;
            case CLASS_DRUID:
                $allowed_weapon_spells = array(
                    1180, //Daggers
                    15590, //Fist weapons
                    198, //One-handed maces
                    200, //Polearms
                    227, //Staves
                    199, //Two-handed maces
                );
                break;
            default:
                GetLog()->writeError('%s : wrong class ID: %d', __METHOD__, $this->class);
                return false;
                break;
        }
        if(!isset($allowed_weapon_spells) || !is_array($allowed_weapon_spells)) {
            GetLog()->writeError('%s : allowed_weapon_spells does not exists or have wrong type!', __METHOD__);
            return false;
        }
        foreach($allowed_weapon_spells as $spell) {
            $this->LearnSpell($spell);
        }
        return true;
    }
    
    private function TeleportTo($x, $y, $z, $orientation, $map, $zone, $isNewHomebind = false) {
        if(!$this->guid) {
            return false;
        }
        GetCharactersDB()->query("UPDATE `characters` SET `position_x`=%d, `position_y`=%d, `position_z`=%d, `orientation`=%d, `map`=%d, `zone`=%d WHERE `guid`=%d", $x, $y, $z, $orientation, $map, $zone, $this->guid);
        if($isNewHomebind == true) {
            GetCharactersDB()->query("REPLACE INTO `character_homebind` VALUES (%d, %d, %d, %d, %d, %d)", $this->guid, $map, $zone, $x, $y, $z);
        }
    }
}

?>