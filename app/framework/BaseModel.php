<?php

class BaseModel {

    static $con;
    private $table;
    private $data;
    private $updated;

    function __construct($table) {
        $this->con_ = BaseModel::$con;
        $this->table = $table;
        $this->updated = array();
        $this->data = array();
    }

    function __set($key, $value) {
        $this->data[$key] = $value;
        $this->updated[$key] = true;
    }

    function __get($key) {
        return isset($this->data[$key])? $this->data[$key] : null;
    }

    public function save() {
        if (isset($this->data["id"])) {
            return $this->update();
        }
        $columns = implode(',', array_keys($this->data));
        $values = array();
        foreach (array_keys($this->data) as $column) {
            array_push($values, "'".addslashes($this->data[$column])."'");
        }
        $formatQuery = "INSERT INTO %s (%s) VALUES (%s)";
        $query = sprintf($formatQuery, $this->table, $columns, implode(",", $values));
        $result = $this->con_->query($query);
        return $result;
    }

    public function getError() {
        return $this->con_->error;
    }

    private function update() {

    }

    public static function findById($table, $id) {

    }

    public static function findAll() {

    }

    public static function find() {

    }

}





