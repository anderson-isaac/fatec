<?php include('config/config.php'); 
      header('Content-Type: application/json');

      if(isset($_SESSION['Usuario']) &&  $_SESSION['Usuario']!='' && isset($_POST['Id_vaga']) && $_POST['Id_vaga']!='' && is_numeric($_POST['Id_vaga'])){
        
        $id_vaga = clean($_POST['Id_vaga']);
        $q = Query('SELECT * FROM vaga WHERE Vaga = '.$id_vaga.' ORDER BY Vaga DESC',0);
        $total_r = mysqli_num_rows($q);
        if($total_r > 0){
            
            $r = mysqli_fetch_assoc($q);
         
            $resp['id_vaga']        = $r['Vaga'];  
            $resp['descricao']      = $r['Descricao'];  
            $resp['cargo']          = $r['Cargo'];  
            $resp['tipo']           = $r['Tipo'];  
            $resp['bolsa']          = $r['Valor_da_bolsa'];  
            $resp['remuneracao']    = $r['Remuneracao'];  
            $resp['beneficios']     = $r['Beneficios']; 
            $resp['diferencial']     = $r['Diferencial'];  
            $resp['empresa']        = $r['Empresa'];  
            $resp['email']          = $r['Email'];  
            $resp['whatsapp']       = $r['Whatsapp'];  
            $resp['situacao']       = $r['Situacao_da_vaga'];  
            $resp['data_postagem']  = formata_data($r['Data_postagem']);  
            $resp['prazo_validade'] = formata_data($r['Data_validade']);  
        }
      }      
   
      echo json_encode($resp);
      exit;