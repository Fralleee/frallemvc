<?php

  $returnUrl = $data["returnUrl"];
  if(array_key_exists("email", $data)){
    $email = $data["email"];
  }
  else{
    $email = "";
  }

?>

<h1 class="welcome"><?php echo $data["welcome"]; ?> </h1>
<em>Returning from URL: <?php echo $returnUrl; ?></em>

<?php 
	
 	if(!empty($data["error"]))
	{
		$error = $data["error"];
 		echo "<h2 class='error'>$error</h2>";
	}

?>
 
 <hr/>
<div class="form">
  <form method="post">
    <input type="hidden" name="returnUrl" value="<?php echo $returnUrl ?>" />

    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" placeholder="Enter email" />
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" name="password" value="" placeholder="" />
    </div>

    <input type="submit" class="btn btn-primary" value="Login" />
  </form>
</div>

