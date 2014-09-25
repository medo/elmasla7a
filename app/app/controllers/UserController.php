<?php

class UserController extends BaseController{

  function registerAction($params) {
    $firstName = $params["firstName"];
    $lastName = $params["lastName"];
    $email = $params["email"];
    $password = $params["password"];
  	$user = new User();
    $user->setFirstName($firstName);
    $user->setLastName($lastName);
    $user->setEmail($email);
    $user->setPassword(md5($password));
    $user->save();
    $this->signInuser($user->getId());
    return $this->redirect("Site", "index");
  }

  function loginAction(String $email, String $password) {

    return $this->redirect("Site", "index");
  }

  function logoutAction(int $userId) {

    return $this->redirect("Site", "index");
  }
}
