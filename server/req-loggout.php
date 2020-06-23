<?php  	session_start();
		$_SESSION['Usuario'] = '';
		unset($_SESSION['Usuario']);
 		session_destroy();
