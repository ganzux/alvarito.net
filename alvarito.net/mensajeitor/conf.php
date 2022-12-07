<?php exit; ?>

 $max_char = 9;                   // Máximo de carácteres por nick

 $cod_html = "OFF";               // Código html activado o desactivado, se recomienda deasctivarlo

 $anti_urls = "ON";               // Censurar urls, activalo si no quieres que un continuo spam

 $smilies = "ON";                 // Para que los usuarios pongan sus caretos :)

 $NicksRegs = array("ito:629737616","bixito:666305174");           // Aquí pon todos los nicks que estarán protegidos por contraseña "nick:contraseña", ATENCIÓN! BORRA LOS NICKS QUE NO VAYAS A UTILIZAR.

 $nick_defecto = "Tu Nick";       // Nick que saldrá por defecto al cargar mensajeitor

 $mensa_defecto = "Tu mensaje";   // Mensaje que saldrá por defecto al cargar mensajeitor

 $nick_info = "H F IP"; 	  // Información que se mostrará en el nick H (hora a la que se introdujo el mensaje)
				  // F (Fecha a la que se introdujo) e IP (la ip del usuario) Puedes cambiar el orden o eliminar la información que quieras.

 $word_limit = "ON";              // Limita el tamaño total de cada palabra para que no te desmonten el diseño

 $word_max = 16; /* (complementario de $word_limit, esto no sirve para nada si $word_limit no está activado)
		   Máximo de carácteres por palabra, cuando palabra llegue a ese máximo se hará un salto de línea */

 $cantidad_mensajes = -1;         // Mensajes que se mostraran en el mensajeitor. -1 para mostarlos todos

 $mostrar_features = "OFF";        // Muestra abajo del todo el autor y la configuración del script

 $maxSmileys = 5;                 //Número máximo de smileys por mensaje.

 $maxPalabras = 50;               //Número máximo de palabras por mensaje. -1 para infinito.
 
 $censura = "ON";                 //Substituye las palabras del censura.txt por ***

 $nick_urls = "ON";		  //Permite que los links contengan una url o e-mail

////////////////////////////////////////////////////
//
// Configuración del diseño!
// Puede que tengas que hacer bastantes pruebas
// antes de encontrar la medida perfecta
//
////////////////////////////////////////////////////

  $divWidth = "170";      // En píxeles, anchura del cuadro de mensajes
  $divHeight = "200";     // En píxeles, altura del cuadro de mensajes

  $Table1Width = "100%";  // Porcentages o píxeles, anchura de la tabla principal
  $Table2Width = "180";   // Porcentages o píxeles, anchura de la tabla donde se muestran los mensajes
  $Table3Width = "100%";  // Porcentages o píxeles, anchura de la tabla que contiene el formulario

// Fin de configuración
