<?php 	include('config/config.php');
        header('Content-Type: application/json'); 


        

		$resposta = array();

		$_POST = json_decode(file_get_contents("php://input"),true);

		if((isset($_SESSION['Usuario']) && $_SESSION['Usuario']!='')){

			if (isset($_POST['id']) && $_POST['id'] != '') {

				$id = clean($_POST['id']);	
				$q_user = Query('SELECT * FROM usuario WHERE Usuario = '. $id .'',0);
				if(mysqli_num_rows($q_user) > 0){
					$r_user = mysqli_fetch_assoc($q_user);
					
					$resposta['id']           = $r_user['Usuario'];
					$resposta['nome']         = $r_user['Nome'];
					$resposta['foto']         = $r_user['Imagem'];
					$resposta['apresentacao'] = $r_user['Texto'];
					$resposta['email']        = $r_user['Email'];
				}

			} 

		}

		echo json_encode($resposta);
		exit;

?>