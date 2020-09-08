<?php

require_once(__DIR__ . '/../../db/Db.php');
require_once(__DIR__ . '/../../model/Vendedor.php');
require_once(__DIR__ . '/../../dao/DaoVendedor.php');
require_once(__DIR__ . '/../../config/config.php');

$conn = Db::getInstance();

if (! $conn->connect()) {
    die();
}


$daoVendedor = new DaoVendedor($conn);

$novoVendedor = new Vendedor($_POST['nome'], $_POST['cpf'], $_POST['matricula'], $_POST['salario'], $_POST['dataNascimento']);

$daoVendedor->inserir($novoVendedor);
    
header('Location: ./index.php');

?>


