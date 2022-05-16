<?php 
error_reporting ( E_ERROR ); 
   include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');    
	 $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];
  
  include('incluir_siempre.php');
//variables recibidas
   $persona_tipo='o';
   $cuitl = $_POST['cuitl'];
   $usuario=$nombre;
     $t_c = $_POST['t_c'];

  //datos de identificacion
  
   $apellido= strtoupper($_POST['apellido']);
   $nombre = ucwords(strtolower($_POST['nombre']));   
   $documento_tipo = $_POST['documento_tipo'];
   $documento_nro = $_POST['documento_nro'];
   $fecha_nacimiento=$_POST['fecha_nacimiento'];
   $area=$_POST['area'];
   $cargo=$_POST['cargo'];
   $saf=$_POST['saf']; 
   $fechac=$_POST['gestion'];
  
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
   ///para guardar en la base
    $cbucont = str_replace('-', '', $banco_cbu);
	$cbucont1 = substr($cbucont,0,3);
	$cbucont2 = substr($cbucont,3,4);
	$cbucont3 = $cbucont[7];
	$cbucont4 = substr($cbucont,8,2);
	$cbucont5 =  substr($cbucont,10,11);
	$cbucont6 = $cbucont[21];
  
   //datos economicos 
  
   $actividad_p=$_POST['actividad_p'];
   $actividad_s=$_POST['actividad_s'];
   $fechai_p=$_POST['fechai_p'];
   $fechai_s=$_POST['fechai_s'];
  
 //datos comercial
 
   $ingreso_bruto = $_POST['ingreso_bruto'];
   $iva_situacion = $_POST['iva_situacion'];
   $observacion = $_POST['observacion'];
  
 //datos de alta web 
 
  $fecha_alta_web = date("d/m/Y");
   $fechaaw=split("/",$fecha_alta_web); 
   $fecha_alta_web=$fechaaw[2].'-'.$fechaaw[1].'-'.$fechaaw[0];
 
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
				direccion_r_provincia,codigo_r_postal,telefono,email,
				persona_tipo,banco_nombre,banco_sucursal,banco_cta_tipo,
				banco_cta_nro,cbu_entidad,cbu_sucursal,verificador1,cbu_tipo_cta,
				cbu_cta,verificador2,cbu,area,cargo,fecha_gestion,saf,
				fecha_alta_web,observacion,cuit_tipo)
				VALUES ('$cuitl','$apellido','$nombre','$documento_tipo',
				'$documento_nro','$fecha_nacimiento','$direccion_calle_f','$direccion_nro_f',
				'$direccion_piso_f','$direccion_dpto_nro_f','$direccion_localidad_f',
				'$direccion_provincia_f','$codigo_postal_f','$direccion_calle_r',
				'$direccion_nro_r','$direccion_piso_r','$direccion_dpto_nro_r',
				'$direccion_localidad_r','$direccion_provincia_r','$codigo_postal_r','$telefono',
			   '$email','$persona_tipo','$banco_nombre','$banco_sucursal',
				'$banco_cta_tipo','$banco_cta_nro','$cbucont1',
				'$cbucont2','$cbucont3','$cbucont4','$cbucont5','$cbucont6','$banco_cbu',
				'$area','$cargo','$fechac','$saf','$fecha_alta_web','$observacion','$t_c')";
				 if (!($r_beneficiarios = mysql_query($ssql,$conexion_mysql)))
				 {
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar dar de alta un beneficiario";
					  echo $cuerpo1;
						   exit;
					  //.....................................................................
				 }
		
		$ssql = "SELECT * FROM `beneficiarios` WHERE cuitl='$cuitl'";
         if (!($r_beneficiario= mysql_query($ssql, $conexion_mysql)))
           {
	
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar beneficiario";
			  echo $cuerpo1;
			  //.....................................................................
		    } 		
			
		 $f_beneficiario= mysql_fetch_array ($r_beneficiario); 
		 $cuit=$f_beneficiario['cuitl'];	 
		 
		 
		 $ssql = "INSERT INTO saf (cuit,banco_nombre,
				banco_sucursal,banco_cta_tipo,banco_cta_nro,cbu_entidad,
				cbu_sucursal,verificador1,cbu_tipo_cta,cbu_cta,verificador2,cbu,
				area,cargo,fecha_gestion,saf,fecha_alta_web,usuario_alta)
				VALUES ('$cuit','$banco_nombre','$banco_sucursal','$banco_cta_tipo',
				'$banco_cta_nro','$cbucont1','$cbucont2','$cbucont3','$cbucont4',
				'$cbucont5','$cbucont6','$banco_cbu',
				'$area','$cargo','$fechac','$saf','$fecha_alta_web','$usuario')";
				 if (!($r_saf = mysql_query($ssql,$conexion_mysql)))
				 {
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar dar de alta un saf";
					  echo $cuerpo1;
						   exit;
					  //.....................................................................
				 }
		 $accion='Alta Beneficiario otras personas';
		  $tabla='beneficiarios';
		  include('agrego_movi.php'); 
		
?>
	<div class="content">
	<center><h1>Guardando</h1></center>
	
	<center><img src="../img/loader_guardando.gif" width="100" height="100" />
	<p>Sus Datos Fueron Grabado con Exito.</p></center>
<code>Si desea Imprimir, <b>Por favor</b></code>
<code>Haga click <a href='tesoreria/formulario_o.php?cuitl=
	<?php echo $cuitl;?>'>aqu&iacute;</a> </code>
<code>Haga click <a href='indextesoreria.php'>aqu&iacute;</a> para regresar.</code>

	 
<?php 
	}
		
?>

<!-- ======================================================================= -->

</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>
</head>