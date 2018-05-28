

1) borre de validaciones estaLogueado() y loguear() -> estan declaradas en clase auth.
NOTA: tengo que corregir la invocación (como funciones del objeto en registro e inicio-sesion.php

2) validarDatos() y validarLogin() quedan en nuestra clase validaciones
en el ejemplo de javi estan en clase validate tambien

3)declaro en clase dbJSON constructor y funciones: existeEmail(), traerTodos(), traerUltimoID(), traerPorID(),
guardarUsuario(), guardarImagen()
Algunas las teniamos declaradas en la clase Usuarios y otras en funciones.php 
las dejo comentadas en Usuarios y funciones.php

nota: revisar guardarImagen() que tenemos comentados la deteccion de errores.

4) mude crearUsuario() a clase usuario
Tengo que revisar si es compatible

5) tengo que corregir que devuelva un objeto de la clase usuario traerPorID()

6) quedo la validación del seteo de la cookie para traer la sesion en funciones.php. 
Tambien esta comentada (y con otra implementación en auth.php). Revisar cual corresponde.

7) quedó agregada la parte de guardar la imagen del usuario en el JSON. Validar que se guardé correctamente.
la funcion guardarImagen() no está implementada como OOP aun.

8) Javi tenia declarado como abstract varias funciones en dB.php ver si es necesario implementarlo asi

9)revisar config-perfil.php y perfil.php (sobre todos las invocaciones a las funciones como objetos de clase).

10) revisar soporte.php

11) no toque ni DBMySQL ni script.php porque no hay que aplicarle OOP.