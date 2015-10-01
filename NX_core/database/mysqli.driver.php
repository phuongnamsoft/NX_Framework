<?php

class MySQLi {

    protected $result_array;
    private $hostname;
    private $username;
    private $password;
    private $database;
    private $charset;
    private $type;
    static $db_link;

    public function __construct($config = array()) {
        if (is_array($config) && !empty($config)) {
            foreach ($config as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function connect() {
        self::$db_link = mysqli_connect($this->hostname, $this->username, $this->password);
        mysqli_select_db($this->database, self::$db_link);
        mysqli_set_charset($this->charset, self::$db_link);
    }

    private function tableExists($table) {
        $tablesInDb = mysqli_query('SHOW TABLES FROM ' . $this->database . ' LIKE "' . $table . '"', self::$db_link);
        if ($tablesInDb) {
            if (mysqli_num_rows($tablesInDb) == 1) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function select($query) {
        $result = mysqli_query($query, self::$db_link);
        $result_array = array();
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $result_array[] = $row;
            }
        }
        return $result_array;
    }

    public function to_object($data) {
        return array2object($data);
    }

    public function insert($query) {
        mysqli_query($query, self::$db_link);
        //return mysqli_affected_rows();
        return mysqli_insert_id(self::$db_link);
    }

    public function delete($query) {
        mysqli_query($query, self::$db_link);
        return mysqli_affected_rows(self::$db_link);
    }

    public function update($query) {
        mysqli_query($query, self::$db_link);
        return mysqli_affected_rows(self::$db_link);
    }

}

class data_query extends MySQLi {

    public function __construct() {
        parent::__construct();
    }

}
