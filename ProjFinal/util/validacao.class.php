<?php
class Validacao {

  public static function validarNome($val) : Int {
    $exp = "/^[a-zA-ZÀ-ú ]{2,30}$/";
    return preg_match($exp, $val);
  }
  public static function validarIdade($val) : Int {
    $exp = "/^[0-9]{1,3}$/";
    return preg_match($exp, $val);
  }
  public static function validarTelefone($val) : Int {
    $exp = "/^\(?\d{2}\)?[\s-]?\d{4}-?\d{4}$/";
    return preg_match($exp, $val);
  }
  public static function validarSexo($val) : Int {
    $exp = "/^[A-z]{8,9}$/";
    return preg_match($exp, $val);
  }
  public static function validarTxt($val) : Int {
    $exp = "/^[A-z 0-9]$/";
    return preg_match($exp, $val);
  }
}//fecha classe
