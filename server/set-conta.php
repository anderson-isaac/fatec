<?php 	include('admin/config/config.php');
		header('Content-Type: application/json'); 

		$resposta = array();
		$curriculo_nome = ''; 
      	

		if((isset($_SESSION['Usuario']) &&  $_SESSION['Usuario']!='') && (isset($_SESSION['Tipo']) &&  $_SESSION['Tipo']==2)){
			$q_user = Query('SELECT * FROM usuario WHERE Usuario = '.$_SESSION['Usuario'].'',0);
			if(mysqli_num_rows($q_user) > 0){

				$path = '../curriculo/';
				if(!is_dir($path)){
					mkdir($path);
				}
			 
				$allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
				if(isset($_FILES['Curriculo']) && $_FILES['Curriculo']['name'] !=''){
					

					$detectedType = exif_imagetype($_FILES['Curriculo']['tmp_name']);
					$error = !in_array($detectedType, $allowedTypes);
					if(!$error){
						
						$name_aux = explode('.',$_FILES['Curriculo']['name']);
						$new_name = $better_token = md5(uniqid(rand(), true)).'.'.$name_aux[1];
						$new_path = $path.$new_name;
						
						if(move_uploaded_file($_FILES['Curriculo']['tmp_name'],$new_path)){
							Query('UPDATE usuario SET Curriculo = "'.$new_name.'" WHERE Usuario = '.$_SESSION['Usuario'].'',0);
						}
					}
				}     
	     
				Query('UPDATE usuario SET Nome = "'.clean($_POST['Nome']).'",Email = "'.clean($_POST['Email']).'",Celular = "'.clean($_POST['Telefone']).'"  WHERE Usuario = '.$_SESSION['Usuario'].'',0);   

				$resposta['status'] = 1;
				$resposta['erro']   = '';

			}else{
				$resposta['status'] = 0;
				$resposta['erro']   = 'falha no login';
			}
		}else{
			$resposta['status'] = 0;
			$resposta['erro']   = 'falha no login';
		}

		echo json_encode($resposta);
		exit;

