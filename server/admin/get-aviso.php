<?php include('config/config.php'); 
      header('Content-Type: application/json');

      if(isset($_SESSION['Usuario']) &&  $_SESSION['Usuario']!='' && isset($_POST['Id_aviso']) && $_POST['Id_aviso']!='' && is_numeric($_POST['Id_aviso'])){
        
        $id_aviso = clean($_POST['Id_aviso']);
        $q = Query('SELECT * FROM aviso WHERE Aviso = '.$id_aviso.' ORDER BY Aviso DESC',0);
        $total_r = mysqli_num_rows($q);
   
        if($total_r > 0){
            
            $r = mysqli_fetch_assoc($q);
         
            $resp['id_aviso']           = $r['Aviso'];  
            $resp['titulo']             = $r['Titulo'];  
            $resp['texto']              = $r['Texto'];  
            $resp['id_autor']           = $r['Usuario'];
            $resp['autor']              = get('usuario',$r['Usuario']); 
            $resp['capa']               = $r['Imagem']; 
            $resp['data_postagem']      = formata_data($r['Data']); 
        }
      }          
      
      echo json_encode($resp);
      exit;