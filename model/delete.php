<?php 
//delete action page
include './model/crud.php';
$secret = include '../credentials.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $user_id = $_GET['user_id'] ;

    $crud = new LoginRegister();
    $login = $crud-> _delete($id, $user_id, $secret);  
}

?>