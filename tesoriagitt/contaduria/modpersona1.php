<?php
error_reporting ( E_ERROR ); 
/////////////////CONEXION DB///////////////////
  include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	$bandera=0;
//////////////////////////////////////////////////
      $id     = $_POST['hid'];
//////////////////////////////////////////////////
	  $doc    = $_POST['docnro'];
   	  $doc_nro = $_POST['doc'];
?>
<div class="content">	

<?php	
	  $doc    = $_POST['docnro'];


/////VALIDA FORMATO DEL NRO DE DOCUMENTO///////////////
$patron = "[[:digit:]]{8}";
  if ( $bandera == 0 and !(ereg($patron, $_POST['docnro'])) )
    {
      $bandera = 1;
	  ?>
<center><h1>Error!</h1></center>
<meta http-equiv='refresh' content='10;url=javascript:window.history.back()'>
<center><img src="../img/messagebox_critical.png" width="128" height="128" />
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
<center><img src="../img/messagebox_critical.png" width="128" height="128" />
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
<center><img src="../img/messagebox_critical.png" width="128" height="128" />
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
//////////////////////////////////////////////////////////////////////////////////////////////
  $fec    = $_POST['anio'].'-'.$_POST['mes'].'-'.$_POST['dia'];
  $patron = "[[:digit:]]{4}";
 // verifica si el año y la fecha son correctos
  if ($bandera == 0 and ((!(ereg($patron, $_POST['anio']))) or (!(checkdate($_POST['mes'], $_POST['dia'], $_POST['anio'])))))
      {
      $bandera = 1;
	  ?>	
<center><h1>Error!</h1></center>
<meta http-equiv='refresh' content='10;url=javascript:window.history.back()'>
<center><img src="../img/messagebox_critical.png" width="128" height="128" />
<p>Se ha detectado un error.
Ud. ingreso la FECHA DE NACIMIENTO incorrectamente. <b>  <ul>
<li>No deje el campo en blanco. 
<li>Debe ingresar solo datos num&eacute;ricos.
<li>El Formato es dd/mm/aaaa
</li>
</ul></p></center>

<code>Espere unos segundos el Sistema se redirigir&aacute; automaticamente.
O haga click <a href='javascript:window.history.back()'>aqu&iacute;</a>.</code>		  
</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>
      <?php
      exit;      
    }	 	

  
////////////VARIABLES DEL FORMULARIO DE PERSONAS////
      $tipo   = $_POST['doctipo'];
	  $doc    = $_POST['docnro'];
	  $ape    = strtoupper($_POST['apellido']);
	  $nom    = ucwords(strtolower($_POST['nombre']));
      $sex    = $_POST['sexo'];
	  $tel    = $_POST['telefono'];
      $mail = $_POST['mail'];
      $ssql   = "UPDATE personas SET
                                     doctipo  = '$tipo',
                                     docnro   = '$doc',
									 apellido = '$ape',                                           
                                     nombre   = '$nom',
                                     sexo     = '$sex',
                                     fechanac = '$fec',
									 telefono = '$tel',
                                     mail = '$mail'
                WHERE id_personas='$id'";

      if (!($r_personas = mysql_query($ssql, $conexion_mysql)))
      {
        //.....................................................................
        // informa del error producido
	             echo "ERROR DE LECTURA TABLA ";exit;
        //.....................................................................
      }
///////modifica contraseña///////////////////////////////////////////////////////
	   $enc    = md5($_POST['encriptado']);
	  

      $ssql   = "UPDATE usuarios SET personas_doctipo='$tipo',personas_docnro ='$doc',encriptado='$enc' WHERE personas_docnro='$doc_nro'";           
     
      if (!($r_usu = mysql_query($ssql, $conexion_mysql)))
      {
        //.....................................................................
        // informa del error producido
                 echo "ERROR EN CONSULTAR LA TABLA";exit;
        //.....................................................................
      }

/////////////INCLUYE LA FUNCION QUE AGREGA MOVIMIENTO DE DATOS//////////
//include('../agrego_movi.php');                                        //
//$accion='ACTUALIZAR UN REGISTRO DE PERSONA PARA UN USUARIO';          //
//$tabla='PERSONAS';                                                    //
//agrego_movi($usuario,$accion,$tabla);                                 //
////////////////////////////////////////////////////////////////////////

?>
 	
	<center><h1>Guardando</h1></center>
	
	<center><img src="../img/loader_guardando.gif" width="100" height="100" />
	<p>Sus Datos Fueron Grabado con Exito.</p></center>
<code>Haga click <a href='indextesoreria.php'>aqu&iacute;</a> para regresar.</code>
		  
</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>
	      