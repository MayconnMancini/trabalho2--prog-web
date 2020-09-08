<?php

require_once(__DIR__ . '/../../templates/template-html.php');
require_once(__DIR__ . '/../../db/Db.php');
require_once(__DIR__ . '/../../config/config.php');

$conn = Db::getInstance();

if (! $conn->connect()) {
    die();
}

ob_start();

?>
    <div class="container">
        <div class="py-5 text-center">
            <h2>Cadastro de Vendedores</h2>
        </div>
        <div class="row">
            <div class="col-md-12" >

                <form action="salvar.php" method="POST">

                    <div class="form-group">
                        <label for="nome">Nome do vendedor</label>
                        <input type="text" class="form-control" id="nome"
                            name="nome" placeholder="Nome" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="salario">Salário</label>
                            <input type="number" class="form-control" 
                                step="0.01"  id="salario" 
                                name="salario" placeholder="Salário R$" required>
                        </div>                            
                        <div class="form-group col-md-6">
                            <label for="matricula">Matrícula</label>
                            <input type="number" class="form-control" id="matricula" 
                                name="matricula" placeholder="Matrícula" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control" id="cpf"
                            name="cpf" placeholder="CPF" required>
                        </div>                            
                        <div class="form-group col-md-6">
                            <label for="dataNascimento">Data de Nascimento</label>
                            <input type="text" class="form-control" id="dataNascimento"
                            name="dataNascimento" placeholder="xx/xx/xxxx" required>
                        </div>
                    </div>
                                                    
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <a href="index.php" class="btn btn-secondary ml-1" role="button" aria-pressed="true">Cancelar</a>

                </form> 
            </div>
        </div>
    </div>
<?php

$content = ob_get_clean();
echo html( $content );
    
?>


