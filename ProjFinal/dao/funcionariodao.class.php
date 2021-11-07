<?php
//CHAMA A CLASSE DE CONEXAO BANCO
require 'conexaobanco.class.php';
//CRIA A CLASSE FUNCIONARIODAO
class FuncionarioDAO{
  //CONEXAO
  private $conexao = null;
  public function __construct(){
    $this->conexao = ConexaoBanco::getInstance();
  }//fecha construct
  public function __destruct(){}
  public function cadastrarFuncionario($f){//objeto funcionario
    try {
      //INSERE DADOS NA TABELA FUNCIONARIO
      $stat = $this->conexao->prepare("insert into funcionario(idFuncionario,nome,cargo,vendas,telefone,salario)values(null,?,?,?,?,?)");
      //BINDVALUES PARA SETAR VALORES
      $stat->bindValue(1,$f->nome);
      $stat->bindValue(2,$f->cargo);
      $stat->bindValue(3,$f->vendas);
      $stat->bindValue(4,$f->telefone);
      $stat->bindValue(5,$f->salario);
      $stat->execute();
    } catch (Exception $e) {
      return "Erro ao cadastrar funcionário! ".$e;
    }//fecha catch
  }//fecha cadastrarFuncionario
  public function buscarFuncionario(){
    try {
      //BUSCA DADOS DA TABELA FUNCIONARIO
      $stat = $this->conexao->query("select * from funcionario");
      $array = $stat->fetchAll(PDO::FETCH_CLASS,'Funcionario');
      return $array;//retorna array com os dados de funcionario
    } catch (Exception $e) {
      return "Erro ao buscar funcionário! ".$e;
    }//fecha catch
  }//fecha buscarFuncionario
  public function filtrarFuncionario($query){
    try {
      //BUSCA DADOS ESPECIFICOS DA TABELA FUNCIONARIO
      $stat = $this->conexao->query("select * from funcionario ".$query);
      $array = $stat->fetchALL(PDO::FETCH_CLASS, 'Funcionario');
      return $array;//retorna array com dados especificos do funcionario
    } catch (Exception $e) {
      return "Erro ao filtrar funcionário! ".$e;
    }//fecha catch
  }//fecha filtrarFuncionario
  public function deletarFuncionario($idFuncionario){
    try {
      //DELETA DADOS DA TABELA FUNCIONARIO COM A ID ESPECIFICA
      $stat = $this->conexao->prepare("delete from funcionario where idfuncionario = ?");
      $stat->bindValue(1,$idFuncionario);
      $stat->execute();
    } catch (Exception $e) {
      "Erro ao deletar funcionário! ".$e;
    }//fecha catch
  }//fecha deletarFuncionario
  public function alterarFuncionario($f){
    try {
      //ALTERA OS DADOS DA TABELA FUNCIONARIO
      $stat = $this->conexao->prepare("update funcionario set nome=?, cargo=?, vendas=? ,telefone=? ,salario=? where idFuncionario=?");
      $stat->bindValue(1,$f->nome);
      $stat->bindValue(2,$f->cargo);
      $stat->bindValue(3,$f->vendas);
      $stat->bindValue(4,$f->telefone);
      $stat->bindValue(5,$f->salario);
      $stat->bindValue(6,$f->idFuncionario);
      $stat->execute();
    } catch (Exception $e) {
      return "Erro ao alterar funcionário! ".$e;
    }//fecha catch
  }//fecha alterarFuncionario
  public function gerarJSONFuncionario(){
    try {
      //SELECIONA A TABELA FUNCIONARIO
      $stat = $this->conexao->query("select * from funcionario");
      //RETORNA A TABELA FUNCIONARIO EM JSON
      return json_encode($stat->fetchAll(PDO::FETCH_ASSOC));
    } catch (Exception $e) {
      "Erro ao gerar JSON de funcionário! ".$e;
    }//fecha catch
  }//fecha gerarJSONFuncionario
}//fecha classe
