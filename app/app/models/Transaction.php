<?php

class Transaction extends BaseModel {

  function __construct() {
    parent::__construct("transactions");
  }

  public function getUser(){
    return User::find($this->getUserId());
  }

  public function getItem(){
    return Item::find($this->getItemId());
  }

}
