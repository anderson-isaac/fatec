<?php 	include('config/config.php');
		header('Content-Type: application/json'); 

		$resposta = array();

		if((isset($_SESSION['Usuario']) &&  $_SESSION['Usuario']!='') && (isset($_SESSION['Tipo']) &&  $_SESSION['Tipo']==1)){
			$q_user = Query('SELECT * FROM usuario WHERE Usuario = '.$_SESSION['Usuario'].'',0);
			if(mysqli_num_rows($q_user) > 0){
				$r_user = mysqli_fetch_assoc($q_user);
				
				$resposta['id']           = $r_user['Usuario'];
				$resposta['nome']         = $r_user['Nome'];
				$resposta['capa']         = 'server/imagens/'.$r_user['Imagem'];
				$resposta['apresentacao'] = $r_user['Texto'];
				$resposta['email']        = $r_user['Email'];
			}
		}

		echo json_encode($resposta);
		exit;

