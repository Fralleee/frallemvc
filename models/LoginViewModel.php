<?php

class LoginViewModel
{
  public $returnUrl = "";
  public $validationdata = array(
      "email" => array(
        "displayname" => "Email",
        "required" => true,
        "exists" => "users"
      ),
      "password" => array(
        "displayname" => "Password",
        "required" => true
      )
    );
  
}