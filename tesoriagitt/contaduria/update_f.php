
<?php 
error_reporting ( E_ERROR ); 
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');    
	 
///
$fecha_mod = date("Y/m/d");	
$nou=$nombre;

//variables recibidas
   $persona_tipo='f';
   $cuitl = $_POST['cuitl'];
  $id_bene=$_POST['id_bene'];
 
  //datos de identificacion
  
   $apellido= strtoupper($_POST['apellido']);
   $nom = ucwords(strtolower($_POST['nombre']));   
   $nombre_f = ucwords(strtolower($_POST['nombre_f']));   
   $documento_tipo = $_POST['documento_tipo'];
   $documento_nro = $_POST['documento_nro'];
   $fecha_nacimiento=$_POST['fecha_nacimiento'];
  
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
  
  
   
  
   //datos economicos 
  
   $actividad_p=$_POST['actividad_p'];
   $actividad_s=$_POST['actividad_s'];
   $fechai_p=$_POST['fechai_p'];
   $fechai_s=$_POST['fechai_s'];
  
  //datos comercial
 
   $ingreso_bruto = $_POST['ingreso_bruto'];
   $iva_situacion = $_POST['iva_situacion'];
   $ingreso_bruto_ac = $_POST['ingreso_bruto_ac'];
  // $alicuota = $_POST['alicuota'];
   echo $ganancia = $_POST['ganancia'];
   echo $ingreso = $_POST['ingreso'];
   echo $regimen = $_POST['regimen'];
   echo $seguridad = $_POST['seguridad'];
   
   
   $observacion = $_POST['observacion']; 
  
 //datos de alta web 
 
   $ssql = "SELECT * FROM `beneficiarios_aprobados` WHERE cuitl='$cuitl'";
     if (!($r_ben= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }    
	 $f_ben= mysql_fetch_array ($r_ben);
	 $sipaf = $f_ben['v_sipaf'];
	  $sipaf_mod = $f_ben['sipaf_m'];
	 if ($sipaf=='N')
	    {
		 if($sipaf_mod=='')
	     {
		  $sf='N';
		 }
		 else
		  {
		   $mod='M';
		   $sf='N';
		  }
		 } 
	 else
	      {
		 $mod='M';
		 $sf='N';
		 }	 	 
   
   
	$ssql = "UPDATE beneficiarios_aprobados SET apellido='$apellido',nombre='$nom',nombre_f='$nombre_f',
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
					email='$email',
					convenio_tipo='$convenio_tipo',
				    convenio_nro='$convenio_nro',
				  ingreso_bruto='$ingreso_bruto',
				  iva_situacion='$iva_situacion',
				  ganancia='$ganancia',
				  ingreso='$ingreso',
				  regimen='$regimen',
				  seguridad='$seguridad',
				  ingreso_bruto_ac='$ingreso_bruto_ac',
				    actividad_p='$actividad_p',
				  fecha_p='$fechai_p',
				  actividad_s= '$actividad_s',
				  fecha_s='$fechai_s',
				  v_sipaf='$sf',sipaf_m='$mod',
				  observacion ='$observacion' 
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
		
		 
	$ssql = "SELECT * FROM `beneficiarios_aprobados` WHERE cuitl='$cuitl'";
     if (!($r_beneficiario= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }    
	 $f_beneficiario= mysql_fetch_array ($r_beneficiario);
	 $fecha_aprobacion = $f_beneficiario['fecha_aprobacion'];  
	 $usuario_aprobo = $f_beneficiario['usuario_aprobo'];  
     $usuario_alta = $f_beneficiario['usuario_alta'];  
			 		 
		$ssql = "INSERT INTO beneficiarios_historial
                (cuitl,razon_social,apellido,nombre,documento_tipo,
				documento_nro,fecha_nacimiento,direccion_f_calle,direccion_f_nro,
				direccion_f_piso,direccion_f_dpto_nro,direccion_f_localidad,
				direccion_f_provincia,codigo_f_postal,direccion_r_calle,direccion_r_nro,
				direccion_r_piso,direccion_r_dpto_nro,direccion_r_localidad,
				direccion_r_provincia,codigo_r_postal,telefono,email,banco_nombre,
				banco_sucursal,banco_cta_tipo,banco_cta_nro,cbu_entidad,
				cbu_sucursal,verificador1,cbu_tipo_cta,cbu_cta,verificador2,cbu,
				fecha_contrato,convenio_tipo,convenio_nro,
				persona_tipo,ingreso_bruto,iva_situacion,actividad_p,fecha_p,actividad_s,
				fecha_s,apellido1,apellido2,apellido3,apellido4,nombre1,nombre2,nombre3,
				nombre4,dni1,dni2,dni3,dni4,cargo1,cargo2,cargo3,cargo4,
			    area,cargo,fecha_gestion,saf,fecha_alta_web,usuario_alta,usuario_aprobo,
				fecha_aprobacion,observacion,usuario_modifico,fecha_modi)
				VALUES ('$cuitl','$nombrer','$apellido','$nom','$documento_tipo',
				'$documento_nro','$fecha_nacimiento','$direccion_calle_f','$direccion_nro_f',
				'$direccion_piso_f','$direccion_dpto_nro_f','$direccion_localidad_f',
				'$direccion_provincia_f','$codigo_postal_f','$direccion_calle_r',
				'$direccion_nro_r','$direccion_piso_r','$direccion_dpto_nro_r',
			    '$direccion_localidad_r','$direccion_provincia_r','$codigo_postal_r',
				'$telefono','$email','$banco_nombre','$banco_sucursal',
			    '$banco_cta_tipo','$banco_cta_nro','$cbucont1','$cbucont2',
				'$cbucont3','$cbucont4','$cbucont5','$cbucont6',
				' $banco_cbu','$fechac_s','$convenio_tipo',
				'$convenio_nro','$persona_tipo','$ingreso_bruto','$iva_situacion',
				'$actividad_p','$fecha_p','$actividad_s','$fecha_s',
				'$apellido1','$apellido2','$apellido3','$apellido4','$nombre1',
				'$nombre2','$nombre3','$nombre4','$dni1','$dni2',
				'$dni3','$dni4','$cargo1','$cargo2','$cargo3','$cargo4',
				'$area','$cargo','$fechac','$saf','$fecha_alta_web','$usuario_alta',
				'$usuario_aprobo','$fecha_aprobacion','$observacion','$nou','$fecha_mod')";
				 if (!($r_beneficiarios = mysql_query($ssql,$conexion_mysql)))
				 {
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar dar de alta un beneficiario";
					  echo $cuerpo1;
						   exit;
					  //.....................................................................
				 }	
		  $accion='Cambio datos Generales de beneficiarios';
		  $tabla='beneficiarios_aprobados';
		  include('agrego_movi.php'); 
		
		 
?>
	<div class="content">
	<center><h1>Guardando</h1></center>
	
	<center><img src="img/loader_guardando.gif" width="100" height="100" />
	<p>Sus Datos Fueron Grabado con Exito.</p></center>
<code>Haga click <a href='indextesoreria.php?sec=contaduria/beneficiarios_aprobado&apli=tgpa&per=G'>aqu&iacute;</a> para regresar.</code>

<!-- ======================================================================= -->

</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>
</head>