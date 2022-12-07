<?
	// Recogemos los datos del formulario
	$nombre = $HTTP_POST_VARS['nombre'];
	$email = $HTTP_POST_VARS['email'];
	$comentarios = $HTTP_POST_VARS['comentarios'];
	$tegusta = $HTTP_POST_VARS['tegusta'];
	
	// Componemos el mail
	$mensaje = "Nombre: $nombre \n Email: $email \n Comentarios: $comentarios \n Te gusta la web: $tegusta";
	$asunto = "¡ A $nombre $tegusta le gusta la Web !";
	$destinatario = 'administrador@calasancio.net';
	$cabeceras = 'From: Comentarios desde la Web' . "\r\n" . 'Reply-To: administrador@calasancio.net';
	
	// Enviamos el mail
	mail($destinatario, $asunto, $mensaje, $cabeceras);
	
	// Redirigimos
	header("Location: enviado.php");
?>