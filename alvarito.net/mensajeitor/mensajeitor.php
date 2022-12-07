<?php
//////////////////////////////////////////////////////
//
// Mensajeitor PHP v1.8.9 r2 by aaff
// 
// Last modifyed: 19-Sep-2003
// Official Site: http://www.mensajeitor.com
//
//////////////////////////////////////////////////////
//
// This program is free software. You can redistribute it and/or modify 
// it under the terms of the GNU General Public License as published by 
// the Free Software Foundation; either version 2 of the License.       
//  	
//////////////////////////////////////////////////////

// Compatibilidad con nuevas versiones PHP (register_globals = off)

 if(isset($Host) && eregi("iespana.es",$Host)) { $iespana = true; } else { $iespana = false; }

 if(get_cfg_var('register_globals') == 0 AND !$iespana) {

	if($HTTP_POST_VARS) {
	 $nick =& $HTTP_POST_VARS['nick'];
	 $titulo =& $HTTP_POST_VARS['titulo'];
	 $enviar =& $HTTP_POST_VARS['enviar'];
	 $actualizar =& $HTTP_POST_VARS['actualizar'];
	 $url =& $HTTP_POST_VARS['url'];
	 $pass =& $HTTP_POST_VARS['pass'];
	}

 }
 


 
 $nick = htmlspecialchars($nick);
 if(isset($pass)) { $last_pass = $pass; }

 // Cargando Configuración

 $conf = file("conf.php");
 $conf[0] = "";
 eval(join("",$conf));

 // Funciones Principales

 function NickInfo($info_string) {
 	global $HTTP_SERVER_VARS;
  if(isset($HTTP_SERVER_VARS['HTTP_CLIENT_IP'])) { $ip = $HTTP_SERVER_VARS['HTTP_CLIENT_IP']; } else { $ip = $HTTP_SERVER_VARS['REMOTE_ADDR']; }
  $ip = explode(".",$ip); $ip[count($ip)-1] = '*'; $ip = join(".",$ip);
  $info_string = str_replace("H",date("H:i:s"),$info_string);
	$info_string = str_replace("F",date("d-m-Y"),$info_string);
	$info_string = str_replace("IP",$ip,$info_string);
	return $info_string;
 }

 function ShowHtml(&$Message) {
	$Message = str_replace("<","&lt; ",$Message);
	$Message = str_replace(">"," &gt;",$Message);
 }

 function RudeReplace(&$Message,$RudeHandle = 'censura.txt') {
	
	$palabrotas = explode(",",join("",file($RudeHandle)));
	
	if(in_array(strtolower($Message),$palabrotas) AND $Message != "") {
	
		$Message = "***";
		
	}
 }

 function SmileyReplace(&$Message,$MaxSmileys,$SmileysDir = "smilies") {

	global $SmileyCount;

	if($SmileyCount < $MaxSmileys) {
		
		$longitud = strlen($Message); 
		
		if($longitud <= 3) {
			
			$smiley = "";
			
			for($a=0;$a<$longitud;$a++) { 
			
				$smiley .= ord(substr($Message,$a,1)); 
			}
				
			if(file_exists($SmileysDir."/".$smiley.".gif")) {
			
				$SmileyCount++;
                $Message = "<img src=\"".$SmileysDir."/".$smiley.".gif\" border=\"0\" alt=\"smiley\">";
		
			} elseif(file_exists($SmileysDir."/".$smiley.".png")) {
			
				$SmileyCount++;
                $Message = "<img src=\"".$SmileysDir."/".$smiley.".png\" border=\"0\" alt=\"smiley\">";
		
			} elseif(file_exists($SmileysDir."/".$smiley.".jpg")) {
			
				$SmileyCount++;
                $Message = "<img src=\"".$SmileysDir."/".$smiley.".jpg\" border=\"0\" alt=\"smiley\">";
	
			}
		
		} 
	}
 }

 function StripUrls(&$Message) {
	
	if(eregi("http|www",$Message)) {
			
		$Message = str_replace($Message,"***",$Message); 
	}
 
 }

 function LimitWordLength(&$Message,$MaxWordLength) {
	
	if(strlen($Message) > $MaxWordLength) {
		$Message = wordwrap($Message,$MaxWordLength,"<br>",1);
	}
 }
	

 // Constantes (por favor no modifiques esto)

 define("VERSION","1.8.9");
 define("FEATURES","cod. HTML $cod_html<br>no spam $anti_urls<br>limite de caracteres por palabra $word_limit<br>Smileys $smilies");
 define("AUTOR","aaff");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Mensajeitor v<?php echo VERSION; ?></title>
