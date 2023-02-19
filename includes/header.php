<?php
include("mysql_connect.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="This is a PHP/MySQL Project that contains a hockey player database. Features include filtered searches, CRUD options, embedded youtube videos, filtered carousel options.">
    <meta name="author" content="Abraar Ahmed">
   
    <!--  This CONSTANT is defined in your mysql_connect.php file. -->
    <title><?php echo APP_NAME; ?> - Home</title>
    <!-- icon -->
    <link rel="icon" type="image/svg" href="img/favicon.svg">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<!-- google fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif&display=swap" rel="stylesheet">



<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<!-- Google Icons: https://material.io/tools/icons/
  also, check out Font Awesome or Glyphicons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!-- Load icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


 <!-- Your Custom styles for this project -->
 <!--  Note how we can use BASE_URL constant to resolve all links no matter where the file resides. -->
<link href="<?php echo BASE_URL ?>css/styles.css" rel="stylesheet">
<!-- Themes from https://bootswatch.com/ : Use the Themes dropdown to select a theme you like; copy/paste the bootstrap.css. Here, we have named the downloaded theme as a new file and can overwrite the default.  -->
<!-- <link href="<?php echo BASE_URL ?>css/bootstrap-lumen.css" rel="stylesheet"> -->
</head>
<header>
<div class="banner">

</div>
</header>
  <nav class="navbar navbar-expand-md mb-4 navbar-dark sticky-top">
  <div class="container-fluid">
  <a class="navbar-brand" href="<?php echo BASE_URL ?>index.php">
    <img src="img/hockey.svg" width="30" height="30" class="d-inline-block align-top" alt="">
    Hockey Players
  </a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
  </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto"> 
        <li class="nav-item">
         <a class="nav-link" href="<?php echo BASE_URL ?>index.php">Home</a>
        </li>

        <li class="nav-item">
        <a class="nav-link active" href="<?php echo BASE_URL ?>display.php">Display</a>
      </li>
          
      <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">Admin</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
             <li><a class="dropdown-item" href="admin/insert.php">Insert</a></li>
             <li><a class="dropdown-item" href="admin/edit-delete.php">Edit/Delete</a></li>
             <li><hr class="dropdown-divider"></li>
             <li><a class="dropdown-item" href="admin/logout.php">Login/Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
      </div>
    </nav>
    <body>
    <main role="main" class="container">

