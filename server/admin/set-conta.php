<?php 	include('config/config.php');
		header('Content-Type: application/json'); 

		$resposta = array();

		if((isset($_SESSION['Usuario']) &&  $_SESSION['Usuario']!='') && (isset($_SESSION['Tipo']) &&  $_SESSION['Tipo']==1)){
			$q_user = Query('SELECT * FROM usuario WHERE Usuario = '.$_SESSION['Usuario'].'',0);
			if(mysqli_num_rows($q_user) > 0){

				$path = '../imagens/';
				if(!is_dir($path)){
					mkdir($path);
				}
			 
				$allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
				if(isset($_FILES['Capa']) && $_FILES['Capa']!=''){
					

					$detectedType = exif_imagetype($_FILES['Capa']['tmp_name']);
					$error = !in_array($detectedType, $allowedTypes);
					if(!$error){
						
						$name_aux = explode('.',$_FILES['Capa']['name']);
						$new_name = $better_token = md5(uniqid(rand(), true)).'.'.$name_aux[1];
						$new_path = $path.$new_name;
						
						if(move_uploaded_file($_FILES['Capa']['tmp_name'],$new_path)){
							Query('UPDATE usuario SET Imagem = "'.$new_name.'" WHERE Usuario = '.$_SESSION['Usuario'].'',0);
						}
					}
				}    

				Query('UPDATE usuario SET Nome = "'.clean($_POST['Nome']).'",Texto = "'.clean($_POST['Apresentacao']).'" WHERE Usuario = '.$_SESSION['Usuario'].'',0);

				$resposta['status'] = 1;
				$resposta['erro']   = '';
			}
		}

		echo json_encode($resposta);
		exit;

