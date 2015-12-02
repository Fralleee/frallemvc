<?php

  if(Session::exists("success")){

    echo "<div class='alert alert-success'><h3 style='color: green;'>";
    echo Session::flash("success");
    echo "</h3></div>";
  }

?>