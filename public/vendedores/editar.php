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
$vendedor = $daoVendedor->porId( $_GET['id'] );
    
if (! $vendedor )
    header('Location: ./index.php');

else {  
    ob_start();

?>
    <div class="container">
        <div class="py-5 text-center">
            <h2>Cadastro de Vendedores</h2>
        </div>
        <div class="row">
            <div class="col-md-12" >

              <form action="atualizar.php" method="POST">

                      <input type="hidden" name="id" 
                          value="<?php echo $vendedor->getId(); ?>">

                    <div class="form-group">
                      <label for="nome">Nome Vendedor(a)</label>
                      <input type="text" placeholder="Nome do vendedor" 
                          value="<?php echo $vendedor->getNome(); ?>"
                          class="form-control" name="nome" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="salario">Salário</label>
                            <input type="number" class="form-control"
                                step="0.01"  id="salario"
                                value="<?php echo $vendedor->getSalario(); ?>" 
                                name="salario" placeholder="Salário R$" required>
                        </div>                            
                        <div class="form-group col-md-6">
                            <label for="matricula">Matrícula</label>
                            <input type="number" class="form-control" id="matricula" 
                                value="<?php echo $vendedor->getMatricula(); ?>" 
                                name="matricula" placeholder="Matrícula" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control" id="cpf"
                            value="<?php echo $vendedor->getCpf(); ?>" 
                            name="cpf" placeholder="CPF" required>
                        </div>                            
                        <div class="form-group col-md-6">
                            <label for="dataNascimento">Data de Nascimento</label>
                            <input type="text" class="form-control" id="dataNascimento"
                            value="<?php echo $vendedor->getDataNascimento(); ?>" 
                            name="dataNascimento" placeholder="xx/xx/xxxx" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Atualizar</button>
                    <a href="index.php" class="btn btn-secondary ml-1" role="button" aria-pressed="true">Cancelar</a>
                  </div>
              </form>
              

            </div>
        </div>
    </div>
<?php

    $content = ob_get_clean();
    echo html( $content );
} // else-if

?>
