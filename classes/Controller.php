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

  private function GenerateView()
  {
    $method = strtolower(get_class($this));
    $action = strtolower(debug_backtrace()[2]['function']);
    return "$method/$action";
  }

  //public function view($view, $data = [])
  public function view()
  {
    if($this->authorize && !$this->Authenticate())
      header("Location:account/login" . $_SERVER['REQUEST_URI']);

    $args = func_get_args();

    // No args
    if(count($args) == 0)
        $view = $this->GenerateView();

    // One arg
    else if(count($args) == 1)
    {
      // If string => view
      if(is_string($args[0]) && $args[0] != null){
        $view = $args[0];
      }
      // Else => model
      else{
        $view = $this->GenerateView();
        $data = $args[0];
      }
    }

    // 2 args => view + model || model + view
    else if(count($args) > 1)
    {
      $view = is_string($args[0]) ? $args[0] : $args[1];
      $data = is_string($args[0]) ? $args[1] : $args[0];
    }

    // Else error?
    else
      return false;
      
    require_once "views/header.php";
    echo "<h1>$view</h1><hr/>";
    require_once "views/$view.php";
    require_once "views/footer.php";
  }

      
}