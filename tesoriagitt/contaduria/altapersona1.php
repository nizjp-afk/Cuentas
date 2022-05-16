<?php
  
//conexion
error_reporting ( E_ERROR ); 
	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
require 'PHPMailer/class.phpmailer.php';
//require 'PHPMailer/class.smtp.php';
	$bandera=0;
?>	
<div class="content">	
	
<?php	
	
	  $doc    = $_POST['docnro'];
////VERIFICA SI NRO DE DOCUMENTO EXISTE/////
$sql = "SELECT docnro FROM personas WHERE docnro ='$doc'";
		
if (! $result = mysql_query ($sql,$conexion_mysql))
    {
       echo "ERROR DE LECTURA TABLA PERSONAS";
       exit;
    }
 	
		
if (mysql_num_rows($result)!=0)
 {
  while($id = mysql_fetch_array($result))
   {
    if($id['docnro'] == $doc)
     {
	  ?>
<center><h1>Error!</h1></center>
<meta http-equiv='refresh' content='10;url=javascript:window.history.back()'>
<center><img src="../img/messagebox_critical.png" width="128" height="128" />
<p>Se ha detectado un error.
Ud. a ingresado un  <b>  N&uacute;mero de documento que se encuentra registrado.</p></center>
<code>Verifique el n&uacute;mero de documento que sea correcto.</code>
<code>Espere unos segundos el Sistema se redirigir&aacute; automaticamente.
O haga click <a href='javascript:window.history.back()'>aqu&iacute;</a>.</code>	  

</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>
	      
		<?php exit;
     }
   }
 }
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
 

///////VERIFICA SI EL NOMBRE DE USER EXISTE/////
 $usu    = $_POST['userid'];
////////////////////////////////////////////////
$sql = "SELECT userid FROM usuarios WHERE userid ='$usu'";
		
if (! $result_usu = mysql_query ($sql,$conexion_mysql))
    {
       echo "ERROR DE LECTURA TABLA USUARIOS";
       exit;
    }
if (mysql_num_rows($result_usu)!=0)
 {
  while($id_usu = mysql_fetch_array($result_usu))
   {
    if($id_usu['userid'] == $usu)
     {
	  ?>
	  <center><h1>Error!</h1></center>
<meta http-equiv='refresh' content='10;url=javascript:window.history.back()'>
<center><img src="../img/messagebox_critical.png" width="128" height="128" />
<p>Se ha detectado un error.
El Nombre de USUARIO se encuentra registrado.  <b>  Debe ingresar otro nombre de usuario..</p></center>

<code>Espere unos segundos el Sistema se redirigir&aacute; automaticamente.
O haga click <a href='javascript:window.history.back()'>aqu&iacute;</a>.</code>	  

</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>
	      
		<?php exit;
     }
    }
  } 
