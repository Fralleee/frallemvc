<?php

  $returnUrl = "";
  $email = "";
  $welcome = "";
  if($data)
  {
    if(array_key_exists("email", $data)){      
      $returnUrl = $data["returnUrl"];
    }
    if(array_key_exists("email", $data)){
      $email = $data["email"];
    }
    if(array_key_exists("welcome", $data)){
      $welcome = $data["welcome"];
    }
  }
?>

<h1 class="welcome"><?php echo $welcome; ?> </h1>
<em>Returning from URL: <?php echo $returnUrl; ?></em>

<?php 
  
if(!empty($data["error"]))
{
  $error = $data["error"];
  echo "<h2 class='error'>$error</h2>";
}

if(Input::exists())
{
  if(Token::check(Input::get("token")))
  {
    $validate = new Validate();
    $validation = $validate->check($_POST, $data["validationdata"]);

    if($validation->passed())
    {
      // Log user in
    }
    else{
      foreach($validation->errors() as $error)
      {
        echo $error;
      }
    }
  }
}

?>
<div class="form">

  <form method="post">
    <input type="hidden" name="returnUrl" value="<?php echo $returnUrl ?>">

    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" placeholder="Enter email" autocomplete="off">
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" name="password" value="" placeholder="" autocomplete="off">
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    <input type="submit" class="btn btn-primary" value="Login">
  </form>

</div>

