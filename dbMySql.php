<?php
require_once('DB.php');
 class dbMySql extends DB{

 private $pdo;  // ver si private o protected
 private $message;

 public function __construct(){
    $this->pdo = new PDO('mysql:host=localhost',"root", '');
    $this->archivo = 'usuarios.json';
 }

 public function getMessage(){
   return $this->message;
 }

 public function my_db(){
    $consultaDeVerificacion_db = $this->pdo->prepare("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'basedeprueba'");
    $consultaDeVerificacion_db->execute();
    $resultadoDeVerificacion = $consultaDeVerificacion_db->fetchAll(PDO::FETCH_ASSOC);
    if(count($resultadoDeVerificacion)==0)
    {
           $crear_db = $this->pdo->prepare('CREATE DATABASE IF NOT EXISTS baseDePrueba');
           $crear_db->execute();

           if($crear_db){
           $use_db = $this->pdo->prepare('USE baseDePrueba');
           $use_db->execute();
           }
  /*header('location: script.php?cdb=ok');
  exit;*/  $this->message = "¡Base de datos creada exitosamente!";
    } else {
       $this->message = "¡La base de datos ya ha sido creada previamente!";
    }
 }

  public function createTable(){
   $use_db = $this->pdo->prepare('USE baseDePrueba');
   $use_db->execute();


   $consultaDeVerificacion_db = $this->pdo->prepare("SELECT COUNT(*) AS count FROM information_schema.tables WHERE table_schema = 'basedeprueba' AND table_name = 'user'");
   $consultaDeVerificacion_db->execute();
   $resultadoDeVerificacion = $consultaDeVerificacion_db->fetchAll(PDO::FETCH_ASSOC);
   if(count($resultadoDeVerificacion)==0)
   {
    $crear_table = $this->pdo->prepare('CREATE TABLE IF NOT EXISTS users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nameComplete VARCHAR(60) NOT NULL,
        username VARCHAR(30) NOT NULL,
        email VARCHAR(50),
        country VARCHAR(30),
        registration_date TIMESTAMP,
        password VARCHAR(60))');
    $crear_table->execute();
    /*header('location: script.php?lalala=ok');
    exit;*/
    $this->message = "¡Tabla creada exitosamente!";
      } else {
         $this->message = "¡La tabla ya ha sido creada previamente!";
      }
  }

  public function migrationToMySql(){
    $usuariosJson = file_get_contents($this->archivo);
    $usuariosArray = explode(PHP_EOL, $usuariosJson);
    array_pop($usuariosArray);
    foreach ($usuariosArray as $usuarioParaDecode) {
        $usuarios[] = json_decode($usuarioParaDecode, true);
    }
     $use_db = $this->pdo->prepare('USE baseDePrueba');
     $use_db->execute();

     foreach ($usuarios as $usuarios) {
       $consultaPrevia= " SELECT email FROM users WHERE email = :email";
       $query=$this->pdo->prepare($consultaPrevia);
       $query->bindValue(':email',$usuarios['email'],PDO::PARAM_STR);
       $query->execute();
       $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
       if(count($resultado)==0)
       {
         $consulta= " INSERT INTO users (nameComplete, username, email, country, password)
                         VALUES (:name, :username, :email, :country, :password)";
         $query=$this->pdo->prepare($consulta);
         $query->bindValue(':name',$usuarios['name'],PDO::PARAM_STR);
         $query->bindValue(':username',$usuarios['username'],PDO::PARAM_STR);
         $query->bindValue(':email',$usuarios['email'],PDO::PARAM_STR);
         $query->bindValue(':country',$usuarios['pais'],PDO::PARAM_STR);
         $query->bindValue(':password',$usuarios['pass'],PDO::PARAM_STR);
         $query->execute();
       }

      }
    /*header('location: script.php?lol=ok');
    exit;*/
  }

}

?>
