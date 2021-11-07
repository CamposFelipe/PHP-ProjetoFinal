<?php
//CHAMA A CLASSE DE CONEXAO BANCO
require 'conexaobanco.class.php';
//CRIA A CLASSE CLIENTEDAO
class ClienteDAO{
  //CONEXAO
  private $conexao = null;
  public function __construct(){
    $this->conexao = ConexaoBanco::getInstance();
  }//fecha construct
  public function __destruct(){}
  public function cadastrarCliente($cli){//objeto cliente
    try {
      //INSERE DADOS NA TABELA CLIENTE
      $stat = $this->conexao->prepare("insert into cliente(idCliente,nomeCompleto,sexo,dataNasc,telefone,endereco)values(null,?,?,?,?,?)");
      //BINDVALUES PARA SETAR VALORES
      $stat->bindValue(1,$cli->nomeCompleto);
      $stat->bindValue(2,$cli->sexo);
      $stat->bindValue(3,$cli->dataNasc);
      $stat->bindValue(4,$cli->telefone);
      $stat->bindValue(5,$cli->endereco);
      $stat->execute();
    } catch (Exception $e) {
      return "Erro ao cadastrar cliente! ".$e;
    }//fecha catch
  }//fecha cadastrarCliente
  public function buscarCliente(){
    try {
      //BUSCA DADOS DA TABELA CLIENTE
      $stat = $this->conexao->query("select * from cliente");
      $array = $stat->fetchAll(PDO::FETCH_CLASS,'Cliente');
      return $array;//retorna array com os dados de cliente
    } catch (Exception $e) {
      return "Erro ao buscar cliente! ".$e;
    }//fecha catch
  }//fecha buscarCliente
  public function filtrarCliente($query){
    try {
      //BUSCA DADOS ESPECIFICOS DA TABELA CLIENTE
      $stat = $this->conexao->query("select * from cliente ".$query);
      $array = $stat->fetchALL(PDO::FETCH_CLASS, 'Cliente');
      return $array;//retorna array com dados especificos do cliente
    } catch (Exception $e) {
      return "Erro ao filtrar cliente! ".$e;
    }//fecha catch
  }//fecha filtrarCliente
  public function deletarCliente($idCliente){
    try {
      //DELETA DADOS DA TABELA CLIENTE COM A ID ESPECIFICA
      $stat = $this->conexao->prepare("delete from cliente where idcliente = ?");
      $stat->bindValue(1,$idCliente);
      $stat->execute();
    } catch (Exception $e) {
      "Erro ao deletar cliente! ".$e;
    }//fecha catch
  }//fecha deletarCliente
  public function alterarCliente($cli){
    try {
      //ALTERA OS DADOS DA TABELA CLIENTE
      $stat = $this->conexao->prepare("update cliente set nomeCompleto=?, sexo=?, dataNasc=? ,telefone=? ,endereco=? where idCliente=?");
      $stat->bindValue(1,$cli->nomeCompleto);
      $stat->bindValue(2,$cli->sexo);
      $stat->bindValue(3,$cli->dataNasc);
      $stat->bindValue(4,$cli->telefone);
      $stat->bindValue(5,$cli->endereco);
      $stat->bindValue(6,$cli->idCliente);
      $stat->execute();
    } catch (Exception $e) {
      return "Erro ao alterar cliente! ".$e;
    }//fecha catch
  }//fecha alterarCliente
  public function gerarJSONCliente(){
    try {
      //SELECIONA A TABELA CLIENTE
      $stat = $this->conexao->query("select * from cliente");
      //RETORNA A TABELA CLIENTE EM JSON
      return json_encode($stat->fetchAll(PDO::FETCH_ASSOC));
    } catch (Exception $e) {
      "Erro ao gerar JSON de cliente! ".$e;
    }//fecha catch
  }//fecha gerarJSONCliente
}//fecha classe
