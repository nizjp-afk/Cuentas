<?php
error_reporting ( E_ERROR ); 
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    //include('conexion/extras.php');
    
    $id = $_GET['id'];
	$ban = $_GET['ban'];
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
     $sociedad_tipo_n = $f_beneficiario['sociedad_tipo'];
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


$fecha_inicio1 = $f_beneficiario['fecha_inicio1'];    
   $fecha_inicio2 = $f_beneficiario['fecha_inicio2'];    
   $fecha_inicio3 = $f_beneficiario['fecha_inicio3'];    
   $fecha_inicio4 = $f_beneficiario['fecha_inicio4'];    
   
   $duracion1 = $f_beneficiario['duracion1'];    
   $duracion2 = $f_beneficiario['duracion2'];    
   $duracion3 = $f_beneficiario['duracion3'];    
   $duracion4 = $f_beneficiario['duracion4'];   
   $observacion= $f_beneficiario['observacion'];
     $motivo=$f_beneficiario['motivo'];
	 
	 ///datos ute
	
	$cuit1_u = $f_beneficiario['cuit_u1'];
    $cuit2_u = $f_beneficiario['cuit_u2'];
    $cuit3_u = $f_beneficiario['cuit_u3'];
    $cuit4_u = $f_beneficiario['cuit_u4'];
	$cuit5_u = $f_beneficiario['cuit_u5'];
    $cuit6_u = $f_beneficiario['cuit_u6']; 
	
	
	$razon1_u = $f_beneficiario['razon_social_u1'];
    $razon2_u = $f_beneficiario['razon_social_u2'];
    $razon3_u = $f_beneficiario['razon_social_u3'];
    $razon4_u = $f_beneficiario['razon_social_u4'];
	$razon5_u = $f_beneficiario['razon_social_u5'];
    $razon6_u = $f_beneficiario['razon_social_u6']; 
	
	$dom1_u = $f_beneficiario['direccion_u1'];
    $dom2_u = $f_beneficiario['direccion_u2'];
    $dom3_u = $f_beneficiario['direccion_u3'];
    $dom4_u = $f_beneficiario['direccion_u4'];
	$dom5_u = $f_beneficiario['direccion_u5'];
    $dom6_u = $f_beneficiario['direccion_u6'];
	
	$por1_u = $f_beneficiario['por_u1'];
    $por2_u = $f_beneficiario['por_u2'];
    $por3_u = $f_beneficiario['por_u3'];
    $por4_u = $f_beneficiario['por_u4'];
	$por5_u = $f_beneficiario['por_u5'];
    $por6_u = $f_beneficiario['por_u6'];
  	

  	

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
<div class="content">
<table border="0" align="center">
  <tr>
    <td colspan="2"><h1> Persona Juridica</h1></td>
  </tr>
  <tr height=10px>
    <td colspan="2"><hr /></td>
  </tr>
  <tr>
    <td width="365" class="subtitle">Nro. CUIL | CUIT</td>
    <td width="375"><?php echo $cuitl; ?></td>
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
      <?php
  if($sociedad_tipo_n == '16')
    {
?>
<tr bgcolor="#EAEAEA">
			<td colspan="2"><h4>&nbsp;Empresas que Integran la U.T.E </h4></td>
		</tr>
		<tr height="2px">
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
		    <td colspan="2">
			    <table>
				     <tr bgcolor="#EAEAEA">
					    <td><span class="Estilo6">1-</span></td>
						<td width="21">&nbsp;  </td>
						<td><span class="Estilo6">2-</span></td>
                        <td width="21">&nbsp;  </td>
						<td><span class="Estilo6">3-</span></td>  
						
					</tr>
       <tr>	
					    <td width="353" height="28" >CUIT:<?php echo $cuit1_u; ?> 
		 	</td>
					 <td>&nbsp;  </td>
					 <td width="354" >CUIT:<?php echo $cuit2_u; ?>	
				  </td>
                   <td>&nbsp;  </td>
                   <td width="354" >CUIT:
				   <?php echo $cuit3_u; ?>	
					   		</td>		  </tr>
					 <tr>
					 <td width="353" height="28" >Razon Social:
					  <?php echo $razon1_u; ?> 	  </td>
					 <td>&nbsp;  </td>
					 <td width="353" height="28" >Razon Social:
					  <?php echo $razon2_u; ?>  	 </td>
                      <td>&nbsp;  </td>
					 <td width="353" height="28" >Razon Social:
					<?php echo $razon3_u; ?>  </td>
					 </tr>
					 <tr>
					    <td width="353" height="28" >Domicilio:  &nbsp;&nbsp;&nbsp;&nbsp;
				       <?php echo $dom1_u; ?>  	</td>
					   <td>&nbsp;  </td>
						 <td width="353" height="28" >Domicilio:  &nbsp;&nbsp;&nbsp;&nbsp;
				       <?php echo $dom2_u; ?> </td>
					   <td>&nbsp;  </td>
                        <td width="353" height="28" >Domicilio:  &nbsp;&nbsp;&nbsp;&nbsp;
				      <?php echo $dom3_u; ?>  </td>
					   </tr>
				<tr>
				 <td width="353" height="28" >Porcentaje:	 &nbsp;&nbsp;&nbsp;
				  <?php echo $por1_u; ?></td>
				 <td>&nbsp;  </td>
				  <td width="353" height="28" >Porcentaje:	 &nbsp;&nbsp;&nbsp;
				  <?php echo $por2_u; ?></td>
				 <td>&nbsp;  </td>
				  <td width="353" height="28" >Porcentaje:	 &nbsp;&nbsp;&nbsp;
				 <?php if($por3_u > 0) {echo $por3_u;} ?> </td>
				
                  </tr>
				
                               
				
                        
 
                        
                       </td>
				  </tr> 
                    <tr bgcolor="#EAEAEA">
					    <td><span class="Estilo6">4-</span></td>
						<td width="21">&nbsp;  </td>
						<td><span class="Estilo6">5-</span></td>
                        <td width="21">&nbsp;  </td>
						<td><span class="Estilo6">6-</span></td>  
						
					</tr>
       <tr>	
					    <td width="353" height="28" >CUIT:
					  <?php echo $cuit4_u; ?>  </td>
					 <td>&nbsp;  </td>
					 <td width="354" >CUIT:
				   <?php echo $cuit5_u; ?> 	</td>
                   <td>&nbsp;  </td>
                   <td width="354" >CUIT:
				  <?php echo $cuit6_u; ?> 		</td>		  </tr>
					 <tr>
					 <td width="353" height="28" >Razon Social:
					<?php echo $razon4_u; ?>  </td>
					 <td>&nbsp;  </td>
					 <td width="353" height="28" >Razon Social:
					 <?php echo $razon5_u; ?></td>
                      <td>&nbsp;  </td>
					 <td width="353" height="28" >Razon Social:
					  <?php echo $razon6_u; ?>  </td>
					 </tr>
					 <tr>
					    <td width="353" height="28" >Domicilio:  &nbsp;&nbsp;&nbsp;&nbsp;
				      <?php echo $dom4_u; ?> </td>
					   <td>&nbsp;  </td>
						 <td width="353" height="28" >Domicilio:  &nbsp;&nbsp;&nbsp;&nbsp;
				      <?php echo $dom5_u; ?> </td>
					   <td>&nbsp;  </td>
                        <td width="353" height="28" >Domicilio:  &nbsp;&nbsp;&nbsp;&nbsp;
				      <?php echo $dom6_u; ?> </td>
					   </tr>
				<tr>
				 <td width="353" height="28" >Porcentaje:	 &nbsp;&nbsp;&nbsp;
				 <?php if($por4_u > 0) {echo $por4_u;} ?> </td>
				 <td>&nbsp;  </td>
				  <td width="353" height="28" >Porcentaje:	 &nbsp;&nbsp;&nbsp;
				 <?php if($por5_u > 0) { echo $por5_u;} ?> </td>
				 <td>&nbsp;  </td>
				  <td width="353" height="28" >Porcentaje:	 &nbsp;&nbsp;&nbsp;
				 <?php if($por6_u > 0) { echo $por6_u; } ?> </td>
				
                  </tr>
				
                               
				
                        
 
                        
                       </td>
				  </tr> 
                </table>  
       
       </td>



	
 </tr>
 <?php  

	}
