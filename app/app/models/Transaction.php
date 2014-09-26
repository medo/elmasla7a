<?php

class Transaction extends BaseModel {

  function __construct() {
    parent::__construct("transactions", self::class);
  }

  public static function model(){
    return new self();
  }

  public function getUser(){
    return User::model()->find($this->userId);
  }

  public function getItem(){
    return Item::model()->find($this->itemId);
  }

}
