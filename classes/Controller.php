<?php

class Controller
{
  public $authorize = false;
  private function Authenticate()
  {
    return Session::get("loggedin");
  }

  public function model($model)
  {
    require_once "models/$model.php";
    return new $model();
  }

  public function view($view, $data = [])
  {
    if($this->authorize && !$this->Authenticate())
      header("Location:account/login" . $_SERVER['REQUEST_URI']);
      
    require_once "views/header.php";
    echo "<h1>$view</h1><hr/>";
    require_once "views/$view.php";
    require_once "views/footer.php";
  }

      
}