<?php header('Content-Type: application/json'); ?>

{    
    "draw": "2",
    "recordsTotal": "4",
    "recordsFiltered": "4",
    "data": [
        {
            "Id_vaga" : "0001",
            "Titulo" : "Estágio Desenvolvedor Web",
            "Acoes" : "<div class='btn-group'><button type='button' data-id='0001' class='btn btn-danger delete-this'><i class='fa fa-trash'></i></button><button type='button' data-id='0001' class='btn btn-info edit-this'><i class='fa fa-edit'></i></button></div>"
        },
        {
            "Id_vaga" : "0002",
            "Titulo" : "Estágio RH",
            "Acoes" : "<div class='btn-group'><button type='button' data-id='0001' class='btn btn-danger delete-this'><i class='fa fa-trash'></i></button><button type='button' data-id='0001' class='btn btn-info edit-this'><i class='fa fa-edit'></i></button></div>"
        },
        {
            "Id_vaga" : "0003",
            "Titulo" : "Desenvolvedor Java",
            "Acoes" : "<div class='btn-group'><button type='button' data-id='0001' class='btn btn-danger delete-this'><i class='fa fa-trash'></i></button><button type='button' data-id='0001' class='btn btn-info edit-this'><i class='fa fa-edit'></i></button></div>"
        },
        {
            "Id_vaga" : "0004",
            "Titulo" : "Assistente de TI",
            "Acoes" : "<div class='btn-group'><button type='button' data-id='0001' class='btn btn-danger delete-this'><i class='fa fa-trash'></i></button><button type='button' data-id='0001' class='btn btn-info edit-this'><i class='fa fa-edit'></i></button></div>"
        }
    ]
}

<?php sleep(3); ?>