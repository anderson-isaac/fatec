<?php   include('admin/config/config.php');
        header('Content-Type: application/json');   
        
        $id   = 0;
        $resp = array();

        if(isset($_POST['id']) && $_POST['id']!=''){
            $id_param = clean($_POST['id']);
        }else{
            $resp['status'] = 'error';
            echo json_encode($resp);
            exit;
        }

        $q = Query('SELECT * FROM usuario_aviso_favorito WHERE Aviso = '.$id_param.' AND Usuario = '.$_SESSION['Usuario'].'');
        if(mysqli_num_rows($q)==0){
            $id = Query('INSERT INTO usuario_aviso_favorito(Usuario,Aviso,Favorito) VALUES('.$_SESSION['Usuario'].','.$id_param.',1)');
            if($id!=''){
                $resp['id'] = $id_param;
                $resp['status'] = 'success';
                $resp['title'] = 'Sucesso';
                $resp['mensagem'] = 'Foi adicionado a lista de favoritos';
                echo json_encode($resp);
                exit;                   
            }else{
                $resp['id'] = $id_param;
                $resp['status'] = 'error';
                $resp['title'] = 'Erro';
                $resp['mensagem'] = 'Não foi possível adicionar esse item aos favoritos';
                echo json_encode($resp);
                exit;
            }     
            $r = mysqli_fetch_assoc($q);
            Query('UPDATE usuario_aviso_favorito SET Favorito = 1 WHERE Usuario_aviso_favorito = '.$r['Usuario_aviso_favorito'].'',0);
            $resp['id'] = $id_param;
            $resp['status'] = 'success';
            $resp['title'] = 'Sucesso';
            $resp['mensagem'] = 'Foi adicionado a lista de favoritos';
            echo json_encode($resp);
            exit;
        }
   