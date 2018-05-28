<?php
require_once('funciones.php'); //borrar una vez que esten migradas las funciones
require_once('soporte.php');
require_once('usuario.php');

	if (!estaLogueado()) {  //esta logueado devuelve si la session[id] esta seteada o no
		header('location: inicio-sesion.php');
		exit;
	}
	$usuario = traerPorId($_SESSION['id']);
 ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Voyager - Planificá tu viaje</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        p {
            font-size: 1.2em;
        }
    </style>
</head>

<body>
  <header class="fixed-top row bg-blue justify-content-md-between mb-3 p-1 pl-2 d-flex align-items-center">
      <div class="col-12 col-sm-6 col-md-2 col-lg-3 ">
          <img alt="logotipo" src="imagenes/logo.png" class="d-block logotipo">
          </div>
      <div class="select-dropdown d-none d-md-inline col-md-5 col-lg-6">

<!-- para que funcionen los getters voy a tener que lograr que traerPorId devuelva un objeto del tipo usuario -->
				<h1>Hola <?=$usuario->getName()?></h1>
				<img class="img-rounded" style="border-radius:100px" src="<?=$usuario->getImagen()?>" width="100px">
				<br><br>
				<!-- <a class="btn btn-warning" href="logout.php">CERRAR SESIÓN</a> -->



      </div>
      <div class="col-12 col-sm-6 col-md-3 col-lg-3">
          <div>
              <button class="toggle-nav d-md-none d-lg-none mt-2">
                                <span class="ion-navicon-round"></span>
                              </button>
              <nav class="main-nav d-md-none d-lg-none" style="display: none;">
                  <ul>
                      <li><a href="faq.html">preguntas frecuentes</a></li>
                      <li><a href="#">seguridad</a></li>
                      <li><a href="#ancla-contacto">contacto</a></li>
                      <li><a href="#">idioma</a></li>
                    </ul>
              </nav>

              <a href="logout.php" class="btn btn-outline-light mt-1 btn-group-justified">Cerrar sesión</a>

          </div>
      </div>

  </header>


  <footer class="bg-blue margin mt-3 text-white text-center">
    <a name="ancla-contacto"></a>
      <p class="pt-2">SEGUINOS</p>
      <a href="https://www.facebook.com/" target="_blank"><span class="ion-social-facebook-outline m-2"></span></a>
      <a href="https://twitter.com/?lang=es" target="_blank"><span class="ion-social-twitter-outline m-2"></span></a>
      <a href="https://www.instagram.com/" target="_blank"><span class="ion-social-instagram-outline m-2"></span></a>
      <a href="https://www.tumblr.com/" target="_blank"><span class="ion-social-tumblr-outline m-2"></span></a>
  </footer>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script>
      /* global $ */
      $('.toggle-nav').click(function() {
          $('.main-nav').slideToggle('fast');
      });
      window.onscroll = function() {
          myFunction()
      };
  </script>

</body>

</html>