?>
       <tr bgcolor="#EAEAEA">
			<td colspan="2"><h4>&nbsp;</h4></td>
		</tr>
       </tr>
    
  <tr>
    <td class="subtitle">Situacion frente I.V.A.</td>
    <td><?php echo $iva_situacion; ?>
    </td>
  </tr>
<tr>
    <td class="subtitle">Ganancia</td>
    <td><?php echo $ganancia; ?>
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
    <td colspan="2"><table>
      <tr bgcolor="#EAEAEA">
        <td><span class="Estilo6">1-</span></td>
        <td width="21">&nbsp;</td>
        <td><span class="Estilo6">2-</span></td>
      </tr>
      <tr>
        <td width="353" height="28" >Apellido:
          <?php
                    echo $apellido1; ?>
        </td>
        <td>&nbsp;</td>
        <td width="354" >Apellido:
          <?php
                    echo $apellido2; 
					   
?>
        </td>
      </tr>
      <tr>
        <td width="353" height="28" >Nombre:
          <?php
                    echo $nombre1; 
				    ?>
        </td>
        <td>&nbsp;</td>
        <td width="354" >Nombre:
          <?php
                    echo $nombre2;
				
?>
        </td>
      </tr>
      <tr>
        <td width="353" height="28" >D.N.I:
          <?php
                    echo $dni1; 
						?>
        </td>
        <td>&nbsp;</td>
        <td width="354" >D.N.I:
          <?php
                    echo $dni2; 
					
