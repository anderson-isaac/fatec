<?php include('config/config.php'); 
	header('Content-Type: application/json'); 

	$id_vaga = 0;

	if((isset($_SESSION['Usuario']) && $_SESSION['Usuario']!='') && (isset($_SESSION['Tipo']) &&  $_SESSION['Tipo']==1) && (isset($_POST['Id_vaga']) && $_POST['Id_vaga']!='')){

		$id_vaga = clean($_POST['Id_vaga']);
		$q = Query('SELECT * FROM vaga WHERE Vaga = '.$id_vaga.'',0);
		    
		if(mysqli_num_rows($q) > 0){
			Query('DELETE FROM vaga WHERE Vaga = '.$id_vaga.'',0);
			$resposta['status'] = 'success';
		}else{
			$resposta['status'] = 'error';	
		}   

	}else{
		$resposta['status'] = 'error';
	}

	echo json_encode($resposta);
	exit;

