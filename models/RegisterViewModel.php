<?php

class RegisterViewModel{

  public $validationdata = array(
      "email" => array(
        "displayname" => "Email",
        "required" => true,
        "max" => 20,
        "unique" => "users"
      ),
      "password" => array(
        "displayname" => "Password",
        "required" => true,
        "min" => 6
      ),
      "password_again" => array(
        "displayname" => "Confirm password",
        "required" => true,
        "matches" => "password"
      ),
      "name" => array(
        "displayname" => "Name",
        "min" => 2,
        "max" => 50
      )
    );
}