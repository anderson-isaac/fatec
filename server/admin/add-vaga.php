<?php include('config/config.php'); 
header('Content-Type: application/json');

$titulo = '';
$resp   = array();
$id     = 0;



if((isset($_SESSION['Usuario']) &&  $_SESSION['Usuario']!='') && (isset($_SESSION['Tipo']) &&  $_SESSION['Tipo']==1) && (isset($_POST['Descricao']) &&  $_POST['Descricao']!='') && (isset($_POST['Cargo']) &&  $_POST['Cargo']!='') && (isset($_POST['Tipo']) &&  $_POST['Tipo']!='') && (isset($_POST['Empresa']) &&  $_POST['Empresa']!='') && (isset($_POST['Situacao']) &&  $_POST['Situacao']!='') && (isset($_POST['Data_da_postagem']) &&  $_POST['Data_da_postagem']!='') && (isset($_POST['Prazo_de_validade']) &&  $_POST['Prazo_de_validade']!='')){
	   
	$descricao 		= clean($_POST['Descricao']);	
	$cargo  		= clean($_POST['Cargo']);	
	$tipo   		= clean($_POST['Tipo']);	
	$remuneracao 	= str_replace(',','.',str_replace('.','',clean($_POST['Remuneracao'])));	
	$valor_da_bolsa = str_replace(',','.',str_replace('.','',clean($_POST['Valor_da_bolsa'])));	
	$diferencial 	= clean($_POST['Diferencial']);	
	$beneficios 	= clean($_POST['Beneficios']);	
	$empresa 		= clean($_POST['Empresa']);	
	$email 			= clean($_POST['Email']);	
	$whatsapp 		   = clean($_POST['Whatsapp']);	
	$situacao 		   = clean($_POST['Situacao']);
	$data_postagem     = data_americana(clean($_POST['Data_da_postagem']));	
	$prazo_de_validade = data_americana(clean($_POST['Prazo_de_validade']));	

	$id = Insert('INSERT INTO `vaga`(`Descricao`, `Cargo`, `Tipo`, `Remuneracao`, `Valor_da_bolsa`, `Diferencial`, `Beneficios`, `Empresa`, `Email`, `Whatsapp`, `Situacao_da_vaga`, `Data_postagem`, `Data_validade`, `Usuario`) VALUES ("'.$descricao.'",'.$cargo.','.$tipo.',"'.$remuneracao.'","'.$valor_da_bolsa.'","'.$diferencial.'","'.$beneficios.'",'.$empresa.',"'.$email.'","'.$whatsapp.'","'.$situacao.'","'.$data_postagem.'","'.$prazo_de_validade.'",'.$_SESSION['Usuario'].')');    
	     
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

