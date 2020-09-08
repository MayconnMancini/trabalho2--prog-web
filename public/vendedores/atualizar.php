<?php

require_once(__DIR__ . '/../../templates/template-html.php');

require_once(__DIR__ . '/../../db/Db.php');
require_once(__DIR__ . '/../../model/Vendedor.php');
require_once(__DIR__ . '/../../dao/DaoVendedor.php');
require_once(__DIR__ . '/../../config/config.php');

$conn = Db::getInstance();

if (! $conn->connect()) {
    die();
}

$daoVendedor = new DaoVendedor($conn);
$vendedor = $daoVendedor->porId( $_POST['id'] );
    
if ( $vendedor )
{  
  $vendedor->setNome( $_POST['nome'] );
  $vendedor->setCpf( $_POST['cpf'] );
  $vendedor->setMatricula( $_POST['matricula'] );
  $vendedor->setSalario( $_POST['salario'] );
  $vendedor->setDataNascimento( $_POST['dataNascimento'] );

  $daoVendedor->atualizar( $vendedor );
}

header('Location: ./index.php');