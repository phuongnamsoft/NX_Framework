<?php

class MySQL {

    protected $result_array;
    private $hostname;
    private $username;
    private $password;
    private $database;
    private $charset;
    static $db_link;

    public function __construct($config = array()) {
        
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function connect() {
        self::$db_link = mysql_connect($this->hostname, $this->username, $this->password);
        mysql_select_db($this->database, self::$db_link);
        mysql_set_charset($this->charset, self::$db_link);
    }

    private function tableExists($table) {
        $tablesInDb = mysql_query('SHOW TABLES FROM ' . $this->database . ' LIKE "' . $table . '"', self::$db_link);
        if ($tablesInDb) {
            if (mysql_num_rows($tablesInDb) == 1) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function select($query) {
        $result = mysql_query($query, self::$db_link);
        $result_array = array();
        if ($result) {
            while ($row = mysql_fetch_assoc($result)) {
                $result_array[] = $row;
            }
        }
        return $result_array;
    }

    public function object() {
        
    }

    public function insert($query) {
        mysql_query($query, self::$db_link);
        //return mysql_affected_rows(); //Dung de thong bao co su thay doi cua cac dong
        return mysql_insert_id(self::$db_link);
    }

    public function delete($query) {
        mysql_query($query, self::$db_link);
        return mysql_affected_rows(self::$db_link);
    }

    public function update($query) {
        mysql_query($query, self::$db_link);
        return mysql_affected_rows(self::$db_link);
    }

}

class data_query extends MySQL {

    public function __construct() {
        parent::__construct();
    }

}
