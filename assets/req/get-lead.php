<?php header('Content-Type: application/json'); ?>
{
  "informacoes" : [
    { "name" : "ID", "value" : "08373b08" },
    { "name" : "Cliente", "value" : "Cecil O'Keefe" },
    { "name" : "Telefone", "value" : "(15) 65144-0003" },
    { "name" : "E-mail", "value" : "cecilkeefe@email.com.br" },
    { "name" : "Data", "value" : "21/12/2019" },
    { "name" : "Hora", "value" : "17:50" },
    { "name" : "Empreendimento", "value" : "Liberty" }
  ],
  "status" : [
    { "name" : "Aberto" , "value" : "aberto" },
    { "name" : "Em andamento" , "value" : "andamento" },
    { "name" : "Aguardando" , "value" : "aguardando"} ,
    { "name" : "Perdido" , "value" : "perdido", "selected" : "selected" },
    { "name" : "Fechado" , "value" : "fechado" }
  ]
}
<?php sleep(1); ?>