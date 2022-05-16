
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>

<script>
var a

function imprime() {
a=document.frames['iframeOculto'].location='beneficiario/formulario.php'  
}

</script>

 
<?php 
error_reporting ( E_ERROR );
    include('conexion/mysql-var_sigcom.php');
    include('conexion/mysql_connect.php');  
    include('conexion/mysql_select_db.php');
    include('conexion/extras.php');       
	 
//variables recibidas
   $persona_tipo='f';
   $cuitl = $_POST['cuitl'];
  
  //datos de identificacion
  
   $apellido= strtoupper($_POST['apellido']);
   $nombre = ucwords(strtolower($_POST['nombre']));   
   $documento_tipo = $_POST['documento_tipo'];
   $documento_nro = $_POST['documento_nro'];
   $fecha_nacimiento=$_POST['fecha'];
  
  //direccion fisica
  
   $direccion_calle_f = $_POST['direccion_calle_f'];
   $direccion_nro_f = $_POST['direccion_nro_f'];
   $direccion_piso_f = $_POST['direccion_piso_f'];
   $direccion_dpto_nro_f = $_POST['direccion_dpto_nro_f'];
   $direccion_localidad_f = $_POST['direccion_localidad_f'];
   $direccion_provincia_f = $_POST['direccion_provincia_f'];
   $codigo_postal_f = $_POST['codigo_postal_f'];
  
  //direccion real
  
   $direccion_calle_r = $_POST['direccion_calle_r'];
   $direccion_nro_r = $_POST['direccion_nro_r'];
   $direccion_piso_r = $_POST['direccion_piso_r'];
   $direccion_dpto_nro_r = $_POST['direccion_dpto_nro_r'];
   $direccion_localidad_r = $_POST['direccion_localidad_r'];
   $direccion_provincia_r = $_POST['direccion_provincia_r'];
   $codigo_postal_r = $_POST['codigo_postal_r'];
  
  //otros datos
  
   $telefono = $_POST['telefono'];
   $email = $_POST['email'];
  
  //banco
  
   $banco_nombre = $_POST['banco_nombre'];
   $banco_sucursal = $_POST['banco_sucursal'];
   $banco_cta_tipo = $_POST['banco_cta_tipo'];
   $banco_cta_nro = $_POST['banco_cta_nro'];
   $banco_cbu = $_POST['banco_cbu'];
  
   //datos economicos 
  
   $actividad_p=$_POST['actividad_p'];
   $actividad_s=$_POST['actividad_s'];
   $fechai_p=$_POST['fechai_p'];
   $fechai_s=$_POST['fechai_s'];
  
 //datos comercial
 
   $ingreso_bruto = $_POST['ingreso_bruto'];
   $iva_situacion = $_POST['iva_situacion'];
  
 //datos de alta web 
 
   $fecha_alta_web = date("d/m/Y");
 
   $bandera=$_POST['bandera'];

 //verifica si existe este cuitl

	$ssql = "SELECT * FROM beneficiarios WHERE cuitl ='$cuitl'";
	if (!($r_beneficiarios = mysql_query($ssql,$conexion_mysql)))
		 {
			  $cuerpo1  = "Error al intentar buscar un beneficiario por CUILT";
			  echo $cuerpo1;
			   exit;
				  //.....................................................................
		}
	$cant = mysql_num_rows($r_beneficiarios);
	if ($cant > 0)
	  {
?>

<div class="content">
<center><h1>Error!</h1></center>
<center><img src="../img/messagebox_critical.png" width="128" height="128" />
<p>Se ha detectado un error.</p></center>
<code>Por favor, <b>comuniquese</b> con la Contaduria General de la Provincia.
&#8226; Direccion: San Nicolas de Bari (Oeste) y 25 de Mayo.
&#8226; Telefono: [03822] 453121</code>
<code>Haga click <a href='index.php'>aqu&iacute;</a> para regresar.</code>

<?php
	}
	else
	{  
	$ssql = "INSERT INTO beneficiarios (cuitl,apellido,nombre,documento_tipo,
				documento_nro,fecha_nacimiento,direccion_f_calle,direccion_f_nro,
				direccion_f_piso,direccion_f_dpto_nro,direccion_f_localidad,
				direccion_f_provincia,codigo_f_postal,direccion_r_calle,direccion_r_nro,
				direccion_r_piso,direccion_r_dpto_nro,direccion_r_localidad,
				direccion_r_provincia,codigo_r_postal,telefono,email,banco_nombre,
				banco_sucursal,banco_cta_tipo,banco_cta_nro,cbu,persona_tipo,ingreso_bruto,
				iva_situacion,actividad_p,fecha_p,actividad_s,fecha_s,fecha_alta_web)
				VALUES ('$cuitl','$apellido','$nombre','$documento_tipo',
				'$documento_nro','$fecha_nacimineto','$direccion_calle_f','$direccion_nro_f',
				'$direccion_piso_f','$direccion_dpto_nro_f','$direccion_localidad_f',
				'$direccion_provincia_f','$codigo_postal_f','$direccion_calle_r','$direccion_nro_r',
				'$direccion_piso_r','$direccion_dpto_nro_r','$direccion_localidad_r',
				'$direccion_provincia_r','$codigo_postal_r','$telefono','$email','$banco_nombre',
				'$banco_sucursal','$banco_cta_tipo','$banco_cta_nro','$banco_cbu','$persona_tipo',
				'$ingreso_bruto','$iva_situacion','$actividad_p','$fechai_p',
				'$actividad_s','$fechai_s','$fecha_alta_web')";
				 if (!($r_beneficiarios = mysql_query($ssql,$conexion_mysql)))
				 {
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar dar de alta un beneficiario";
					  echo $cuerpo1;
						   exit;
					  //.....................................................................
				 }
		
	  
?>
		<div class="content">
	<center><h1>Guardando</h1></center>
<body>
	<input name="" type="button" onClick="imprime()" value="Print"  />
</body>	
	<!-- <meta http-equiv='refresh' content='3;url=beneficiario/indexprint.php?cuitl=
	<?php //echo $cuitl;?>'>--> 
	<center><img src="../img/loader_guardando.gif" width="100" height="100" />
	<p>Espere unos segundos el Sistema se redirigir&aacute; automaticamente</p>
	<p>Gracias</p><center>
	 
<?php 
	}
		
?>

<!-- ======================================================================= -->

</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>
</head>