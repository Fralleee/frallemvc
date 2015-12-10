<?php

class Admin extends Controller
{
  public function index($name = "")
  {
    $this->authorize = true;
    $this->view("admin/index");
  }

}