<link rel="stylesheet" href="<?php if(!isset($estilo)) { echo "estilo"; } else { echo $estilo; } ?>.css" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript">
function a1(paco,que) {
  if (paco.value==que) {
    paco.value='';
  }
}
function a2(paco,que) {
  if (paco.value=='') {
    paco.value=que;
  }
}
</script>
<!-- Mensajeitor <?=VERSION;?> http://www.mensajeitor.tk -->
</head>
<body>
<?php

 //Sistema de Identificación

 if(strlen($nick) > $max_char) { echo "<span class=\"tabla\">Este nick no vale!!!!! <a href=\"javascript:history.back(1)\">Volver</a></span>"; exit; }

 for($i=0;$i<count($NicksRegs);$i++) { 
 list($admin_nick,$admin_pass) = explode(":",$NicksRegs[$i]);
 if (eregi($admin_nick,$nick) AND $pass != $admin_pass) { $autentificado = "no"; }
 } 
 if(isset($autenticado) && $autentificado == "no") { echo "<span class=\"tabla\">Este nick no vale!!!!! <a href=\"javascript:history.back(1)\">Volver</a></span>"; exit; }
 if(!eregi("^(http://|mailto:)",$url)) { $url = ''; }
 if(isset($url) && ($url == "http://" || $url == "mailto:")) { $url = ''; }


 if ($nick) { $defecto = $nick; } else { $defecto = $nick_defecto; }
 if ($enviar) 
 {
 // Nick, mensaje: Vacío o sin tocar

 $nick_test = str_replace(" ","",$nick);
 if ($nick_test == "" OR $nick == $nick_defecto) { echo "<span class=\"tabla\">Ponte un nick!!! <a href=\"javascript:history.back(1)\">Volver</a></span>"; exit; }
 $titulo_test = str_replace(" ","",$titulo);
 if($titulo_test == "" OR $titulo == $mensa_defecto) { echo "<span class=\"tabla\">Pon un mensaje!!! <a href=\"javascript:history.back(1)\">Volver</a></span>"; exit; }
 if(strlen($titulo_test) > $maxPalabras*2) { echo "Mensaje demasiado largo"; exit; }
 
 //sistema anti-leim inicio:

 if (isset($nick) && isset($titulo) && isset($url) && (eregi("#-#",$nick) || eregi("#-#",$titulo) || eregi("#-#",$url))) {
	echo "No puedes poner #-# leim :P"; exit; 
 }
 
 if ($anti_urls == "ON" OR $cod_html != "ON" OR $smilies == "ON" OR $word_limit == "ON") {

	 if($cod_html != "ON") {
		ShowHtml($titulo);
	 }

	 $anti_leim = explode(" ",$titulo); //Para procesar palabra por palabra

	 if ($maxPalabras == -1) { 
		$palabras = count($anti_leim); 
	 } else { 
	 
	 	$palabras = count($anti_leim);
	 
	 	if($palabras > $maxPalabras) { $palabras = $maxPalabras; }
			
		$temp = $anti_leim;
		$anti_leim = array();
		for($i=0;$i<$palabras;$i++) { 
			$anti_leim[] = $temp[$i];
		}
		unset($temp);
			
	 }

         for($i=0;$i<$palabras;$i++) {

		$anti_leim[$i] = trim($anti_leim[$i]);

		if($word_limit == "ON") {
			LimitWordLength($anti_leim[$i],$word_max);
		}		


		if($anti_urls == "ON") {
			StripUrls($anti_leim[$i]);
		}
		     

		if($smilies == "ON") {
			SmileyReplace($anti_leim[$i],$maxSmileys);
		}
	
		if($censura == "ON") {
			RudeReplace($anti_leim[$i]);
		}

	} //fin del bucle anti-leim

 $titulo = implode(" ",$anti_leim);

 } //final sistema anti-leim


 $cadena_final = '&lt;';
 
 if(isset($url)) {

	 $url = htmlspecialchars(trim(strip_tags($url)));  

	 if(!eregi("^(http://[a-z0-9_./:-]+|mailto:(.+)\.(.+){2,3})",$url)) { $url = ''; }
	 
 } else { 
 
 	$url = '';
	
}

	if(!empty($url)) { 

		$cadena_final .= "<a href='$url' target='_blank'>"; 
	
	}
	
 $AdminNick = "no";

 for($i=0;$i<count($NicksRegs);$i++) {
	list($admin_nick,$admin_pass) = explode(":",$NicksRegs[$i]);

	if ($nick == $admin_nick) {
		$cadena_final .= "<span class=\"admin\">".$nick."</span>";
		$AdminNick = "si"; 
	}
 }

 if ($AdminNick != "si") { 
	$cadena_final .= "<acronym title='".nickinfo($nick_info)."'>$nick</acronym>"; 
 }

 if($url) { $cadena_final .= "</a>"; }
 
 $cadena_final .= '&gt;';
 $cadena_final .= ' ';
 $cadena_final .= trim($titulo);
 $cadena_final .= "#-#"; 
 $fh = fopen("mensajeitor.txt","a");
 $cadena_final = stripslashes($cadena_final);

  if($iespana) {

    fputs($fh,$cadena_final);

  } else {

    if($HTTP_SERVER_VARS['REQUEST_METHOD'] == "POST")  {

      fputs($fh,$cadena_final);
      
    }

  }

 fclose($fh);
 }

