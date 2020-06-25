<?php include('config/config.php'); 
header('Content-Type: application/json');

$titulo = '';
$resp   = array();
$id     = 0;

if (isset($_POST['Remuneracao']) &&  $_POST['Remuneracao']!='') {
	$remuneracao = clean($_POST['Remuneracao']);
	$remuneracao = str_replace(',','.',$remuneracao);
	$remuneracao = str_replace('.','',$remuneracao);
} else {
	$remuneracao = "";
}

if (isset($_POST['Valor_da_bolsa']) &&  $_POST['Valor_da_bolsa']!='') {
	$valor_da_bolsa = clean($_POST['Valor_da_bolsa']);
	$valor_da_bolsa = str_replace(',','.',$valor_da_bolsa);
	$valor_da_bolsa = str_replace('.','',$valor_da_bolsa);
} else {
	$valor_da_bolsa = "";
}


if((isset($_SESSION['Usuario']) &&  $_SESSION['Usuario']!='') && (isset($_SESSION['Tipo']) &&  $_SESSION['Tipo']==1) && (isset($_POST['Descricao']) &&  $_POST['Descricao']!='') && (isset($_POST['Cargo']) &&  $_POST['Cargo']!='') && (isset($_POST['Empresa']) &&  $_POST['Empresa']!='') && (isset($_POST['Prazo_de_validade']) &&  $_POST['Prazo_de_validade']!='')) {

	$descricao 		= (isset($_POST['Descricao']) && $_POST['Descricao'] != "") ? clean($_POST['Descricao']) : "";
	$cargo  		= (isset($_POST['Cargo']) && $_POST['Cargo'] != "") ? clean($_POST['Cargo']) : "";
	$tipo   		= (isset($_POST['Tipo']) && $_POST['Tipo'] != "") ? clean($_POST['Tipo']) : "";
	$diferencial 	= (isset($_POST['Diferencial']) && $_POST['Diferencial'] != "") ? clean($_POST['Diferencial']) : "";
	$beneficios 	= (isset($_POST['Beneficios']) && $_POST['Beneficios'] != "") ? clean($_POST['Beneficios']) : "";
	$empresa 		= (isset($_POST['Empresa']) && $_POST['Empresa'] != "") ? clean($_POST['Empresa']) : "";
	$email 			= (isset($_POST['Email']) && $_POST['Email'] != "") ? clean($_POST['Email']) : "";
	$whatsapp 		   = (isset($_POST['Whatsapp']) && $_POST['Whatsapp'] != "") ? clean($_POST['Whatsapp']) : "";
	$situacao 		   = (isset($_POST['Situacao']) && $_POST['Situacao'] != "") ? clean($_POST['Situacao']) : "";
	$data_postagem     = (isset($_POST['Data_da_postagem']) && $_POST['Data_da_postagem'] != "") ? data_americana(clean($_POST['Data_da_postagem'])) : "";
	$prazo_de_validade = (isset($_POST['Prazo_de_validade']) && $_POST['Prazo_de_validade'] != "") ? data_americana(clean($_POST['Prazo_de_validade'])) : "";

	$id = Insert('INSERT INTO `vaga`(`Descricao`, `Cargo`, `Tipo`, `Remuneracao`, `Valor_da_bolsa`, `Diferencial`, `Beneficios`, `Empresa`, `Email`, `Whatsapp`, `Situacao_da_vaga`, `Data_postagem`, `Data_validade`, `Usuario`) VALUES ("'.$descricao.'",'.$cargo.','.$tipo.',"'.$remuneracao.'","'.$valor_da_bolsa.'","'.$diferencial.'","'.$beneficios.'",'.$empresa.',"'.$email.'","'.$whatsapp.'","'.$situacao.'","'.$data_postagem.'","'.$prazo_de_validade.'",'.$_SESSION['Usuario'].')');    
	     
	if($id!=0){
		$resp['status']  = 'success';	
	}else{
		$resp['status']  = 'error';	
	}
}else{
	$resp['status']  = 'error';
	$resp['mensagem']  = 'Existem campos obrigatórios que não foram preenchidos.';
}

echo json_encode($resp);
exit;

