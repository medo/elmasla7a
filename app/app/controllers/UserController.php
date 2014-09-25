<?php

class UserController extends BaseController{

  function registerAction(String $name, String $email, String $password) {
  	$user = new User();
    $user->setName($name);
    $user->setEmail($email);
    $user->setPassword(hash("md5",$password,false));
    $user->save();
    return $this->redirect(UserController, login);
  }

  function loginAction(String $email, String $password) {
    
    return $this->redirect(SiteController, index);
  }

  function logoutAction(int $userId) {

    return $this->redirect(SiteController, index);
  }
}
