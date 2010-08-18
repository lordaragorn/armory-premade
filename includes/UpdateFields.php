<?php
// Converted from MaNGOS GIT repository
// Auto generated for version 3.3.5.12340
define('OBJECT_FIELD_GUID', 0x0000);
define('OBJECT_FIELD_TYPE', 0x0002);
define('OBJECT_FIELD_ENTRY', 0x0003);
define('OBJECT_FIELD_SCALE_X', 0x0004);
define('OBJECT_FIELD_PADDING', 0x0005);
define('OBJECT_END', 0x0006);

define('ITEM_FIELD_OWNER', OBJECT_END+0x0000);
define('ITEM_FIELD_CONTAINED', OBJECT_END+0x0002);
define('ITEM_FIELD_CREATOR', OBJECT_END+0x0004);
define('ITEM_FIELD_GIFTCREATOR', OBJECT_END+0x0006);
define('ITEM_FIELD_STACK_COUNT', OBJECT_END+0x0008);
define('ITEM_FIELD_DURATION', OBJECT_END+0x0009);
define('ITEM_FIELD_SPELL_CHARGES', OBJECT_END+0x000A);
define('ITEM_FIELD_FLAGS', OBJECT_END+0x000F);
define('ITEM_FIELD_ENCHANTMENT_1_1', OBJECT_END+0x0010);
define('ITEM_FIELD_ENCHANTMENT_1_3', OBJECT_END+0x0012);
define('ITEM_FIELD_ENCHANTMENT_2_1', OBJECT_END+0x0013);
define('ITEM_FIELD_ENCHANTMENT_2_3', OBJECT_END+0x0015);
define('ITEM_FIELD_ENCHANTMENT_3_1', OBJECT_END+0x0016);
define('ITEM_FIELD_ENCHANTMENT_3_3', OBJECT_END+0x0018);
define('ITEM_FIELD_ENCHANTMENT_4_1', OBJECT_END+0x0019);
define('ITEM_FIELD_ENCHANTMENT_4_3', OBJECT_END+0x001B);
define('ITEM_FIELD_ENCHANTMENT_5_1', OBJECT_END+0x001C);
define('ITEM_FIELD_ENCHANTMENT_5_3', OBJECT_END+0x001E);
define('ITEM_FIELD_ENCHANTMENT_6_1', OBJECT_END+0x001F);
define('ITEM_FIELD_ENCHANTMENT_6_3', OBJECT_END+0x0021);
define('ITEM_FIELD_ENCHANTMENT_7_1', OBJECT_END+0x0022);
define('ITEM_FIELD_ENCHANTMENT_7_3', OBJECT_END+0x0024);
define('ITEM_FIELD_ENCHANTMENT_8_1', OBJECT_END+0x0025);
define('ITEM_FIELD_ENCHANTMENT_8_3', OBJECT_END+0x0027);
define('ITEM_FIELD_ENCHANTMENT_9_1', OBJECT_END+0x0028);
define('ITEM_FIELD_ENCHANTMENT_9_3', OBJECT_END+0x002A);
define('ITEM_FIELD_ENCHANTMENT_10_1', OBJECT_END+0x002B);
define('ITEM_FIELD_ENCHANTMENT_10_3', OBJECT_END+0x002D);
define('ITEM_FIELD_ENCHANTMENT_11_1', OBJECT_END+0x002E);
define('ITEM_FIELD_ENCHANTMENT_11_3', OBJECT_END+0x0030);
define('ITEM_FIELD_ENCHANTMENT_12_1', OBJECT_END+0x0031);
define('ITEM_FIELD_ENCHANTMENT_12_3', OBJECT_END+0x0033);
define('ITEM_FIELD_PROPERTY_SEED', OBJECT_END+0x0034);
define('ITEM_FIELD_RANDOM_PROPERTIES_ID', OBJECT_END+0x0035);
define('ITEM_FIELD_DURABILITY', OBJECT_END+0x0036);
define('ITEM_FIELD_MAXDURABILITY', OBJECT_END+0x0037);
define('ITEM_FIELD_CREATE_PLAYED_TIME', OBJECT_END+0x0038);
define('ITEM_FIELD_PAD', OBJECT_END+0x0039);
define('ITEM_END', OBJECT_END+0x003A);

