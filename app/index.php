<?php
session_start();
error_reporting(E_ERROR);
ini_set('display_errors', 1);

require_once("config/database.php");

function connectToDatabase(){
  $con = mysqli_connect($GLOBALS['DATABASE_SERVER_HOST'], $GLOBALS['DATABASE_SERVER_USERNAME'],
      $GLOBALS['DATABASE_SERVER_PASSWORD'], $GLOBALS['DATABASE_NAME']);
  if( mysqli_connect_errno() ) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
  }
  return $con;
}

function closeDatabaseConnection($con){
  mysqli_close($con);
}

function loadRoutes(){
  return Routes::getRoutes();
}

function runApp($con, $routes){
  $config = array();
  $app = new App($con, $config, $routes);
  echo $app->run();
}

$con = connectToDatabase();
$routes = loadRoutes();
runApp($con, $routes);
closeDatabaseConnection($con);

