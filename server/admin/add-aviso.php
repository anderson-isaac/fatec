<?php include('config/config.php'); 
header('Content-Type: application/json');

$resp   = array();
$id     = 0;

if((isset($_SESSION['Usuario']) &&  $_SESSION['Usuario']!='') && (isset($_SESSION['Tipo']) &&  $_SESSION['Tipo']==1) && (isset($_POST['Titulo']) &&  $_POST['Titulo']!='') && (isset($_POST['Texto']) &&  $_POST['Texto']!='')){
	   
	$titulo 		= clean($_POST['Titulo']);	
	$texto  		= clean($_POST['Texto']);	

	$id = Insert('INSERT INTO `aviso`(`Titulo`, `Texto`, `Imagem`, `Usuario`, `Data`) VALUES ("'.$titulo.'","'.$texto.'","'.$capa.'",'.$_SESSION['Usuario'].',NOW())');    
	
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
				Query('UPDATE aviso SET Imagem = "'.$new_name.'" WHERE Aviso = '.$id.'',0);
			}
		}
	}    





	if($id!=0){
		$resp['status']  = 'success';	
	}else{
		$resp['status']  = 'error';	
	}

}else{
	$resp['status']  = 'error';
}

echo json_encode($resp);
exit;

