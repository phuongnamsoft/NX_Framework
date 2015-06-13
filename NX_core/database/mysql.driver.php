<?php


class MySQL  {

    protected $result_array;
    private $host;
    private $user;
    private $passwd;
    private $database;
    protected $db;

    public function __construct($config = array()) {
        
    }

    public function connect() {
        $this->db = mysql_connect($this->host, $this->user, $this->passwd);
        mysql_select_db($this->database, $this->db);
        mysql_set_charset('utf8', $this->db);
    }
    private function tableExists($table) {
        $tablesInDb = @mysql_query('SHOW TABLES FROM ' . $this->database . ' LIKE "' . $table . '"');
        if ($tablesInDb) {
            if (mysql_num_rows($tablesInDb) == 1) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function select($query) {
        $result = mysql_query($query, $this->db);
        $result_array = array();
        while ($row = mysql_fetch_assoc($result)) { //fetch_assoc: hiển thị  tên mà mình đặt cho mảng
            $result_array[] = $row;
        }
        $this->result_array = $result_array;
        return $this->result_array;
    }
    
    public function object() {
        
    }
    
    

    public function insert($query) {
        mysql_query($query, $this->db);
        //return mysql_affected_rows(); //Dung de thong bao co su thay doi cua cac dong
        return mysql_insert_id($this->db);
    }

    public function delete($query) {
        mysql_query($query, $this->db);
        return mysql_affected_rows($this->db);
    }

    public function update($query) {
        mysql_query($query, $this->db);
        return mysql_affected_rows($this->db);
    }

}

class data_query extends MySQL {

    public function __construct() {
        parent::__construct();
    }

}
