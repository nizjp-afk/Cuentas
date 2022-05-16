<?php
error_reporting ( E_ERROR ); 
//////////////////CONEXION DB//////////////////
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
//////////////////////////////////////////////

$aplicacion = $_GET['apli'];
     $permisosnecesarios = $_GET['per'];
//////////////////////////////

?>	
<div class="content">	
	
<?php	
	  $doc    = $_POST['docnro'];
  

/////validacion de numero de doc

$patron = "[[:digit:]]{8}";
  if ( $bandera == 0 and !(ereg($patron, $_POST['docnro'])) )
    {
      $bandera = 1;
	  ?>
<center><h1>Error!</h1></center>
<meta http-equiv='refresh' content='10;url=javascript:window.history.back()'>
<center><img src="img/messagebox_critical.png" width="128" height="128" />
<p>Se ha detectado un error.
Ud. ingreso el N&uacute;mero de documento incorrectamente.<br>
<ul>
 <li>No deje el campo en blanco.</li>
 <li>Debe ingresar solo n&uacute;meros.</li> 
 <li>Debe ingresar 8 caracteres.<br />
 Si el documento no contiene 8 caracteres,<br /> rellene el campo con 0<br> 
 hasta completar su longitud.
 </li>
</ul>
<code>Verifique el n&uacute;mero de documento que sea correcto.</code>
<code>Espere unos segundos el Sistema se redirigir&aacute; automaticamente.
O haga click <a href='javascript:window.history.back()'>aqu&iacute;</a>.</code>	  

</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>
 <?php
      exit;  
	 }    
      
if($cuil==$doc)
	       {
		   
		   //////////VALIDA CONTRASEÑA//////
	  $enc    = $_POST['encriptado'];
  	  $enc1   = $_POST['encriptado1'];
/////////////////////////////////////////////////
////////VERIFICA SI INGRESO CONTRASEÑA/////
// $bandera == 0 and 
  if ($enc == '' and $bandera == 0)
    {
      $bandera = 1;
	  ?>	
<center><h1>Error!</h1></center>
<meta http-equiv='refresh' content='10;url=javascript:window.history.back()'>
<center><img src="img/messagebox_critical.png" width="128" height="128" />
<p>Se ha detectado un error.
Ud. no ingreso una contraseña. <b> No deje el campo en blanco.</p></center>

<code>Espere unos segundos el Sistema se redirigir&aacute; automaticamente.
O haga click <a href='javascript:window.history.back()'>aqu&iacute;</a>.</code>		  
</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>
      <?php
      exit;      
    }

/////////////////////////////////////////////////
/////VERIFICA SI LAS CONTRASEÑA SON IGUALES//////

  if ($enc != $enc1 and $bandera == 0)
    {
      $bandera = 1;
	  ?>
<center><h1>Error!</h1></center>
<meta http-equiv='refresh' content='10;url=javascript:window.history.back()'>
<center><img src="img/messagebox_critical.png" width="128" height="128" />
<p>Se ha detectado un error.
Las CONTRASEÑAS NO COINCIDEN. <b> Ud. debe ingresar la misma contrase&ntilde;a en los campos indicados.</p></center>

<code>Espere unos segundos el Sistema se redirigir&aacute; automaticamente.
O haga click <a href='javascript:window.history.back()'>aqu&iacute;</a>.</code>		  
</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>
      <?php
      exit;      
    }	  

///////////////INSERTA DATOS DE USUARIOS///////////////////////////////////////////////////////
	  $enc    = md5($_POST['encriptado']);
	//  $t   = $_POST['tipo'];
      

      $ssql   = "UPDATE usuarios SET password='$enc',encriptado='$enc' where personas_docnro='$doc'";
      if (!($r_usu = mysql_query($ssql, $conexion_mysql)))
      {
        //.....................................................................
        // informa del error producido
	             echo "ERROR DE LECTURA TABLA ";exit;
        //.....................................................................
      }
/////////////////FIN INSERCION DE USUARIO////////////////////////////////////////

  }
else
  {   
	  
?>
<center><h1>Error!</h1></center>
<meta http-equiv='refresh' content='10;url=javascript:window.history.back()'>
<center><img src="img/messagebox_critical.png" width="128" height="128" />
<p>Se ha detectado un error.
Ud. a ingresado un  <b>  N&uacute;mero de documento que no pertenece al usuario logueado.</p></center>
<code>Verifique el n&uacute;mero de documento que sea correcto.</code>
<code>Espere unos segundos el Sistema se redirigir&aacute; automaticamente.
O haga click <a href='javascript:window.history.back()'>aqu&iacute;</a>.</code>	  

</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>
	      
		<?php exit;
     
 }


?>
<div class="content">
<meta http-equiv='refresh' content='3;url=indextesoreria.php?sec=ordenes/periodo&apli=orden&per=C'> 

	<table width="60%" border="0" align="center" >
     <tr>
     <td align="center">
	 <p class="Estilo2 style1 Estilo1"><img src="img/loader_guardando.gif" width="100" height="100" /></p>
      <p class="Estilo2 style1">
	  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Espere unos segundos el Sistema se Redirigir&aacute; automaticamente
	  <br><br>
    Gracias
</font>
</p>
   	    	 </td>
        </tr>
   </table>
</meta>
</div>