<?php

/**
 * Copy existed character directly from Retail WoW Armory to MaNGOS DB
 * @author Shadez
 * @copyright 2010
 */

if(!defined('__MANGOS__')) {
    die('Direct access to this file is not allowed!');
}

$logHandler = false;
$worldDBHandler = false;
$charactersDBHandler = false;
$realmDBHandler = false;
$scriptDBHandler = false;

function GetLog() {
    return InitLog(true);
}

function InitLog($return = false) {
    global $logHandler;
    if(!is_object($logHandler) && class_exists('MLogHandler')) {
        global $Configs;
        $logHandler = new MLogHandler( array('useDebug' => $Configs['settings']['useDebug'], 'logLevel' => $Configs['settings']['logLevel']) );
        GetLog()->writeLog('%s : Log System initialized', __FUNCTION__);
        if($return == true) {
            return $logHandler;
        }
    }
    elseif(is_object($logHandler) && $logHandler->CheckClass() === true && $return == true) {
        return $logHandler;
    }
}

function InitCharactersOrWorldDB($dbType, $dbID = 1, $return = false) {
    if($dbType == 'world') {
        global $worldDBHandler;
        $tmpDBHandler = $worldDBHandler;
        $prefix = 'wdb';
        GetLog()->writeLog('%s : initiate connect to world database', __FUNCTION__);
    }
    else {
        global $charactersDBHandler;
        $tmpDBHandler = $charactersDBHandler;
        $prefix = 'cdb';
        GetLog()->writeLog('%s : initiate connect to characters database', __FUNCTION__);
    }
    if(!is_object($tmpDBHandler) && class_exists('MDatabaseHandler')) {
        global $Configs;
        if(isset($Configs['realms'][$dbID])) {
            $tmpConfig = $Configs['realms'][$dbID];
            $tmpDBHandler = new MDatabaseHandler($tmpConfig[$prefix.'_host'], $tmpConfig[$prefix.'_user'], $tmpConfig[$prefix.'_pass'], $tmpConfig[$prefix.'_name'], $tmpConfig[$prefix.'_charset']);
            if($tmpDBHandler->TestLink() === true) {
                if($dbType == 'world') {
                    GetLog()->writeLog('%s : connection success', __FUNCTION__);
                    $worldDBHandler = $tmpDBHandler;
                    if($return == true) {
                        return $worldDBHandler;
                    }
                }
                else {
                    GetLog()->writeLog('%s : connection success', __FUNCTION__);
                    $charactersDBHandler = $tmpDBHandler;
                    if($return == true) {
                        return $charactersDBHandler;
                    }
                }
            }
            else {
                GetLog()->writeLog('%s : unable to connect to MySQL database (host: %s, user: %s, password: %s, dbName: %s)', __FUNCTION__, $tmpConfig[$prefix.'_host'], $tmpConfig[$prefix.'_user'], $tmpConfig[$prefix.'_pass'], $tmpConfig[$prefix.'_name']);
            }
        }
    }
    elseif(is_object($tmpDBHandler) && $tmpDBHandler->TestLink() === true) {
        if($dbType == 'world') {
            GetLog()->writeLog('%s : connection success', __FUNCTION__);
            $worldDBHandler = $tmpDBHandler;
            if($return == true) {
                return $worldDBHandler;
            }
        }
        else {
            GetLog()->writeLog('%s : connection success', __FUNCTION__);
            $charactersDBHandler = $tmpDBHandler;
            if($return == true) {
                return $charactersDBHandler;
            }
        }
    } 
}

function GetCharactersDB() {
    global $charactersDBHandler;
    if(is_object($charactersDBHandler) && $charactersDBHandler->TestLink() === true) {
        return $charactersDBHandler;
    }
    else {
        return InitCharactersOrWorldDB('characters', 1, true);
    }
}

function InitRealmDB($return = false) {
    global $realmDBHandler;
    if(!is_object($realmDBHandler) && class_exists('MDatabaseHandler')) {
        global $Configs;
        $tmpConfig = $Configs['mysql']['realmd'];
        $realmDBHandler = new MDatabaseHandler($tmpConfig['host'], $tmpConfig['user'], $tmpConfig['pass'], $tmpConfig['name'], $tmpConfig['charset']);
        if($realmDBHandler->TestLink() === true && $return) {
            return $realmDBHandler;
        }
    }
    elseif(is_object($realmDBHandler) && $realmDBHandler->TestLink() === true && $return) {
        return $realmDBHandler;
    }
}

function GetRealmDB() {
    return InitRealmDB(true);
}

function GetWorldDB() {
    global $worldDBHandler;
    if(is_object($worldDBHandler) && $worldDBHandler->TestLink() === true) {
        return $worldDBHandler;
    }
    else {
        return InitCharactersOrWorldDB('world', 1, true);
    }
}

?>