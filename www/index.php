<?php
session_start();

$devmode = $_SERVER["HTTP_HOST"] == "localhost";
if ($devmode) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
}
function autoload($name) {
  if (strpos($name, "Controller") == false) {
    require "models/$name.php";
  } else {
    require "controllers/$name.php";
  }
}

spl_autoload_register("autoload");

DB::connect("db", "root", "test", "myDb");
$router = new RouterController;

$router->render([$_SERVER["REQUEST_URI"]]);
