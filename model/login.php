<?php 
//login action page
include './crud.php'; 
$secret = include '../credentials.php';

if(isset($_POST['login'])){
    $arr = array(
        'username' => $_POST['username'],
        'password' => $_POST['password'], 
    );
    $encoded = json_encode($arr);

    $crud = new LoginRegister();
    $crud->_login($encoded, $secret);  
}

?>