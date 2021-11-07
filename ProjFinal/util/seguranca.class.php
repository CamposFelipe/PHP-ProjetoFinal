<?php
class Seguranca {
  public static function criptografar($v){
    return md5('Proj'.$v.'Info');
  }//fecha criptografar
}//fecha classe
