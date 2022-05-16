<?php
error_reporting ( E_ERROR ); 
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    //include('conexion/extras.php');
    
    $id = $_GET['id'];
    $ssql = "SELECT * FROM `beneficiarios_aprobados` WHERE id_beneficiario='$id'";
     if (!($r_beneficiario= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }    
	 $f_beneficiario= mysql_fetch_array ($r_beneficiario);

	 $ssql = "SELECT * FROM `provincias` WHERE codprovincia='$direccion_provincia'";
     if (!($r_provincia= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }    
	
	$ssql = "SELECT * FROM `departamentos` WHERE cod_dpto='$direccion_dpto'";
     if (!($r_departamento= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }  
	
	$ssql = "SELECT * FROM `localidades` WHERE id_localidades='$direccion_localidad'";
     if (!($r_localidad= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }  
	
	$ssql = "SELECT * FROM tipo_documento WHERE  id_tipo='$documento_tipo'";
     if (!($r_documento= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo documento";
      echo $cuerpo1;
      //.....................................................................
    }        

   $ssql = "SELECT * FROM bancos where id_banco='$banco_nombre'";
     if (!($r_banco= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar banco";
      echo $cuerpo1;
      //.....................................................................
    }        
	
	$ssql = "SELECT * FROM bancos_cuentas where id_ban_cta='$banco_cta_tipo'";
     if (!($r_bcocta= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de cuenta";
      echo $cuerpo1;
      //.....................................................................
    }        


    $ssql = "SELECT * FROM sociedades where id_sociedad='$sociedad_tipo'";
     if (!($r_sociedad= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar sociedad";
      echo $cuerpo1;
      //.....................................................................
    }        


     $ssql = "SELECT * FROM iva where id_iva='$iva_situacion'";
     if (!($r_iva= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de cuenta";
      echo $cuerpo1;
      //.....................................................................
    } 
  $cuitl = $f_beneficiario['cuitl'];
  $razon_social = $f_beneficiario['razon_social'];  
  $direccion_f_calle=$f_beneficiario['direccion_f_calle'];
  $direccion_f_nro=$f_beneficiario['direccion_f_nro'];
  $direccion_f_piso=$f_beneficiario['direccion_f_piso'];
  $direccion_f_dpto_nro=$f_beneficiario['direccion_f_dpto_nro'];
  $direccion_f_localidad=$f_beneficiario['direccion_f_localidad'];
  $direccion_f_provincia=$f_beneficiario['direccion_f_provincia'];
  $codigo_f_postal=$f_beneficiario['codigo_f_postal'];
  $direccion_r_calle=$f_beneficiario['direccion_r_calle'];
  $direccion_r_nro=$f_beneficiario['direccion_r_nro'];
  $direccion_r_piso=$f_beneficiario['direccion_r_piso'];
  $direccion_r_dpto_nro=$f_beneficiario['direccion_r_dpto_nro'];
  $direccion_r_provincia=$f_beneficiario['direccion_r_provincia'];
  $direccion_r_localidad=$f_beneficiario['direccion_r_localidad'];
  $codigo_r_postal=$f_beneficiario['codigo_r_postal']; 
  $telefono=$f_beneficiario['telefono'];
  $email=$f_beneficiario['email'];
  $banco_nombre=$f_beneficiario['banco_nombre'];
  $banco_sucursal=$f_beneficiario['banco_sucursal'];
  $banco_cta_tipo=$f_beneficiario['banco_cta_tipo'];
  $banco_cta_nro=$f_beneficiario['banco_cta_nro'];
  $cbu=$f_beneficiario['cbu'];
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
   $ganancia = $f_beneficiario['ganancia'];
  //$alicuota = $f_beneficiario['alicuota'];
  $ingreso = $f_beneficiario['ingreso'];
  $regimen = $f_beneficiario['regimen'];
  $seguridad = $f_beneficiario['seguridad'];
  $ingreso_bruto_ac=$f_beneficiario['ingreso_bruto_ac'];
  

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
   $tipo= $f_beneficiario['persona_tipo'];
   $observacion=$f_beneficiario['observacion'];
   $inhi=$f_beneficiario['inhi'];

  	

//provincia

 $ssql = "SELECT * FROM `provincias` WHERE codprovincia='$direccion_f_provincia'";
     if (!($r_provincia= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }    
	 $f_prov= mysql_fetch_array ($r_provincia);
	 $direccion_f_provincia=$f_prov['nombre']; 

//localidad
	
	$ssql = "SELECT * FROM `localidades` WHERE id_localidades='$direccion_f_localidad'";
     if (!($r_localidad= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }

    $f_localidad= mysql_fetch_array ($r_localidad);
	$direccion_f_localidad=$f_localidad['descripcion']; 	  

//provincia

 $ssql = "SELECT * FROM `provincias` WHERE codprovincia='$direccion_r_provincia'";
     if (!($r_provincia= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }    
	 $f_prov= mysql_fetch_array ($r_provincia);
	 $direccion_r_provincia=$f_prov['nombre']; 

//localidad
	
	$ssql = "SELECT * FROM `localidades` WHERE id_localidades='$direccion_r_localidad'";
     if (!($r_localidad= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }

    $f_localidad= mysql_fetch_array ($r_localidad);
	$direccion_r_localidad=$f_localidad['descripcion']; 	  


//banco

   $ssql = "SELECT * FROM bancos where id_banco='$banco_nombre'";
     if (!($r_banco= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar banco";
      echo $cuerpo1;
      //.....................................................................
    }  
	
	 $f_banco= mysql_fetch_array ($r_banco);
	$banco_nombre=$f_banco['nombre']; 	        
	
//tipo cta

	$ssql = "SELECT * FROM bancos_cuentas where id_ban_cta='$banco_cta_tipo'";
     if (!($r_bcocta= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de cuenta";
      echo $cuerpo1;
      //.....................................................................
    }        

    $f_bcocta= mysql_fetch_array ($r_bcocta);
	$banco_cta_tipo=$f_bcocta['nombre']; 
	
//iva  
	
     $ssql = "SELECT * FROM iva where id_iva='$iva_situacion'";
     if (!($r_iva= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de cuenta";
      echo $cuerpo1;
      //.....................................................................
    } 
	
	$f_iva= mysql_fetch_array ($r_iva);
	$iva_situacion=$f_iva['nombre']; 
	
	
//actividad

 $ssql = "SELECT * FROM `actividad` where id_actividad='$actividad_p'";
     if (!($r_actividad_p= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar actividad";
      echo $cuerpo1;
      //.....................................................................
    }  
	
	$f_actividad_p= mysql_fetch_array ($r_actividad_p);
	$actividad_p=$f_actividad_p['nombre_actividad']; 
	
	 $ssql = "SELECT * FROM `actividad` where id_actividad='$actividad_s'";
     if (!($r_actividad_s= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar actividad";
      echo $cuerpo1;
      //.....................................................................
    }  
	
	$f_actividad_s= mysql_fetch_array ($r_actividad_s);
	$actividad_s=$f_actividad_s['nombre_actividad']; 
	
	 $ssql = "SELECT * FROM `sociedades` where id_sociedad='$sociedad_tipo'";
     if (!($r_sociedad= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar sociedad";
      echo $cuerpo1;
      //.....................................................................
    }  
	
	$f_sociedad= mysql_fetch_array ($r_sociedad);
	$sociedad_tipo=$f_sociedad['nombre']; 
	
	
 $ssql = "SELECT * FROM ganancias where id_ganancia='$ganancia'  order by nombre";
     if (!($r_ganancia= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }      
    $f_ganancia= mysql_fetch_array ($r_ganancia);
	$ganancia=$f_ganancia['nombre']; 	  

  $ssql = "SELECT * FROM ingreso_bruto  where id_ingreso='$ingreso' order by nombre ";
     if (!($r_ingreso= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }  
	
	 $f_ingreso= mysql_fetch_array ($r_ingreso);
	 $ingreso=$f_ingreso['nombre']; 	  
	
	$ssql = "SELECT * FROM regimen where id_regimen='$regimen' order by nombre ";
     if (!($r_regimen= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }   
	
	 $f_regimen= mysql_fetch_array ($r_regimen);
	 $regimen=$f_regimen['nombre']; 	  
	
	/*$ssql = "SELECT * FROM alicuota where id_alicuota='$alicuota'  order by nombre";
     if (!($r_alicuota= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    } 
	 $f_alicuota= mysql_fetch_array ($r_alicuota);
	$alicuota=$f_alicuota['nombre']; 	  
	*/
	
	$ssql = "SELECT * FROM seguridad_social where id_seguridad='$seguridad'  order by nombre ";
     if (!($r_seguridad= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }          
     $f_seguridad= mysql_fetch_array ($r_seguridad);
	 $seguridad=$f_seguridad['nombre']; 	  
     


 ?>   
<form action="index.php?sec=beneficiario/registro_j" method="post">

<input type="hidden" value="<?php echo $cuitl;?>"  name="cuitl" size="2" maxlength="2">
<input type="hidden" value="<?php echo $cuitl_1;?>"  name="cuitl_1" size="2" maxlength="2">
<input type="hidden" value="<?php echo $cuitl_2;?>"  name="cuitl_2" size="2" maxlength="2">
<input type="hidden" value="<?php echo $cuitl_3;?>"  name="cuitl_3" size="2" maxlength="2">


<!--datos identificacion -->
<input type="hidden" value="<?php echo $razon_social;?>"  name="razon_social">

<!--domicilio fiscal -->
<input type="hidden"  value="<?php echo $direccion_calle_f;?>" name="direccion_calle_f" size="30">
<input type="hidden" value="<?php echo  $direccion_nro_f;?>" name="direccion_nro_f" size="5">
<input type="hidden"  value="<?php echo $direccion_piso_f ;?>" name="direccion_piso_f" size="5">
<input type="hidden" value="<?php echo $direccion_dpto_nro_f;?>" name="direccion_dpto_nro_f" />
<input type="hidden" value="<?php echo $direccion_localidad_f ;?>" name="direccion_localidad_f" />
<input type="hidden" value="<?php echo $direccion_provincia_f; ?>" name="direccion_provincia_f" />
<input type="hidden" value="<?php echo $codigo_postal_f; ?>" name="codigo_postal_f" />

<!--domicilio real -->
<input type="hidden"  value="<?php echo $direccion_calle_r;?>" name="direccion_calle_r" size="30">
<input type="hidden" value="<?php echo  $direccion_nro_r;?>" name="direccion_nro_r" size="5">
<input type="hidden"  value="<?php echo $direccion_piso_r ;?>" name="direccion_piso_r" size="5">
<input type="hidden" value="<?php echo $direccion_dpto_nro_r;?>" name="direccion_dpto_nro_r" />
<input type="hidden" value="<?php echo $direccion_localidad_r ;?>" name="direccion_localidad_r" />
<input type="hidden" value="<?php echo $direccion_provincia_r; ?>" name="direccion_provincia_r" />
<input type="hidden" value="<?php echo $codigo_postal_r; ?>" name="codigo_postal_r" />

<!--otros datos -->
<input type="hidden" value="<?php echo $telefono; ?>" name="telefono" />
<input type="hidden" value="<?php echo $email; ?>" name="email"  />

<!--datos banco -->
<input type="hidden" value="<?php echo $banco_nombre; ?>" name="banco_nombre" />
<input type="hidden" value="<?php echo $banco_sucursal; ?>" name="banco_sucursal" />
<input type="hidden" value="<?php echo $banco_cta_tipo;?>" name="banco_cta_tipo" />
<input type="hidden" value="<?php echo $banco_cta_nro; ?>" name="banco_cta_nro"  />
<input type="hidden" value="<?php echo $banco_cbu; ?>" name="banco_cbu"  />

<!--datos economicos -->
<input type="hidden" value="<?php echo $actividad_p; ?>" name="actividad_p" />
<input type="hidden" value="<?php echo $actividad_s; ?>" name="actividad_s" />
<input type="hidden" value="<?php echo $fechai_p; ?>" name="fechai_p" />
<input type="hidden" value="<?php echo $fechai_s; ?>" name="fechai_s" />

<!-- actividad comercial -->
<input type="hidden" value="<?php echo $fechac_s; ?>" name="fechac_s" />
<input type="hidden" value="<?php echo $sociedad_tipo; ?>" name="sociedad_tipo" />
<input type="hidden" value="<?php echo $persona_tipo; ?>" name="persona_tipo" />
<input type="hidden" value="<?php echo $ingreso_bruto; ?>" name="ingreso_bruto"  />
<input type="hidden" value="<?php echo $iva_situacion; ?>" name="iva_situacion" />
<input type="hidden" value="<?php echo $convenio_tipo; ?>" name="convenio_tipo" />
<input type="hidden" value="<?php echo $convenio_nro; ?>" name="convenio_nro" />

<!--componentes de la sociedad -->
<input type="hidden" value="<?php echo $apellido1; ?>" name="apellido1" />
<input type="hidden" value="<?php echo $apellido2; ?>" name="apellido2" />
<input type="hidden" value="<?php echo $apellido3; ?>" name="apellido3" />
<input type="hidden" value="<?php echo $apellido4; ?>" name="apellido4" />

<input type="hidden" value="<?php echo $nombre1; ?>" name="nombre1" />
<input type="hidden" value="<?php echo $nombre2; ?>" name="nombre2" />
<input type="hidden" value="<?php echo $nombre3; ?>" name="nombre3" />
<input type="hidden" value="<?php echo $nombre4; ?>" name="nombre4" />

<input type="hidden" value="<?php echo $dni1; ?>" name="dni1" />
<input type="hidden" value="<?php echo $dni2; ?>" name="dni2" />
<input type="hidden" value="<?php echo $dni3; ?>" name="dni3" />
<input type="hidden" value="<?php echo $dni4; ?>" name="dni4" />

<input type="hidden" value="<?php echo $cargo1; ?>" name="cargo1" />
<input type="hidden" value="<?php echo $cargo2; ?>" name="cargo2" />
<input type="hidden" value="<?php echo $cargo3; ?>" name="cargo3" />
<input type="hidden" value="<?php echo $cargo4; ?>" name="cargo4" />

<!--datos para sistema -->
<input type="hidden" value="<?php echo $fecha_alta_web;?>" name="fecha_alta_web" />
<table border="0" align="center">
  <tr>
    <td colspan="2"><h1> Persona Juridica</h1></td>
  </tr>
  <tr height=10px>
    <td colspan="2"><hr /></td>
  </tr>
  <tr>
    <td class="subtitle">Nro. CUIL | CUIT</td>
    <td><?php echo $cuitl; ?></td>
  </tr>
  <tr height=10px>
    <td colspan="2"><hr /></td>
  </tr>
  <tr bgcolor="#EAEAEA">
    <td colspan="2"><h3>Datos de Identificacion</h3></td>
  </tr>
  <tr height=10px>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td class="subtitle">Denominacion de la Entidad</td>
    <td><?php  echo $razon_social; ?></td>
  </tr>
  <tr height=10px>
    <td colspan="2"></td>
  </tr>
  <tr bgcolor="#EAEAEA">
    <td colspan="2"><h3>Domicilio Fiscal</h3></td>
  </tr>
  <tr height=20px>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td class="subtitle">Calle</td>
    <td><?php echo $direccion_f_calle; ?>
    </td>
  </tr>
  <tr>
    <td class="subtitle">Numero</td>
    <td><?php echo $direccion_f_nro; ?> </td>
  </tr>
  <tr>
    <td class="subtitle">Piso</td>
    <td><?php echo $direccion_f_piso;?></td>
  </tr>
  <tr>
    <td class="subtitle">Departamento Nro.</td>
    <td><?php echo $direccion_f_dpto_nro;?></td>
  </tr>
  <tr>
    <td class="subtitle">Provincia</td>
    <td><?php  echo $direccion_f_provincia; ?> </td>
  </tr>
  <tr>
    <td class="subtitle">Localidad</td>
    <td><?php echo $direccion_f_localidad; ?></td>
  </tr>
  <tr>
    <td class="subtitle">Codigo Postal</td>
    <td><?php echo $codigo_f_postal; ?></td>
  </tr>
  <tr height=10px>
    <td colspan="2"></td>
  </tr>
  <tr bgcolor="#EAEAEA">
    <td colspan="2"><h3>Domicilio Real</h3></td>
  </tr>
  <tr height=20px>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td class="subtitle">Calle</td>
    <td><?php echo $direccion_r_calle; ?> </td>
  </tr>
  <tr>
    <td class="subtitle">Numero</td>
    <td><?php echo $direccion_r_nro;?> </td>
  </tr>
  <tr>
    <td class="subtitle">Piso</td>
    <td><?php echo $direccion_r_piso;?></td>
  </tr>
  <tr>
    <td class="subtitle">Departamento Nro.</td>
    <td><?php echo $direccion_r_dpto_nro;?></td>
  </tr>
  <tr>
    <td class="subtitle">Provincia</td>
    <td><?php echo $direccion_r_provincia; ?>
    </td>
  </tr>
  <tr>
    <td class="subtitle">Localidad</td>
    <td><?php echo $direccion_r_localidad; ?>
    </td>
  </tr>
  <tr>
    <td class="subtitle">Codigo Postal</td>
    <td><?php echo $codigo_r_postal; ?></td>
  </tr>
  <tr height=10px>
    <td colspan="2"></td>
  </tr>
  <tr bgcolor="#EAEAEA">
    <td colspan="2"><h3>Otros Datos</h3></td>
  </tr>
  <tr height=20px>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td class="subtitle">Telefono</td>
    <td><?php echo $telefono; ?></td>
  </tr>
  <tr>
    <td class="subtitle">Direccion E-mail</td>
    <td><?php echo $email; ?>
    </td>
  </tr>
  <tr height=10px>
    <td colspan="2"></td>
  </tr>
  <tr bgcolor="#EAEAEA">
    <td colspan="2"><h3>Datos Economicos</h3></td>
  </tr>
  <tr height=20px>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td class="subtitle">Actividad Principal</td>
    <td><?php  echo $actividad_p; ?>
    </td>
  </tr>
  <tr>
    <td class="subtitle">Fecha Inicio de Actividad 1º </td>
    <td><?php echo $fecha_p; ?>
       
    </td>
  </tr>
  <tr>
    <td class="subtitle">Actividad Secundaria</td>
    <td><?php echo $actividad_s; ?>
    </td>
  </tr>
  <tr>
    <td class="subtitle">Fecha Inicio de Actividad 2º</td>
    <td><?php  echo $fecha_s; ?>
    </td>
  </tr>
  <tr height=10px>
    <td colspan="2"></td>
  </tr>
  <tr bgcolor="#EAEAEA">
    <td colspan="2"><h3>Datos Comerciales</h3></td>
  </tr>
  <tr height=20px>
    <td colspan="2"></td>
  </tr>
  <tr height=20px>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td class="subtitle">Fecha Contrato Social</td>
    <td><?php echo $fechac_s; ?>
    </td>
  </tr>
  <tr>
    <td class="subtitle">Tipo de Sociedad</td>
    <td><?php echo $sociedad_tipo; ?>
    </td>
  </tr>
  <tr>
    <td class="subtitle">Situacion frente I.V.A.</td>
    <td><?php echo $iva_situacion; ?>
    </td>
  </tr>
  <tr>
    <td class="subtitle">Nro. de Ingreso Bruto</td>
    <td><?php echo $ingreso_bruto; ?>
    </td>
  </tr>
  
  
  	<tr>
			<td class="subtitle" colspan="2" >Nro. Inscripcion Ingreso Bruto(Jurisdiccion la Rioja) 			
				<?php echo $ingreso_bruto;
				  
 ?>		 			</td>
		</tr>

        <tr>
			<td class="subtitle" colspan="2" >Nro. Inscripcion Ingreso Bruto (Adm. Central)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  <?php echo $ingreso_bruto_ac;
			 	  
 ?>		 			</td>
		</tr>

		<tr>
			<td class="subtitle">Regimen de Convenio  </td>
			<td>
<?php
                echo $regimen;
?>				  	</td>
		</tr>
		<tr>
			<td class="subtitle">Seguridad Social</td>
			<td>
<?php
             	
                echo $seguridad;
?>				  	</td>
		</tr>
  <tr height=20px>
    <td colspan="2"></td>
  </tr>
  <tr bgcolor="#EAEAEA">
    <td colspan="2"><h3>Componentes de la Sociedad o Autoridades en Ejercicio </h3></td>
  </tr>
  <tr height=20px>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td colspan="2"><table width="365" height="89" border="1">
      <tr>
        <td width="110" height="28" align="center">Apellido</td>
        <td align="center" width="120">Nombre</td>
        <td align="center" width="42">D.N.I</td>
        <td align="center" width="42">Cargo</td>
      </tr>
      <tr>
        <td height="15"><?php echo $apellido1; ?>
        </td>
        <td><?php echo $nombre1; ?>
        </td>
        <td><?php echo $dni1; ?>
        </td>
        <td><?php echo $cargo1; ?>
        </td>
      </tr>
      <tr>
        <td height="15"><?php echo $apellido2; 	    
?>
        </td>
        <td><?php  echo $nombre2;
				
?>
        </td>
        <td><?php echo $dni2; 
				
?>
        </td>
        <td><?php  echo $cargo2;
				
?>
        </td>
      </tr>
      <tr>
        <td height="15"><?php
                    echo $apellido3; 
			?>
        </td>
        <td><?php
                    echo $nombre3; 
			?>
        </td>
        <td><?php
                    echo $dni3; 
			?>
        </td>
        <td><?php
                    echo $cargo3;
					
?>
        </td>
      </tr>
      <tr>
        <td height="15"><?php
                    echo $apellido4; 
				?>
        </td>
        <td><?php
                    echo $nombre4; 
				?>
        </td>
        <td><?php
                    echo $dni4; 
				?>
        </td>
        <td><?php
                    echo $cargo4;
					
?>
        </td>
      </tr>
    </table></td>
  </tr>
  <tr height=10px>
    <td colspan="2"></td>
  </tr>
  <tr bgcolor="#D6DFE3">
    <td colspan="2"><h4>&nbsp;Datos Cuenta Bancaria Asociada</h4></td>
  </tr>
  <tr height=20px>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td class="subtitle">Nombre de Banco</td>
    <td><?php echo $banco_nombre;
?>
    </td>
  </tr>
  <tr>
    <td class="subtitle">Sucursal</td>
    <td><?php echo $banco_sucursal;?></td>
  </tr>
  <tr>
    <td class="subtitle">Tipo de Cuenta</td>
    <td><?php  echo $banco_cta_tipo;		   
?>
    </td>
  </tr>
  <tr>
    <td class="subtitle">Nro. de Cuenta</td>
    <td><?php echo $banco_cta_nro;
			 
?>
    </td>
    <td></td>
  </tr>
  <tr>
    <td class="subtitle">Nro. C.B.U.</td>
    <td><?php echo $cbu; ?></td>
  </tr>
   <tr>
    <td class="subtitle">Inhibiciones</td>
    <td><?php echo $inhi; ?></td>
  </tr>
  <tr height=20px>
    <td colspan="2"><hr /></td>
  </tr>
  
 <tr>
    <td align="center" colspan="2"><a href="indextesoreria.php?sec=sapem/beneficiarios_consulta_aprobado&apli=s&per=C">Regresar</a></td>
  </tr>
  
</table>
</form> 
</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>