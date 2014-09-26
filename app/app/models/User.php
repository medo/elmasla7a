<?php

class User extends BaseModel {
  
  function __construct() {
    parent::__construct("users", "User");
  }

  public static function model(){
    return new self();
  }

}
