<?php 
error_reporting ( E_ERROR ); 
   include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');    
	 
//variables recibidas
   $persona_tipo='o';
   $cuitl = $_POST['cuitl'];
  $id_bene=$_POST['id_bene'];
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
   $observacion=$_POST['observacion']; 
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
  
 //datos de alta web 
 
  
	$ssql = "UPDATE beneficiarios SET apellido='$apellido',nombre='$nombre',
	                documento_tipo='$documento_tipo',fecha_nacimiento='$fecha_nacimiento',
					direccion_f_calle='$direccion_calle_f',direccion_f_nro='$direccion_nro_f',
					direccion_f_piso='$direccion_piso_f',
					direccion_f_dpto_nro='$direccion_dpto_nro_f',
					direccion_f_localidad='$direccion_localidad_f',
					direccion_f_provincia='$direccion_provincia_f',
					codigo_f_postal='$codigo_postal_f',
					direccion_r_calle='$direccion_calle_r',
					direccion_r_nro='$direccion_nro_r',
					direccion_r_piso='$direccion_piso_r',
					direccion_r_dpto_nro='$direccion_dpto_nro_r',
				    direccion_r_localidad='$direccion_localidad_r',
				    direccion_r_provincia='$direccion_provincia_r',
				    codigo_r_postal='$codigo_postal_r',telefono='$telefono',
					email='$email',banco_nombre='$banco_nombre',
					banco_sucursal='$banco_sucursal',banco_cta_tipo='$banco_cta_tipo',
					banco_cta_nro='$banco_cta_nro',cbu_entidad='$cbucont1',
					cbu_sucursal='$cbucont2',verificador1='$cbucont3',
					cbu_tipo_cta='$cbucont4',cbu_cta='$cbucont5',
					verificador2='$cbucont6',cbu='$banco_cbu',area='$area',
					cargo='$cargo',fecha_gestion='$fechac',saf='$saf',observacion='$observacion',
					cuit_tipo='$t_c'
					WHERE id_beneficiario='$id_bene'";
				 if (!($r_beneficiarios = mysql_query($ssql,$conexion_mysql)))
				 {
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar dar de alta un beneficiario";
					  echo $cuerpo1;
						   exit;
					  //.....................................................................
				 }
				 
		$ssql = "UPDATE saf SET banco_nombre='$banco_nombre',
					banco_sucursal='$banco_sucursal',banco_cta_tipo='$banco_cta_tipo',
					banco_cta_nro='$banco_cta_nro',cbu_entidad='$cbucont1',
					cbu_sucursal='$cbucont2',verificador1='$cbucont3',
					cbu_tipo_cta='$cbucont4',cbu_cta='$cbucont5',
					verificador2='$cbucont6',cbu='$banco_cbu',area='$area',
					cargo='$cargo',fecha_gestion='$fechac',saf='$saf'
					WHERE cuit='$cuitl'";
				 if (!($r_beneficiarios = mysql_query($ssql,$conexion_mysql)))
				 {
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar dar de alta un beneficiario";
					  echo $cuerpo1;
						   exit;
					  //.....................................................................
				 }	
			 $accion='Modificacion Beneficiarios Otras Personas';
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

<!-- ======================================================================= -->

</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>
</head>