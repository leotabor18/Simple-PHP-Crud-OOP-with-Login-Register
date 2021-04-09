<?php 
//register action page
 include './crud.php';

 if(isset($_POST['register'])){

     $arr = array(
         'fullname' => $_POST['fullname'],
         'username' => $_POST['username'],
         'password' => $_POST['password'], 
     );

     $encoded = json_encode($arr);

     $crud = new LoginRegister();
    //  $register = $crud->_register($encoded); 
    //  echo $register;           
 }


?>

