<?php exit; ?>

 $max_char = 9;                   // M�ximo de car�cteres por nick

 $cod_html = "OFF";               // C�digo html activado o desactivado, se recomienda deasctivarlo

 $anti_urls = "ON";               // Censurar urls, activalo si no quieres que un continuo spam

 $smilies = "ON";                 // Para que los usuarios pongan sus caretos :)

 $NicksRegs = array("ito:629737616","bixito:666305174");           // Aqu� pon todos los nicks que estar�n protegidos por contrase�a "nick:contrase�a", ATENCI�N! BORRA LOS NICKS QUE NO VAYAS A UTILIZAR.

 $nick_defecto = "Tu Nick";       // Nick que saldr� por defecto al cargar mensajeitor

 $mensa_defecto = "Tu mensaje";   // Mensaje que saldr� por defecto al cargar mensajeitor

 $nick_info = "H F IP"; 	  // Informaci�n que se mostrar� en el nick H (hora a la que se introdujo el mensaje)
				  // F (Fecha a la que se introdujo) e IP (la ip del usuario) Puedes cambiar el orden o eliminar la informaci�n que quieras.

 $word_limit = "ON";              // Limita el tama�o total de cada palabra para que no te desmonten el dise�o

 $word_max = 16; /* (complementario de $word_limit, esto no sirve para nada si $word_limit no est� activado)
		   M�ximo de car�cteres por palabra, cuando palabra llegue a ese m�ximo se har� un salto de l�nea */

 $cantidad_mensajes = -1;         // Mensajes que se mostraran en el mensajeitor. -1 para mostarlos todos

 $mostrar_features = "OFF";        // Muestra abajo del todo el autor y la configuraci�n del script

 $maxSmileys = 5;                 //N�mero m�ximo de smileys por mensaje.

 $maxPalabras = 50;               //N�mero m�ximo de palabras por mensaje. -1 para infinito.
 
 $censura = "ON";                 //Substituye las palabras del censura.txt por ***

 $nick_urls = "ON";		  //Permite que los links contengan una url o e-mail

////////////////////////////////////////////////////
//
// Configuraci�n del dise�o!
// Puede que tengas que hacer bastantes pruebas
// antes de encontrar la medida perfecta
//
////////////////////////////////////////////////////

  $divWidth = "170";      // En p�xeles, anchura del cuadro de mensajes
  $divHeight = "200";     // En p�xeles, altura del cuadro de mensajes

  $Table1Width = "100%";  // Porcentages o p�xeles, anchura de la tabla principal
  $Table2Width = "180";   // Porcentages o p�xeles, anchura de la tabla donde se muestran los mensajes
  $Table3Width = "100%";  // Porcentages o p�xeles, anchura de la tabla que contiene el formulario

// Fin de configuraci�n
