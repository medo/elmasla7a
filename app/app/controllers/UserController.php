<?php

class UserController extends BaseController{

  function registerAction($params) {
    $firstName = $params["firstName"];
    $lastName = $params["lastName"];
    $email = $params["email"];
    $password = $params["password"];
  	$user = new User();
    $user->firstName = $firstName;
    $user->lastName = $lastName;
    $user->email = $email;
    $user->password = md5($password);
    $user->save();
    $this->signInUser($user->getId());
    
    return $this->redirect("Site", "index");
  }

  function editAction($params) {
    $user = $this->signedInUser();
    $firstName = $user->firstName;
    $lastName = $user->lastName;
    $email = $user->email;

    return $this->render("edit.html.haml", 
      array("firstName"=>$firstName,"lastName"=>$lastName,"email"=>$email));
  }

  function saveAction($params) {
    $user = $this->signedInUser();
    $user->firstName = ($params["firstName"])? $user->firstName : $params["firstName"];
    $user->lastName = ($params["lastName"])? $user->lastName : $params["lastName"];
    $user->email = ($params["email"])? $user->email : $params["email"];
    $user->password = ($params["password"])? $user->getpassword() : md5($params["password"]);
    $user->save();

    return $this->redirect("Site", "index");

  }

  function loginAction($params) {
    $email = $params["email"];
    $password = md5($params["password"]);
    $user = User::findById(array("email", $email));
    if(($user!= null) 
      && ($user->password == $password) {
      $this->signInUser($user->getId());
    }
    
    return $this->redirect("Site", "index");
  }

  function logoutAction($params) {
    $_SESSION['userId'] = null;
    
    return $this->redirect("Site", "index");
  }
}
