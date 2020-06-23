<?php header('Content-Type: application/json'); 
      include('config/config.php'); 

    $resposta['cargos'] = array();

    if((isset($_SESSION['Usuario']) &&  $_SESSION['Usuario']!='')){
        $q = Query('SELECT Cargo,Titulo FROM cargo ORDER BY Titulo ASC',0);
        $total_r = mysqli_num_rows($q);
        if($total_r > 0){
    
            while($r = mysqli_fetch_assoc($q)){
                $resposta_aux = array();
                $resposta_aux['cargo_id']         = $r['Cargo'];
                $resposta_aux['cargo']           =  $r['Titulo'];
                $resposta['cargos'][] = $resposta_aux;        
          }
        }
    }      

    echo json_encode($resposta);
    exit;

