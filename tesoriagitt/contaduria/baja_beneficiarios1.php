<?php 
error_reporting ( E_ERROR ); 
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');    
	 
///


$nou=$nombre;
$usuario=$nombre;
//variables recibidas
  
   $cuitl = $_POST['cuitl'];
   $id_bene=$_POST['id_bene'];
   $nro = $_POST['nro'];
   $estado=$_POST['estado'];  
if ($estado=='B')
   {
	   $fecha_baja = date("Y/m/d");	
	   
	   $ssql = "UPDATE beneficiarios_aprobados SET 
					nro_nota='$nro',
					estado='$estado'
					WHERE id_beneficiario='$id_bene'";
				 if (!($r_beneficiarios = mysql_query($ssql,$conexion_mysql)))
				 {
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar dar de alta un beneficiario update";
					  echo $cuerpo1;
						   exit;
					  //.....................................................................
				 }
	   
	   
	   	$ssql = "SELECT * FROM `beneficiarios_aprobados` WHERE id_beneficiario = '$id_bene'";
     if (!($r_beneficiario= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }    
	 $f_beneficiario= mysql_fetch_array ($r_beneficiario);
	 

    $cuitl = $f_beneficiario['cuitl'];
  $ape = $f_beneficiario['apellido'];  
  $nom = $f_beneficiario['nombre'];  
  $nombrer = $f_beneficiario['razon_social'];  
  $documento_tipo =$f_beneficiario['documento_tipo'];
  $documento_nro =$f_beneficiario['documento_nro'];
  $fecha_nacimiento=$f_beneficiario['fecha_nacimiento'];
  $fecha=split("-",$fecha_nacimiento);
  $fecha_nacimiento=$fecha[2].'-'.$fecha[1].'-'.$fecha[0]; 
  $direccion_calle_f=$f_beneficiario['direccion_f_calle'];
  $direccion_nro_f=$f_beneficiario['direccion_f_nro'];
  $direccion_piso_f=$f_beneficiario['direccion_f_piso'];
  $direccion_dpto_nro_f=$f_beneficiario['direccion_f_dpto_nro'];
  $direccion_localidad_f=$f_beneficiario['direccion_f_localidad'];
  $direccion_provincia_f=$f_beneficiario['direccion_f_provincia'];
  $codigo_postal_f=$f_beneficiario['codigo_f_postal'];
  $direccion_calle_r=$f_beneficiario['direccion_r_calle'];
  $direccion_nro_r=$f_beneficiario['direccion_r_nro'];
  $direccion_piso_r=$f_beneficiario['direccion_r_piso'];
  $direccion_dpto_nro_r=$f_beneficiario['direccion_r_dpto_nro'];
  $direccion_provincia_r=$f_beneficiario['direccion_r_provincia'];
  $direccion_localidad_r=$f_beneficiario['direccion_r_localidad'];
  $codigo_postal_r=$f_beneficiario['codigo_r_postal']; 
  $telefono=$f_beneficiario['telefono'];
  $email=$f_beneficiario['email'];
  $ingreso_bruto=$f_beneficiario['ingreso_bruto'];
  $iva_situacion=$f_beneficiario['iva_situacion'];
  $actividad_p=$f_beneficiario['actividad_p'];
  $fecha_p=$f_beneficiario['fecha_p'];
  $actividad_s=$f_beneficiario['actividad_s'];
  $fecha_s=$f_beneficiario['fecha_s'];
   $fechac_s = $f_beneficiario['fecha_contrato'];
   $sociedad_tipo = $f_beneficiario['sociedad_tipo'];
   $ingreso_bruto = $f_beneficiario['ingreso_bruto'];
   $iva_situacion = $f_beneficiario['iva_situacion'];
   $convenio_tipo = $f_beneficiario['convenio_tipo'];
   $convenio_nro = $f_beneficiario['convenio_nro'];
   $apellido1 = $f_beneficiario['apellido1'];
   $apellido2 = $f_beneficiario['apellido2'];
   $apellido3 = $f_beneficiario['apellido3'];
   $apellido4 = $f_beneficiario['apellido4']; 
   $nombre1 = $f_beneficiario['nombre1'];
   $nombre2 = $f_beneficiario['nombre2'];
   $nombre3 = $f_beneficiario['nombre3'];
   $nombre4 = $f_beneficiario['nombre4'];
   $dni1  = $f_beneficiario['dni1'];
   $dni2 = $f_beneficiario['dni2'];
   $dni3 = $f_beneficiario['dni3'];
   $dni4 = $f_beneficiario['dni4'];
   $cargo1 = $f_beneficiario['cargo1'];
   $cargo2 = $f_beneficiario['cargo2'];
   $cargo3= $f_beneficiario['cargo3'];
   $cargo4= $f_beneficiario['cargo4'];
   $persona_tipo=$f_beneficiario['persona_tipo'];
   $cargo=$f_beneficiario['cargo'];
   $saf=$f_beneficiario['saf'];
   $area=$f_beneficiario['area'];
   $ministerial=$f_beneficiario['ministerial'];
   $fecha_c=$f_beneficiario['fecha_gestion'];
   $observacion=$f_beneficiario['observacion'];
   $inhi=$f_beneficiario['inhi'];
   $fecha_aprobacion = $f_beneficiario['fecha_aprobacion']; 
   $usuario_aprobo = $f_beneficiario['usuario_aprobo'];  
   $usuario_alta = $f_beneficiario['usuario_alta']; 
   $nro = $f_beneficiario['nro_nota']; 
  
	 
	 
	 
	 		 		 
		$ssql = "INSERT INTO beneficiarios_historial
                (cuitl,razon_social,apellido,nombre,documento_tipo,
				documento_nro,fecha_nacimiento,direccion_f_calle,direccion_f_nro,
				direccion_f_piso,direccion_f_dpto_nro,direccion_f_localidad,
				direccion_f_provincia,codigo_f_postal,direccion_r_calle,direccion_r_nro,
				direccion_r_piso,direccion_r_dpto_nro,direccion_r_localidad,
				direccion_r_provincia,codigo_r_postal,telefono,email,banco_nombre,
				banco_sucursal,banco_cta_tipo,banco_cta_nro,cbu_entidad,
				cbu_sucursal,verificador1,cbu_tipo_cta,cbu_cta,verificador2,cbu,
				fecha_contrato,sociedad_tipo,convenio_tipo,convenio_nro,
				persona_tipo,ingreso_bruto,iva_situacion,actividad_p,fecha_p,actividad_s,
				fecha_s,apellido1,apellido2,apellido3,apellido4,nombre1,nombre2,nombre3,
				nombre4,dni1,dni2,dni3,dni4,cargo1,cargo2,cargo3,cargo4,
			    area,cargo,fecha_gestion,saf,fecha_alta_web,usuario_alta,usuario_aprobo,
				fecha_aprobacion,observacion,nro_nota,usuario_baja,fecha_baja)
				VALUES ('$cuitl','$nombrer','$ape','$nom','$documento_tipo',
				'$documento_nro','$fecha_nacimiento','$direccion_calle_f','$direccion_nro_f',
				'$direccion_piso_f','$direccion_dpto_nro_f','$direccion_localidad_f',
				'$direccion_provincia_f','$codigo_postal_f','$direccion_calle_r',
				'$direccion_nro_r','$direccion_piso_r','$direccion_dpto_nro_r',
			    '$direccion_localidad_r','$direccion_provincia_r','$codigo_postal_r',
				'$telefono','$email','$banco_nombre','$banco_sucursal',
			    '$banco_cta_tipo','$banco_cta_nro','$cbucont1','$cbucont2',
				'$cbucont3','$cbucont4','$cbucont5','$cbucont6',
				'$banco_cbu','$fechac_s','$sociedad_tipo','$convenio_tipo',
				'$convenio_nro','$persona_tipo','$ingreso_bruto','$iva_situacion',
				'$actividad_p','$fecha_p','$actividad_s','$fecha_s',
				'$apellido1','$apellido2','$apellido3','$apellido4','$nombre1',
				'$nombre2','$nombre3','$nombre4','$dni1','$dni2',
				'$dni3','$dni4','$cargo1','$cargo2','$cargo3','$cargo4',
			    '$area','$cargo','$fecha_c','$saf','$fecha_alta_web','$usuario_alta',
				'$usuario_aprobo','$fecha_aprobacion','$observacion','$nro','$nou','$fecha_baja')";
					
					if (!($r_beneficiarios = mysql_query($ssql,$conexion_mysql)))
					 {
						  //.....................................................................
						  // informa del error producido
						  $cuerpo1  = "al intentar dar de alta un beneficiario";
						  echo $cuerpo1;
							   exit;
						  //.....................................................................
					 }			 		 
				
				
					
		  $accion='Baja Sistema de Beneficiarios';
		  $tabla='beneficiarios_aprobados';
		  include('agrego_movi.php');     
   }
else
   {
	   $fecha_alta = date("Y/m/d");	
   
           $ssql = "UPDATE beneficiarios_aprobados SET 
					nro_nota='$nro',
					estado='$estado'
					WHERE id_beneficiario='$id_bene'";
				 if (!($r_beneficiarios = mysql_query($ssql,$conexion_mysql)))
				 {
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar dar de alta un beneficiario update";
					  echo $cuerpo1;
						   exit;
					  //.....................................................................
				 }
   
   	 
	$ssql = "SELECT * FROM `beneficiarios_aprobados` WHERE id_beneficiario = '$id_bene'";
     if (!($r_beneficiario= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }    
	 $f_beneficiario= mysql_fetch_array ($r_beneficiario);
	 

    $cuitl = $f_beneficiario['cuitl'];
  $ape = $f_beneficiario['apellido'];  
  $nom = $f_beneficiario['nombre'];  
  $nombrer = $f_beneficiario['razon_social'];  
  $documento_tipo =$f_beneficiario['documento_tipo'];
  $documento_nro =$f_beneficiario['documento_nro'];
  $fecha_nacimiento=$f_beneficiario['fecha_nacimiento'];
  $fecha=split("-",$fecha_nacimiento);
  $fecha_nacimiento=$fecha[2].'-'.$fecha[1].'-'.$fecha[0]; 
  $direccion_calle_f=$f_beneficiario['direccion_f_calle'];
  $direccion_nro_f=$f_beneficiario['direccion_f_nro'];
  $direccion_piso_f=$f_beneficiario['direccion_f_piso'];
  $direccion_dpto_nro_f=$f_beneficiario['direccion_f_dpto_nro'];
  $direccion_localidad_f=$f_beneficiario['direccion_f_localidad'];
  $direccion_provincia_f=$f_beneficiario['direccion_f_provincia'];
  $codigo_postal_f=$f_beneficiario['codigo_f_postal'];
  $direccion_calle_r=$f_beneficiario['direccion_r_calle'];
  $direccion_nro_r=$f_beneficiario['direccion_r_nro'];
  $direccion_piso_r=$f_beneficiario['direccion_r_piso'];
  $direccion_dpto_nro_r=$f_beneficiario['direccion_r_dpto_nro'];
  $direccion_provincia_r=$f_beneficiario['direccion_r_provincia'];
  $direccion_localidad_r=$f_beneficiario['direccion_r_localidad'];
  $codigo_postal_r=$f_beneficiario['codigo_r_postal']; 
  $telefono=$f_beneficiario['telefono'];
  $email=$f_beneficiario['email'];
  $ingreso_bruto=$f_beneficiario['ingreso_bruto'];
  $iva_situacion=$f_beneficiario['iva_situacion'];
  $actividad_p=$f_beneficiario['actividad_p'];
  $fecha_p=$f_beneficiario['fecha_p'];
  $actividad_s=$f_beneficiario['actividad_s'];
  $fecha_s=$f_beneficiario['fecha_s'];
   $fechac_s = $f_beneficiario['fecha_contrato'];
   $sociedad_tipo = $f_beneficiario['sociedad_tipo'];
   $ingreso_bruto = $f_beneficiario['ingreso_bruto'];
   $iva_situacion = $f_beneficiario['iva_situacion'];
   $convenio_tipo = $f_beneficiario['convenio_tipo'];
   $convenio_nro = $f_beneficiario['convenio_nro'];
   $apellido1 = $f_beneficiario['apellido1'];
   $apellido2 = $f_beneficiario['apellido2'];
   $apellido3 = $f_beneficiario['apellido3'];
   $apellido4 = $f_beneficiario['apellido4']; 
   $nombre1 = $f_beneficiario['nombre1'];
   $nombre2 = $f_beneficiario['nombre2'];
   $nombre3 = $f_beneficiario['nombre3'];
   $nombre4 = $f_beneficiario['nombre4'];
   $dni1  = $f_beneficiario['dni1'];
   $dni2 = $f_beneficiario['dni2'];
   $dni3 = $f_beneficiario['dni3'];
   $dni4 = $f_beneficiario['dni4'];
   $cargo1 = $f_beneficiario['cargo1'];
   $cargo2 = $f_beneficiario['cargo2'];
   $cargo3= $f_beneficiario['cargo3'];
   $cargo4= $f_beneficiario['cargo4'];
   $persona_tipo=$f_beneficiario['persona_tipo'];
   $cargo=$f_beneficiario['cargo'];
   $saf=$f_beneficiario['saf'];
   $area=$f_beneficiario['area'];
   $ministerial=$f_beneficiario['ministerial'];
   $fecha_c=$f_beneficiario['fecha_gestion'];
   $observacion=$f_beneficiario['observacion'];
   $inhi=$f_beneficiario['inhi'];
   $fecha_aprobacion = $f_beneficiario['fecha_aprobacion']; 
   $usuario_aprobo = $f_beneficiario['usuario_aprobo'];  
  // $usuario_alta = $f_beneficiario['usuario_alta']; 
   $nro = $f_beneficiario['nro_nota']; 
  
   //$fecha_alta = $f_beneficiario['fecha_alta'];
	 
   $ssql = "INSERT INTO beneficiarios_historial
                (cuitl,razon_social,apellido,nombre,documento_tipo,
				documento_nro,fecha_nacimiento,direccion_f_calle,direccion_f_nro,
				direccion_f_piso,direccion_f_dpto_nro,direccion_f_localidad,
				direccion_f_provincia,codigo_f_postal,direccion_r_calle,direccion_r_nro,
				direccion_r_piso,direccion_r_dpto_nro,direccion_r_localidad,
				direccion_r_provincia,codigo_r_postal,telefono,email,banco_nombre,
				banco_sucursal,banco_cta_tipo,banco_cta_nro,cbu_entidad,
				cbu_sucursal,verificador1,cbu_tipo_cta,cbu_cta,verificador2,cbu,
				fecha_contrato,sociedad_tipo,convenio_tipo,convenio_nro,
				persona_tipo,ingreso_bruto,iva_situacion,actividad_p,fecha_p,actividad_s,
				fecha_s,apellido1,apellido2,apellido3,apellido4,nombre1,nombre2,nombre3,
				nombre4,dni1,dni2,dni3,dni4,cargo1,cargo2,cargo3,cargo4,
			    area,cargo,fecha_gestion,saf,fecha_alta_web,usuario_alta,usuario_aprobo,
				fecha_aprobacion,observacion,nro_nota,usuario_alta_new,fecha_alta_new)
				VALUES ('$cuitl','$nombrer','$ape','$nom','$documento_tipo',
				'$documento_nro','$fecha_nacimiento','$direccion_calle_f','$direccion_nro_f',
				'$direccion_piso_f','$direccion_dpto_nro_f','$direccion_localidad_f',
				'$direccion_provincia_f','$codigo_postal_f','$direccion_calle_r',
				'$direccion_nro_r','$direccion_piso_r','$direccion_dpto_nro_r',
			    '$direccion_localidad_r','$direccion_provincia_r','$codigo_postal_r',
				'$telefono','$email','$banco_nombre','$banco_sucursal',
			    '$banco_cta_tipo','$banco_cta_nro','$cbucont1','$cbucont2',
				'$cbucont3','$cbucont4','$cbucont5','$cbucont6',
				'$banco_cbu','$fechac_s','$sociedad_tipo','$convenio_tipo',
				'$convenio_nro','$persona_tipo','$ingreso_bruto','$iva_situacion',
				'$actividad_p','$fecha_p','$actividad_s','$fecha_s',
				'$apellido1','$apellido2','$apellido3','$apellido4','$nombre1',
				'$nombre2','$nombre3','$nombre4','$dni1','$dni2',
				'$dni3','$dni4','$cargo1','$cargo2','$cargo3','$cargo4',
			    '$area','$cargo','$fecha_c','$saf','$fecha_alta_web','$usuario_alta',
			    '$usuario_aprobo','$fecha_aprobacion','$observacion','$nro',
				'$nou','$fecha_alta')";
					
					if (!($r_beneficiarios = mysql_query($ssql,$conexion_mysql)))
					 {
						  //.....................................................................
						  // informa del error producido
						  $cuerpo1  = "al intentar dar de alta un beneficiario";
						  echo $cuerpo1;
							   exit;
						  //.....................................................................
					 }			 		 
				
				
					
		  $accion='Restauracion Sistema de Beneficiarios';
		  $tabla='beneficiarios_aprobados';
		  include('agrego_movi.php');                                       //
   }
?>
	<div class="content">
	<center><h1>Guardando</h1></center>
	
	<center><img src="../img/loader_guardando.gif" width="100" height="100" />
	<p>Sus Datos Fueron Grabado con Exito.</p></center>
<code>Haga click <a href='indextesoreria.php?sec=contaduria/consulta_beneficiarios&apli=cgp&per=A'>aqu&iacute;</a> para regresar.</code>

<!-- ======================================================================= -->

</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>
</head>