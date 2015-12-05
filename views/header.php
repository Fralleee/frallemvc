<!doctype html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php UrlHelpers::GetCss('main');?>">
    <title>Fralle Mvc</title>
</head>
<body>
<header>  
  <nav>
    <a href="/frallemvc/home">Home</a>
    <?php if($this->Authenticate()): ?>
      <a href="/frallemvc/account">Manage</a>
      <a href="/frallemvc/account/logout">Log out</a>
    <?php else: ?>
      <a href="/frallemvc/account/login">Login</a>
    <?php endif; ?>
  </nav>
</header>
<div class="content">
