<?php include('config/config.php'); 
header('Content-Type: application/json');

$titulo = '';
$resp   = array();
$id     = 0;

if(isset($_POST['Nova_empresa']) &&  $_POST['Nova_empresa']!=''){
	$titulo = clean($_POST['Nova_empresa']);	

	$ramo     = '';
	$endereco = '';
	$contato  = '';
	if(isset($_POST['Ramo']) &&  $_POST['Ramo']!=''){
		$ramo = clean($_POST['Ramo']);
	}	

	if(isset($_POST['Endereco']) &&  $_POST['Endereco']!=''){
		$endereco = clean($_POST['Endereco']);
	}	

	if(isset($_POST['Contato']) &&  $_POST['Contato']!=''){
		$contato = clean($_POST['Contato']);
	}		

	$id = Insert('INSERT INTO empresa(Titulo,Ramo,Endereco,Contato) values("'.$titulo.'","'.$ramo.'","'.$endereco.'","'.$contato.'")');
	if($id!=0){
		$resp['status']  = 'success';
		$resp['empresa']    = $titulo;
		$resp['empresa_id'] = $id;	
	}else{
		$resp['status']  = 'error';
		$resp['empresa']    = '';
		$resp['empresa_id'] = '';		
	}
}else{    
	$resp['status']  = 'error';
	$resp['empresa']    = '';
	$resp['empresa_id'] = '';
}

echo json_encode($resp);
exit;

