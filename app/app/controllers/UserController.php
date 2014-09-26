<?php

class UserController extends BaseController{

  function registerAction($params) {
    $firstName = $params["firstName"];
    $lastName = $params["lastName"];
    $email = $params["email"];
    $password = $params["password"];
    $profilePicturePath = $params["profilePicturePath"];
  	$user = new User();
    $user->firstName = $firstName;
    $user->lastName = $lastName;
    $user->email = $email;
    $user->password = md5($password);
    $user->profilePicturePath = $profilePicturePath;
    $user->save();
    $this->signInUser($user->Id);
    
    return $this->redirect("Site", "index");
  }

  function editAction($params) {
    $user = $this->signedInUser();
    $firstName = $user->firstName;
    $lastName = $user->lastName;
    $email = $user->email;
    $profilePicturePath = $user->profilePicturePath;

    return $this->render("edit.html.haml", 
      array("firstName"=>$firstName,"lastName"=>$lastName,
        "email"=>$email, "profilePicturePath" => $profilePicturePath));
  }

  function saveAction($params) {
    $user = $this->signedInUser();
    $user->firstName = ($params["firstName"] == "")? $user->firstName : $params["firstName"];
    $user->lastName = ($params["lastName"] == "")? $user->lastName : $params["lastName"];
    $user->email = ($params["email"] == "")? $user->email : $params["email"];
    $user->profilePicturePath = ($params["profilePicturePath"] == "")? $user->profilePicturePath : $params["profilePicturePath"];
    $user->password = ($params["password"] == "")? $user->password : md5($params["password"]);
    $user->save();

    return $this->redirect("Site", "index");

  }

  function loginAction($params) {
    $email = $params["email"];
    $password = md5($params["password"]);
    $user = User::model()->findOne(array("email" => $email, "password" => $password));
    if($user!= null){
      $this->signInUser($user->id);
     return $this->redirect("Site", "index");
    } else {
      $message = true;
      return $this->redirect("Site", "index");
    }
    
   
  }

  function logoutAction($params) {
    $_SESSION['userId'] = null;
    return $this->redirect("Site", "index");
  }
}
