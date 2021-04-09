<?php
//logout user by resetting session
	session_start();
	session_unset();
	header("Location: ./index.php");

?>