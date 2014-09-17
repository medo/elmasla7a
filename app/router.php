<?php
require_once("vendor/autoload.php");

$path = pathinfo($_SERVER["SCRIPT_FILENAME"]);
if ($path["extension"] == "coffee") {
  $filepath = $path["dirname"]."/".$path["basename"];
  $coffee = file_get_contents($filepath);
  $js = CoffeeScript\Compiler::compile($coffee, array('filename' => $filepath));
  echo $js;
}else if($path["extension"] == "scss") {
  return false;
}else{
  return false;
}
