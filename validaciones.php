<?php
class Validaciones{

//modifico paso la DB como en el ejemplo de OOP
public function validarDatos(DB $db, $imagen){
  $errores=array();
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $pais = trim($_POST['pais']);
  $pass = trim($_POST['pass']);
  $rpass = trim($_POST['rpass']);
  $username = trim($_POST['username']);


  if ($name == '') {
      $errores['name'] = "Completa tu nombre";
  }
  if ($username == '') {
      $errores['username'] = "Completa tu nombre de usuario";
  }
  if ($pais == '') {
      $errores['pais'] = "Completa tu país de origen";
  }
  if ($email == '') {
      $errores['email'] = "Completa tu email";
  }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errores['email'] = "El email indicado es incorrecto";
  } elseif ($db->existeMail($email)) {
    $errores['email'] = "Este mail ya se encuentra registrado";
  }
  if ($pass == '' || $rpass == '') {
      $errores['pass'] = "Por favor completa tu password";
  }elseif ($pass != $rpass) {
      $errores['pass'] = "Las contraseñas no coinciden";
  }

  if($imagen['error'] !== UPLOAD_ERR_OK){
          $errores['imagen'] = 'Por favor subí tu foto de perfil';
  } else {
           $ext = strtolower(pathinfo($imagen['name'], PATHINFO_EXTENSION)); // VAMOS A PASAR A MINUSCULA

           if ($ext !== 'jpg' && $ext !== 'jpeg' && $ext !== 'png')  {
             $errores['imagen']= "Formato no reconocido, subi solamente jpg, jpeg, JPG o png: La extension subida es: $ext";
           }
            /*else {
                //             PREGUNTAR ACA   guardarImagen($imagen);
              }*/
   }
   return $errores;
}

//paso la DB
public function validarLogin(DB $db){
   $arrayADevolver = [];
   $email = trim($_POST['e-mail']);
   $pass = trim($_POST['password']);
   if ($email == '') {
               $arrayADevolver['email'] = 'Completá tu email';
                     } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                                   $arrayADevolver['email'] = 'Poné un formato de email válido';
                                                 } elseif (!$usuario = $db->existeMail($email)) {   //  <--- MIRAR ACA ME GENERA DUDA
                                                 /*  SI NO EXISTE EL MAIL   !false= false*/
                                                   $arrayADevolver['email'] = 'Este email no está registrado';
                                                                           } else {
                                                     // Si el mail existe, me guardo al usuario dueño del mismo
                                                    // $usuario = existeMail($email);   //Esta demas esta creo
/* el $usuario=existeMail se ejecuta igual no?*/		  	if (!password_verify($pass, $usuario->getPassword())) {
                                           $arrayADevolver['pass'] = "Credenciales incorrectas";
                                         }
                                       }
   return $arrayADevolver;

}

} ?>
