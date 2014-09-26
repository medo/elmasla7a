<?php

class Item extends BaseModel {

  function __construct() {
    parent::__construct("items", "item");
  }

  public static function model(){
    return new self();
  }

}
