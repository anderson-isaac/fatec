<?php //header('Content-Type: application/json'); ?>
<?php    

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

    if ($filtrar_favoritos && $filtrar_candidaturas) {
        echo file_get_contents('json/vagas_todas.json');
        sleep(1);
        exit;
    }
    if ($filtrar_candidaturas) {
        echo file_get_contents('json/vagas_candidaturas.json'); 
        sleep(1);
        exit;       
    }
    if ($filtrar_favoritos) {
        echo file_get_contents('json/vagas_favoritos.json');
        sleep(1);
        exit;       
    }

    echo file_get_contents('json/vagas_todas.json');    
    sleep(1);
    
?>
