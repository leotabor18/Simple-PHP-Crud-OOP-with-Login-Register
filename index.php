<?php 
    session_start();

    if(isset($_SESSION['fullname'])){
        session_destroy();
        header("Location: /index.php");
    }
 ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./CSS/stylesheet.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>PHP CRUD with LOG IN/REGISTER SYSTEM</title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg p-1 navbar-dark shadow-sm rounded">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><h2>My Online Diary</h2></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item me-4">
                        <a class="nav-link " aria-current="page" data-bs-toggle="modal" data-bs-target="#Modal-login">Login</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#Modal">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="container-fluid d-flex justify-content-center  align-items-center flex-column">
      <h3 class="mt-5 mb-4 ">Write down your feelings and thoughts here</h3>
      <button type="button" class="btn  btn-secondary border-top-0 p-2 shadow rounded" data-bs-toggle="modal" data-bs-target="#Modal">Get Started</button>
    </main>
    <footer class="container-fluid developer d-flex justify-content-end align-items-end flex-column">
        <small class="m-0">a Simple PHP Crud website with Login/Register System</small>
        <small class="m-0">Built by Leonardo Tabor</small> 
    </footer>
    
    <div class="modal fade show" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Register</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form-register" action='' method="POST">
                <div class="modal-body pt-0 pb-2">
                    <div class="mb-2">
                        <label for="fullname" class="col-form-label">Fullname:</label>
                        <input type="text" id="fullname" class="form-control" name='fullname'>
                    </div>
                    <div class="mb-2">
                        <label for="username" class="col-form-label">Username:</label>
                        <input type="text" class="form-control" id="username" name='username'>
                    </div>
                    <div class="mb-2">
                        <label for="password" ty class="col-form-label">Password:</label>
                        <input class="form-control" id="password" type="password" name="password"></input>
                    </div>
                    <div class="mb-2">
                        <label for="confirm_password" ty class="col-form-label">Confirm Password:</label>
                        <input class="form-control" id="confirm_password" type="password" name="confirm_password"></input>
                    </div>
                </div>
                <div class="modal-footer d-flex flex-column">
                    <small id="error-register" class="error align-self-start"></small>
                    <div class=" btns-form">
                        <button type="button" class="btn-change btn btn-secondary me-1" name="register" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#Modal-login" >Login</button>
                        <button class="btn btn-primary me-1" type="submit" name="register" id="register">Register</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    <div class="modal fade show" id="Modal-login" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Log in</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form-login" action='' method="POST">
                <div class="modal-body pt-0 pb-2">
                    <div class="mb-2">
                        <label for="name" class="col-form-label">Username:</label>
                        <input type="text" id="name" class="form-control" id="name" name='username'>
                    </div>
                        <div class="mb-2">
                        <label for="login_password" ty class="col-form-label">Password:</label>
                        <input class="form-control" id="login_password" type="password" name="password"></input>
                    </div>
                </div>
                <div class="modal-footer d-flex flex-column">
                    <small id="success" class="align-self-start"></small>
                    <small id="error-login" class="error align-self-start"></small>
                    <div class=" btns-form">
                        <button type="button" class="btn-change btn btn-secondary me-1" name="register" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#Modal" >Register</button>
                        <button class="btn btn-primary me-1" id="login" type="submit" name="login">Login</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    <?php include './Modal/error-display.php';
    include './Modal/crud.php';

    $credentials = array(
        'username' => "ukkyn2dznzmkrthe",
        'password' => "EyGzX2ECAXg904cDhBNL",
        'host' => "bpglhv6d8zls7rbm7myi-mysql.services.clever-cloud.com", 
        'dbase' => "bpglhv6d8zls7rbm7myi",
    );

    $encoded = json_encode($credentials);
    
    $crud = new Crud();
    $register = $crud->_connect($encoded);
    ?>
    <script src="./Javascript/index.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </body>
</html>