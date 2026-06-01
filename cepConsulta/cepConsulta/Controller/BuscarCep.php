<?php
require_once '../Model/Endereco.php';

header('Content-Type: application/json');

if (isset($_GET['cepParaBuscar'])) {

    $cepParaBuscar = $_GET['cepParaBuscar'];

$enderecosBuscados = Endereco::buscarCepzin($cepParaBuscar);

    //$model = new CepModel();
    $buscarCep =  Endereco::buscarCepzin($cepParaBuscar);
    //$resposta = $model->buscarEndereco($cep);

    echo json_encode($enderecosBuscados);

} else {
    echo json_encode(['erro' => 'CEP não informado']);
}
