<?php  header('Content-Type: application/json');   
	   session_start();
	
		$arr = array();
		if(isset($_SESSION['Usuario']) && $_SESSION['Usuario']!='' && is_numeric($_SESSION['Usuario'])){
			$arr['status'] = true;
			$arr['tipo']   = $_SESSION['Tipo'];
		}else{
			$arr['status'] = false;
		}

		echo json_encode($arr);

		exit;