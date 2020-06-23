<?php  header('Content-Type: application/json');   
	   session_start();
	
		$arr = array();
		if(isset($_SESSION['User']) && $_SESSION['User']!='' && is_numeric($_SESSION['User'])){
			$arr['status'] = false;
			$arr['tipo']   = $_SESSION['Tipo'];
		}else{
			$arr['status'] = false;
		}

		echo json_encode($arr);
		exit;