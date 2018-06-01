<?php
//agrego el require_once de la clase db
require_once ('db.php');

class dbJSON extends DB{
   //declaro variable de la clase
    private $archive;

//declaro constructor
public function __construct(){
  $this->archive="usuarios.json";
}

//busca si existe un usuario registrado con ese mail en el Json
public function existeMail($email){

    $todos = $this->traerTodos();

    foreach ($todos as $unUsuario) {
    			if ($unUsuario->getEmail() == $email) {                                               // ACAAAAAAAAAAAAAAA
    							return $unUsuario;
    																				 }
    	                              }
  	return false;
  }  //SI EXISTE ME DEVUELVE EL USUARIO

//trae todos los usuarios del Json
public function traerTodos(){
    		$todosJson = file_get_contents($this->archive);
    		// Esto me arma un array con todos los usuarios
    		$usuariosArray = explode(PHP_EOL, $todosJson);    // creo que usuariosArray tiene solo 2 posiciones la ultima es vacia
    		// Saco el último elemento que es una línea vacia
    		array_pop($usuariosArray);
    		// Creo un array vacio, para guardar los usuarios
    		$todosPHP = [];
    		// Recorremos el array y generamos por cada usuario un array del usuario
    		foreach ($usuariosArray as $usuario) {
    			$usuarioJSON[] = json_decode($usuario, true);   // PREGUNTAR PORQUE HACEMOS ESTO EN UN foreach !!!!!!!!!!!!!!!!!!!!!!!!!!!
        //agrego para que devuelva un array de objetos de la clase USUARIO
        $usuario= new Usuario($usuarioJSON['name'],$usuarioJSON['username'], $usuarioJSON['email'], $usuarioJSON['pass'], $usuarioJSON['pais'], $usuarioJSON['imagen']);)
        $usuario->setId($usuarioJSON['id']);
        $todosPHP[]=$usuario;
        }
        return $todosPHP;
  }

//guarda usuario en el JSON (usa crearUsuario() que va estar declarada en clase usuario
//paso variables Usuario y DB. Corregir invocacion de funcion con pasaje de variables
function guardarUsuario(Usuario $usuario, DB $db){  /*ACA HAY ALGO PARA PREGUNTAR*/
      $usuariotemp = $usuario->crearUsuario($db);
   		$usuarioJSON = json_encode($usuariotemp);
   		file_put_contents($this->archive, $usuarioJSON . PHP_EOL, FILE_APPEND);
   		// Devuelvo al usuario para poder auto loguearlo después del registro   MIRAR ACAAAAAAAAAAAAAAAAAAAAAAAAAAA
   		return $usuario;
}


//busca ultimo ID para asignar a nuevo usuario
public function traerUltimoId(){

  $arrayDeUsuarios=$this->traerTodos();
  if(empty($arrayDeUsuarios)){
      return 1;
  }
  //si hay usuarios en el array, traigo el ultimo
  $elUltimo = array_pop($arrayDeUsuarios);
  $id = $elUltimo->getId();
  //$id = $elUltimo->id;                                                        //   MODIFIQUE ACAAAAAAAAAAA
  //$id = $elUltimo->getId();
  return $id + 1;
  }


  //guarda Imagen de usuario en Json
  function guardarImagen($imagen,$email){   // aca modifique $imagen antes estaba $_FILES[$imagen]
      // $errores = [];
     if ($imagen['error'] == UPLOAD_ERR_OK) {
  				     $nombreArchivo = $imagen['name'];
  				     $ext = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
  				     $archivoFisico = $imagen['tmp_name'];
  				     // Pregunto si la extensión es la deseada
  				    // if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png') {   VAMOS A ELIMINAR ESTO PORQUE EN TEORIA YA LO COMPRUEBA EN LA FUNCION VALIDAR
  				       // Armo la ruta donde queda gurdada la imagen
  				       $direccionReal = dirname(__FILE__);
  				       $rutaFinalConNombre = $direccionReal . '/imagenUsuarios/' . $email. '.' . $ext;
  				       // Subo la imagen definitivamente
  				       move_uploaded_file($archivoFisico, $rutaFinalConNombre);
  				                  /* } else {
  				                       $errores['imagen'] = 'El formato tiene que ser JPG, JPEG, PNG o GIF';
  				                     }
  				                   } else {
  				                     // Genero error si no se puede subir
  				                     $errores['imagen'] = 'No subiste nada';
  				                   }
  				                    return $errores;*/
  				                    // VAMOS A PROBAR HACIENDO QUE guardarImagen no devuelva nada simplemente se dedique a guardar la imagen

   }
  }

  //traje traerPorId($id) desde funciones.php
  public function traerPorId($id){
  		$todos = $this->traerTodos();
  		// Recorro el array de todos los usuarios
  		foreach ($todos as $usuario) {
  			if ($id == $usuario->getId()) {
  				return $usuario;
  			}
  		}
  		return false;
  	}
  }

} ?>
