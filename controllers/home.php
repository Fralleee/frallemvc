<?php

class Home extends Controller
{
  public function index($name = "")
  {
    $this->authorize = false;

    $user = $this->model("User");
    $user->name = $name;

    /*
    $user = DB::getInstance()->query("select * from users where name = ?", array("roland"));
    $user = DB::getInstance()->get("users", array("name", "=", "roland"))->first();
    $userUpdate = DB::getInstance()->update("users", 4, array("email" => "hehe"));

    if($user)
      echo $user->name."<br/>";
    else
      echo "No user found!";
    */
          
    //$userInsert = DB::getInstance()->update("users", 3,array(
    //  "email" => "Greger",
    //  "password" => "hehee"
    //));

    //$this->view("home/index", null);

    $this->view();
  }

}