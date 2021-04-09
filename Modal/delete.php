<?php 
include './crud.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $user_id = $_GET['user_id'] ;

    $crud = new LoginRegister();
    $login = $crud-> _delete($id, $user_id);  
}

?>