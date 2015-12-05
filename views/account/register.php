<?php

  if(Input::exists() && Token::check(Input::get("token")))
  {
    $validate = new Validate();
    $validation = $validate->check($_POST, $data["validationdata"]);

    if($validation->passed())
    {
      $user = new User();
      $salt = Hash::salt(32);

      try
      {
        $user->create(array(
          "email" => Input::get("email"),
          "password" => Hash::make(Input::get("password"), $salt),
          "salt" => $salt,
          "name" => Input::get("name"),
          "created" => date("Y-m-d H:i:s"),
          "role" => 1
        ));

        Session::flash("home", "Success! You are now registered.");
        Session::put("loggedin", true);
        Redirect::to("/frallemvc/home");
      }
      catch(Exception $e)
      {
        die($e->getMessage());
      }
    }
    else
      $errors = $validation->errors();
  }

?>

<div class="form">
<form action="" method="post">

  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" name="email" id="email" value="<?php echo escape(Input::get("email")); ?>" placeholder="Enter email" autocomplete="off">
    <p style="font-weight: bold; color: firebrick;">
      <?php 
        if(isset($errors["email"]))
          echo $errors["email"];
      ?>
    </p>
  </div>

  <div class="form-group">
    <label for="password">Choose a password</label>
    <input type="password" class="form-control" name="password" id="password" value="">
    <p style="font-weight: bold; color: firebrick;">
      <?php 
        if(isset($errors["password"]))
          echo $errors["password"];
      ?>
    </p>
  </div>

  <div class="form-group">
    <label for="password_again">Repeat password</label>
    <input type="password" class="form-control" name="password_again" id="password_again" value="">
    <p style="font-weight: bold; color: firebrick;">
      <?php 
        if(isset($errors["password_again"]))
          echo $errors["password_again"];
      ?>
    </p>
  </div>

  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name" value="<?php echo escape(Input::get("name")); ?>" placeholder="Enter name" autocomplete="off">
    <p style="font-weight: bold; color: firebrick;">
      <?php 
        if(isset($errors["name"]))
          echo $errors["name"];
      ?>
    </p>
  </div>

  <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
  <input type="submit" class="btn btn-primary" value="Register">

</form>
</div>