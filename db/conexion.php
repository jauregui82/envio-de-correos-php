<?php
//CONEXION A MySQL PDO
/**
* 
*/
class Conexion extends PDO { 
   private $tipo_de_base = 'mysql';
   private $host = 'localhost';
   private $nombre_de_base = 'test_excel_mysql';

   private $usuario = 'root';
   private $contrasena = ''; 
   public function __construct() {
      //Sobreescribo el método constructor de la clase PDO.
      try{
         parent::__construct($this->tipo_de_base.':host='.$this->host.';dbname='.$this->nombre_de_base, $this->usuario, $this->contrasena);
      }catch(PDOException $e){
         echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
         exit;
      }
   } 
 }

   class Db
   {
      private static $instance=NULL;
      
      private function __construct(){}

      private function __clone(){}
      
      public static function getConnect(){
         if (!isset(self::$instance)) {
            $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
            self::$instance= new PDO('mysql:host=localhost;dbname=mastersite','root','',$pdo_options);
         }
         return self::$instance;
      }
   } 
?>