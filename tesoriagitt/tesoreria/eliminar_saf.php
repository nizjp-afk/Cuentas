<?php 
error_reporting ( E_ERROR ); 
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	 
//variables recibidas
      $id = $_GET['id'];
      $usuario1=$_POST['usuario'];
      $observacion=$_POST['observacion'];
 
//fecha de aprobacion
 
  $fecha_aprobacion = date("d/m/Y");
  $fechaa=split("/",$fecha_aprobacion); 
 //datos aprobacion
  $fecha_aprobacion=$fechaa[2].'-'.$fechaa[1].'-'.$fechaa[0];
  $usuario1=$nombre; 
  
  //datos usuarios

$ssql = "SELECT * FROM `personas` WHERE id_personas='$usuario1'";
     if (!($r_usuario= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar beneficiario";
      echo $cuerpo1;
      //.....................................................................
    }    
	 $f_usuario= mysql_fetch_array ($r_usuario);
     $usuarion=$f_usuario['nombre'].' '.$f_usuario['apellido'];
  
  $ssql = "SELECT * FROM `beneficiarios` WHERE id_beneficiario='$id'";
     if (!($r_beneficiario= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar beneficiario9";
      echo $cuerpo1;
      //.....................................................................
    }    
	 $f_beneficiario= mysql_fetch_array ($r_beneficiario);
	 $cuitl = $f_beneficiario['cuitl'];
	 
	
		//datos personales
			
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
		  $tipo=$f_beneficiario['persona_tipo'];
		  
		  //banco
		   $banco_nombre=$f_beneficiario['banco_nombre'];
           $banco_sucursal=$f_beneficiario['banco_sucursal'];
           $banco_cta_tipo=$f_beneficiario['banco_cta_tipo'];
           $banco_cta_nro=$f_beneficiario['banco_cta_nro'];
 
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
			
   	

       //
	   $fecha_alta_web=$f_beneficiario['fecha_alta_web'];
    
       $ssql = "INSERT INTO bene_eliminados (cuitl,apellido,nombre,documento_tipo,
				documento_nro,fecha_nacimiento,direccion_f_calle,direccion_f_nro,
				direccion_f_piso,direccion_f_dpto_nro,direccion_f_localidad,
				direccion_f_provincia,codigo_f_postal,direccion_r_calle,direccion_r_nro,
				direccion_r_piso,direccion_r_dpto_nro,direccion_r_localidad,
				direccion_r_provincia,codigo_r_postal,telefono,email,
				persona_tipo,banco_nombre,
				banco_sucursal,banco_cta_tipo,banco_cta_nro,cbu_entidad,
			    cbu_sucursal,verificador1,cbu_tipo_cta,cbu_cta,verificador2,cbu,
				fecha_alta_web,usuario_elimino,area,cargo,
				fecha_eliminacion,observacion)
				VALUES ('$cuitl','$apellido','$nom','$documento_tipo',
				'$documento_nro','$fecha_nacimiento','$direccion_f_calle','$direccion_f_nro',
				'$direccion_f_piso','$direccion_f_dpto_nro','$direccion_f_localidad',
				'$direccion_f_provincia','$codigo_f_postal','$direccion_r_calle',
				'$direccion_r_nro','$direccion_r_piso','$direccion_r_dpto_nro',
				'$direccion_r_localidad','$direccion_r_provincia','$codigo_r_postal',
				'$telefono','$email','$tipo','$banco_nombre','$banco_sucursal',
			    '$banco_cta_tipo','$banco_cta_nro','$cbu_entidad','$cbu_sucursal',
				'$verificador1','$cbu_tipo_cta','$cbu_cta','$verificador2',
				'$cbu','$fecha_alta_web','$usuario1','$area','$cargo',
				'$fecha_aprobacion','$observacion')";
				 if (!($r_beneficiarios = mysql_query($ssql,$conexion_mysql)))
				 {
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar dar de alta un beneficiario1ver";
					  echo $cuerpo1;
						   exit;
					  //.....................................................................
				 }
		
		
	 $ssql="DELETE FROM `beneficiarios` WHERE `beneficiarios`.`id_beneficiario` = '$id'";
	  
	   if (!($r_beneficiarios = mysql_query($ssql,$conexion_mysql)))
				 {
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar dar de alta un beneficiario2";
					  echo $cuerpo1;
						   exit;
					  //.....................................................................
				 }
		    
				 
		 $accion='Elimino Beneficiario';
		  $tabla='beneficiarios';
		  include('agrego_movi.php'); 
	  
?>
	<div class="content">
	<center><h1>Guardando</h1></center>
	
	<center><img src="../img/loader_guardando.gif" width="100" height="100" />
	<p>Sus Datos Fueron Eliminados con Exito.</p></center>

<code>Haga click <a href='indextesoreria.php?sec=tesoreria/beneficiarios_consulta_confirmar&apli=tgp&per=C'>aqu&iacute;</a> para regresar.</code>



<!-- ======================================================================= -->

</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>