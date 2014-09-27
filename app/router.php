<?php
require_once("vendor/autoload.php");

$path = pathinfo($_SERVER["SCRIPT_FILENAME"]);
if ($path["extension"] == "coffee") {
  $filepath = $path["dirname"]."/".$path["basename"];
  $coffee = file_get_contents($filepath);
  $js = CoffeeScript\Compiler::compile($coffee, array('filename' => $filepath));
  header("Content-Type: application/javascript");
  echo $js;
}else if($path["extension"] == "scss") {
  $filepath = $path["dirname"]."/".$path["basename"];
  $scss_code = file_get_contents($filepath);
  $scss = new scssc();
  header("Content-Type: text/css");
  echo $scss->compile($scss_code);
}else{
  return false;
}
