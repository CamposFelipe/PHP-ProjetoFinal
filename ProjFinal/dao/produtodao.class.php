<?php
//CHAMA A CLASSE DE CONEXAO BANCO
require 'conexaobanco.class.php';
//CRIA A CLASSE PRODUTODAO
class ProdutoDAO{
  //CONEXAO
  private $conexao = null;
  public function __construct(){
    $this->conexao = ConexaoBanco::getInstance();
  }//fecha construct
  public function __destruct(){}
  public function cadastrarProduto($prod){//objeto produto
    try {
      //INSERE DADOS NA TABELA PRODUTO
      $stat = $this->conexao->prepare("insert into produto(idProd,nomeProd,valorProd,marcaProd,classeProd,quantEstoque)values(null,?,?,?,?,?)");
      //BINDVALUES PARA SETAR VALORES
      $stat->bindValue(1,$prod->nomeProd);
      $stat->bindValue(2,$prod->valorProd);
      $stat->bindValue(3,$prod->marcaProd);
      $stat->bindValue(4,$prod->classeProd);
      $stat->bindValue(5,$prod->quantEstoque);
      $stat->execute();
    } catch (Exception $e) {
      return "Erro ao cadastrar produto! ".$e;
    }//fecha catch
  }//fecha cadastrarProduto
    public function buscarProduto(){
    try {
      //BUSCA DADOS NA TABELA PRODUTO
      $stat = $this->conexao->query("select * from produto");
      $array = $stat->fetchAll(PDO::FETCH_CLASS,'Produto');
      return $array;
    }catch (Exception $e) {
      echo "Erro ao buscar Cadastros! ".$e;
    }//fecha catch
  }//fecha buscarProduto
  public function filtrarProduto($query){
    try {
      //BUSCA DADOS ESPECIFICOS DA TABELA PRODUTO
      $stat = $this->conexao->query("select * from produto ".$query);
      $array = $stat->fetchALL(PDO::FETCH_CLASS, 'Produto');
      return $array;//retorna array com dados especificos do produto
    } catch (Exception $e) {
      return "Erro ao filtrar produto! ".$e;
    }//fecha catch
  }//fecha filtrarProduto
  public function deletarProduto($idProd){
    try {
      //DELETA DADOS DA TABELA PRODUTO COM A ID ESPECIFICA
      $stat = $this->conexao->prepare("delete from produto where idprod = ?");
      $stat->bindValue(1,$idProd);
      $stat->execute();
    } catch (Exception $e) {
      "Erro ao deletar produto! ".$e;
    }//fecha catch
  }//fecha deletarProduto
  public function alterarProduto($p){
    try {
      //ALTERA OS DADOS DA TABELA PRODUTO
      $stat = $this->conexao->prepare("update produto set nomeProd = ?, valorProd = ?, marcaProd = ? ,classeProd = ?, quantEstoque = ? where idProd = ?");
      $stat->bindValue(1,$p->nomeProd);
      $stat->bindValue(2,$p->valorProd);
      $stat->bindValue(3,$p->marcaProd);
      $stat->bindValue(4,$p->classeProd);
      $stat->bindValue(5,$p->quantEstoque);
      $stat->bindValue(6,$p->idProd);
      $stat->execute();
    } catch (Exception $e) {
      return "Erro ao alterar produto! ".$e;
    }//fecha catch
  }//fecha alterarProduto
  public function gerarJSONProduto(){
    try {
      //SELECIONA A TABELA PRODUTO
      $stat = $this->conexao->query("select * from produto");
      //RETORNA A TABELA PRODUTO EM JSON
      return json_encode($stat->fetchAll(PDO::FETCH_ASSOC));
    } catch (Exception $e) {
      "Erro ao gerar JSON de produto! ".$e;
    }//fecha catch
  }//fecha gerarJSONProduto
}//fecha classe