?>
        </td>
      </tr>
      <tr>
        <td width="353" height="28" >Cargo:
          <?php
                    echo $cargo1; 
				    
?>
        </td>
        <td>&nbsp;</td>
        <td width="354" >Cargo:
          <?php
                    echo $cargo2;
				
?>
        </td>
      </tr>
      <tr>
        <td width="353" height="28" >Fecha Inicio:
          <?php
                    echo $fecha_inicio1; 
			
?>
        </td>
        <td>&nbsp;</td>
        <td width="354" >Fecha Inicio:
          <?php
                    echo $fecha_inicio2;
			?>
        </td>
      </tr>
      <tr>
        <td width="353" height="28" >Duracion:
          <?php
                    echo $duracion1; 
				
?>
        </td>
        <td>&nbsp;</td>
        <td width="354" >Duracion:
          <?php
                    echo $duracion2;
						
?>
        </td>
      </tr>
      <tr>
        <td colspan="3"></td>
      </tr>
      <tr bgcolor="#EAEAEA">
        <td><span class="Estilo6">3-</span></td>
        <td>&nbsp;</td>
        <td><span class="Estilo6">4-</span></td>
      </tr>
      <tr>
        <td width="353" height="28">Apellido:
          <?php
                    echo $apellido3; 
						
?>
        </td>
        <td>&nbsp;</td>
        <td width="354" >Apellido:
          <?php
                    echo $apellido4; 
					
?>
        </td>
      </tr>
      <tr>
        <td width="353" height="28">Nombre:
          <?php
                    echo $nombre3; 
						
?>
        </td>
        <td>&nbsp;</td>
        <td width="354" >Nombre:
          <?php
                    echo $nombre4; 
						
?>
        </td>
      </tr>
      <tr>
        <td width="353" height="28">D.N.I:
          <?php
                    echo $dni3; 
						
?>
        </td>
        <td>&nbsp;</td>
        <td width="354" >D.N.I:
          <?php
                    echo $dni4; 
						
?>
        </td>
      </tr>
      <tr>
        <td width="353" height="28">Cargo:
          <?php
                    echo $cargo3;
				
?>
        </td>
        <td>&nbsp;</td>
        <td width="354" >Cargo:
          <?php
                    echo $cargo4;
				
?>
        </td>
      </tr>
      <tr>
        <td width="353" height="28" >Fecha Inicio:
          <?php
                    echo $fecha_inicio3; 
			?>
        </td>
        <td>&nbsp;</td>
        <td width="354" >Fecha Inicio:
          <?php
                    echo $fecha_inicio4;
				
?>
        </td>
      </tr>
      <tr>
        <td width="353" height="28" >Duracion:
          <?php
                    echo $duracion3; 
			?>
        </td>
        <td>&nbsp;</td>
        <td width="354" >Duracion:
          <?php
                    echo $duracion4;
				
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
    <td width="6"></td>
  </tr>
  <tr>
    <td class="subtitle">Nro. C.B.U.</td>
    <td><?php echo $cbu; ?></td>
  </tr>
   <tr height=20px>
    <td colspan="2"><hr /></td>
  </tr>
   <tr>
    <td class="subtitle">Inhibiciones</td>
    <td><?php echo $inhi; ?></td>
  </tr>
   <tr>
		  <td>Motivo
		  <td><?php echo $motivo; ?></td>
		</tr>
		<tr height=20px>
			<td colspan="2"><hr></td>
		</tr>
  <tr>
  <tr>
		  <td>Observacion
		  <td><?php echo $observacion; ?></td>
  </tr>
  <tr height=20px>
    <td colspan="2"><hr /></td>
  </tr>
  
 <tr>
    <td align="center" colspan="2">
  
   <?php 
 if (($nrosaf=='D') or ($nrosaf=='SC'))
 {
?>	 
 <td align="center" colspan="2"><a href="indextesoreria.php?sec=hacienda/index_des1&apli=bene&per=C">Regresar</a></td>
 <?php
 }
else if ($nrosaf=='F')
{
?>	 
 <td align="center" colspan="2"><a href="indextesoreria.php?sec=hacienda/index_fed&apli=bene&per=C">Regresar</a></td>
 <?php
 }
  
else if($ban=='f')
{
	?>  
    
  	
	<a href="indextesoreria.php?sec=tesoreria/beneficiarios_consulta_fin&apli=tgp&per=C">Regresar</a>
<?php
   }
 else
   {
?> 
   <a href="indextesoreria.php?sec=tesoreria/beneficiarios_consulta_aprobado&apli=tgp&per=C">Regresar</a>
       	
	
	</td>
  <?php 
   }
?>  
  </tr>
  
</table>
</form> 
</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>