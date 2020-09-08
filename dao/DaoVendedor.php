<?php 
require_once(__DIR__ . '/../model/Vendedor.php');
require_once(__DIR__ . '/../db/Db.php');

// Classe para persistencia de Vendedores 
// DAO - Data Access Object
class DaoVendedor {
    
  private $connection;

  public function __construct(Db $connection) {
      $this->connection = $connection;
  }
  
  public function porId(int $id): ?Vendedor {
    $sql = "SELECT vendedores.nome, vendedores.cpf, 
                   vendedores.matricula, vendedores.salario, vendedores.datanascimento 
            FROM vendedores 
            WHERE vendedores.id = ?";
    $stmt = $this->connection->prepare($sql);
    $prod = null;
    if ($stmt) {
      $stmt->bind_param('i',$id);
      if ($stmt->execute()) {
        $stmt->bind_result($nome,$cpf,$matricula,$salario,$datanascimento);
        $stmt->store_result();
        if ($stmt->num_rows == 1 && $stmt->fetch()) {
          $vend = new Vendedor($nome,$cpf,$matricula,$salario,$datanascimento, $id);
        }
      }
      $stmt->close();
    }
    return $vend;
  }

  public function inserir(Vendedor $vendedor): bool {
    $sql = "INSERT INTO vendedores (nome,cpf,matricula,salario,datanascimento) VALUES(?,?,?,?,?)";
    $stmt = $this->connection->prepare($sql);
    $res = false;
    if ($stmt) {
      $nome = $vendedor->getNome();
      $cpf = $vendedor->getCpf();
      $matricula = $vendedor->getMatricula();
      $salario = $vendedor->getSalario();
      $datanascimento = $vendedor->getDataNascimento();
      $stmt->bind_param('ssids', $nome, $cpf, $matricula, $salario, $datanascimento);
      if ($stmt->execute()) {
          $id = $this->connection->getLastID();
          $vendedor->setId($id);
          $res = true;
      }
      $stmt->close();
    }
    return $res;
  }

  public function remover(Vendedor $vendedor): bool {
    $sql = "DELETE FROM vendedores where id=?";
    $id = $vendedor->getId(); 
    $stmt = $this->connection->prepare($sql);
    $ret = false;
    if ($stmt) {
      $stmt->bind_param('i',$id);
      $ret = $stmt->execute();
      $stmt->close();
    }
    return $ret;
  }

  public function atualizar(Vendedor $vendedor): bool {
    $sql = "UPDATE vendedores SET nome=?, cpf=?, matricula=?, salario=?, datanascimento=? WHERE id = ?";
    $stmt = $this->connection->prepare($sql);
    $ret = false;      
    if ($stmt) {
      $nome = $vendedor->getNome();
      $cpf = $vendedor->getCpf();
      $matricula = $vendedor->getMatricula();
      $salario = $vendedor->getSalario();
      $datanascimento = $vendedor->getDataNascimento();      
      $id   = $vendedor->getId();
      $stmt->bind_param('ssidsi', $nome, $cpf, $matricula, $salario, $datanascimento, $id);
      $ret = $stmt->execute();
      $stmt->close();
    }
    return $ret;
  }

  
  public function todos(): array {
    $sql = "SELECT vendedores.id, vendedores.nome, vendedores.cpf, 
                   vendedores.matricula, vendedores.salario, vendedores.datanascimento
            FROM vendedores";
    $stmt = $this->connection->prepare($sql);
    $vendedores = [];
    if ($stmt) {
      if ($stmt->execute()) {
        $id = 0; $nome = '';
        $stmt->bind_result(
          $id, $nome, $cpf, $matricula, $salario, $datanascimento
        );
        $stmt->store_result();
        while($stmt->fetch()) {
          $vendedores[] = new Vendedor($nome, $cpf, $matricula, $salario, $datanascimento, $id);
        }
      }
      $stmt->close();
    }
    return $vendedores;
  }

};

