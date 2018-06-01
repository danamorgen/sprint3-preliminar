<?php

class Auth{

public function__construct(){
//validar si es necesario agregarlo
  session_start();

//validar si el seteo aca esta ok
if (isset($_COOKIE['id']) && !$this->estaLogueado()) {
  $this->loguear($_COOKIE['id']);
}
}
//declaro funcion loguear($usuario)
public function loguear($usuario) {
  // Guardo en $_SESSION el ID del USUARIO
  setcookie('id', $usuario['id'], time() + 3600 * 24 * 30);
 $_SESSION['id'] = $usuario['id'];
header('location: perfil.php');
exit;
}

//declaro funcion estaLogueado()
public function estaLogueado() {
return isset($_SESSION['id']);
}
}

?>
