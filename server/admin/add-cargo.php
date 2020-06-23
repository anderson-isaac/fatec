<?php include('config/config.php'); 
header('Content-Type: application/json');

$titulo = '';
$resp   = array();
$id     = 0;

if(isset($_POST['Novo_cargo']) &&  $_POST['Novo_cargo']!=''){
	$titulo = clean($_POST['Novo_cargo']);	
	$id = Insert('INSERT INTO cargo(Titulo) values("'.$titulo.'")');
	if($id!=0){
		$resp['status']  = 'success';
		$resp['cargo']    = $titulo;
		$resp['cargo_id'] = $id;	
	}else{
		$resp['status']  = 'error';
		$resp['cargo']    = '';
		$resp['cargo_id'] = '';		
	}
}else{
	$resp['status']  = 'error';
	$resp['cargo']    = '';
	$resp['cargo_id'] = '';
}

echo json_encode($resp);
exit;

