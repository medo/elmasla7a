<?php
require_once("config/database.php");
require_once("vendor/autoload.php");

function connectToDatabase(){
  $con = mysqli_connect($DATABASE_SERVER_HOST, $DATABASE_SERVER_USERNAME, $DATABASE_SERVER_PASSWORD, $DATABASE_NAME); 
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

