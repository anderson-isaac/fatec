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
    "mensagem" : "Este item foi adicionado aos seus favoritos" 
}
<?php } else { ?>
{                
    "id" : "<?php echo $id; ?>",
    "status" : "<?php echo $strings[$key] ?>",
    "title" : "Erro",
    "mensagem" : "Não foi possível adicionar esse items aos favoritos"  
}
<?php } ?>
<?php sleep(1); ?>