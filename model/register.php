<?php 
//register action page
 include './crud.php'; 
 $secret = include '../credentials.php';

 if(isset($_POST['register'])){

     $arr = array(
         'fullname' => $_POST['fullname'],
         'username' => $_POST['username'],
         'password' => $_POST['password'], 
     );

     $encoded = json_encode($arr);

     $crud = new LoginRegister();
     $crud->_register($encoded, $secret);
     
    //  if($secret){
    //     echo "<script>console.log(".$secret.")</script>";   
    //  } else {
    //     echo "<script>console.log('error')</script>";   
    //  }
            
 }


?>