define('CONTAINER_FIELD_NUM_SLOTS', ITEM_END+0x0000);
define('CONTAINER_ALIGN_PAD', ITEM_END+0x0001);
define('CONTAINER_FIELD_SLOT_1', ITEM_END+0x0002);
define('CONTAINER_END', ITEM_END+0x004A);

define('UNIT_FIELD_CHARM', OBJECT_END+0x0000);
define('UNIT_FIELD_SUMMON', OBJECT_END+0x0002);
define('UNIT_FIELD_CRITTER', OBJECT_END+0x0004);
define('UNIT_FIELD_CHARMEDBY', OBJECT_END+0x0006);
define('UNIT_FIELD_SUMMONEDBY', OBJECT_END+0x0008);
define('UNIT_FIELD_CREATEDBY', OBJECT_END+0x000A);
define('UNIT_FIELD_TARGET', OBJECT_END+0x000C);
define('UNIT_FIELD_CHANNEL_OBJECT', OBJECT_END+0x000E);
define('UNIT_CHANNEL_SPELL', OBJECT_END+0x0010);
define('UNIT_FIELD_BYTES_0', OBJECT_END+0x0011);
define('UNIT_FIELD_HEALTH', OBJECT_END+0x0012);
define('UNIT_FIELD_POWER1', OBJECT_END+0x0013);
define('UNIT_FIELD_POWER2', OBJECT_END+0x0014);
define('UNIT_FIELD_POWER3', OBJECT_END+0x0015);
define('UNIT_FIELD_POWER4', OBJECT_END+0x0016);
define('UNIT_FIELD_POWER5', OBJECT_END+0x0017);
define('UNIT_FIELD_POWER6', OBJECT_END+0x0018);
define('UNIT_FIELD_POWER7', OBJECT_END+0x0019);
define('UNIT_FIELD_MAXHEALTH', OBJECT_END+0x001A);
define('UNIT_FIELD_MAXPOWER1', OBJECT_END+0x001B);
define('UNIT_FIELD_MAXPOWER2', OBJECT_END+0x001C);
define('UNIT_FIELD_MAXPOWER3', OBJECT_END+0x001D);
define('UNIT_FIELD_MAXPOWER4', OBJECT_END+0x001E);
define('UNIT_FIELD_MAXPOWER5', OBJECT_END+0x001F);
define('UNIT_FIELD_MAXPOWER6', OBJECT_END+0x0020);
define('UNIT_FIELD_MAXPOWER7', OBJECT_END+0x0021);
define('UNIT_FIELD_POWER_REGEN_FLAT_MODIFIER', OBJECT_END+0x0022);
define('UNIT_FIELD_POWER_REGEN_INTERRUPTED_FLAT_MODIFIER', OBJECT_END+0x0029);
define('UNIT_FIELD_LEVEL', OBJECT_END+0x0030);
define('UNIT_FIELD_FACTIONTEMPLATE', OBJECT_END+0x0031);
define('UNIT_VIRTUAL_ITEM_SLOT_ID', OBJECT_END+0x0032);
define('UNIT_FIELD_FLAGS', OBJECT_END+0x0035);
define('UNIT_FIELD_FLAGS_2', OBJECT_END+0x0036);
define('UNIT_FIELD_AURASTATE', OBJECT_END+0x0037);
define('UNIT_FIELD_BASEATTACKTIME', OBJECT_END+0x0038);
define('UNIT_FIELD_RANGEDATTACKTIME', OBJECT_END+0x003A);
define('UNIT_FIELD_BOUNDINGRADIUS', OBJECT_END+0x003B);
define('UNIT_FIELD_COMBATREACH', OBJECT_END+0x003C);
define('UNIT_FIELD_DISPLAYID', OBJECT_END+0x003D);
define('UNIT_FIELD_NATIVEDISPLAYID', OBJECT_END+0x003E);
define('UNIT_FIELD_MOUNTDISPLAYID', OBJECT_END+0x003F);
define('UNIT_FIELD_MINDAMAGE', OBJECT_END+0x0040);
define('UNIT_FIELD_MAXDAMAGE', OBJECT_END+0x0041);
define('UNIT_FIELD_MINOFFHANDDAMAGE', OBJECT_END+0x0042);
define('UNIT_FIELD_MAXOFFHANDDAMAGE', OBJECT_END+0x0043);
define('UNIT_FIELD_BYTES_1', OBJECT_END+0x0044);
define('UNIT_FIELD_PETNUMBER', OBJECT_END+0x0045);
define('UNIT_FIELD_PET_NAME_TIMESTAMP', OBJECT_END+0x0046);
define('UNIT_FIELD_PETEXPERIENCE', OBJECT_END+0x0047);
define('UNIT_FIELD_PETNEXTLEVELEXP', OBJECT_END+0x0048);
define('UNIT_DYNAMIC_FLAGS', OBJECT_END+0x0049);
define('UNIT_MOD_CAST_SPEED', OBJECT_END+0x004A);
define('UNIT_CREATED_BY_SPELL', OBJECT_END+0x004B);
define('UNIT_NPC_FLAGS', OBJECT_END+0x004C);
define('UNIT_NPC_EMOTESTATE', OBJECT_END+0x004D);
define('UNIT_FIELD_STAT0', OBJECT_END+0x004E);
define('UNIT_FIELD_STAT1', OBJECT_END+0x004F);
define('UNIT_FIELD_STAT2', OBJECT_END+0x0050);
define('UNIT_FIELD_STAT3', OBJECT_END+0x0051);
define('UNIT_FIELD_STAT4', OBJECT_END+0x0052);
define('UNIT_FIELD_POSSTAT0', OBJECT_END+0x0053);
define('UNIT_FIELD_POSSTAT1', OBJECT_END+0x0054);
define('UNIT_FIELD_POSSTAT2', OBJECT_END+0x0055);
define('UNIT_FIELD_POSSTAT3', OBJECT_END+0x0056);
define('UNIT_FIELD_POSSTAT4', OBJECT_END+0x0057);
define('UNIT_FIELD_NEGSTAT0', OBJECT_END+0x0058);
define('UNIT_FIELD_NEGSTAT1', OBJECT_END+0x0059);
define('UNIT_FIELD_NEGSTAT2', OBJECT_END+0x005A);
define('UNIT_FIELD_NEGSTAT3', OBJECT_END+0x005B);
define('UNIT_FIELD_NEGSTAT4', OBJECT_END+0x005C);
define('UNIT_FIELD_RESISTANCES', OBJECT_END+0x005D);
define('UNIT_FIELD_RESISTANCEBUFFMODSPOSITIVE', OBJECT_END+0x0064);
define('UNIT_FIELD_RESISTANCEBUFFMODSNEGATIVE', OBJECT_END+0x006B);
define('UNIT_FIELD_BASE_MANA', OBJECT_END+0x0072);
define('UNIT_FIELD_BASE_HEALTH', OBJECT_END+0x0073);
define('UNIT_FIELD_BYTES_2', OBJECT_END+0x0074);
define('UNIT_FIELD_ATTACK_POWER', OBJECT_END+0x0075);
define('UNIT_FIELD_ATTACK_POWER_MODS', OBJECT_END+0x0076);
define('UNIT_FIELD_ATTACK_POWER_MULTIPLIER', OBJECT_END+0x0077);
define('UNIT_FIELD_RANGED_ATTACK_POWER', OBJECT_END+0x0078);
define('UNIT_FIELD_RANGED_ATTACK_POWER_MODS', OBJECT_END+0x0079);
define('UNIT_FIELD_RANGED_ATTACK_POWER_MULTIPLIER', OBJECT_END+0x007A);
define('UNIT_FIELD_MINRANGEDDAMAGE', OBJECT_END+0x007B);
define('UNIT_FIELD_MAXRANGEDDAMAGE', OBJECT_END+0x007C);
define('UNIT_FIELD_POWER_COST_MODIFIER', OBJECT_END+0x007D);
define('UNIT_FIELD_POWER_COST_MULTIPLIER', OBJECT_END+0x0084);
define('UNIT_FIELD_MAXHEALTHMODIFIER', OBJECT_END+0x008B);
define('UNIT_FIELD_HOVERHEIGHT', OBJECT_END+0x008C);
define('UNIT_FIELD_PADDING', OBJECT_END+0x008D);
define('UNIT_END', OBJECT_END+0x008E);

