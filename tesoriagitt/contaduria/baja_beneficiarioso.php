<?php
error_reporting ( E_ERROR ); 
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    //include('conexion/extras.php');
    
	$aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
     include('incluir_siempre.php');

    $id = $_GET['id'];
	$estado = $_GET['estado'];
    $ssql = "SELECT * FROM `beneficiarios_aprobados` WHERE id_beneficiario='$id'";
     if (!($r_beneficiario= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar beneficiarios";
      echo $cuerpo1;
      //.....................................................................
    }    
	 $f_beneficiario= mysql_fetch_array ($r_beneficiario);

  $cuitl = $f_beneficiario['cuitl'];
  $ape = $f_beneficiario['apellido'];  
  $nom = $f_beneficiario['nombre'];  
  $razon_social = $f_beneficiario['razon_social'];  
  $direccion_f_calle=$f_beneficiario['direccion_f_calle'];
  $direccion_f_nro=$f_beneficiario['direccion_f_nro'];
  $direccion_f_piso=$f_beneficiario['direccion_f_piso'];
  $direccion_f_dpto_nro=$f_beneficiario['direccion_f_dpto_nro'];
  $direccion_localidad_f=$f_beneficiario['direccion_f_localidad'];
  $direccion_provincia_f=$f_beneficiario['direccion_f_provincia'];
  $codigo_postal_f=$f_beneficiario['codigo_f_postal'];
  $direccion_calle_r=$f_beneficiario['direccion_r_calle'];
  $direccion_r_nro=$f_beneficiario['direccion_r_nro'];
  $direccion_piso_r=$f_beneficiario['direccion_r_piso'];
  $direccion_dpto_nro_r=$f_beneficiario['direccion_r_dpto_nro'];
  $direccion_provincia_r=$f_beneficiario['direccion_r_provincia'];
  $direccion_localidad_r=$f_beneficiario['direccion_r_localidad'];
  $codigo_postal_r=$f_beneficiario['codigo_r_postal']; 
  $telefono=$f_beneficiario['telefono'];
  $telefono =split("-",$telefono);
  $email=$f_beneficiario['email'];
  //datos banco
  $banco_nombre=$f_beneficiario['banco_nombre'];
  $banco_sucursal=$f_beneficiario['banco_sucursal'];
  $banco_cta_tipo=$f_beneficiario['banco_cta_tipo'];
  $banco_cta_nro=$f_beneficiario['banco_cta_nro'];
  $banco_cbu=$f_beneficiario['cbu'];
  //datos comerciales
  $ingreso_bruto=$f_beneficiario['ingreso_bruto'];
   $ingreso_bruto= str_replace('-', '', $ingreso_bruto);
	$ingreso_bruto1 = substr($ingreso_bruto,0,3);
	$ingreso_bruto2 = substr($ingreso_bruto,3,6);
	$ingreso_bruto3 = substr($ingreso_bruto,9,1);
  
  $iva_situacion=$f_beneficiario['iva_situacion'];
  $fechac_s = $f_beneficiario['fecha_contrato'];
  $sociedad_tipo = $f_beneficiario['sociedad_tipo'];
  $ingreso_bruto = $f_beneficiario['ingreso_bruto'];
  $iva_situacion = $f_beneficiario['iva_situacion'];
  $convenio_tipo = $f_beneficiario['convenio_tipo'];
  $convenio_nro = $f_beneficiario['convenio_nro'];
  $fechacs=split("-",$fechac_s);
  //datos economicos
  $actividad_p=$f_beneficiario['actividad_p'];
  $fecha_p=$f_beneficiario['fecha_p'];
  $actividad_s=$f_beneficiario['actividad_s'];
  $fecha_s=$f_beneficiario['fecha_s'];
  $fechaip=split("-",$fecha_p);
  $fechais=split("-",$fecha_s);
  
   //componente sociedad
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
    
	
    $cuitl= str_replace('-', '', $cuitl);
	$cuitl_1 = substr($cuitl,0,2);
	$cuitl_2 = substr($cuitl,2,8);
	$cuitl_3 = substr($cuitl,10,2);
	
  ///datos otra persona
  
  $cargo=$f_beneficiario['cargo'];
  $saf=$f_beneficiario['saf'];
  $area=$f_beneficiario['area'];
  $ministerial=$f_beneficiario['ministerial'];
  $fecha_c=$f_beneficiario['fecha_gestion'];



//consulta a las bases
	 $ssql = "SELECT * FROM `provincias`  ";
     if (!($r_provincia= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }    
	
	$ssql = "SELECT * FROM `localidades` order by cod_prov,descripcion ";
     if (!($r_departamento= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }  

	 $ssql = "SELECT * FROM `actividad`  ";
     if (!($r_actividad= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar actividad";
      echo $cuerpo1;
      //.....................................................................
    }    

	
	// Consulta tipo de documento
	$ssql = "SELECT * FROM tipo_documento ";
     if (!($r_documento= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo documento";
      echo $cuerpo1;
      //.....................................................................
    }        

   $ssql = "SELECT * FROM bancos ";
     if (!($r_banco= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar banco";
      echo $cuerpo1;
      //.....................................................................
    }        
	
	$ssql = "SELECT * FROM bancos_cuentas ";
     if (!($r_bcocta= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de cuenta";
      echo $cuerpo1;
      //.....................................................................
    }        


    $ssql = "SELECT * FROM sociedades ";
     if (!($r_sociedad= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar sociedad";
      echo $cuerpo1;
      //.....................................................................
    }        


     $ssql = "SELECT * FROM iva ";
     if (!($r_iva= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de cuenta";
      echo $cuerpo1;
      //.....................................................................
    }        
   
?>

<div class="content">
	<table border="0" align="center">
		<tr>
			<td colspan="2"><h1>Baja Otras Personas</h1></td>
		</tr>
		
		<tr height=10px>
			<td colspan="2"><hr></td>
		</tr>
		

<form action="indextesoreria.php?sec=contaduria/baja_beneficiarios1&apli=&per=A" method="post">

  <tr>
    <td width="229" class="subtitle">Nro. CUIL | CUIT</td>
    <td width="278"><input type="text" disabled name="cuitl_1" size="2" maxlength="2" value="<?php echo $cuitl_1; ?> "> - 
    	<input type="text" disabled name="cuitl_2" size="8" maxlength="8" value="<?php echo $cuitl_2; ?> "> - 
		<input type="text" disabled name="cuitl_3" size="1" maxlength="1"  value="<?php echo $cuitl_3; ?> ">
		<input type="hidden" name="cuitl_1" value="<?php echo $cuitl_1; ?>"> 
    	<input type="hidden" name="cuitl_2" value="<?php echo $cuitl_2; ?>" >
		<input type="hidden" name="cuitl_3" value="<?php echo $cuitl_3; ?>" >		
		<input type="hidden" name="id_bene" value="<?php echo $id; ?>" > 
		<input type="hidden" name="apli" value="<?php echo $aplicacion; ?>" > 
		<input type="hidden" name="per" value="<?php echo $permisosnecesarios; ?>" >
		<input type="hidden" name="razon_social" value="<?php echo $razon_social; ?>">
		<input type="hidden" name="tipo" value="j"> 
        <input type="hidden" name="estado" value="<?php echo $estado; ?>" > 
		</td>
  </tr>
    <tr height=10px>
			<td colspan="2"><hr></td>
		</tr>
		<tr bgcolor="#EAEAEA">
		
			<td colspan="2"><h4>&nbsp;Datos de Identificacion</h4></td>
		</tr>
		<tr height="2px">
			<td colspan="2">&nbsp;</td>
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
		</tr>
		<tr>
			<td class="subtitle">Resolucion Ministerial</td>
			<td><?php echo $ministerial; 
?>     	     </td>
		</tr>
		<tr height="2px">
			<td colspan="2">&nbsp;</td>
		</tr>
		
		<tr height="2px">
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr bgcolor="#D6DFE3">
			<td colspan="2"><h4>&nbsp;Datos </h4></td>
		</tr>
		<tr height="2px">
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td class="subtitle">N&ordm; de Nota</td>
			<td><input type="text" name="nro" size="15" maxlength="15" value="" /></td>
		</tr>
		<tr>
			<td class="subtitle">&nbsp;</td>
			<td>&nbsp;</td>
		</tr>

		<tr height="2px">
			<td colspan="2">&nbsp;</td>
		</tr>
		
		<tr height=20px>
			<td colspan="2"><hr></td>
		</tr>
		<tr>
		  <td colspan="2" align="center">
		  <a href="indextesoreria.php?sec=tesoreria/beneficiarios_aprobado_modi&apli=tgpa&per=A"><img src="img/cancelar.jpg" width="60" height="20" border="0"/></a>
			<input type="submit" value="Enviar Datos"></td>
		</tr>
	  
</form>
</table>
 </div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>