if ($usu == '' and $bandera == 0)
    {
      $bandera = 1;
	  ?>  
<center><h1>Error!</h1></center>
<meta http-equiv='refresh' content='10;url=javascript:window.history.back()'>
<center><img src="../img/messagebox_critical.png" width="128" height="128" />
<p>Se ha detectado un error.
Ud. NO INGRESO un nombre de USUARIO. <b> No deje el campo en blanco.</p></center>

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
Ud. ingreso la FECHA DE AlTA incorrectamente. <b>  <ul>
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
	  $razon    = ucwords(strtolower($_POST['razon']));
     // $sex    = $_POST['sexo'];
	  $tel    = $_POST['telefono'];
      $mail_p = $_POST['mail'];
	  $saf = substr($_POST['saf'],0-3);
	  //$escritural = $_POST['escritural'];

      $ssql   = "INSERT INTO personas (doctipo,docnro,apellido,nombre,razon_social,fechanac,telefono,mail,saf)";

      $ssql.= "VALUES ('$tipo','$doc','$ape','$nom','$razon','$fec','$tel','$mail_p','$saf')";
      if (!($r_personas = mysql_query($ssql, $conexion_mysql)))
      {
        //.....................................................................
        // informa del error producido
         echo "ERROR AL INSERTAR PERSONAS";exit;
        //.....................................................................
      }

/////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////INSERTA DATOS DE USUARIOS///////////////////////////////////////////////////////
	   $enc    = md5($_POST['encriptado']);
	
	 $clave    = $_POST['encriptado'];
	  $t   = $_POST['tipo'];
      

      $ssql   = "INSERT INTO usuarios (
                                             userid,
											 password,
                                             encriptado,
											 personas_doctipo,
											 personas_docnro,
											 tipo)";

      $ssql.= "VALUES (                      '$usu',
	                                         '$enc',
                                             '$enc',
											 '$tipo',
                                             '$doc',
											 '$t')";
      if (!($r_usu = mysql_query($ssql, $conexion_mysql)))
      {
        //.....................................................................
        // informa del error producido
	             echo "ERROR DE LECTURA TABLA ";exit;
        //.....................................................................
      }

	 $ssql   = "INSERT INTO permisos (
                                             usuarios_userid,
                                             aplicaciones_cod,
											 permisospart)";

      $ssql.= "VALUES (                      '$usu',
                                             'orden',
											 'C')";
      if (!($r_per= mysql_query($ssql, $conexion_mysql)))
      {
        //.....................................................................
        // informa del error producido
         echo "ERROR EN INSERTAR PERMISOS";
		 exit;
        //.....................................................................
      }
	
	
	
	
	
	
	 $cuitl=$doc;
	$accion='Alta de Personas - Usuario';
		  $tabla='persona';
		  include('agrego_movi.php');
	/////////////////FIN INSERCION DE USUARIO////////////////////////////////////////



 echo $hacia = $mail_p;
				$titulo = "Usuario y Contraseña ...";
				$mensaje = "
							Usted se ha registrado en el Sistema de Beneficiario de Tesoreria General de la Provincia de la Rioja ...
							<br>
							Sus datos de ingreso al sistema ... son:
 							<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Usuario: </b> $usu
							<br>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Clave  : </b> $clave
							<br>
							<a href='https://uis.larioja.gob.ar/beneficiarios/tutoriales/GUIA PASO A PASO DE ACCESO WEB.pdf' target='_blank'><p align='left'>Tutorial Acceso Web</p> </a>

							<br>
							Nota: No responder a la direccion de este Mail debido a que solo es para envio de informacion.
							";
							
							$mail = new PHPMailer();
							$mail->IsSMTP();
	                 //       $mail->Host = "smtp.gmail.com"; // servidor smtp
							$mail->SMTPAuth = true;
	                       
							$mail->Username = "beneficiario.tgplr@gmail.com"; // Cuenta que hace los envíos
							$mail->Password = "tesoreriab"; // Contraseña
							$mail->From = "beneficiario.tgplr@gmail.com"; // Desde donde enviamos (Para mostrar)

	
	             // $mail->SMTPSecure = 'tls'; //seguridad
                 // $mail->Port = 587; //puerto
	
	$mail->FromName = "Tesoreria General de la Pcia - Area Beneficiario ...";
							$mail->AddAddress($hacia); // Esta es la dirección a donde enviamos
							//$mail->AddCC("cuenta@dominio.com"); // Copia
							//$mail->AddBCC("cuenta@dominio.com"); // Copia oculta
							$mail->IsHTML(true); // El correo se envía como HTML
							$mail->Subject = $titulo; // Este es el asunto del email.
							$mail->Body = $mensaje; // Mensaje a enviar
							//$mail->AddAttachment("archivos/imagen.jpg", "imagen.jpg");
							$exito = $mail->Send(); // Envía el correo.
		
						   if($exito == 'true'){
						      echo 'El correo fue enviado correctamente.';    
						   }
						   else{

	 echo "Mailer Error: " . $mail->ErrorInfo;
	?>
						    <script language="JavaScript" type="text/javascript">
							alert("Fallo envio de email");
							</script>
						    <?php
						   } 

?>


	<center><h1>Guardando</h1></center>
	
	<center><img src="img/loader_guardando.gif" width="100" height="100" />
	<p>Sus Datos Fueron Grabado con Exito.</p></center>
<code>Haga click <a href='indextesoreria.php'>aqu&iacute;</a> para regresar.</code>
		  
</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>
	      