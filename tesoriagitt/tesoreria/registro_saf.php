  <?php 
  error_reporting ( E_ERROR ); 
   include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');    
	 
//variables recibidas
   $persona_tipo='o';
   $cuitl = $_POST['id'];
   $usuario=$nombre;
  
  //datos de identificacion
  
   $area=$_POST['area'];
   $cargo=$_POST['cargo'];
   $saf=$_POST['saf']; 
   $fechac=$_POST['fecha_gestion'];
  
 
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
 
  
 //datos de alta web 
 
  $fecha_alta_web = date("d/m/Y");
   $fechaaw=split("/",$fecha_alta_web); 
   $fecha_alta_web=$fechaaw[2].'-'.$fechaaw[1].'-'.$fechaaw[0];
 
   $bandera=$_POST['bandera'];
 $ssql = "INSERT INTO saf (cuit,banco_nombre,
				banco_sucursal,banco_cta_tipo,banco_cta_nro,cbu_entidad,
				cbu_sucursal,verificador1,cbu_tipo_cta,cbu_cta,verificador2,cbu,
				area,cargo,fecha_gestion,saf,fecha_alta_web,usuario_alta)
				VALUES ('$cuitl','$banco_nombre','$banco_sucursal','$banco_cta_tipo',
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
		$ultimo=mysql_insert_id();		 
		 $ssql="UPDATE `beneficiarios` SET alta='NS' WHERE `beneficiarios`.`cuitl` = '$cuitl'";
	  
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
	<p>Sus Datos Fueron Grabado con Exito.</p></center>
<code>Si desea Imprimir, <b>Por favor</b></code>
<code>Haga click <a href='tesoreria/formulario_o.php?cuitl=
	<?php echo $cuitl;?>&ultimo=
	<?php echo $ultimo;?>'>aqu&iacute;</a> </code>
<code>Haga click <a href='indextesoreria.php'>aqu&iacute;</a> para regresar.</code>

	 

<!-- ======================================================================= -->

</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>
</head>