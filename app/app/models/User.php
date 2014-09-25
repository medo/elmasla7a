<?php

class User extends BaseModel {

  function __construct() {
    parent::__construct("users");
  }

  public function getId()
  {
    return $this->get("id");
  }

  public function setEmail($email)
  {
    $this->set("email", $email);
  }

  public function getEmail()
  {
    return $this->get("email");
  }

  public function setFirstName($name)
  {
    $this->set("firstName", $name);
  }

  public function getFirstName()
  {
    return $this->get("firstName");
  }

  public function setLastName($name)
  {
    $this->set("lastName", $name);
  }    

  public function getLastName()
  {
    return $this->get("lastName");
  }

  public function setPassword($password)
  {
    $this->set("password", $password);
  }

  public function getPassword()
  {
    return $this->get("password");
  }

  public function setProfilePicturePath($profilePicturePath)
  {
    return $this->set("profilePicturePath",$profilePicturePath);
  }

  public function getProfilePicturePath()
  {
    return $this->get("profilePicturePath");
  }

}
