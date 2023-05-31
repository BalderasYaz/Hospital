<?php
class Conexion{
   private $conect;
   public function __construct()
   {
      require_once("Config/Config.php");
      $pdo="mysql:host=".host.";dbname=".db.";charset=utf8";
      try{
         $this->conect = new PDO($pdo,user,pass);
         $this->conect ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      }catch(PDOException $e){
         echo "Error en la conexión".$e->getMessage();
      }
   }
   public function conect()
   {
      return $this->conect;
   }
}
?>