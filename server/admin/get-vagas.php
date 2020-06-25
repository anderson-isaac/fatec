<?php include('config/config.php'); 
      header('Content-Type: application/json');

      $resposta = array();
      $resposta['draw'] = 0;
      $resposta['recordsTotal'] = 0;
      $resposta['recordsFiltered'] = 0;
      $resposta['data'] =  array();
    
      $Tipo = 0;
    
      if((isset($_SESSION['Usuario']) &&  $_SESSION['Usuario']!='') && (isset($_SESSION['Tipo']) &&  $_SESSION['Tipo']!='' && $_SESSION['Tipo']==1)){
        $q = Query('SELECT * FROM vaga WHERE Usuario = '.$_SESSION['Usuario'].' ORDER BY Vaga DESC',0);
        $total_r = mysqli_num_rows($q);
        if($total_r > 0){

            $resposta['draw'] = $_POST['draw'];
            $resposta['recordsTotal'] = $total_r;
            $resposta['recordsFiltered'] = $total_r;
               
            while($r = mysqli_fetch_assoc($q)){

                $resposta_aux = array();
    
                $resposta_aux['Id_vaga']         = $r['Vaga'];
                $resposta_aux['Titulo']             = get('cargo',$r['Cargo']);
                $resposta_aux['Data_postagem']   = formata_data($r['Data_postagem']);                
                $resposta_aux['Situacao']        = get_situacao($r['Situacao_da_vaga']);                
                $resposta_aux['Acoes']           = "<div class='btn-group'><button type='button' data-id='".$r['Vaga']."' class='btn btn-danger delete-this'><i class='fa fa-trash'></i></button><button type='button' data-id='".$r['Vaga']."' class='btn btn-info edit-this'><i class='fa fa-edit'></i></button></div>";
                
                $resposta['data'][] = $resposta_aux;        
          }
        }
      }

      echo json_encode($resposta);