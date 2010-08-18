<?php

/**
 * Copy existed character directly from Retail WoW Armory to MaNGOS DB
 * @author Shadez
 * @copyright 2010
 */

if(!defined('__MANGOS__')) {
    die('Direct access to this file is not allowed!');
}
if(!@include('configuration.php')) {
    die('Unable to load configuration.php');
}
if(!@include('UpdateFields.php')) {
    die('Unable to load UpdateFields.php!');
}
if(!@include('defines.php')) {
    die('Unable to load defines.php!');
}
if(!@include('class.dbhandler.php')) {
    die('Unable to load database class!');
}
if(!@include('class.debug.php')) {
    die('Unable to load debug class!');
}
if(!@include('functions.php')) {
    die('Unable to load functions.php');
}
if(!@include('class.characters.php')) {
    die('Unable to load characters class!');
}
if(!@include('class.item.php')) {
    die('Unable to load Item class!');
}
// 3rd party
if(!@include('phpArmory/phpArmory.class.php')) {
    die('Unable to load Wowarmory extension!');
}
// Init classes
InitLog(false);
InitCharactersOrWorldDB('world', 1, false);
InitCharactersOrWorldDB('characters', 1, false);
InitRealmDB(false);

?>