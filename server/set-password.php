<?php 
  include('admin/config/config.php');
	header('Content-Type: application/json'); 

  $resposta = array();

  if((isset($_SESSION['Usuario']) && $_SESSION['Usuario']!='') && (isset($_SESSION['Tipo']) && $_SESSION['Tipo']=='2')) {
    
    if (isset($_POST['Senha_atual']) && $_POST['Senha_atual'] != '') {

      if (isset($_POST['Senha_nova']) && $_POST['Senha_nova'] != '') {

        $atual = $_POST['Senha_atual'];
        $nova = $_POST['Senha_nova'];

        $query_senha = 'SELECT Senha from usuario WHERE Usuario = '. $_SESSION['Usuario'] .'';
        $result_senha = Query($query_senha,0);
        if (mysqli_num_rows($result_senha) == 1) {
          $r = mysqli_fetch_assoc($result_senha);
          $atual_sistema = $r['Senha'];
        }

        if (md5($atual) == $atual_sistema) {
          
          $query = 'UPDATE usuario SET Senha = "' . md5($nova) . '" WHERE Usuario = ' . $_SESSION['Usuario'] . '';
          $update = Query($query,0);
          if($update == 1) {            
            $resposta['status'] = "1";
            $resposta['mensagem'] = "Sua senha foi alterada com sucesso";
          } else {
            $resposta['status'] = "0";
            $resposta['mensagem'] = "Não foi possível atualizar sua senha";  
          }


        } else {

          $resposta['status'] = "0";
          $resposta['mensagem'] = "Senha incorreta";

        }

      } else {

        $resposta['status'] = "0";
        $resposta['mensagem'] = "É necessário incluir o campo Senha Nova";  

      }

    } else {

      $resposta['status'] = "0";
      $resposta['mensagem'] = "É necessário incluir o campo Senha Atual";      

    }

  }

  echo json_encode($resposta);

?>