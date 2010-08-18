<?php

/**
 * Copy existed character directly from Retail WoW Armory to MaNGOS DB
 * @author Shadez
 * @copyright 2010
 */

define('HIGHGUID_ITEM', 0x4700);
define('HIGHGUID_CONTAINER', 0x4700);
define('HIGHGUID_PLAYER', 0x0000);
define('HIGHGUID_PET', 0xF140);

define('ITEM_FIELD_ENCHANTMENT_3_2', ITEM_FIELD_ENCHANTMENT_3_1+1);
define('ITEM_FIELD_ENCHANTMENT_4_2', ITEM_FIELD_ENCHANTMENT_4_1+1);
define('ITEM_FIELD_ENCHANTMENT_5_2', ITEM_FIELD_ENCHANTMENT_5_1+1);
define('ITEM_FIELD_ENCHANTMENT_6_2', ITEM_FIELD_ENCHANTMENT_6_1+1);

define('MAX_ITEM_PROTO_DAMAGES', 2);

/* Classes */
define('CLASS_WARRIOR', 0x01);
define('CLASS_PALADIN', 0x02);
define('CLASS_HUNTER',  0x03);
define('CLASS_ROGUE',   0x04);
define('CLASS_PRIEST',  0x05);
define('CLASS_DK',      0x06);
define('CLASS_SHAMAN',  0x07);
define('CLASS_MAGE',    0x08);
define('CLASS_WARLOCK', 0x09);
define('CLASS_DRUID',   0x0B);
define('MAX_CLASSES',   0x0C);

/* Races */
define('RACE_HUMAN',    0x01);
define('RACE_ORC',      0x02);
define('RACE_DWARF',    0x03);
define('RACE_NIGHTELF', 0x04);
define('RACE_UNDEAD',   0x05);
define('RACE_TAUREN',   0x06);
define('RACE_GNOME',    0x07);
define('RACE_TROLL',    0x08);
define('RACE_BLOODELF', 0x0A);
define('RACE_DRAENEI',  0x0B);
define('MAX_RACES',     0x0C);

/* Item classes */
define('ITEM_CLASS_CONSUMABLE', 0);
define('ITEM_CLASS_CONTAINER', 1);
define('ITEM_CLASS_WEAPON', 2);
define('ITEM_CLASS_GEM', 3);
define('ITEM_CLASS_ARMOR', 4);
define('ITEM_CLASS_REAGENT', 5);
define('ITEM_CLASS_PROJECTILE', 6);
define('ITEM_CLASS_TRADE_GOODS', 7);
define('ITEM_CLASS_GENERIC', 8);
define('ITEM_CLASS_RECIPE', 9);
define('ITEM_CLASS_MONEY', 10);
define('ITEM_CLASS_QUIVER', 11);
define('ITEM_CLASS_QUEST', 12);
define('ITEM_CLASS_KEY', 13);
define('ITEM_CLASS_PERMANENT', 14);
define('ITEM_CLASS_MISC', 15);
define('ITEM_CLASS_GLYPH', 16);

/* Item subclasses */
define('ITEM_SUBCLASS_CONSUMABLE', 0);
define('ITEM_SUBCLASS_POTION', 1);
define('ITEM_SUBCLASS_ELIXIR', 2);
define('ITEM_SUBCLASS_FLASK', 3);
define('ITEM_SUBCLASS_SCROLL', 4);
define('ITEM_SUBCLASS_FOOD', 5);
define('ITEM_SUBCLASS_ITEM_ENHANCEMENT', 6);
define('ITEM_SUBCLASS_BANDAGE', 7);
define('ITEM_SUBCLASS_CONSUMABLE_OTHER', 8);

/* Item flags */
define('ITEM_FLAGS_BINDED',            0x00000001); // set in game at binding); not set in template
define('ITEM_FLAGS_CONJURED',          0x00000002);
define('ITEM_FLAGS_OPENABLE',          0x00000004);
define('ITEM_FLAGS_WRAPPED',           0x00000008); // conflicts with heroic flag
define('ITEM_FLAGS_HEROIC',            0x00000008); // weird...
define('ITEM_FLAGS_BROKEN',            0x00000010); // appears red icon (like when item durability==0)
define('ITEM_FLAGS_INDESTRUCTIBLE',    0x00000020); // used for totem. Item can not be destroyed); except by using spell (item can be reagent for spell and then allowed)
define('ITEM_FLAGS_USABLE',            0x00000040); // ?
define('ITEM_FLAGS_NO_EQUIP_COOLDOWN', 0x00000080); // ?
define('ITEM_FLAGS_UNK3',              0x00000100); // saw this on item 47115); 49295...
define('ITEM_FLAGS_WRAPPER',           0x00000200); // used or not used wrapper
define('ITEM_FLAGS_IGNORE_BAG_SPACE',  0x00000400); // ignore bag space at new item creation?
define('ITEM_FLAGS_PARTY_LOOT',        0x00000800); // determines if item is party loot or not
define('ITEM_FLAGS_REFUNDABLE',        0x00001000); // item cost can be refunded within 2 hours after purchase
define('ITEM_FLAGS_CHARTER',           0x00002000); // arena/guild charter
define('ITEM_FLAGS_UNK4',              0x00008000); // a lot of items have this
define('ITEM_FLAGS_UNK1',              0x00010000); // a lot of items have this
define('ITEM_FLAGS_PROSPECTABLE',      0x00040000);
define('ITEM_FLAGS_UNIQUE_EQUIPPED',   0x00080000);
define('ITEM_FLAGS_USEABLE_IN_ARENA',  0x00200000);
define('ITEM_FLAGS_THROWABLE',         0x00400000); // not used in game for check trow possibility); only for item in game tooltip
define('ITEM_FLAGS_SPECIALUSE',        0x00800000); // last used flag in 2.3.0
define('ITEM_FLAGS_BOA',               0x08000000); // bind on account (set in template for items that can binded in like way)
define('ITEM_FLAGS_ENCHANT_SCROLL',    0x10000000); // for enchant scrolls
define('ITEM_FLAGS_MILLABLE',          0x20000000);
define('ITEM_FLAGS_BOP_TRADEABLE',     0x80000000);

