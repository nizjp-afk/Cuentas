<?php 
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	 
    $ssql = "SELECT * FROM `beneficiarios_aprobados` where `persona_tipo`='o'";
     if (!($r_beneficiario= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar beneficiario";
      echo $cuerpo1;
      //.....................................................................
    }
	
	/*$ssql = "SELECT * FROM `beneficiarios` where `alta`='' and persona_tipo='o'  order by id_beneficiario";
     if (!($r_beneficiario= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar beneficiario";
      echo $cuerpo1;
      //.....................................................................
    } */     
	while($f_beneficiario= mysql_fetch_array ($r_beneficiario))
	    {

//datos personales
	
  $cuitl = $f_beneficiario['cuitl'];
  $apellido= $f_beneficiario['apellido'];
  $nom = $f_beneficiario['nombre'];
  $documento_tipo =$f_beneficiario['documento_tipo'];
  $documento_nro =$f_beneficiario['documento_nro'];
  $fecha_nacimiento=$f_beneficiario['fecha_nacimiento'];
  $fecha_c=$f_beneficiario['fecha_gestion'];
  $cargo=$f_beneficiario['cargo'];
  $saf=$f_beneficiario['saf'];
  $area=$f_beneficiario['area'];
  $razon_social=$f_beneficiario['razon_social'];
 
//domicilio fiscal 

  $direccion_f_calle=$f_beneficiario['direccion_f_calle'];
  $direccion_f_nro=$f_beneficiario['direccion_f_nro'];
  $direccion_f_piso=$f_beneficiario['direccion_f_piso'];
  $direccion_f_dpto_nro=$f_beneficiario['direccion_f_dpto_nro'];
  $direccion_f_localidad=$f_beneficiario['direccion_f_localidad'];
  $direccion_f_provincia=$f_beneficiario['direccion_f_provincia'];
  $codigo_f_postal=$f_beneficiario['codigo_f_postal'];

//domicilio real

  $direccion_r_calle=$f_beneficiario['direccion_r_calle'];
  $direccion_r_nro=$f_beneficiario['direccion_r_nro'];
  $direccion_r_piso=$f_beneficiario['direccion_r_piso'];
  $direccion_r_dpto_nro=$f_beneficiario['direccion_r_dpto_nro'];
  $direccion_r_provincia=$f_beneficiario['direccion_r_provincia'];
  $direccion_r_localidad=$f_beneficiario['direccion_r_localidad'];
  $codigo_r_postal=$f_beneficiario['codigo_r_postal'];

//otros datos

  $telefono=$f_beneficiario['telefono'];
  $email=$f_beneficiario['email'];

//banco

  $banco_nombre=$f_beneficiario['banco_nombre'];
  $banco_sucursal=$f_beneficiario['banco_sucursal'];
  $banco_cta_tipo=$f_beneficiario['banco_cta_tipo'];
  $banco_cta_nro=$f_beneficiario['banco_cta_nro'];
  $cbu_entidad=$f_beneficiario['cbu_entidad'];
  $cbu_sucursal=$f_beneficiario['cbu_sucursal'];
  $verificador1=$f_beneficiario['verificador1'];
  $cbu_tipo_cta=$f_beneficiario['cbu_tipo_cta'];
  $cbu_cta=$f_beneficiario['cbu_cta'];
  $verificador2=$f_beneficiario['verificador2'];
  $cbu=$f_beneficiario['cbu'];
  
    $cbucont = str_replace('-', '', $cbu);
	$cbucont1 = substr($cbucont,0,3);
	$cbucont2 = substr($cbucont,3,4);
	$cbucont3 = $cbucont[7];
	$cbucont4 = substr($cbucont,8,2);
	$cbucont5 =  substr($cbucont,10,11);
	$cbucont6 = $cbucont[21];
	
  $cbu_entidad=$cbucont1;
  $cbu_sucursal=$cbucont2;
  $verificador1=$cbucont3;
  $cbu_tipo_cta=$cbucont4;
  $cbu_cta=$cbucont5;
  $verificador2=$cbucont6;	
//actividad 

  $ingreso_bruto=$f_beneficiario['ingreso_bruto'];
  $iva_situacion=$f_beneficiario['iva_situacion'];
  $actividad_p=$f_beneficiario['actividad_p'];
  $fecha_p=$f_beneficiario['fecha_p'];
  $actividad_s=$f_beneficiario['actividad_s'];
  $fecha_s=$f_beneficiario['fecha_s'];
  $fechac_s=$f_beneficiario['fecha_contrato'];
  $sociedad_tipo = $f_beneficiario['sociedad_tipo'];
  $convenio_tipo = $f_beneficiario['convenio_tipo'];
  $convenio_nro = $f_beneficiario['convenio_nro'];
  $persona_tipo = $f_beneficiario['persona_tipo'];
  
 //datos sociedad

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

   //fecha alta
   $fecha_alta_web=$f_beneficiario['fecha_alta_web'];
   //datos aprobacion
   
   $fecha_aprobacion=$f_beneficiario['fecha_aprobacion'];
   $usuario_aprobo=$f_beneficiario['usuario_aprobo']; 
    
   
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
			    area,cargo,fecha_gestion,saf,fecha_alta_web,usuario_aprobo,
				fecha_aprobacion)
				VALUES ('$cuitl','$razon_social','$apellido','$nom','$documento_tipo',
				'$documento_nro','$fecha_nacimiento','$direccion_f_calle','$direccion_f_nro',
				'$direccion_f_piso','$direccion_f_dpto_nro','$direccion_f_localidad',
				'$direccion_f_provincia','$codigo_f_postal','$direccion_r_calle',
				'$direccion_r_nro','$direccion_r_piso','$direccion_r_dpto_nro',
			    '$direccion_r_localidad','$direccion_r_provincia','$codigo_r_postal',
				'$telefono','$email','$banco_nombre','$banco_sucursal',
			    '$banco_cta_tipo','$banco_cta_nro','$cbu_entidad','$cbu_sucursal',
				'$verificador1','$cbu_tipo_cta','$cbu_cta','$verificador2',
				'$cbu','$fechac_s','$sociedad_tipo','$convenio_tipo',
				'$convenio_nro','$persona_tipo','$ingreso_bruto','$iva_situacion',
				'$actividad_p','$fechai_p','$actividad_s','$fechai_s',
				'$apellido1','$apellido2','$apellido3','$apellido4','$nombre1',
				'$nombre2','$nombre3','$nombre4','$dni1','$dni2',
				'$dni3','$dni4','$cargo1','$cargo2','$cargo3','$cargo4',
				'$area','$cargo','$fecha_c','$saf','$fecha_alta_web','$usuario_aprobo',
				'$fecha_aprobacion')";
				 if (!($r_beneficiarios = mysql_query($ssql,$conexion_mysql)))
				 {
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar dar de alta un beneficiario";
					  echo $cuerpo1;
						   exit;
					  //.....................................................................
				 }
		
	
	  
	 } 
?>
	<div class="content">
	<center><h1>Guardando</h1></center>
	
	<center><img src="../img/loader_guardando.gif" width="100" height="100" />
	<p>Sus Datos Fueron Grabado con Exito.</p></center>
<code>Si desea Imprimir, <b>Por favor</b></code>
<code>Haga click <a href='beneficiario/formulario_j.php?cuitl=
	<?php echo $cuitl;?>'>aqu&iacute;</a> </code>
<code>Haga click <a href='index.php'>aqu&iacute;</a> para regresar.</code>



<!-- ======================================================================= -->

</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>