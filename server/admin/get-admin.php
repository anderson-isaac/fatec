<?php 	include('config/config.php');
		header('Content-Type: application/json'); 

		$resposta = array();

		$_POST = json_decode(file_get_contents("php://input"),true);

		if((isset($_SESSION['Usuario']) && $_SESSION['Usuario']!='') && (isset($_SESSION['Tipo']) && $_SESSION['Tipo']=='1')){

			$q_user = Query('SELECT * FROM usuario WHERE Usuario = '. $_SESSION['Usuario'] .'',0);
			if(mysqli_num_rows($q_user) > 0){
				$r_user = mysqli_fetch_assoc($q_user);
				
				$resposta['id']           = $r_user['Usuario'];
				$resposta['nome']         = $r_user['Nome'];
				if ($r_user['Imagem']) {
					$resposta['capa']         = 'server/imagens/'.$r_user['Imagem'];
				} else {
					$resposta['capa']         = 'assets/images/avatar.jpg';
				}
				$resposta['apresentacao'] = $r_user['Texto'];
				$resposta['email']        = $r_user['Email'];
			}

		

		}

		echo json_encode($resposta);
		exit;

