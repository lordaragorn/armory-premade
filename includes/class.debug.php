<?php

/**
 * Copy existed character directly from Retail WoW Armory to MaNGOS DB
 * @author Shadez
 * @copyright 2010
 */

if(!defined('__MANGOS__')) {
    die('Direct access to this file is not allowed!');
}

Class MLogHandler {
    
    /**
     * Log config
     **/
    private $config = false;
    private $file = '_debug/tmp.dbg';
    
    /**
     * Initializes debugger
     **/
    public function MLogHandler($config, $file = false) {
        if($config['useDebug'] == false) {
            return;
        }
        $this->config = $config;
        if($file) {
            $this->file = $file;
        }
    }
    
    public function CheckClass() {
        if($this->config) {
            return true;
        }
        return false;
    }
    
    public function writeError($errorText) {
        if($this->config['useDebug'] == false || $this->config['logLevel'] < 1) {
            return;
        }
        $args = func_get_args();
        $error_log = self::AddStyle('error');
        $error_log .= call_user_func_array('sprintf', $args);
        $error_log .= '<br />
';
        self::__writeFile($error_log);
        return;
    }
    
    public function writeLog($logtext) {
        if($this->config['useDebug'] == false || $this->config['logLevel'] < 2) {
            return;
        }
        $args = func_get_args();
        $debug_log = self::AddStyle('debug');
        $debug_log .= call_user_func_array('sprintf', $args);
        $debug_log .= '<br />
';
        self::__writeFile($debug_log);
        return;
    }
    
    public function writeSql($sqlText) {
        if($this->config['useDebug'] == false || $this->config['logLevel'] < 3) {
            return;
        }
        $args = func_get_args();
        $error_log = self::AddStyle('sql');
        $error_log .= call_user_func_array('sprintf', $args);
        $error_log .= '<br />
';
        self::__writeFile($error_log);
        return;
    }
    
    private function AddStyle($type) {
        if($this->config['useDebug'] == false) {
            return;
        }
        switch($type) {
            case 'debug':
                $log = sprintf('<strong>DEBUG</strong> [%s]: ', date('d-m-Y H:i:s'));
                break;
            case 'error':
                $log = sprintf('<strong>ERROR</strong> [%s]: ', date('d-m-Y H:i:s'));
                break;
            case 'sql':
                $log = sprintf('<strong>SQL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong> [%s]: ', date('d-m-Y H:i:s'));
                break;
        }
        return $log;
    }
    
    private function __writeFile($data) {
        @file_put_contents($this->file, $data, FILE_APPEND);
    }
}
?>