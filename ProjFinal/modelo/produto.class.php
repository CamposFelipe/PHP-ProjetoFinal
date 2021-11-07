<?php
class Produto{
  //ATRIBUTOS
  private $idProd;
  private $nomeProd;
  private $valorProd;
  private $marcaProd;
  private $classeProd;
  private $quantEstoque;
  //CONSTRUCT/DESTRUCT
  public function __construct(){}
  public function __destruct(){}
  //GET/SET
  public function __get($a){return $this->$a;}
  public function __set($a, $v){$this->$a = $v;}
  //TO STRING
  public function __toString(){
    return nl2br("ID: $this->idProd
                  Nome: $this->nomeProd
                  Preço: $this->valorProd
                  Marca: $this->marcaProd
                  Classe: $this->classeProd
                  Quantidade em Estoque: $this->quantEstoque");
  }//fecha toString
}//fecha classe
