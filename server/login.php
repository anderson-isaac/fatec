<?php 	include('admin/config/config.php');
		header('Content-Type: application/json'); 

		$login = '';
		if(isset($_POST['Login']) && $_POST['Login']!=''){
			$login = clean($_POST['Login']);
		}else{
			$resposta['status'] = 0;
			$resposta['erro'] = "Preencha o login";
		}

		$senha = '';
		if(isset($_POST['Senha']) && $_POST['Senha']!=''){
			$senha = clean($_POST['Senha']);
		}else{
			$resposta['status'] = 0;
			$resposta['erro'] = "Preencha a senha";
		}
    
		$tipo = '';
		if(isset($_POST['Tipo_acesso']) && $_POST['Tipo_acesso']!=''){
			$tipo = clean($_POST['Tipo_acesso']);
			if($tipo=='professor'){
				$tipo = 1;
			}else if($tipo=='aluno'){
				$tipo = 2;
			}
		}else{
			$resposta['status'] = 0;
			$resposta['erro'] = "Preencha o tipo de acesso";
		}    

		$q_user = Query('SELECT * FROM usuario WHERE Email = "'.$login.'" AND Tipo = '.$tipo.'',0);
		if(mysqli_num_rows($q_user) > 0) {
			$r_user = mysqli_fetch_assoc($q_user);

			if($r_user['Tipo']==1){
				$resposta['tipo_acesso'] = "professor";					
				$_SESSION['Tipo'] = 1;
			}else if($r_user['Tipo']==2){
				$resposta['tipo_acesso'] = "aluno";
				$_SESSION['Tipo'] = 2;
			}

			if($r_user['Senha']==md5($senha)){
				
				$resposta['status'] = 1;

				$resposta['erro'] = "";

				$_SESSION['Usuario'] = $r_user['Usuario'];
				

			}else{
				$resposta['status'] = 0;
				$resposta['erro'] = "Senha incorreta";
			}

		}else{
			$resposta['status'] = 0;
			$resposta['erro'] = "Usuário não encontrado";
		}

		echo json_encode($resposta);
		exit;