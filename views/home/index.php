<?php
  if(Session::exists("home"))
  {
    echo "<h2>".Session::flash("home")."</h2>";
  }
?>