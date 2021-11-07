<?php
class Funcionario{
  //ATRIBUTOS
  private $idFuncionario;
  private $nome;
  private $cargo;
  private $vendas;
  private $telefone;
  private $salario;
  //CONSTRUCT/DESTRUCT
  public function __construct(){}
  public function __destruct(){}
  //GET/SET
  public function __get($a){return $this->$a;}
  public function __set($a, $v){$this->$a = $v;}
  //TO STRING
  public function __toString(){
    return nl2br("ID: $this->idFuncionario
                  Nome: $this->nome
                  Cargo: $this->cargo
                  Vendas: $this->vendas
                  Telefone: $this->telefone
                  Salário: $this->salario");
  }//fecha toString
}//fecha classe
