<?php

abstract class BaseModel {

  static $con;
  private $table;
  private $data;
  private $updated;
  private $class;
  private $con_;

  function __construct($table, $class) {
    $this->table = $table;
    $this->updated = array();
    $this->data = array();
    $this->class = $class;
    $this->con_ = BaseModel::$con;
  }

  public abstract static function model();

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
    $values = array_map(function($key){
      return $this->escape($this->data[$key]); 
    },array_keys($this->data));
    $values = implode(",", $values);
    $formatQuery = "INSERT INTO %s (%s) VALUES (%s)";
    $query = sprintf($formatQuery, $this->table, $columns,  $values);
    $result = $this->con_->query($query);
    $this->id = $this->con_->insert_id;
    return $result;
  }

  public function getError() {
    return $this->con_->error;
  }

  private function escape($value){
    return "'".addslashes($value)."'";
  }

  private function update() {
    $columns = array_filter(array_keys($this->data),function ($key){ return $this->updated[$key]; });
    $values = array_map(function($key){ 
      return $key.'='.$this->escape($this->data[$key]);
    }, $columns);
    $values = implode(", ", $values);
    $formatQuery = "UPDATE %s SET %s WHERE id= %s";
    $query = sprintf($formatQuery, $this->table, $values, $this->data["id"]);
    $result = $this->con_->query($query);
    return $result;
  }

  public function findAll($_cond) {
    $cond = array_map(function($key, $_cond){ 
      return $key.'='.$this->escape($_cond);
    }, array_keys($_cond), $_cond);
    $cond = implode(" AND ", $cond);
    if(strlen($cond) == 0) $cond = "1=1";
    $formatQuery = "SELECT * FROM %s WHERE %s";
    $query = sprintf($formatQuery, $this->table, $cond);
    $result = $this->con_->query($query);
    $tmp = array();
    while ($tmp[] = $result->fetch_assoc());
    $result = array_slice($tmp,0,count($tmp)-1);
    $ret = array();
    foreach($result as $res){
      $tmp = new $this->class();
      foreach($res as $key=>$value){
        $tmp->$key = $value;
      }
      $ret[] = $tmp;
    }
    return $ret;
  }

  public function findOne($cond){
    $all = $this->findAll($cond);
    return $all[0];
  }

  public function find($id) {
    $formatQuery = "SELECT * FROM %s WHERE id= %s";
    $query = sprintf($formatQuery, $this->table, $id);
    $result = $this->con_->query($query);
    if( $result == NULL) return NULL;
    $result = $result->fetch_assoc();
    $ret = new $this->class();
    foreach($result as $key=>$value){
      $ret->$key = $value;
    }
    return $ret;
  }

  public function __toString()
  {
    return print_r($this->data,true);
  }
}
