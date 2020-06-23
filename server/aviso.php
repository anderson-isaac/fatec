<?php   include('admin/config/config.php');
        header('Content-Type: application/json'); 

        $resp = array();
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        
           $id = clean($data->id);         
           $q  = Query('SELECT * FROM aviso WHERE Aviso = '.$id.'',0);

           if(mysqli_num_rows($q) > 0){
             $r = mysqli_fetch_assoc($q);            

              $resp['id']        = $r['Aviso'];
              $resp['titulo']        = $r['Titulo'];    
              $resp['texto']        = $r['Texto'];
              $resp['resumo']        = $r['Resumo'];
              $resp["postado"]   = formata_data($r['Data']);

              $q_testa_usuario = Query('SELECT * FROM usuario_aviso_favorito WHERE Usuario = '.$_SESSION['User'].' AND Aviso = '.$id.'');
              if(mysqli_num_rows($q_testa_usuario) > 0){
                $r_testa_usuario = mysqli_fetch_assoc($q_testa_usuario);
           
                if($r_testa_usuario['Favorito']==1){
                    $resp["favorito"]  = 'true';
                }else{
                    $resp["favorito"] = 'false';  
                }

              }else{
                $resp["favorito"] = 'false';  
              }

             
             $q_user = Query('SELECT * FROM usuario WHERE Usuario = '.$r['Usuario'].'',0);
             if(mysqli_num_rows($q_user) > 0){
                
                $r_user = mysqli_fetch_assoc($q_user);

                $resp['autor'] = $r_user['Usuario'];
                $resp['autor_foto'] = $Config['UrlServer'].'imagens/'.$r_user['Imagem'];
                $resp['autor_nome'] = $r_user['Nome'];
             
             }

             echo json_encode($resp);
             exit; 
           }
        

