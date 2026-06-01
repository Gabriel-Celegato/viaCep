<?php
require_once '../Model/Endereco.php';

header('Content-Type: application/json');

if (isset($_GET['cep'])) {
    $cep = $_GET['cep'];

    //$model = new CepModel();
    $model = new Endereco($cep);
    //$resposta = $model->buscarEndereco($cep);

    echo $model;
} else {
    echo json_encode(['erro' => 'CEP não informado']);
}