/* Item mods */
define('ITEM_MOD_MANA', 0);
define('ITEM_MOD_HEALTH', 1);
define('ITEM_MOD_AGILITY', 3);
define('ITEM_MOD_STRENGTH', 4);
define('ITEM_MOD_INTELLECT', 5);
define('ITEM_MOD_SPIRIT', 6);
define('ITEM_MOD_STAMINA', 7);
define('ITEM_MOD_DEFENSE_SKILL_RATING', 12);
define('ITEM_MOD_DODGE_RATING', 13);
define('ITEM_MOD_PARRY_RATING', 14);
define('ITEM_MOD_BLOCK_RATING', 15);
define('ITEM_MOD_HIT_MELEE_RATING', 16);
define('ITEM_MOD_HIT_RANGED_RATING', 17);
define('ITEM_MOD_HIT_SPELL_RATING', 18);
define('ITEM_MOD_CRIT_MELEE_RATING', 19);
define('ITEM_MOD_CRIT_RANGED_RATING', 20);
define('ITEM_MOD_CRIT_SPELL_RATING', 21);
define('ITEM_MOD_HIT_TAKEN_MELEE_RATING', 22);
define('ITEM_MOD_HIT_TAKEN_RANGED_RATING', 23);
define('ITEM_MOD_HIT_TAKEN_SPELL_RATING', 24);
define('ITEM_MOD_CRIT_TAKEN_MELEE_RATING', 25);
define('ITEM_MOD_CRIT_TAKEN_RANGED_RATING', 26);
define('ITEM_MOD_CRIT_TAKEN_SPELL_RATING', 27);
define('ITEM_MOD_HASTE_MELEE_RATING', 28);
define('ITEM_MOD_HASTE_RANGED_RATING', 29);
define('ITEM_MOD_HASTE_SPELL_RATING', 30);
define('ITEM_MOD_HIT_RATING', 31);
define('ITEM_MOD_CRIT_RATING', 32);
define('ITEM_MOD_HIT_TAKEN_RATING', 33);
define('ITEM_MOD_CRIT_TAKEN_RATING', 34);
define('ITEM_MOD_RESILIENCE_RATING', 35);
define('ITEM_MOD_HASTE_RATING', 36);
define('ITEM_MOD_EXPERTISE_RATING', 37);
define('ITEM_MOD_ATTACK_POWER', 38);
define('ITEM_MOD_RANGED_ATTACK_POWER', 39);
define('ITEM_MOD_FERAL_ATTACK_POWER', 40);//deprecated
define('ITEM_MOD_SPELL_HEALING_DONE', 41);//deprecated
define('ITEM_MOD_SPELL_DAMAGE_DONE', 42);//deprecated
define('ITEM_MOD_MANA_REGENERATION', 43);
define('ITEM_MOD_ARMOR_PENETRATION_RATING', 44);
define('ITEM_MOD_SPELL_POWER', 45);
define('ITEM_MOD_HEALTH_REGEN', 46);
define('ITEM_MOD_SPELL_PENETRATION', 47);
define('ITEM_MOD_BLOCK_VALUE', 48);

define('CR_WEAPON_SKILL', 0);
define('CR_DEFENSE_SKILL', 1);
define('CR_DODGE', 2);
define('CR_PARRY', 3);
define('CR_BLOCK', 4);
define('CR_HIT_MELEE', 5);
define('CR_HIT_RANGED', 6);
define('CR_HIT_SPELL', 7);
define('CR_CRIT_MELEE', 8);
define('CR_CRIT_RANGED', 9);
define('CR_CRIT_SPELL', 10);
define('CR_HIT_TAKEN_MELEE', 11);
define('CR_HIT_TAKEN_RANGED', 12);
define('CR_HIT_TAKEN_SPELL', 13);
define('CR_CRIT_TAKEN_MELEE', 14);
define('CR_CRIT_TAKEN_RANGED', 15);
define('CR_CRIT_TAKEN_SPELL', 16);
define('CR_HASTE_MELEE', 17);
define('CR_HASTE_RANGED', 18);
define('CR_HASTE_SPELL', 19);
define('CR_WEAPON_SKILL_MAINHAND', 20);
define('CR_WEAPON_SKILL_OFFHAND', 21);
define('CR_WEAPON_SKILL_RANGED', 22);
define('CR_EXPERTISE', 23);
define('CR_ARMOR_PENETRATION', 24);

define('BASE_ATTACK', 0);
define('OFF_ATTACK', 1);
define('RANGED_ATTACK', 2);

define('ITEM_FIELD_ENCHANTMENT_3_2', ITEM_FIELD_ENCHANTMENT_3_1+1);
define('ITEM_FIELD_ENCHANTMENT_4_2', ITEM_FIELD_ENCHANTMENT_4_1+1);
define('ITEM_FIELD_ENCHANTMENT_5_2', ITEM_FIELD_ENCHANTMENT_5_1+1);
define('ITEM_FIELD_ENCHANTMENT_6_2', ITEM_FIELD_ENCHANTMENT_6_1+1);
?>