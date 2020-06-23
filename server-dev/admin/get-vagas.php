<?php header('Content-Type: application/json'); ?>

{    
    "draw": "2",
    "recordsTotal": "4",
    "recordsFiltered": "4",
    "data": [
        {
            "Id_vaga" : "0001",
            "Titulo" : "Estágio Desenvolvedor Web",
            "Data_postagem" : "21/05/2020",
            "Situacao" : "1",
            "Acoes" : "<div class='btn-group'><button type='button' data-id='0001' class='btn btn-danger delete-this'><i class='fa fa-trash'></i></button><button type='button' data-id='0001' class='btn btn-info edit-this'><i class='fa fa-edit'></i></button></div>"
        },
        {
            "Id_vaga" : "0002",
            "Titulo" : "Estágio RH",
            "Data_postagem" : "21/05/2020",
            "Situacao" : "1",
            "Acoes" : "<div class='btn-group'><button type='button' data-id='0001' class='btn btn-danger delete-this'><i class='fa fa-trash'></i></button><button type='button' data-id='0001' class='btn btn-info edit-this'><i class='fa fa-edit'></i></button></div>"
        },
        {
            "Id_vaga" : "0003",
            "Titulo" : "Desenvolvedor Java",
            "Data_postagem" : "21/05/2020",
            "Situacao" : "1",
            "Acoes" : "<div class='btn-group'><button type='button' data-id='0001' class='btn btn-danger delete-this'><i class='fa fa-trash'></i></button><button type='button' data-id='0001' class='btn btn-info edit-this'><i class='fa fa-edit'></i></button></div>"
        },
        {
            "Id_vaga" : "0004",
            "Titulo" : "Assistente de TI",
            "Data_postagem" : "21/05/2020",
            "Situacao" : "1",
            "Acoes" : "<div class='btn-group'><button type='button' data-id='0001' class='btn btn-danger delete-this'><i class='fa fa-trash'></i></button><button type='button' data-id='0001' class='btn btn-info edit-this'><i class='fa fa-edit'></i></button></div>"
        }
    ]
}

<?php sleep(3); ?>