?>
<table align="center">
  <tr> 
    <td valign="top"> 
      <div style="text-align: left; height: <?=$divHeight?>px; width: <?=$divWidth?>px; overflow: auto;"> 
<?php

 $fh = fopen("mensajeitor.txt","r");
 
 $cadena_lectura = '';

 while (!feof ($fh)) 
 {
 	$cadena_lectura .= fgets($fh,4096); 
 }

 fclose($fh);
 
 $cacho_lectura = explode("#-#",$cadena_lectura);
 $num_mensajes = count($cacho_lectura);

 if($cantidad_mensajes == -1) 
 {
	$limite = 0; 
 }
 else
 { 
	$limite = ($num_mensajes-$cantidad_mensajes)-1; 
 }

?>

        <table width="<?=$Table1Width?>" cellpadding="2" cellspacing="0" class="tabla">
<?php

$design = 0;

if($limite < 0) { $limite = 0; }

 for ($i=$num_mensajes-1;$i>=$limite;$i--) 
 {

	if ($cacho_lectura[$i] != "") 
	{
		$design++; 
		if($design == 2) 
		{ 
			$design = 0; 
		}
?>
		<tr>
		<td class="td<?php if($design != 0) { echo $design; } ?>"> 
<?php 
		echo $cacho_lectura[$i]; 
?>
		</td>
		</tr>
<?php 
		echo "\n"; 
	} 
 }
?>
        </table>
      </div>
    </td>
  </tr>
  <tr> 
    <td align="left"> 
      <form name="form1" method="post" action="mensajeitor.php">
        <table width="<?=$Table2Width?>" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td> 
              
				<table width="<?=$Table3Width?>" border="0" cellspacing="0" cellpadding="0">
                	<tr valign="middle"> 
                  		<td height="20" valign="middle">&nbsp;</td>
                	</tr>
                	<tr valign="middle"> 
                  		<td valign="middle"> 
                    		<input type="text" name="nick" size="10" value="<?php echo $defecto; ?>" class="form" maxlength="<?php echo $max_char; ?>" onFocus="a1(this,'<?php echo $defecto; ?>');" onBlur="a2(this,'<?php echo $defecto; ?>');">
<?php 
 
 if (isset($_GET['status']) && $_GET['status'] == "administrator") 
 { 
?>
                    		<input type="password" name="pass" size="10" class="form" value="<?php echo $last_pass; ?>">
                    		<input type="hidden" name="status" value="administrator">
<?php 
 }
?>
						</td>
                	</tr>
                	<tr valign="middle"> 
                  		
                  <td align="left" valign="middle"> 
                    <input type="text" name="titulo" size="21" value="<?=$mensa_defecto;?>" class="form" onFocus="a1(this,'<?php echo $mensa_defecto; ?>');" onBlur="a2(this,'<?php echo $mensa_defecto; ?>');">
<?php
if($nick_urls == "ON") { ?>
                    <br><input type="text" name="url" size="21" value="http://" class="form" onFocus="a1(this,'http://');" onBlur="a2(this,'No link');">
<?php } ?>
                  </td>
	                </tr>
    	            <tr> 
        				<td> 
                    		<input type="submit" name="enviar" value="Enviar" class="form">
                    		<input type="submit" name="actualizar" value="Actualizar" class="form">
                  </td>
                	</tr>
              </table>
            
			</td>
          </tr>
        </table>
      </form>
    </td>
  </tr>
  <tr> 
    <td> 
      <table align="center" width="170" cellpadding="0" cellspacing="0" border="0" class="info">
<?php 
 if ($mostrar_features == "ON") 
 {
?>
        <tr> 
          <td>MensajeitorPHP v 
            <?php echo VERSION; ?>
            <br>
            <?php echo FEATURES; ?>
            <br>
            by 
            <?php echo AUTOR; ?>
          </td>
        </tr>
<?php
 }
?>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
