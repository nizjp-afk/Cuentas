<?php
session_name('valido');
session_start();
session_unset();
session_destroy();
?>

<html>
<head>
<title>Debe ingresar su usuario y contrase&ntilde;a</title>
<meta http-equiv="refresh" content="4;url=index.php">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.Estilo1 {color: #000000}
.Estilo2 {
	color: #EFF9D0;
	font-weight: bold;
}
.Estilo3 {color: #FF0000}
-->
</style>
</head>
<link href="styles.css" rel="stylesheet" type="text/css">


<body>
<table width="450" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#000000">
  
  <tr>
    <td height="173" align="center" bgcolor="#FFFFFF"><br> 
	<img src="img/cerrando_sesion.gif" width="72" height="72">
	<p class="Estilo2 Estilo3">&nbsp;</p>
      <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        Aguarde unos segundos y ser&aacute; redirigido a<br> 
        la p&aacute;gina principal del Sistema.<br><br>Es necesario 
        que espere para una correcta<br>
        eliminacion de sus datos en el servidor</font></p>
      <p class="Estilo1"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="http://www.larioja.gov.ar/beneficiarios/">Elija 
        esta opci&oacute;n</a> si la pantalla no cambia autom&aacute;ticamente</font><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><br>
        <br>
        </font></p>
    </td>
  </tr>
 
  </table>
</body>
</html>
