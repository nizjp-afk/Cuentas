<?php 
error_reporting ( E_ERROR );
   include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	 
//variables recibidas
   $persona_tipo='j';
   $cuitl = $_POST['cuitl'];
  
  //datos de identificacion
  
   $nombre = ucwords(strtolower($_POST['razon_social']));   
   
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
   $banco_denominacion = $_POST['banco_denominacion'];	 
	
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
 
   $fechac_s = $_POST['fechac_s'];
   $sociedad_tipo = $_POST['sociedad_tipo'];
   $ingreso_bruto = $_POST['ingreso_bruto'];
   $iva_situacion = $_POST['iva_situacion'];
   $ingreso_bruto_ac = $_POST['ingreso_bruto_ac'];
  // $alicuota = $_POST['alicuota'];
   $ganancia = $_POST['ganancia'];
   $ingreso = $_POST['ingreso'];
   $regimen = $_POST['regimen'];
   $seguridad = $_POST['seguridad'];
  
 //componente de la sociedad
  
   $apellido1 = $_POST['apellido1'];
   $apellido2 = $_POST['apellido2'];
   $apellido3 = $_POST['apellido3'];
   $apellido4 = $_POST['apellido4'];

   $nombre1 = $_POST['nombre1'];
   $nombre2 = $_POST['nombre2'];
   $nombre3 = $_POST['nombre3'];
   $nombre4 = $_POST['nombre4'];
   
   $dni1 = $_POST['dni1'];
   $dni2 = $_POST['dni2'];
   $dni3 = $_POST['dni3'];
   $dni4 = $_POST['dni4'];   
   
   $cargo1 = $_POST['cargo1'];
   $cargo2 = $_POST['cargo2'];
   $cargo3 = $_POST['cargo3'];
   $cargo4 = $_POST['cargo4']; 
   
   $fecha_inicio1 = $_POST['fecha_inicio1'];    
   $fecha_inicio2 = $_POST['fecha_inicio2'];    
   $fecha_inicio3 = $_POST['fecha_inicio3'];    
   $fecha_inicio4 = $_POST['fecha_inicio4'];    
   
   $duracion1 = $_POST['duracion1'];    
   $duracion2 = $_POST['duracion2'];    
   $duracion3 = $_POST['duracion3'];    
   $duracion4 = $_POST['duracion4'];    
   
   $observacion=$_POST['observacion'];
   
   //// miembros de las ute
   
    $cuit1_u = $_POST['cuit1_u'];
    $cuit2_u = $_POST['cuit2_u'];
    $cuit3_u = $_POST['cuit3_u'];
    $cuit4_u = $_POST['cuit4_u'];
	$cuit5_u = $_POST['cuit5_u'];
    $cuit6_u = $_POST['cuit6_u']; 
	
	
	$razon1_u = $_POST['razon1_u'];
    $razon2_u = $_POST['razon2_u'];
    $razon3_u = $_POST['razon3_u'];
    $razon4_u = $_POST['razon4_u'];
	$razon5_u = $_POST['razon5_u'];
    $razon6_u = $_POST['razon6_u']; 
	
	$dom1_u = $_POST['dom1_u'];
    $dom2_u = $_POST['dom2_u'];
    $dom3_u = $_POST['dom3_u'];
    $dom4_u = $_POST['dom4_u'];
	$dom5_u = $_POST['dom5_u'];
    $dom6_u = $_POST['dom6_u'];
	
	$por1_u = $_POST['por1_u'];
    $por2_u = $_POST['por2_u'];
    $por3_u = $_POST['por3_u'];
    $por4_u = $_POST['por4_u'];
	$por5_u = $_POST['por5_u'];
    $por6_u = $_POST['por6_u']; 
	
   
 //datos de alta web 
 
   $fecha_alta_web = date("d/m/Y");
   $fechaaw=split("/",$fecha_alta_web); 
   $fecha_alta_web=$fechaaw[2].'-'.$fechaaw[1].'-'.$fechaaw[0];
   
   $bandera=0;

   ///verifica si existe este cuitl

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
<code>Por favor, <b>comuniquese</b> con la Tesoreria General de la Provincia.
&#8226; Direccion: San Nicolas de Bari (Oeste) y 25 de Mayo.
&#8226; Telefono: [03822] 453121</code>
<code>Haga click <a href='index.php'>aqu&iacute;</a> para regresar.</code>
<?php
	}
	else
	{  
	//echo $cbucont5;
	//exit;
	 	$ssql = "INSERT INTO beneficiarios (cuitl,razon_social,direccion_f_calle,direccion_f_nro,
				direccion_f_piso,direccion_f_dpto_nro,direccion_f_localidad,
				direccion_f_provincia,codigo_f_postal,direccion_r_calle,direccion_r_nro,
				direccion_r_piso,direccion_r_dpto_nro,direccion_r_localidad,
		        direccion_r_provincia,codigo_r_postal,telefono,email,
			    banco_nombre,banco_sucursal,banco_cta_tipo,banco_cta_nro,cbu_entidad,
				cbu_sucursal,verificador1,cbu_tipo_cta,cbu_cta,verificador2,
				cbu,banco_denominacion,fecha_contrato,sociedad_tipo,convenio_tipo,convenio_nro,
			    persona_tipo,ingreso_bruto,iva_situacion,ganancia,alicuota,
				ingreso,ingreso_bruto_ac,seguridad,regimen,actividad_p,fecha_p,actividad_s,
				fecha_s,apellido1,apellido2,apellido3,apellido4,nombre1,nombre2,nombre3,
				nombre4,dni1,dni2,dni3,dni4,cargo1,cargo2,cargo3,
				cargo4,fecha_inicio1,fecha_inicio2,fecha_inicio3,
				fecha_inicio4,duracion1,duracion2,duracion3,duracion4,
				fecha_alta_web,observacion,cuit_tipo,cuit_u1,cuit_u2,cuit_u3,cuit_u4,
				cuit_u5,cuit_u6,razon_social_u1,razon_social_u2,razon_social_u3,razon_social_u4,
				razon_social_u5,razon_social_u6,direccion_u1,direccion_u2,direccion_u3,
				direccion_u4,direccion_u5,direccion_u6,por_u1,por_u2,por_u3,por_u4,por_u5,por_u6,usuario_alta_f)
				VALUES ('$cuitl','$nombre','$direccion_calle_f','$direccion_nro_f',
				'$direccion_piso_f','$direccion_dpto_nro_f','$direccion_localidad_f',
				'$direccion_provincia_f','$codigo_postal_f','$direccion_calle_r',
				'$direccion_nro_r','$direccion_piso_r','$direccion_dpto_nro_r',
				'$direccion_localidad_r','$direccion_provincia_r','$codigo_postal_r',
				'$telefono','$email','$banco_nombre','$banco_sucursal','$banco_cta_tipo',
				'$banco_cta_nro','$cbucont1','$cbucont2','$cbucont3','$cbucont4',
				'$cbucont5','$cbucont6','$banco_cbu','$banco_denominacion','$fechac_s',
				'$sociedad_tipo','$convenio_tipo','$convenio_nro','$persona_tipo',
				'$ingreso_bruto','$iva_situacion','$ganancia','$alicuota',
				'$ingreso','$ingreso_bruto_ac','$seguridad','$regimen','$actividad_p',
				'$fechai_p','$actividad_s','$fechai_s','$apellido1','$apellido2',
				'$apellido3','$apellido4','$nombre1','$nombre2','$nombre3',
			    '$nombre4','$dni1','$dni2','$dni3','$dni4','$cargo1',
				'$cargo2','$cargo3','$cargo4','$fecha_inicio1','$fecha_inicio2',
				'$fecha_inicio3','$fecha_inicio4','$duracion1','$duracion2',
   			    '$duracion3','$duracion4','$fecha_alta_web','$observacion',
				'1','$cuit1_u','$cuit2_u','$cuit3_u','$cuit4_u','$cuit_u5','$cuit_u6',
				'$razon1_u','$razon2_u','$razon3_u','$razon4_u','$razon5_u','$razon6_u',
				'$dom1_u','$dom2_u','$dom3_u','$dom4_u','$dom5_u','$dom6_u','$por1_u','$por2_u',
				'$por3_u','$por4_u','$por5_u','$por6_u','$usuario')";
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
	
	<center><img src="../img/loader_guardando.gif" width="100" height="100" />
	<p>Sus datos fueron grabados con exito.</p></center>
<code>Si desea Imprimir, <b>Por favor</b> haga click
 <a href='federal/formulario_j.php?cuitl=<?php echo $cuitl;?>'>aqu&iacute;</a>.</code>
<code>O haga click <a href='indextesoreria.php?sec=hacienda/index_fed&apli=orden&per=C&valor=F'>aqu&iacute;</a> para regresar.</code>

	 
<?php 
	}
		
?>

<!-- ======================================================================= -->

</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>