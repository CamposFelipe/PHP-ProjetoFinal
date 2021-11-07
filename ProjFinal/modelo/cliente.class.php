<?php
class Cliente{
  //ATRIBUTOS
  private $idCliente;
  private $nomeCompleto;
  private $sexo;
  private $dataNasc;
  private $telefone;
  private $endereco;
  //CONSTRUCT/DESTRUCT
  public function __construct(){}
  public function __destruct(){}
  //GET/SET
  public function __get($a){return $this->$a;}
  public function __set($a, $v){$this->$a = $v;}
  //TO STRING
  public function __toString(){
    return nl2br("Nome: $this->nomeCompleto
                  Sexo: $this->sexo
                  Data de Nascimento: $this->dataNasc
                  Telefone: $this->telefone
                  Endereço: $this->endereco");
  }//fecha toString
}//fecha classe
