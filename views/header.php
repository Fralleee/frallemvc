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
    <a href="/phpmvc/home">Home</a>
    <?php if($this->Authenticate()): ?>
      <a href="/phpmvc/account">Manage</a>
      <a href="/phpmvc/account/logout">Log out</a>
    <?php else: ?>
      <a href="/phpmvc/account/login">Login</a>
    <?php endif; ?>
  </nav>
</header>
<div class="content">
