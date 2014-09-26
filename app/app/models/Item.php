<?php

class Item extends BaseModel {

  function __construct() {
    parent::__construct("items", "Item");
  }

  public static function model(){
    return new self();
  }

}
