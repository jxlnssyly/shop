<?php

/**
  * session 入库工具类
  */

class  SessionDB {

    private $_db;

    public function __construct() {
        ini_set('session.save_handler','user');
        session_set_save_handler(
                array($this,'sess_open'),
                array($this,'sess_close'),
                array($this,'sess_read'),
                array($this,'sess_write'),
                array($this,'sess_destroy'),
                array($this,'sess_gc')
            );
        @session_start();
    }

    public function sess_open() {
        $this->_db = MySQLDB::getInstance($GLOBALS['config']['db']);

    }

    public function sess_close() {
        return true;
    }

    public function sess_read($sess_id) {
        $sql = "select sess_data from `it_session` where sess_id='$sess_id'";
        return (string) $this->_db->fetchColumn($sql);
    }

    public function sess_write($sess_id,$sess_data) {
        $expires = time();
        $sql = "replace into `it_session` values ('$sess_id','$sess_data',$expires)";
        $this->_db->query($sql);
    }

    public function sess_destroy($sess_id) {
        $sql = "delete from`it_session` where sess_id='$sess_id'";
        $this->_db->query($sql);
    }

    public function sess_gc($max_lifetime) {

        $now = time();
        $sql = "delete from `it_session` where expires < $now - $max_lifetime";
        $this->_db->query($sql);
    }

}


