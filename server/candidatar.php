<?php header('Content-Type: application/json'); ?>
<?php $id = $_POST['id']; ?>
<?php 
    $strings = array(
        'success',
        'error',
    );
    $key = array_rand($strings);
    if ($strings[$key] == "success") {
?>
{                
    "id" : "<?php echo $id; ?>",
    "status" : "<?php echo $strings[$key] ?>",
    "title" : "Sucesso",
    "mensagem" : "Sua candidatura está confirmada para esta vaga" 
}
<?php } else { ?>
{                
    "id" : "<?php echo $id; ?>",
    "status" : "<?php echo $strings[$key] ?>",
    "title" : "Erro",
    "mensagem" : "Sua candidatura não pôde ser confirmada para esta vaga"   
}
<?php } ?>
<?php sleep(1); ?>