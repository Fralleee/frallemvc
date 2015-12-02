<?php

class Account extends Controller
{

  public function index()
  {
    $this->authorize = true;
    $this->view();
  }

  public function register()
  {
    $model = $this->model("RegisterViewModel");
    $data = (array)$model;
    $this->view($data);
  }

  public function login()
  {
    if(!empty($_POST)){
      $this->PostLogin();
    }
    else
    {
      $numargs = func_get_args();
      $this->GetLogin($numargs);
    }

  }

  public function logout()
  {
    if(isset($_SESSION["loggedin"]))
      session_unset($_SESSION["loggedin"]);

    $this->view();
  }


  private function PostLogin()
  {
    $loginText = "Login";
    $email = UrlHelpers::ValidateInput($_POST["email"]);
    $password = UrlHelpers::ValidateInput($_POST["password"]);
    $returnUrl =  UrlHelpers::ValidateInput($_POST["returnUrl"]);
    $error = $this->ValidateLogin($email, $password);
    
    if(count($error) > 0)
    {
      $this->view("account/login", [
        "welcome" => $loginText, 
        "returnUrl" => $returnUrl,
        "email" => $email,
        "error" => $error
      ]); 
    }

    else
    {
      $_SESSION["loggedin"] = true;
      if($returnUrl)
        Redirect::to($returnUrl);
      else
        Redirect::to("/phpmvc/home");
    }

  }

  private function GetLogin($numargs)
  {
    $loginText = "Login";
    $returnUrl = "";
    //$i = 1;
    foreach($numargs as $arg)
    {
      $returnUrl .= "/" . UrlHelpers::ValidateInput($arg);
      //$returnUrl .= ($i != count($numargs)) ? "/" : "";
      //$i++;
    }

    if(isset($returnUrl)) {
      $returnUrl = htmlspecialchars($returnUrl);
    }

    // Gör hidden input i login view med returnUrl
    $this->view("account/login", [
      "welcome" => $loginText, 
      "returnUrl" => $returnUrl
    ]);
  }

  private function ValidateLogin($email, $password)
  {
    if($email == "" || $email == null)
      $error = "Enter your email";
    else if($password == "" || $password == null)
      $error = "Wrong password";
    else 
      $error = null;

    return $error;
  }

}