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

  function loginAction($params) {
    $user = $this->signedInUser();
    $this->signInUser($user->getId());
    
    return $this->redirect("Site", "index");
  }

  function logoutAction($params) {
    $_SESSION['userId'] = null;
    
    return $this->redirect("Site", "index");
  }
}
