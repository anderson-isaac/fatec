<?php include('config/config.php'); 
      header('Content-Type: application/json');

      $resposta = array();
      $resposta['draw'] = 0;
      $resposta['recordsTotal'] = 0;
      $resposta['recordsFiltered'] = 0;
      $resposta['data'] =  array();
    
      $Tipo = 0;
    
      if((isset($_SESSION['Usuario']) &&  $_SESSION['Usuario']!='') && (isset($_SESSION['Tipo']) &&  $_SESSION['Tipo']!='' && $_SESSION['Tipo']==1)){
        $q = Query('SELECT * FROM aviso WHERE Usuario = '.$_SESSION['Usuario'].' ORDER BY Aviso DESC',0);
        $total_r = mysqli_num_rows($q);
        if($total_r > 0){

            $resposta['draw'] = $total_r;
            $resposta['recordsTotal'] = $total_r;
            $resposta['recordsFiltered'] = $total_r;
               
            while($r = mysqli_fetch_assoc($q)){

                $resposta_aux = array();
    
                $resposta_aux['Id_aviso']         = $r['Aviso'];
                $resposta_aux['Titulo']           = $r['Titulo'];
                $resposta_aux['Data_postagem']   = formata_data($r['Data']);
                 
                $resposta_aux['Acoes']           = "<div class='btn-group'><button type='button' data-id='".$r['Aviso']."' class='btn btn-danger delete-this'><i class='fa fa-trash'></i></button><button type='button' data-id='".$r['Aviso']."' class='btn btn-info edit-this'><i class='fa fa-edit'></i></button></div>";
                
                $resposta['data'][] = $resposta_aux;        
          }
        }
      }

      echo json_encode($resposta);