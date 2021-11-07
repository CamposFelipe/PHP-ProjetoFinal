<?php
class ConexaoBanco extends PDO {
  private static $instance = null;
  //NOME DO BANCO, USUARIO, SENHA
  public function __construct($dsn,$user,$pass){
    //CONSTRUTOR DA CLASSE PAI 'PDO'
    parent::__construct($dsn,$user,$pass);
  }//fecha construct
  public static function getInstance(){
    if(!isset(self::$instance)){
      try{
        //CRIA E RETORNA UMA NOVA CONEXÃO
        self::$instance = new ConexaoBanco("mysql:dbname=lojainfo;host=localhost","root","");
      }catch(PDOException $e){
        echo "Erro ao fazer a conexão com o banco de dados! ".$e;
      }//fecha catch
    }//fecha if
    return self::$instance;
  }//fecha método
}//fecha classe