define('PLAYER_DUEL_ARBITER', UNIT_END+0x0000);
define('PLAYER_FLAGS', UNIT_END+0x0002);
define('PLAYER_GUILDID', UNIT_END+0x0003);
define('PLAYER_GUILDRANK', UNIT_END+0x0004);
define('PLAYER_BYTES', UNIT_END+0x0005);
define('PLAYER_BYTES_2', UNIT_END+0x0006);
define('PLAYER_BYTES_3', UNIT_END+0x0007);
define('PLAYER_DUEL_TEAM', UNIT_END+0x0008);
define('PLAYER_GUILD_TIMESTAMP', UNIT_END+0x0009);
define('PLAYER_QUEST_LOG_1_1', UNIT_END+0x000A);
define('PLAYER_QUEST_LOG_1_2', UNIT_END+0x000B);
define('PLAYER_QUEST_LOG_1_3', UNIT_END+0x000C);
define('PLAYER_QUEST_LOG_1_4', UNIT_END+0x000E);
define('PLAYER_QUEST_LOG_2_1', UNIT_END+0x000F);
define('PLAYER_QUEST_LOG_2_2', UNIT_END+0x0010);
define('PLAYER_QUEST_LOG_2_3', UNIT_END+0x0011);
define('PLAYER_QUEST_LOG_2_5', UNIT_END+0x0013);
define('PLAYER_QUEST_LOG_3_1', UNIT_END+0x0014);
define('PLAYER_QUEST_LOG_3_2', UNIT_END+0x0015);
define('PLAYER_QUEST_LOG_3_3', UNIT_END+0x0016);
define('PLAYER_QUEST_LOG_3_5', UNIT_END+0x0018);
define('PLAYER_QUEST_LOG_4_1', UNIT_END+0x0019);
define('PLAYER_QUEST_LOG_4_2', UNIT_END+0x001A);
define('PLAYER_QUEST_LOG_4_3', UNIT_END+0x001B);
define('PLAYER_QUEST_LOG_4_5', UNIT_END+0x001D);
define('PLAYER_QUEST_LOG_5_1', UNIT_END+0x001E);
define('PLAYER_QUEST_LOG_5_2', UNIT_END+0x001F);
define('PLAYER_QUEST_LOG_5_3', UNIT_END+0x0020);
define('PLAYER_QUEST_LOG_5_5', UNIT_END+0x0022);
define('PLAYER_QUEST_LOG_6_1', UNIT_END+0x0023);
define('PLAYER_QUEST_LOG_6_2', UNIT_END+0x0024);
define('PLAYER_QUEST_LOG_6_3', UNIT_END+0x0025);
define('PLAYER_QUEST_LOG_6_5', UNIT_END+0x0027);
define('PLAYER_QUEST_LOG_7_1', UNIT_END+0x0028);
define('PLAYER_QUEST_LOG_7_2', UNIT_END+0x0029);
define('PLAYER_QUEST_LOG_7_3', UNIT_END+0x002A);
define('PLAYER_QUEST_LOG_7_5', UNIT_END+0x002C);
define('PLAYER_QUEST_LOG_8_1', UNIT_END+0x002D);
define('PLAYER_QUEST_LOG_8_2', UNIT_END+0x002E);
define('PLAYER_QUEST_LOG_8_3', UNIT_END+0x002F);
define('PLAYER_QUEST_LOG_8_5', UNIT_END+0x0031);
define('PLAYER_QUEST_LOG_9_1', UNIT_END+0x0032);
define('PLAYER_QUEST_LOG_9_2', UNIT_END+0x0033);
define('PLAYER_QUEST_LOG_9_3', UNIT_END+0x0034);
define('PLAYER_QUEST_LOG_9_5', UNIT_END+0x0036);
define('PLAYER_QUEST_LOG_10_1', UNIT_END+0x0037);
define('PLAYER_QUEST_LOG_10_2', UNIT_END+0x0038);
define('PLAYER_QUEST_LOG_10_3', UNIT_END+0x0039);
define('PLAYER_QUEST_LOG_10_5', UNIT_END+0x003B);
define('PLAYER_QUEST_LOG_11_1', UNIT_END+0x003C);
define('PLAYER_QUEST_LOG_11_2', UNIT_END+0x003D);
define('PLAYER_QUEST_LOG_11_3', UNIT_END+0x003E);
define('PLAYER_QUEST_LOG_11_5', UNIT_END+0x0040);
define('PLAYER_QUEST_LOG_12_1', UNIT_END+0x0041);
define('PLAYER_QUEST_LOG_12_2', UNIT_END+0x0042);
define('PLAYER_QUEST_LOG_12_3', UNIT_END+0x0043);
define('PLAYER_QUEST_LOG_12_5', UNIT_END+0x0045);
define('PLAYER_QUEST_LOG_13_1', UNIT_END+0x0046);
define('PLAYER_QUEST_LOG_13_2', UNIT_END+0x0047);
define('PLAYER_QUEST_LOG_13_3', UNIT_END+0x0048);
define('PLAYER_QUEST_LOG_13_5', UNIT_END+0x004A);
define('PLAYER_QUEST_LOG_14_1', UNIT_END+0x004B);
define('PLAYER_QUEST_LOG_14_2', UNIT_END+0x004C);
define('PLAYER_QUEST_LOG_14_3', UNIT_END+0x004D);
define('PLAYER_QUEST_LOG_14_5', UNIT_END+0x004F);
define('PLAYER_QUEST_LOG_15_1', UNIT_END+0x0050);
define('PLAYER_QUEST_LOG_15_2', UNIT_END+0x0051);
define('PLAYER_QUEST_LOG_15_3', UNIT_END+0x0052);
define('PLAYER_QUEST_LOG_15_5', UNIT_END+0x0054);
define('PLAYER_QUEST_LOG_16_1', UNIT_END+0x0055);
define('PLAYER_QUEST_LOG_16_2', UNIT_END+0x0056);
define('PLAYER_QUEST_LOG_16_3', UNIT_END+0x0057);
define('PLAYER_QUEST_LOG_16_5', UNIT_END+0x0059);
define('PLAYER_QUEST_LOG_17_1', UNIT_END+0x005A);
define('PLAYER_QUEST_LOG_17_2', UNIT_END+0x005B);
define('PLAYER_QUEST_LOG_17_3', UNIT_END+0x005C);
define('PLAYER_QUEST_LOG_17_5', UNIT_END+0x005E);
define('PLAYER_QUEST_LOG_18_1', UNIT_END+0x005F);
define('PLAYER_QUEST_LOG_18_2', UNIT_END+0x0060);
define('PLAYER_QUEST_LOG_18_3', UNIT_END+0x0061);
define('PLAYER_QUEST_LOG_18_5', UNIT_END+0x0063);
define('PLAYER_QUEST_LOG_19_1', UNIT_END+0x0064);
define('PLAYER_QUEST_LOG_19_2', UNIT_END+0x0065);
define('PLAYER_QUEST_LOG_19_3', UNIT_END+0x0066);
define('PLAYER_QUEST_LOG_19_5', UNIT_END+0x0068);
define('PLAYER_QUEST_LOG_20_1', UNIT_END+0x0069);
define('PLAYER_QUEST_LOG_20_2', UNIT_END+0x006A);
define('PLAYER_QUEST_LOG_20_3', UNIT_END+0x006B);
define('PLAYER_QUEST_LOG_20_5', UNIT_END+0x006D);
define('PLAYER_QUEST_LOG_21_1', UNIT_END+0x006E);
define('PLAYER_QUEST_LOG_21_2', UNIT_END+0x006F);
define('PLAYER_QUEST_LOG_21_3', UNIT_END+0x0070);
define('PLAYER_QUEST_LOG_21_5', UNIT_END+0x0072);
define('PLAYER_QUEST_LOG_22_1', UNIT_END+0x0073);
define('PLAYER_QUEST_LOG_22_2', UNIT_END+0x0074);
define('PLAYER_QUEST_LOG_22_3', UNIT_END+0x0075);
define('PLAYER_QUEST_LOG_22_5', UNIT_END+0x0077);
define('PLAYER_QUEST_LOG_23_1', UNIT_END+0x0078);
define('PLAYER_QUEST_LOG_23_2', UNIT_END+0x0079);
define('PLAYER_QUEST_LOG_23_3', UNIT_END+0x007A);
define('PLAYER_QUEST_LOG_23_5', UNIT_END+0x007C);
define('PLAYER_QUEST_LOG_24_1', UNIT_END+0x007D);
define('PLAYER_QUEST_LOG_24_2', UNIT_END+0x007E);
define('PLAYER_QUEST_LOG_24_3', UNIT_END+0x007F);
define('PLAYER_QUEST_LOG_24_5', UNIT_END+0x0081);
define('PLAYER_QUEST_LOG_25_1', UNIT_END+0x0082);
define('PLAYER_QUEST_LOG_25_2', UNIT_END+0x0083);
define('PLAYER_QUEST_LOG_25_3', UNIT_END+0x0084);
define('PLAYER_QUEST_LOG_25_5', UNIT_END+0x0086);
define('PLAYER_VISIBLE_ITEM_1_ENTRYID', UNIT_END+0x0087);
define('PLAYER_VISIBLE_ITEM_1_ENCHANTMENT', UNIT_END+0x0088);
define('PLAYER_VISIBLE_ITEM_2_ENTRYID', UNIT_END+0x0089);
define('PLAYER_VISIBLE_ITEM_2_ENCHANTMENT', UNIT_END+0x008A);
define('PLAYER_VISIBLE_ITEM_3_ENTRYID', UNIT_END+0x008B);
define('PLAYER_VISIBLE_ITEM_3_ENCHANTMENT', UNIT_END+0x008C);
define('PLAYER_VISIBLE_ITEM_4_ENTRYID', UNIT_END+0x008D);
define('PLAYER_VISIBLE_ITEM_4_ENCHANTMENT', UNIT_END+0x008E);
define('PLAYER_VISIBLE_ITEM_5_ENTRYID', UNIT_END+0x008F);
define('PLAYER_VISIBLE_ITEM_5_ENCHANTMENT', UNIT_END+0x0090);
define('PLAYER_VISIBLE_ITEM_6_ENTRYID', UNIT_END+0x0091);
define('PLAYER_VISIBLE_ITEM_6_ENCHANTMENT', UNIT_END+0x0092);
define('PLAYER_VISIBLE_ITEM_7_ENTRYID', UNIT_END+0x0093);
define('PLAYER_VISIBLE_ITEM_7_ENCHANTMENT', UNIT_END+0x0094);
define('PLAYER_VISIBLE_ITEM_8_ENTRYID', UNIT_END+0x0095);
define('PLAYER_VISIBLE_ITEM_8_ENCHANTMENT', UNIT_END+0x0096);
define('PLAYER_VISIBLE_ITEM_9_ENTRYID', UNIT_END+0x0097);
define('PLAYER_VISIBLE_ITEM_9_ENCHANTMENT', UNIT_END+0x0098);
define('PLAYER_VISIBLE_ITEM_10_ENTRYID', UNIT_END+0x0099);
define('PLAYER_VISIBLE_ITEM_10_ENCHANTMENT', UNIT_END+0x009A);
define('PLAYER_VISIBLE_ITEM_11_ENTRYID', UNIT_END+0x009B);
define('PLAYER_VISIBLE_ITEM_11_ENCHANTMENT', UNIT_END+0x009C);
define('PLAYER_VISIBLE_ITEM_12_ENTRYID', UNIT_END+0x009D);
define('PLAYER_VISIBLE_ITEM_12_ENCHANTMENT', UNIT_END+0x009E);
define('PLAYER_VISIBLE_ITEM_13_ENTRYID', UNIT_END+0x009F);
define('PLAYER_VISIBLE_ITEM_13_ENCHANTMENT', UNIT_END+0x00A0);
define('PLAYER_VISIBLE_ITEM_14_ENTRYID', UNIT_END+0x00A1);
define('PLAYER_VISIBLE_ITEM_14_ENCHANTMENT', UNIT_END+0x00A2);
define('PLAYER_VISIBLE_ITEM_15_ENTRYID', UNIT_END+0x00A3);
define('PLAYER_VISIBLE_ITEM_15_ENCHANTMENT', UNIT_END+0x00A4);
define('PLAYER_VISIBLE_ITEM_16_ENTRYID', UNIT_END+0x00A5);
define('PLAYER_VISIBLE_ITEM_16_ENCHANTMENT', UNIT_END+0x00A6);
define('PLAYER_VISIBLE_ITEM_17_ENTRYID', UNIT_END+0x00A7);
define('PLAYER_VISIBLE_ITEM_17_ENCHANTMENT', UNIT_END+0x00A8);
define('PLAYER_VISIBLE_ITEM_18_ENTRYID', UNIT_END+0x00A9);
define('PLAYER_VISIBLE_ITEM_18_ENCHANTMENT', UNIT_END+0x00AA);
define('PLAYER_VISIBLE_ITEM_19_ENTRYID', UNIT_END+0x00AB);
define('PLAYER_VISIBLE_ITEM_19_ENCHANTMENT', UNIT_END+0x00AC);
define('PLAYER_CHOSEN_TITLE', UNIT_END+0x00AD);
define('PLAYER_FAKE_INEBRIATION', UNIT_END+0x00AE);
define('PLAYER_FIELD_PAD_0', UNIT_END+0x00AF);
define('PLAYER_FIELD_INV_SLOT_HEAD', UNIT_END+0x00B0);
define('PLAYER_FIELD_PACK_SLOT_1', UNIT_END+0x00DE);
define('PLAYER_FIELD_BANK_SLOT_1', UNIT_END+0x00FE);
define('PLAYER_FIELD_BANKBAG_SLOT_1', UNIT_END+0x0136);
define('PLAYER_FIELD_VENDORBUYBACK_SLOT_1', UNIT_END+0x0144);
define('PLAYER_FIELD_KEYRING_SLOT_1', UNIT_END+0x015C);
define('PLAYER_FIELD_CURRENCYTOKEN_SLOT_1', UNIT_END+0x019C);
define('PLAYER_FARSIGHT', UNIT_END+0x01DC);
define('PLAYER__FIELD_KNOWN_TITLES', UNIT_END+0x01DE);
define('PLAYER__FIELD_KNOWN_TITLES1', UNIT_END+0x01E0);
define('PLAYER__FIELD_KNOWN_TITLES2', UNIT_END+0x01E2);
define('PLAYER_FIELD_KNOWN_CURRENCIES', UNIT_END+0x01E4);
define('PLAYER_XP', UNIT_END+0x01E6);
define('PLAYER_NEXT_LEVEL_XP', UNIT_END+0x01E7);
define('PLAYER_SKILL_INFO_1_1', UNIT_END+0x01E8);
define('PLAYER_CHARACTER_POINTS1', UNIT_END+0x0368);
define('PLAYER_CHARACTER_POINTS2', UNIT_END+0x0369);
define('PLAYER_TRACK_CREATURES', UNIT_END+0x036A);
define('PLAYER_TRACK_RESOURCES', UNIT_END+0x036B);
define('PLAYER_BLOCK_PERCENTAGE', UNIT_END+0x036C);
define('PLAYER_DODGE_PERCENTAGE', UNIT_END+0x036D);
define('PLAYER_PARRY_PERCENTAGE', UNIT_END+0x036E);
define('PLAYER_EXPERTISE', UNIT_END+0x036F);
define('PLAYER_OFFHAND_EXPERTISE', UNIT_END+0x0370);
define('PLAYER_CRIT_PERCENTAGE', UNIT_END+0x0371);
define('PLAYER_RANGED_CRIT_PERCENTAGE', UNIT_END+0x0372);
define('PLAYER_OFFHAND_CRIT_PERCENTAGE', UNIT_END+0x0373);
define('PLAYER_SPELL_CRIT_PERCENTAGE1', UNIT_END+0x0374);
define('PLAYER_SHIELD_BLOCK', UNIT_END+0x037B);
define('PLAYER_SHIELD_BLOCK_CRIT_PERCENTAGE', UNIT_END+0x037C);
define('PLAYER_EXPLORED_ZONES_1', UNIT_END+0x037D);
define('PLAYER_REST_STATE_EXPERIENCE', UNIT_END+0x03FD);
define('PLAYER_FIELD_COINAGE', UNIT_END+0x03FE);
define('PLAYER_FIELD_MOD_DAMAGE_DONE_POS', UNIT_END+0x03FF);
define('PLAYER_FIELD_MOD_DAMAGE_DONE_NEG', UNIT_END+0x0406);
define('PLAYER_FIELD_MOD_DAMAGE_DONE_PCT', UNIT_END+0x040D);
define('PLAYER_FIELD_MOD_HEALING_DONE_POS', UNIT_END+0x0414);
define('PLAYER_FIELD_MOD_HEALING_PCT', UNIT_END+0x0415);
define('PLAYER_FIELD_MOD_HEALING_DONE_PCT', UNIT_END+0x0416);
define('PLAYER_FIELD_MOD_TARGET_RESISTANCE', UNIT_END+0x0417);
define('PLAYER_FIELD_MOD_TARGET_PHYSICAL_RESISTANCE', UNIT_END+0x0418);
define('PLAYER_FIELD_BYTES', UNIT_END+0x0419);
define('PLAYER_AMMO_ID', UNIT_END+0x041A);
define('PLAYER_SELF_RES_SPELL', UNIT_END+0x041B);
define('PLAYER_FIELD_PVP_MEDALS', UNIT_END+0x041C);
define('PLAYER_FIELD_BUYBACK_PRICE_1', UNIT_END+0x041D);
define('PLAYER_FIELD_BUYBACK_TIMESTAMP_1', UNIT_END+0x0429);
define('PLAYER_FIELD_KILLS', UNIT_END+0x0435);
define('PLAYER_FIELD_TODAY_CONTRIBUTION', UNIT_END+0x0436);
define('PLAYER_FIELD_YESTERDAY_CONTRIBUTION', UNIT_END+0x0437);
define('PLAYER_FIELD_LIFETIME_HONORBALE_KILLS', UNIT_END+0x0438);
define('PLAYER_FIELD_BYTES2', UNIT_END+0x0439);
define('PLAYER_FIELD_WATCHED_FACTION_INDEX', UNIT_END+0x043A);
define('PLAYER_FIELD_COMBAT_RATING_1', UNIT_END+0x043B);
define('PLAYER_FIELD_ARENA_TEAM_INFO_1_1', UNIT_END+0x0454);
define('PLAYER_FIELD_HONOR_CURRENCY', UNIT_END+0x0469);
define('PLAYER_FIELD_ARENA_CURRENCY', UNIT_END+0x046A);
define('PLAYER_FIELD_MAX_LEVEL', UNIT_END+0x046B);
define('PLAYER_FIELD_DAILY_QUESTS_1', UNIT_END+0x046C);
define('PLAYER_RUNE_REGEN_1', UNIT_END+0x0485);
define('PLAYER_NO_REAGENT_COST_1', UNIT_END+0x0489);
define('PLAYER_FIELD_GLYPH_SLOTS_1', UNIT_END+0x048C);
define('PLAYER_FIELD_GLYPHS_1', UNIT_END+0x0492);
define('PLAYER_GLYPHS_ENABLED', UNIT_END+0x0498);
define('PLAYER_PET_SPELL_POWER', UNIT_END+0x0499);
define('PLAYER_END', UNIT_END+0x049A);

