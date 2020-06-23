<?php header('Content-Type: application/json'); 
      include('config/config.php'); 

    $resposta['empresas'] = array();

    if((isset($_SESSION['Usuario']) &&  $_SESSION['Usuario']!='')){
        $q = Query('SELECT Empresa,Titulo FROM empresa ORDER BY Titulo ASC',0);
        $total_r = mysqli_num_rows($q);
        if($total_r > 0){   

            while($r = mysqli_fetch_assoc($q)){
                $resposta_aux = array();
                $resposta_aux['empresa_id']         = $r['Empresa'];
                $resposta_aux['empresa']           =  $r['Titulo'];
                $resposta['empresas'][] = $resposta_aux;        
          }
        }
    }
   
    echo json_encode($resposta);
    exit;

