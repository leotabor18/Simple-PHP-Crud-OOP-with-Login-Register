<?php 
include './crud.php';

if(isset($_POST['login'])){
    $arr = array(
        'username' => $_POST['username'],
        'password' => $_POST['password'], 
    );
    $encoded = json_encode($arr);

    $crud = new LoginRegister();
    $login = $crud->_login($encoded);  
}

?>