define('OBJECT_FIELD_CREATED_BY', OBJECT_END+0x0000);
define('GAMEOBJECT_DISPLAYID', OBJECT_END+0x0002);
define('GAMEOBJECT_FLAGS', OBJECT_END+0x0003);
define('GAMEOBJECT_PARENTROTATION', OBJECT_END+0x0004);
define('GAMEOBJECT_DYNAMIC', OBJECT_END+0x0008);
define('GAMEOBJECT_FACTION', OBJECT_END+0x0009);
define('GAMEOBJECT_LEVEL', OBJECT_END+0x000A);
define('GAMEOBJECT_BYTES_1', OBJECT_END+0x000B);
define('GAMEOBJECT_END', OBJECT_END+0x000C);

define('DYNAMICOBJECT_CASTER', OBJECT_END+0x0000);
define('DYNAMICOBJECT_BYTES', OBJECT_END+0x0002);
define('DYNAMICOBJECT_SPELLID', OBJECT_END+0x0003);
define('DYNAMICOBJECT_RADIUS', OBJECT_END+0x0004);
define('DYNAMICOBJECT_CASTTIME', OBJECT_END+0x0005);
define('DYNAMICOBJECT_END', OBJECT_END+0x0006);

define('CORPSE_FIELD_OWNER', OBJECT_END+0x0000);
define('CORPSE_FIELD_PARTY', OBJECT_END+0x0002);
define('CORPSE_FIELD_DISPLAY_ID', OBJECT_END+0x0004);
define('CORPSE_FIELD_ITEM', OBJECT_END+0x0005);
define('CORPSE_FIELD_BYTES_1', OBJECT_END+0x0018);
define('CORPSE_FIELD_BYTES_2', OBJECT_END+0x0019);
define('CORPSE_FIELD_GUILD', OBJECT_END+0x001A);
define('CORPSE_FIELD_FLAGS', OBJECT_END+0x001B);
define('CORPSE_FIELD_DYNAMIC_FLAGS', OBJECT_END+0x001C);
define('CORPSE_FIELD_PAD', OBJECT_END+0x001D);
define('CORPSE_END', OBJECT_END+0x001E);
?>