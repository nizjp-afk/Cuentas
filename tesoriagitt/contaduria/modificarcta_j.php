<?php
error_reporting ( E_ERROR ); 
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    //include('conexion/extras.php');
    
	$aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
     include('incluir_siempre.php');
	 
	  if (isset($_POST['modi']))
    {
 
  //cuitl
  
   $cuitl_1=$_POST['cuitl_1'];
   $cuitl_2=$_POST['cuitl_2'];
   $cuitl_3=$_POST['cuitl_3'];
   $razon_social=$_POST['razon_social'];
   //direccion fisica
  
   $direccion_f_calle = $_POST['direccion_calle_f'];
   $direccion_f_nro = $_POST['direccion_nro_f'];
   $direccion_f_piso = $_POST['direccion_piso_f'];
   $direccion_f_dpto_nro = $_POST['direccion_dpto_nro_f'];
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
  
   $telefono =split("-",$_POST['telefono']);
   $email = $_POST['email'];
  
  //banco
  
   $banco_nombre = $_POST['banco_nombre'];
   $banco_sucursal = $_POST['banco_sucursal'];
   $banco_cta_tipo = $_POST['banco_cta_tipo'];
   $banco_cta_nro = $_POST['banco_cta_nro'];
   $banco_cbu = $_POST['banco_cbu'];
  
   //datos economicos 
  
   $actividad_p=$_POST['actividad_p'];
   $actividad_s=$_POST['actividad_s'];
   $fechai_p=$_POST['fechai_p'];
   $fechai_s=$_POST['fechai_s'];
   $fechaip=split("-",$fechai_p);
   $fechais=split("-",$fechai_s);
  /* echo $fechais[0];
   echo $fechais[1];
   echo $fechais[2];*/
 //datos comercial
 
   $fechac_s = $_POST['fechac_s'];
   $fechacs=split("-",$fechac_s);
   $sociedad_tipo = $_POST['sociedad_tipo'];
   $ingreso_bruto = $_POST['ingreso_bruto'];
   $iva_situacion = $_POST['iva_situacion'];
   $convenio_tipo = $_POST['convenio_tipo'];
   $convenio_nro = $_POST['convenio_nro'];
  
    $ingreso_bruto1=substr($ingreso_bruto,0,-7);
    $ingreso_bruto2=substr($ingreso_bruto,3,-1);
    $ingreso_bruto3=substr($ingreso_bruto,-1);
   
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
  }
  else
   {
    $id = $_GET['id'];
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
	
  

}

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
			<td colspan="2"><h1>Modificacion Persona Juridica</h1></td>
		</tr>
		
		<tr height=10px>
			<td colspan="2"><hr></td>
		</tr>
		

<form action="indextesoreria.php?sec=contaduria/validardatoscta&apli=tgpa&per=M" method="post">

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
			<td class="subtitle">Denominacion de la Entidad</td>
			<td><input type="text" disabled name="razon_social" size="30" value="<?php echo $razon_social; ?>"></td>
		</tr>
		<tr height="2px">
			<td colspan="2">&nbsp;</td>
		</tr>
		
		<tr height="2px">
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr bgcolor="#D6DFE3">
			<td colspan="2"><h4>&nbsp;Datos Cuenta Bancaria Asociada</h4></td>
		</tr>
		<tr height="2px">
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td class="subtitle">Nombre de Banco</td>
			<td><select  name="banco_nombre" >
                <option value="N" selected >Sin Especificar</option>
<?php     
       
                    while ($f_banco = mysql_fetch_array ($r_banco))
                           {
?>
                    <option value="<?php echo $f_banco['id_banco'] ?>"
<?php
                            if($f_banco['id_banco']==$banco_nombre)
							   {
							    echo 'selected';
							   }
							echo '>'.$f_banco['nombre'];
							}
?>
 					</option>
           </select>
				  
				  			</td>
		</tr>
		<tr>
			<td class="subtitle">Sucursal</td>
			<td><input type="text" name="banco_sucursal" size="30" value="<?php echo $banco_sucursal; ?>"></td>
		</tr>
		<tr>
			<td class="subtitle">Tipo de Cuenta</td>
			<td><select name="banco_cta_tipo">
                              <option value="N" selected >Sin Especificar</option>
<?php     
       
                    while ($f_bcocta = mysql_fetch_array ($r_bcocta))
                           {
?>
                    <option value="<?php echo $f_bcocta['id_ban_cta'] ?>" 
<?php
                            if($f_bcocta['id_ban_cta']==$banco_cta_tipo)
							    {
								 echo 'selected';
								}
							echo '>'.$f_bcocta['nombre'];
							}
?>
					</option>
				  </select>		      </td>
		</tr>
		<tr>
			<td class="subtitle">Nro. de Cuenta</td>
			<td><input type="text" name="banco_cta_nro" size="15" maxlength="15" value="<?php echo $banco_cta_nro; ?>"></td>
		</tr>
		<tr>
			<td class="subtitle">Nro. C.B.U.</td>
			<td><input type="text" name="banco_cbu" size="22" maxlength="22" value="<?php echo $banco_cbu; ?>"></td>
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


