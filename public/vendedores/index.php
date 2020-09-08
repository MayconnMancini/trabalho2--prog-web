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
$vendedores = $daoVendedor->todos();

ob_start();

?>
    <div class="container">
        <div class="py-5 text-center">
            <h2>Cadastro de Vendedores</h2>
        </div>
        <div class="row mb-2">
            <div class="col-md-12" >
                <a href="novo.php" class="btn btn-primary active" role="button" aria-pressed="true">Novo Vendedor</a>
            </div>
        </div>

<?php 
    if (count($vendedores) >0) 
    {
?>
        <div class="row">
            <div class="col-md-12" >
            <div class="table-responsive">
                <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Matrícula</th>
                        <th scope="col">Salario Base</th>
                        <th scope="col">Data de Nascimento</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
<?php 
        foreach($vendedores as $p) {
?>                    
                    <tr>
                        <th scope="row"><?php echo  $p->getId(); ?></th>
                        <td><?php echo $p->getNome(); ?></td>
                        <td><?php echo $p->getCpf(); ?></td>
                        <td><?php echo $p->getMatricula(); ?></td>
                        <td><?php echo 'R$'. $p->getSalario(); ?></td>
                        <td><?php echo $p->getDataNascimento(); ?></td>
                        <td>
                            <a class="btn btn-danger btn-sm active" 
                                href="apagar.php?id=<?php echo $p->getId();?>">
                                Apagar
                            </a>
                            <a class="btn btn-secondary btn-sm active" 
                                href="editar.php?id=<?php echo $p->getId();?>">
                                Editar
                            </a>                        
                        </td>
                    </tr>
<?php
        } // foreach
?>                    
                </tbody>
                </table>
            </div>
            </div>
        </div>
<?php 
    
    }  // if 
?>        
    </div>
<?php

$content = ob_get_clean();
echo html( $content );
    
?>


