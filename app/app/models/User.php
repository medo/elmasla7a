<?php

class User extends BaseModel {
  
  function __construct() {
    parent::__construct("users", self::class);
  }

  public static function model(){
    return new self();
  }

}
