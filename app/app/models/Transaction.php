<?php

class Transaction extends BaseModel {

  function __construct() {
    parent::__construct("transactions");
  }

  public function getId()
  {
    return $this->get("id");
  }

  public function setUserId($userId)
  {
    $this->set("userId", $userId);
  }

  public function getUserId()
  {
    return $this->get("userId");
  }

  public function getUser(){
    return User::find($this->getUserId());
  }

  public function setItemId($itemId){
    return $this->set("itemId",$itemId);
  }

  public function getItemId(){
    return $this->get("itemId");
  }

  public function getItem(){
    return Item::find($this->getItemId());
  }

}
