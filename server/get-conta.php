<?php   include('admin/config/config.php');
        header('Content-Type: application/json');   
    

        $resp = array();

        if(isset($_SESSION['Usuario']) && $_SESSION['Usuario']!='' && is_numeric($_SESSION['Usuario'])){
        	$q = Query('SELECT * FROM usuario WHERE Usuario = '.$_SESSION['Usuario'].'',0);
        	if(mysqli_num_rows($q) > 0){
        		$r = mysqli_fetch_assoc($q);

        		$resp['id'] = $r['Usuario'];
        		$resp['nome'] = $r['Nome'];
        		$resp['email'] = $r['Email'];
        		$resp['telefone'] = $r['Celular'];
        		$resp['curriculo'] = $Config['UrlServerLess'].'curriculo/'.$r['Curriculo'];
        	}
        }
 
        echo json_encode($resp);  
        exit;

