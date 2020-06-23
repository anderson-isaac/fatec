<?php header('Content-Type: application/json'); ?>
<?php

    $filtrar_favoritos = false;    

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    if (isset($data->filtrarFavoritos) && $data->filtrarFavoritos) {
        $filtrar_favoritos = $data->filtrarFavoritos;
    }
    

    if ($filtrar_favoritos) {
        echo file_get_contents('json/avisos_favoritos.json');
        sleep(1);
        exit;       
    }

    echo file_get_contents('json/avisos_todos.json');    
    sleep(1);
?>