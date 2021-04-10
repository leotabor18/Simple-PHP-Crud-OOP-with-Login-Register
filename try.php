<?php 
 $host ='bpglhv6d8zls7rbm7myi-mysql.services.clever-cloud.com';
 $username ='ukkyn2dznzmkrthe';
 $pass ='EyGzX2ECAXg904cDhBNL';
 $dbase ='bpglhv6d8zls7rbm7myi';
 try 
 {
     $connect = new mysqli($host, $username , 
     $pass, $dbase);

     if($connect){
        echo 'connected!';
     }
 }catch (Exception $e)
 {
     echo 'Error'.$e->getMessage();
 }

?>