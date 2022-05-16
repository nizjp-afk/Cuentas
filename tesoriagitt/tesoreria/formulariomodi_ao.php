<?php
error_reporting ( E_ERROR ); 
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    //include('conexion/extras.php');
  $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];
  include('incluir_siempre.php');
  $ssql = "SELECT apellido,nombre,id_personas FROM usuarios, personas, permisos
WHERE docnro = personas_docnro
AND userid = usuarios_userid
AND aplicaciones_cod = 'tgpc'";
     if (!($r_usuario= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo documento";
      echo $cuerpo1;
      //.....................................................................
    }
	
    $id = $_GET['id'];
	$id_saf=$_GET['id_saf'];
    $ssql = "SELECT * FROM `beneficiarios` WHERE id_beneficiario='$id'";
     if (!($r_beneficiario= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }    
	   
	 $ssql = "SELECT * FROM `saf` WHERE id_saf='$id_saf'";
     if (!($r_saf= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }    
	 $f_beneficiario= mysql_fetch_array ($r_beneficiario);
	 $f_saf= mysql_fetch_array ($r_saf);
	
  $cuitl = $f_beneficiario['cuitl'];
  $ape = $f_beneficiario['apellido'];  
  $nom = $f_beneficiario['nombre'];  
  $documento_tipo =$f_beneficiario['documento_tipo'];
  $documento_nro =$f_beneficiario['documento_nro'];
  $fecha_nacimiento=$f_beneficiario['fecha_nacimiento'];
  $fecha=split("-",$fecha_nacimiento);
  $fecha_nacimiento=$fecha[2].'-'.$fecha[1].'-'.$fecha[0]; 
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
  $observacion=$f_beneficiario['observacion'];
  $banco_nombre=$f_beneficiario['banco_nombre'];
  $banco_sucursal=$f_beneficiario['banco_sucursal'];
  $banco_cta_tipo=$f_beneficiario['banco_cta_tipo'];
  $banco_cta_nro=$f_beneficiario['banco_cta_nro'];
  $cbu=$f_beneficiario['cbu'];
   $banco_denominacion=$f_beneficiario['banco_denominacion'];
  $cargo=$f_beneficiario['cargo'];
  $saf=$f_beneficiario['saf'];
  $area=$f_beneficiario['area'];
  $fecha_c=$f_beneficiario['fecha_gestion'];
  $dato=split("-",$fecha_c);
  $fechac=$dato[2].'-'.$dato[1].'-'.$dato[0];
  $t_c= $f_beneficiario['cuit_tipo'];
  
  	$ssql = "SELECT * FROM tipo_documento WHERE  id_tipo='$documento_tipo'";
     if (!($r_documento= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo documento";
      echo $cuerpo1;
      //.....................................................................
    }   
// tipo de documento
    $f_documento= mysql_fetch_array ($r_documento);
	$documento_tipo=$f_documento['descripcion']; 
	
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
	$actividad_p_n=$f_actividad_p['nombre_actividad']; 
	
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
	$actividad_s_n=$f_actividad_s['nombre_actividad']; 
	
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

 ?>   
<form action="indextesoreria.php?sec=tesoreria/aprobado" method="post">

<table border="0" align="center">
  <tr>
    <td colspan="2"><h1> Otras Personas </h1></td>
  </tr>
  <tr height=10px>
    <td colspan="2"><hr /></td>
  </tr>
  <tr>
    <td class="subtitle">Nro. CUIL | CUIT</td>
    <td><?php echo $cuitl; ?></td>
  </tr>
  <tr>
			<td class="subtitle">Tipo Cuit</td>
			<td>
<?php 
                  if($t_c=='1') {echo 'CUIT';}
				  if($t_c=='2') {echo 'CUIL';}
				  if($t_c=='N') {echo '--';}
				  ?>
                  </td>
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
    <tr>
			<td class="subtitle">Apellido</td>
			<td><?php echo $ape; 
				   ?>	
		    </td>
		</tr>
		<tr>
			<td class="subtitle">Nombres</td>
			<td><?php echo $nom;  
				   		 
?>             </td>
		</tr>
		<tr>
			<td class="subtitle">Tipo de Documento</td>
			<td><?php echo $documento_tipo; 
?>     	     </td>
		</tr>
		<tr>
			<td class="subtitle">Nro. de Documento</td>
			<td><?php echo $documento_nro; 
			     
?>          </td>
		</tr>
		<tr>
			<td class="subtitle">Fecha de Nacimiento</td>
			<td><?php echo $fecha_nacimiento;
			 
?>			</td>
		
  </tr>
  <tr>
		<td class="subtitle">Area de Gobierno</td>
		<td><?php echo $area; ?></td>
	</tr>
	<tr>
		<td class="subtitle">Cargo</td>
		<td><?php echo $cargo; ?></td>
	</tr>
		
	<tr>
			<td class="subtitle">Fecha Inicio de Gestion</td>
			<td><?php echo $fechac; ?></td>
		</tr>
		<tr>
		<td class="subtitle">SAF Nº</td>
		<td><?php echo $saf; ?></td>
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
  
  <tr height=20px>
    <td colspan="2"></td>
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
    <td class="subtitle">Denominacion de Cuenta</td>
    <td><?php echo $banco_denominacion; ?></td>
  </tr>
 <tr height=20px>
			<td colspan="2"><hr></td>
	</tr>
  <tr>
		  <td>Observacion
		  <td><?php echo $observacion; ?></td>
		</tr>
  <tr height=20px>
    <td colspan="2"><hr /></td>
  </tr>
   		
  <tr height=20px>
    <td colspan="2"><hr /></td>
  </tr>
  <tr>
    <td align="center" colspan="2" >       
<a href="indextesoreria.php?sec=tesoreria/modificar_o&apli=tgp&per=O&id=<?php echo $id;?>&tipo= <?php echo $tipo; ?>">Modificar</a></td>
	
  </tr>
  
  
</table>
</form> 
</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>