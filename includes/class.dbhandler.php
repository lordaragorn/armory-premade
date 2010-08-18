<?php

/**
 * Copy existed character directly from Retail WoW Armory to MaNGOS DB
 * @author Shadez
 * @copyright 2010
 */

if(!defined('__MANGOS__')) {
    die('Direct access to this file is not allowed!');
}

/** Database Query Types **/
define('SINGLE_CELL',   0x01);
define('SINGLE_ROW',    0x02);
define('MULTIPLY_ROW',  0x03);
define('SQL_QUERY',     0x04);
define('OBJECT_QUERY',  0x05);
define('SQL_RAW_QUERY', 0x06);

Class MDatabaseHandler {
    private $dbLink = false;
    private $connectionLink = false;
    private $databaseInfo = array();
    
    /** Queries counter **/
    private $queryCount = 0;
    private $queryTimeGeneration = 0;
    
    /**
     * Connect to DB
     * @category Database Handler
     * @access   public
     * @param    string $host
     * @param    string $user
     * @param    string $password
     * @param    string $dbName
     * @param    string $charset = false
     * @return   bool
     **/
    public function MDatabaseHandler($host, $user, $password, $dbName, $charset = false) {
        $this->connectionLink = @mysql_connect($host, $user, $password, true);
        $this->dbLink         = @mysql_select_db($dbName, $this->connectionLink);
        if($charset === false) {
            $this->query("SET NAMES UTF8");
        }
        else {
            $this->query("SET NAMES %s", $charset);
        }
        $this->databaseInfo = array(
            'host'     => $host,
            'user'     => $user,
            'password' => $password,
            'name'     => $dbName,
            'charset'  => ($charset === false) ? 'UTF8' : $charset,
        );
        return true;
    }
    
    /**
     * Returns current database info
     * @category Database Handler
     * @access   public
     * @param    string $info
     * @return   mixed
     **/
    public function GetDatabaseInfo($info) {
        return (isset($this->databaseInfo[$info])) ? $this->databaseInfo[$info] : false;
    }
    
    /**
     * Tests conection link
     * @category Database Handler
     * @access   public
     * @return   bool
     **/
    public function TestLink() {
        if($this->connectionLink == true) {
            return true;
        }
        return false;
    }
    
    /**
     * Execute SQL query
     * @category Database Handler
     * @access   public
     * @param    string $safe_sql
     * @param    int $queryType
     * @return   mixed
     **/
    private function _query($safe_sql, $queryType) {
        // Execute query and calculate execution time
        $make_array = array();
        $query_start = microtime(true);
        $this->queryCount++;
        $perfomed_query = @mysql_query($safe_sql, $this->connectionLink);
        if($perfomed_query === false) {
            return false;
        }
        $result = false;
        switch($queryType) {
            case SINGLE_CELL:
                $result = @mysql_result($perfomed_query, 0);
                break;
            case SINGLE_ROW:
                $result = @mysql_fetch_array($perfomed_query);
                if(is_array($result)) {
                    foreach($result as $rKey => $rValue) {
                        if(is_string($rKey)) {
                            $make_array[$rKey] = $rValue;
                        }
                    }
                    $result = $make_array;
                }
                break;
            case MULTIPLY_ROW:
                $result = array();
                while($_result = @mysql_fetch_array($perfomed_query)) {
                    if(is_array($_result)) {
                        foreach($_result as $rKey => $rValue) {
                            if(is_string($rKey)) {
                                $make_array[$rKey] = $rValue;
                            }
                        }
                        $result[] = $make_array;
                    }
                    else {
                        $result[] = $_result;
                    }
                }
                break;
            case OBJECT_QUERY:
                $result = array();
                while($_result = @mysql_fetch_object($perfomed_query)) {
                    $result[] = $_result;
                }
                break;
            case SQL_QUERY:
                $result = true;
                break;
            default:
                $result = false;
                break;
        }
        $query_end = microtime(true);
        $queryTime = round($query_end - $query_start, 4);
        $this->queryCount++;
        $this->queryTimeGeneration += $queryTime;
        return $result;
    }
    
    private function _prepareQuery($funcArgs, $numArgs, $query_type) {
        // funcArgs[0] - SQL query text (with placeholders)
        if($query_type != SQL_RAW_QUERY) {
            for($i = 1; $i < $numArgs; $i++) {
                if(is_string($funcArgs[$i])) {
                    $funcArgs[$i] = addslashes($funcArgs[$i]);
                }
                if(is_array($funcArgs[$i])) {
                    $funcArgs[$i] = $this->ConvertArray($funcArgs[$i]);
                }
            }
        }
        $safe_sql = call_user_func_array('sprintf', $funcArgs);
        return $this->_query($safe_sql, $query_type);
    }
    
    public function selectCell($query) {
        $funcArgs = func_get_args();
        $numArgs = func_num_args();
        return $this->_prepareQuery($funcArgs, $numArgs, SINGLE_CELL);
    }
    
    public function selectRow($query) {
        $funcArgs = func_get_args();
        $numArgs = func_num_args();
        return $this->_prepareQuery($funcArgs, $numArgs, SINGLE_ROW);
    }
    
    public function select($query) {
        $funcArgs = func_get_args();
        $numArgs = func_num_args();
        return $this->_prepareQuery($funcArgs, $numArgs, MULTIPLY_ROW);
    }
    
    public function query($query) {
        $funcArgs = func_get_args();
        $numArgs = func_num_args();
        return $this->_prepareQuery($funcArgs, $numArgs, SQL_QUERY);
    }
    
    public function RawQuery($query) {
        $funcArgs = func_get_args();
        $numArgs = func_num_args();
        return $this->_prepareQuery($funcArgs, $numArgs, SQL_RAW_QUERY);
    }
    
    public function selectObject($query) {
        $funcArgs = func_get_args();
        $numArgs = func_num_args();
        return $this->_prepareQuery($funcArgs, $numArgs, OBJECT_QUERY);
    }
    
    /**
     * Converts array values to string format (for IN(%s) cases)
     * @category Database Handler
     * @access   public
     * @param    array $source
     * @return   string
     **/
    private function ConvertArray($source) {
        if(!is_array($source)) {
            return null;
        }
        $returnString = null;
        $count = count($source);
        for($i = 0; $i < $count; $i++) {
            if(!isset($source[$i])) {
                continue;
            }
            if($i) {
                $returnString .= ", '" . addslashes($source[$i]) . "'";
            }
            else {
                $returnString .="'" . addslashes($source[$i]) . "'";
            }
        }
        return $returnString;
    }
}

?>