<?php   include('admin/config/config.php');
        header('Content-Type: application/json');   
    


    $filtrar_favoritos = false;
    $filtrar_candidaturas = false;

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    if (isset($data->filtrarFavoritos) && $data->filtrarFavoritos) {
        $filtrar_favoritos = $data->filtrarFavoritos;
    }
    
    if (isset($data->filtrarCandidaturas) && $data->filtrarCandidaturas) {
        $filtrar_candidaturas = $data->filtrarCandidaturas;
    }

    $arr['vagas'] = array();
   

    if ($filtrar_favoritos && $filtrar_candidaturas) {

        $q = Query('SELECT * FROM usuario_vaga as user_fav INNER JOIN vaga as vag ON user_fav.Vaga = vag.Vaga WHERE user_fav.Usuario = '.$_SESSION['Usuario'].' AND user_fav.Inscrito = 1 AND user_fav.Favorito = 1 ORDER BY user_fav.Usuario_vaga DESC LIMIT 6',0);
        while($r = mysqli_fetch_assoc($q)){
              $r_aux = array();
              
              $r_aux['id']        = $r['Vaga'];
              $r_aux['tipo']        = $r['Tipo'];
              $r_aux["cargo"]   = get('cargo',$r['Cargo']);
              $r_aux["empresa"]   = get('empresa',$r['Empresa']);
              $r_aux["vaga"]      = get('cargo',$r['Cargo']);
                $r_aux['valor_da_bolsa']     = $r['Valor_da_bolsa'];
              $r_aux['remuneracao']        = $r['Remuneracao'];
              $r_aux["postado"]   = formata_data($r['Data_postagem']);
              if($r["Favorito"]==1){
                $r_aux["favorito"]  = true;  
              }else{
                $r_aux["favorito"]  = false; 
              }
              
              if($r["Inscrito"]==1){
                $r_aux["candidato"] = true;  
              }else{
                $r_aux["candidato"] = false;  
              }
              echo $r_aux['favorito'];
              echo $r_aux['candidato'];
              exit;
              $r_aux["descricao"] = $r['Descricao']; 
              $arr['vagas'][] = $r_aux;   
        }  
    }else if ($filtrar_candidaturas) {
        $q = Query('SELECT * FROM usuario_vaga as  user_fav INNER JOIN vaga as vag ON user_fav.Vaga = vag.Vaga WHERE user_fav.Usuario = '.$_SESSION['Usuario'].' AND user_fav.Inscrito = 1 ORDER BY user_fav.Usuario_vaga DESC LIMIT 6',0);
        while($r = mysqli_fetch_assoc($q)){
              $r_aux = array();
              
              $r_aux['id']        = $r['Vaga']; 
              $r_aux['tipo']        = $r['Tipo'];
              $r_aux["cargo"]   = get('cargo',$r['Cargo']);
              $r_aux["empresa"]   = get('empresa',$r['Empresa']);
              $r_aux["vaga"]      = get('cargo',$r['Cargo']);
                $r_aux['valor_da_bolsa']     = $r['Valor_da_bolsa'];
              $r_aux['remuneracao']        = $r['Remuneracao'];
              $r_aux["postado"]   = formata_data($r['Data_postagem']);
              if($r["Favorito"]==1){
                $r_aux["favorito"]  = true;  
              }else{
                $r_aux["favorito"]  = false; 
              }
              
              if($r["Inscrito"]==1){
                $r_aux["candidato"] = true;  
              }else{
                $r_aux["candidato"] = false;  
              }
              $r_aux["descricao"] = $r['Descricao']; 
              $arr['vagas'][] = $r_aux;   
        }      
    }else if ($filtrar_favoritos) {
        $q = Query('SELECT * FROM usuario_vaga as  user_fav INNER JOIN vaga as vag ON user_fav.Vaga = vag.Vaga WHERE user_fav.Usuario = '.$_SESSION['Usuario'].' AND user_fav.Favorito = 1 ORDER BY user_fav.Usuario_vaga DESC LIMIT 6',0);
        while($r = mysqli_fetch_assoc($q)){
              $r_aux = array();   
              
              $r_aux['id']        = $r['Vaga'];
              $r_aux['tipo']        = $r['Tipo'];
              $r_aux["cargo"]   = get('cargo',$r['Cargo']);
                $r_aux['valor_da_bolsa']     = $r['Valor_da_bolsa'];
              $r_aux['remuneracao']        = $r['Remuneracao'];
              $r_aux["empresa"]   = get('empresa',$r['Empresa']);
              $r_aux["vaga"]      = get('cargo',$r['Cargo']);
              $r_aux["postado"]   = formata_data($r['Data_postagem']);
              if($r["Favorito"]==1){
                $r_aux["favorito"]  = true;  
              }else{
                $r_aux["favorito"]  = false; 
              }
              
              if($r["Inscrito"]==1){
                $r_aux["candidato"] = true;  
              }else{
                $r_aux["candidato"] = false;  
              }
              
              $r_aux["descricao"] = $r['Descricao']; 
              $arr['vagas'][] = $r_aux;   
        }      
    }else{
        // $q = Query('SELECT * FROM usuario_vaga as  user_fav INNER JOIN vaga as vag ON user_fav.Vaga = vag.Vaga WHERE user_fav.Usuario = '.$_SESSION['Usuario'].' ORDER BY user_fav.Usuario_vaga DESC LIMIT 6',0);
        $query_vagas = 'SELECT * FROM vaga WHERE Situacao_da_vaga = 1';
        $q = Query($query_vagas, 0);
        while($r = mysqli_fetch_assoc($q)){
          $r_aux = array();
          
          $r_aux['id']        = $r['Vaga'];
          $r_aux['tipo']        = $r['Tipo'];
          $r_aux["cargo"]   = get('cargo',$r['Cargo']);
          $r_aux["empresa"]   = get('empresa',$r['Empresa']);
          $r_aux['valor_da_bolsa']     = $r['Valor_da_bolsa'];
          $r_aux['remuneracao']        = $r['Remuneracao'];
          $r_aux["vaga"]      = get('cargo',$r['Cargo']);
          $r_aux["postado"]   = formata_data($r['Data_postagem']);

          $query_fav = 'SELECT Favorito, Inscrito FROM usuario_vaga WHERE Vaga = ' . $r_aux['id'] . ' AND Favorito = 1';
          $q_fav = Query($query_fav,0);
          if(mysqli_num_rows($q_fav) > 0){
                
            $r_fav = mysqli_fetch_assoc($q_fav);
            if($r_fav['Favorito']==1){
              $r_aux["favorito"]  = true;  
            } else{
              $r_aux["favorito"]  = false; 
            }

            if($r_fav['Inscrito']==1){
              $r_aux["candidato"]  = true;  
            } else{
              $r_aux["candidato"]  = false; 
            }

          } else{
            $r_aux["favorito"]  = false; 
            $r_aux["candidato"]  = false; 
          }

          $r_aux["descricao"] = $r['Descricao']; 
          $arr['vagas'][] = $r_aux;   
        } 
    }
        
    echo json_encode($arr);
    exit;
    
?>
