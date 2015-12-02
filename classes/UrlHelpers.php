<?php

class UrlHelpers{

  static function GetCss($file)
  {
    echo ROOT_URL . "/content/css/" . $file  . ".css";
  }

  static function GetJs($file)
  {
    echo ROOT_URL . "/content/scripts/" . $file  . ".js";
  }

  static function ValidateInput($data) {
  	$data = trim($data);
  	$data = stripslashes($data);
  	$data = htmlspecialchars($data);
  	return $data;
	}
}