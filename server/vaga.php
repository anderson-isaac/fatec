<?php   include('admin/config/config.php');
        header('Content-Type: application/json'); 

        $resp = array();

        $json = file_get_contents('php://input');
        $data = json_decode($json);

    
        
           $id = clean($data->id);
           $q  = Query('SELECT * FROM vaga WHERE Vaga = '.$id.'',0);

            
    
           if(mysqli_num_rows($q) > 0){
             $r = mysqli_fetch_assoc($q);            
   

              $resp['id']        = $r['Vaga'];
              $resp['tipo']        = $r['Tipo'];
              $resp["cargo"]   = get('cargo',$r['Cargo']);
              $resp["empresa"]   = get('empresa',$r['Empresa']);
              $resp["postado"]   = formata_data($r['Data_postagem']);

              $q_testa_usuario = Query('SELECT * FROM usuario_vaga WHERE Usuario = '.$_SESSION['Usuario'].' AND Vaga = '.$id.'');
              if(mysqli_num_rows($q_testa_usuario) > 0){
                $r_testa_usuario = mysqli_fetch_assoc($q_testa_usuario);
      
                if($r_testa_usuario['Favorito']==1){
                    $resp["favorito"]  = true;
                }else{
                    $resp["favorito"] = false;  
                }

                if($r_testa_usuario['Inscrito']==1){
                    $resp["candidato"] = true;  
                }else{
                    $resp["candidato"] = false;  
                }
                      
                
              }else{
                $resp["candidato"] = false;  
                $resp["favorito"] = false;  
              }

              $resp["descricao"] = $r['Descricao']; 

              $resp['valor_da_bolsa']     = $r['Valor_da_bolsa'];
              $resp['remuneracao']        = $r['Remuneracao'];
              if ($resp['tipo'] == 0) {
                $resp['tipo']        = 'Estágio';
              } else {
                $resp['tipo']        = 'Emprego';
              }

             $resp['diferencial']        = $r['Diferencial'];
             $resp['beneficios']        = $r['Beneficios'];

             $resp['email']        = $r['Email'];
             $resp['whatsapp']        = $r['Whatsapp'];
             $resp['situacao']        = $r['Situacao_da_vaga'];
             $resp['prazo_validade']        = formata_data($r['Data_validade']);
             
             $q_user = Query('SELECT * FROM usuario WHERE Usuario = '.$r['Usuario'].'',0);
             if(mysqli_num_rows($q_user) > 0){
                
                $r_user = mysqli_fetch_assoc($q_user);

                $resp['autor_id'] = $r_user['Usuario'];
                $resp['autor_foto'] = $r_user['Imagem'];
                $resp['autor_nome'] = $r_user['Nome'];
             
             }

             echo json_encode($resp);
             exit; 
           }
        