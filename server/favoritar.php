<?php   include('admin/config/config.php');
        header('Content-Type: application/json');   
    
        $id   = 0;
        $resp = array();

        if(isset($_POST['id']) && $_POST['id']!='' && is_numeric($_POST['id'])){
            $id_param = clean($_POST['id']);
        }else{
            $resp['status'] = 'error';
            echo json_encode($resp);
            exit;
        }
 

        $q = Query('SELECT * FROM usuario_vaga WHERE Vaga = '.$id_param.' AND Usuario = '.$_SESSION['Usuario'].'');
        if(mysqli_num_rows($q)==0){
            $id = Query('INSERT INTO usuario_vaga(Usuario,Vaga,Favorito) VALUES('.$_SESSION['Usuario'].','.$id_param.',1)');
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
                $resp['mensagem'] = 'Não foi possível adicionar esse items aos favoritos';
                echo json_encode($resp);
                exit;
            }     
            $r = mysqli_fetch_assoc($q);
            Query('UPDATE usuario_vaga SET Favorito = 1 WHERE Usuario_vaga = '.$r['Usuario_vaga'].'',0);
            $resp['id'] = $id_param;
            $resp['status'] = 'success';
            $resp['title'] = 'Sucesso';
            $resp['mensagem'] = 'Foi adicionado a lista de favoritos';
            echo json_encode($resp);
            exit;
        }
      
   