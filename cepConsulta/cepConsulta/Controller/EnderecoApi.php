<?php
require_once '../Model/Endereco.php';

header('Content-Type: application/json');
if($_SERVER['REQUEST_METHOD'] === 'DELETE') {

if (isset($_GET['id'])) {
    $id = $_GET['id'];


    //$model = new CepModel();
    $deletar = Endereco::deletar($id);
    //$resposta = $model->buscarEndereco($cep);

  
    if ($deletar == true) {

    echo (json_encode(true));
    
    }

    else{
        echo (json_encode(false));
    }
    
} else {
    echo json_encode(['erro' => 'Deu errado aqui meu patrão']);
}

}

else{
    echo json_encode(['erro' => 'Método não permitido']);
}