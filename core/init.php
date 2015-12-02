<?php

session_start();

$GLOBALS["config"] = array(
	
  "mysql" => array(
		"host" => "127.0.0.1",
		"username" => "root",
		"password" => "",
		"db" => "joyart"
	),
	
  "remember" => array(
    "cookie_name" => "hash",
    "cookie_expires" => 604800
  ),
	
  "session" => array(
    "session_name" => "user",
    "token_name" => "token"
  )

);

spl_autoload_register(function($class){
  if(file_exists ("classes/".$class.".php"))
    require_once "classes/".$class.".php";
  else
    require_once "models/".$class.".php";
});

require_once "functions/sanitize.php";
require_once "functions/resize.php";