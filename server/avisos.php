<?php   include('admin/config/config.php');
        header('Content-Type: application/json');

    $filtrar_favoritos = false;    

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    if (isset($data->filtrarFavoritos) && $data->filtrarFavoritos) {
        $filtrar_favoritos = $data->filtrarFavoritos;
    }
        
     $arr['avisos'] = array();

    if ($filtrar_favoritos) {
        $q = Query('SELECT * FROM usuario_aviso_favorito as  user_fav INNER JOIN aviso as av ON user_fav.Aviso = av.Aviso WHERE user_fav.Usuario = '.$_SESSION['Usuario'].' AND user_fav.Favorito = 1 ORDER BY user_fav.Usuario_aviso_favorito DESC LIMIT 6',0);
        while($r = mysqli_fetch_assoc($q)){
              $r_aux = array();   
              
              $r_aux['id']        = $r['Aviso'];
              $r_aux['capa'] = $Config['UrlServer'].'imagens/'.$r['Imagem'];


            $q_user = Query('SELECT * FROM usuario WHERE Usuario = '.$r['Usuario'].'',0);
             if(mysqli_num_rows($q_user) > 0){
                
                $r_user = mysqli_fetch_assoc($q_user);

                $r_aux['autor_id'] = $r_user['Usuario'];
                $r_aux['autor_foto'] = $Config['UrlServer'].'imagens/'.$r_user['Imagem'];
                $r_aux['autor_nome'] = $r_user['Nome'];
             
             }

             $r_aux['titulo']        = $r['Titulo'];
             $r_aux['texto']        = $r['Texto'];
             $r_aux['resumo']        = $r['Resumo'];
             $r_aux['postado']        = formata_data($r['Data']);

              
              if($r["Favorito"]==1){
                $r_aux["favorito"]  = true;  
              }else{
                $r_aux["favorito"]  = false; 
              }

              $arr['avisos'][] = $r_aux;   
        }        
    }else{
        $q = Query('SELECT * FROM aviso as av WHERE av.Aviso NOT IN (SELECT Aviso FROM usuario_aviso_favorito WHERE Usuario = '.$_SESSION['Usuario'].') ORDER BY Aviso DESC LIMIT 6',0);
        while($r = mysqli_fetch_assoc($q)){   
              $r_aux = array();
              
              $r_aux['id']        = $r['Aviso'];
              $r_aux['capa'] = $Config['UrlServer'].'imagens/'.$r['Imagem'];

            $q_user = Query('SELECT * FROM usuario WHERE Usuario = '.$r['Usuario'].'',0);
             if(mysqli_num_rows($q_user) > 0){
                
                $r_user = mysqli_fetch_assoc($q_user);

                $r_aux['autor_id'] = $r_user['Usuario'];
                $r_aux['autor_foto'] = $Config['UrlServer'].'imagens/'.$r_user['Imagem'];
                $r_aux['autor_nome'] = $r_user['Nome'];
             
             }

             $r_aux['titulo']        = $r['Titulo'];
             $r_aux['texto']        = $r['Texto'];
             $r_aux['resumo']        = $r['Resumo'];
             $r_aux['postado']        = formata_data($r['Data']);

              
              if($r["Favorito"]==1){
                $r_aux["favorito"]  = true;  
              }else{
                $r_aux["favorito"]  = false; 
              }

              $arr['avisos'][] = $r_aux; 
              $arr['vagas'][] = $r_aux;   
        } 
    }

    echo json_encode($arr);
    exit;

    //echo file_get_contents('json/avisos_todos.json');    
    //sleep(1);
?>