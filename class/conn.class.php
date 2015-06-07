<?php
abstract class Conn{
     private static $Host = 'localhost';
     private static $User = 'root';
     private static $Pass = 'vertrigo';    
     private static $Base = 'bf_sysadmin';
    
    
    private static $Conection = null;
    
    protected  static function Conexao(){
       if(self::$Conection == null){
           self::$Conection = mysqli_connect(self::$Host, self::$User, self::$Pass, self::$Base);
       }
       return self::$Conection;
       echo self::$Conection;
    }
}
?>
