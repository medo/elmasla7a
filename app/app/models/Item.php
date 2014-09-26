<?php

class Item extends BaseModel {

  function __construct() {
    parent::__construct("items", self::class);
  }

  public static function model(){
    return new self();
  }

}
