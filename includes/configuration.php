<?php

/**
 * Copy existed character directly from Retail WoW Armory to MaNGOS DB
 * @author Shadez
 * @copyright 2010
 */

if(!defined('__MANGOS__')) {
    die('Direct access to this file is not allowed!');
}

$Configs = array();

$Configs['mysql'] = array();
$Configs['mysql']['realmd'] = array();
// Realmd database settings
$Configs['mysql']['realmd']['host'] = 'localhost';
$Configs['mysql']['realmd']['user'] = 'root';
$Configs['mysql']['realmd']['pass'] = '';
$Configs['mysql']['realmd']['name'] = 'realmd';
$Configs['mysql']['realmd']['charset'] = 'UTF8';

$Configs['realms'] = array();
$Configs['realms'][1] = array();
// Characters database settings
$Configs['realms'][1]['cdb_host'] = 'localhost';
$Configs['realms'][1]['cdb_user'] = 'root';
$Configs['realms'][1]['cdb_pass'] = '';
$Configs['realms'][1]['cdb_name'] = 'characters';
$Configs['realms'][1]['cdb_charset'] = 'UTF8';
// World database settings
$Configs['realms'][1]['wdb_host'] = 'localhost';
$Configs['realms'][1]['wdb_user'] = 'root';
$Configs['realms'][1]['wdb_pass'] = '';
$Configs['realms'][1]['wdb_name'] = 'mangos';
$Configs['realms'][1]['wdb_charset'] = 'UTF8';
// Only 1 realm supported.

$Configs['settings'] = array();
$Configs['settings']['useDebug'] = true;
$Configs['settings']['logLevel'] = 3;
?>