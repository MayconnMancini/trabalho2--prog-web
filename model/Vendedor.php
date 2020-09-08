<?php 

class Vendedor {
    
  private $id;
  private $nome;
  private $cpf;
  private $matricula;
  private $salario;
  private $dataNascimento;

  public function __construct(string $nome="", string $cpf="", $matricula=0, float $salario=0, string $dataNascimento="", int $id=-1) {
      $this->id = $id;
      $this->nome = $nome;
      $this->cpf = $cpf;
      $this->matricula = $matricula;
      $this->salario = $salario;
      $this->dataNascimento = $dataNascimento;
  }
  
  public function setId(int $id) {
      $this->id = $id;
  }

  public function getId() {
      return $this->id;
  }
  
  public function setNome(string $nome) {
      $this->nome = $nome;
  }

  public function getNome() {
      return $this->nome;
  }
  
  public function setCpf(string $cpf) {
      $this->cpf = $cpf;
  }

  public function getCpf() {
      return $this->cpf;
  }

  public function setMatricula(int $matricula) {
    $this->matricula = $matricula;
  }

  public function getMatricula() {
    return $this->matricula;
  }

  public function setSalario(float $salario) {
      $this->salario = $salario;
  }

  public function getSalario() {
      return $this->salario;
  }

  public function setDataNascimento(string $dtNascimento) {
    $this->dataNascimento = $dtNascimento;
}

public function getDataNascimento() {
    return $this->dataNascimento;
}
};