<?php

/*
  |------------------------------------------------------------------------------------------------------
  | Author:         Sahith Vibudhi
  | E-Mail:         v.sahithkumar@gmail.com
  | Version:        1.0
  | Released:       March 28, 2017
  | Updated:        March 28, 2017
  |-------------------------------------------------------------------------------------------------------
 */
session_start();

class CSRF{

    private static $name = "form-token";
    const USE_SESSION = false; //SET IT TO TRUE IF YOU WANT TO USE SESSION
    const USE_HASH = true;
    const SECRET = '1>58_>KLY]}p|KquwUeP?yqCt*RZ_rD'; //YOUR SECRET KEY GOES HERE
    const SEPARATOR = '--';
    const ERROR = 'Error: form token validation';

    public static function putTokenField($name = Null, $shouldReturn = false){
      if(empty($name)) $name = self::$name;
      if(self::USE_SESSION){
        //use session to store form token
        $token = $_SESSION[$name];
        //store token in a session
        if($token === null){$token = md5(uniqid()); $session->add($name, $token);}
      }else{
        //use secret key to create a new token for each form
        $salt = md5(uniqid());
        $token = $salt . self::SEPARATOR . md5($salt . self::SECRET);
      }
      $form = "<input type='hidden' name='{$name}' value='{$token}' id='{$name}'>";
      if($shouldReturn) return $form;
      else echo $form;
    }

    public static function isValidRequest($name = Null){
      if(empty($name)) $name = self::$name;
      if(self::USE_SESSION){
        if(!isset($_SESSION[$name]) || !isset($_POST[$name]) || $_SESSION[$name] !== $_POST[$name]){
          die(self::ERROR);
        }
      }else{
        if(!isset($_POST[$name])) die(self::ERROR);
        list($salt, $hash) = explode(self::SEPARATOR, $_POST[$name]);
        if($hash !== md5($salt . self::SECRET)) die(self::ERROR);
      }
      return true;
    }

}

?>
