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
 
    $id=$_POST['id_bene'];
  
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
   
    $ingreso_bruto_ac = $_POST['ingreso_bruto_ac'];
   
//   $ingresobruto=split("-",$ingreso_bruto);
  
    $ingreso_bruto_ac1=substr($ingreso_bruto_ac,0,-7);
    $ingreso_bruto_ac2=substr($ingreso_bruto_ac,3,-1);
    $ingreso_bruto_ac3=substr($ingreso_bruto_ac,-1);
	
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
   
  $fecha_inicio1=split("-",$fecha_inicio1);
  $fecha_inicio2=split("-",$fecha_inicio2);
  $fecha_inicio3=split("-",$fecha_inicio3);
  $fecha_inicio4=split("-",$fecha_inicio4);
  
  $duracion1 = $_POST['duracion1'];
  $duracion2 = $_POST['duracion2'];
  $duracion3 = $_POST['duracion3'];
  $duracion4 = $_POST['duracion4'];
  
  $fecha_fin1=split("-",$duracion1);
  $fecha_fin2=split("-",$duracion2);
  $fecha_fin3=split("-",$duracion3);
  $fecha_fin4=split("-",$duracion4);
  
  
  //dato _ute
  
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
	
   
   
  }
  else
   {
    $id = $_GET['id'];
    $ssql = "SELECT * FROM `beneficiarios` WHERE id_beneficiario='$id'";
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
     $ganancia = $f_beneficiario['ganancia'];
  //$alicuota = $f_beneficiario['alicuota'];
  $ingreso = $f_beneficiario['ingreso'];
  $regimen = $f_beneficiario['regimen'];
  $seguridad = $f_beneficiario['seguridad'];
  $ingreso_bruto_ac=$f_beneficiario['ingreso_bruto_ac'];
  $ingreso_bruto_ac1 = substr($ingreso_bruto_ac,0,3);
	$ingreso_bruto_ac2 = substr($ingreso_bruto_ac,3,6);
	$ingreso_bruto_ac3 = substr($ingreso_bruto_ac,9,1);
  
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
   
 
   $fecha_inicio1 = $f_beneficiario['fecha_inicio1'];    
   $fecha_inicio2 = $f_beneficiario['fecha_inicio2'];    
   $fecha_inicio3 = $f_beneficiario['fecha_inicio3'];    
   $fecha_inicio4 = $f_beneficiario['fecha_inicio4'];    
   
   $fecha_inicio1=split("-",$fecha_inicio1);
   $fecha_inicio2=split("-",$fecha_inicio2);
   $fecha_inicio3=split("-",$fecha_inicio3);
   $fecha_inicio4=split("-",$fecha_inicio4);
   
   $duracion1 = $f_beneficiario['duracion1'];    
   $duracion2 = $f_beneficiario['duracion2'];    
   $duracion3 = $f_beneficiario['duracion3'];    
   $duracion4 = $f_beneficiario['duracion4'];   
   
   $fecha_fin1=split("-",$duracion1);
   $fecha_fin2=split("-",$duracion2);
   $fecha_fin3=split("-",$duracion3);
   $fecha_fin4=split("-",$duracion4);
    
	
    $cuitl= str_replace('-', '', $cuitl);
	$cuitl_1 = substr($cuitl,0,2);
	$cuitl_2 = substr($cuitl,2,8);
	$cuitl_3 = substr($cuitl,10,2);
	
  $observacion= $f_beneficiario['observacion'];
  
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
   
    $ssql = "SELECT * FROM ganancias  order by nombre";
     if (!($r_ganancia= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }        

  $ssql = "SELECT * FROM ingreso_bruto  order by nombre ";
     if (!($r_ingreso= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }  
	
	$ssql = "SELECT * FROM regimen order by nombre ";
     if (!($r_regimen= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }   
	
	$ssql = "SELECT * FROM alicuota  order by nombre";
     if (!($r_alicuota= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    } 
	
	$ssql = "SELECT * FROM seguridad_social  order by nombre ";
     if (!($r_seguridad= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }          

?>

<script language='javascript' type='text/javascript'>

function slctr(texto,valor)
{
    this.texto = texto
    this.valor = valor
 }
</script>
<script language='javascript' type='text/javascript'>


function toggle_listar(elemento) {

  if(elemento.value=="16") {
      document.getElementById("div_ute").style.display = "block";
	   document.getElementById("div_ute1").style.display = "block";
	    document.getElementById("div_ute2").style.display = "block";
   } else {
     document.getElementById("div_ute").style.display = "none";
	      document.getElementById("div_ute1").style.display = "none";
		     document.getElementById("div_ute2").style.display = "none";
   }

}


</script>


<?php
        // Generando localidades deacuerdo a la provincia seleccionada  
 $f_departamento=mysql_fetch_array($r_departamento);
	echo "<script language='javascript' type='text/javascript'>".chr(13).chr(10);
	$varaux= $f_departamento['cod_prov'];
	$cont=0;
	echo "var ".$f_departamento['cod_prov']."=new Array()".chr(13).chr(10);
	echo $f_departamento['cod_prov']."[$cont] = new slctr('Seleccione Localidad','d00')".chr(13).chr(10);
	$cont++;
	echo $f_departamento['cod_prov']."[$cont] = new slctr('".trim($f_departamento['descripcion'])."','".$f_departamento['id_localidades']."')";
	echo chr(13).chr(10);
	$cont++;
	while ($f_departamento=mysql_fetch_array($r_departamento))
  	{
		if ($f_departamento['cod_prov']==$varaux)
		{
			$vcod=$f_departamento['cod_prov'];
			echo $f_departamento['cod_prov']."[$cont] = new slctr('".trim($f_departamento['descripcion'])."','".$f_departamento['id_localidades']."')";
			echo chr(13).chr(10);
			$cont++;
		}
		else
		{
			$varaux=$f_departamento['cod_prov'];
			echo "var ".$f_departamento['cod_prov']."=new Array()".chr(13).chr(10);
			$cont=0;
			echo $f_departamento['cod_prov']."[$cont] = new slctr('Seleccione Localidades','d00')".chr(13).chr(10);
			$cont++;
			echo $f_departamento['cod_prov']."[$cont] = new slctr('".trim($f_departamento['descripcion'])."','".$f_departamento['id_localidades']."')";
			echo chr(13).chr(10);
			$cont++;
		}
	}
	echo "</script>";
	
?>

<script language='javascript' type='text/javascript'>
function slctryole(cual,donde)
{
	if(cual.selectedIndex != 0)
	{
		donde.length=0
		cual = eval(cual.value)
		for(m=0;m<cual.length;m++)
		{
			var nuevaOpcion = new Option(cual[m].texto);
			donde.options[m] = nuevaOpcion;
			if(cual[m].valor != null)
			{
				donde.options[m].value = cual[m].valor
			}
			else
			{
				donde.options[m].value = cual[m].texto
			}
		}
	}
}
</script>
<style type="text/css">
<!--
.Estilo6 {color: #0000FF; font-weight: bold; }
-->
</style>
<div class="content">
	<table border="0" align="center">
		<tr>
			<td colspan="2"><h1>Modificacion Persona Juridica</h1></td>
		</tr>
		
		<tr height=10px>
			<td colspan="2"><hr></td>
		</tr>
		
   
<form action="indextesoreria.php?sec=federal/validardatos_jm" method="post">

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
		<input type="hidden" name="per" value="<?php echo $permisosnecesarios; ?>" > </td>
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
			<td><input type="text" name="razon_social" size="30" value="<?php echo $razon_social; ?>"></td>
		</tr>
		<tr height="2px">
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr bgcolor="#EAEAEA">
			<td colspan="2"><h4>&nbsp;Domicilio Fiscal</h4></td>
		</tr>
		<tr height="2px">
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td class="subtitle">Calle</td>
			<td><input type="text" name="direccion_calle_f" size="30" value="<?php echo $direccion_f_calle; ?>"></td>
		</tr>
		<tr>
			<td class="subtitle">Numero</td>
			<td><input type="text" name="direccion_nro_f" size="5" value="<?php echo $direccion_f_nro; ?>"></td>
		</tr>
		<tr>
			<td class="subtitle">Piso</td>
			<td><input type="text" name="direccion_piso_f" size="5" value="<?php echo $direccion_f_piso; ?>"></td>
		</tr>
		<tr>
			<td class="subtitle">Departamento Nro.</td>
			<td><input type="text" name="direccion_dpto_nro_f" size="5" value="<?php echo $direccion_f_dpto_nro; ?>"></td>
		</tr>
		<tr>
			<td class="subtitle">Provincia</td>
			<td><select name="direccion_provincia_f" size="1"			
                     onChange="slctryole(this,this.form.direccion_localidad_f)"> 
					  <option value="N">Sin Especificar</option>
<?php     
        
			while ($f_provincia= mysql_fetch_array ($r_provincia))
				{
?>				
				<option value="<?php echo $f_provincia['codprovincia']; ?>"
<?php 
                    if ($f_provincia['codprovincia']==$direccion_provincia_f)
					    {
						  echo 'selected';
						 }
						echo '>'.$f_provincia['nombre'];
				}
?>
                  </option>
			  </select>	      			</td>
</tr>
<?php 
  mysql_data_seek($r_departamento,0);
?>		
		<tr>
			<td class="subtitle">Localidad</td>
		  <td><select name="direccion_localidad_f" size="1">
			    <option value="S">Sin Especificar</option> 
<?php			  
			    while ($f_departamento= mysql_fetch_array ($r_departamento))
				{
?>				
				<option value="<?php echo $f_departamento['id_localidades']; ?>"
<?php 
                    if ($f_departamento['id_localidades']==$direccion_localidad_f)
					    {
						  echo 'selected';
						 }
						echo '>'.$f_departamento['descripcion'];
				}
?>
                  </option>
			  </select>		 </td>
		</tr>
		
		<tr>
			<td class="subtitle">Codigo Postal</td>
			<td><input type="text" name="codigo_postal_f" value="<?php echo $codigo_postal_f; ?>"  size="5" /></td>
		</tr>
			
		<tr height="2px">
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr bgcolor="#EAEAEA">
			<td colspan="2"><h4>&nbsp;Domicilio Legal</h4></td>
		</tr>
		<tr height="2px">
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td class="subtitle">Calle</td>
			<td><input type="text" name="direccion_calle_r" size="30" value="<?php echo $direccion_calle_r; ?>"></td>
		</tr>
		<tr>
			<td class="subtitle">Numero</td>
			<td><input type="text" name="direccion_nro_r" value="<?php echo $direccion_r_nro; ?>" size="5"></td>
		</tr>
		<tr>
			<td class="subtitle">Piso</td>
			<td><input type="text" name="direccion_piso_r" size="5" value="<?php echo $direccion_piso_r; ?>"></td>
		</tr>
		<tr>
			<td class="subtitle">Departamento Nro.</td>
			<td><input type="text" name="direccion_dpto_nro_r" value="<?php echo $direccion_dpto_nro_r; ?>" size="5"></td>
		</tr>
		<tr>
<?php 		
mysql_data_seek($r_provincia,0);		
?>
			<td class="subtitle">Provincia</td>
			<td><select name="direccion_provincia_r" size="1"			
                     onChange="slctryole(this,this.form.direccion_localidad_r)"> 
					  <option value="N">Sin Especificar</option>
<?php     
        
			while ($f_provincia= mysql_fetch_array ($r_provincia))
				  {
				?>				
				<option value="<?php echo $f_provincia['codprovincia']; ?>"
<?php 
                    if ($f_provincia['codprovincia']==$direccion_provincia_r)
					    {
						  echo 'selected';
						 }
						echo '>'.$f_provincia['nombre'];
				}
?>
                  </option>
			  </select>						</td>
		</tr>
<?php 
  mysql_data_seek($r_departamento,0);
?>			
		<tr>
			<td class="subtitle">Localidad</td>
			<td><select name="direccion_localidad_r" size="1">
			     <option value="S">Sin Especificar</option> 
<?php			  
			    while ($f_departamento= mysql_fetch_array ($r_departamento))
				 {
?>				
				<option value="<?php echo $f_departamento['id_localidades']; ?>"
<?php 
                    if ($f_departamento['id_localidades']==$direccion_localidad_r)
					    {
						  echo 'selected';
						 }
						echo '>'.$f_departamento['descripcion'];
				}
?>
                  </option>
			  </select>	</td>
		</tr>
			
		<tr>
			<td class="subtitle">Codigo Postal</td>
			<td><input type="text" name="codigo_postal_r" size="5" value="<?php echo $codigo_postal_r; ?>"></td>
		</tr>
		<tr height="2px">
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr bgcolor="#EAEAEA">
			<td colspan="2"><h4>&nbsp;Otros Datos</h4></td>
		</tr>
		<tr height="2px">
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td class="subtitle">Telefono</td>
			<td><input type="text" name="telefono1" maxlength="5" size="5" value="<?php echo $telefono[0];?>">                -<input type="text" name="telefono2" size="9"  maxlength="9" value="<?php echo $telefono[1];?>">			</td>
		</tr>
		<tr>
			<td class="subtitle">Direccion E-mail</td>
			<td><input type="text" name="email" size="30" value="<?php echo $email; ?>"></td>
		</tr>
		<tr height="2px">
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr bgcolor="#EAEAEA">
			<td colspan="2"><h4>&nbsp;Datos Economicos</h4></td>
		</tr>
		<tr height="2px">
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td class="subtitle">Actividad Principal</td>
			<td><select name="actividad_p">
					<option value="N" selected >Sin Especificar</option>
<?php     
       
                 while ($f_actividad = mysql_fetch_array ($r_actividad))
                      {
?>
                    <option value="<?php echo $f_actividad['id_actividad']; ?>"
<?php  
                    if ($f_actividad['id_actividad'] == $actividad_p)
					    {
						  echo "selected"; 
						}
						echo '>'.$f_actividad['id_actividad'].' - '.substr($f_actividad['nombre_actividad'],0,35);
								
			          }
?>					  
					</option>
			  </select>				  	</td>
		</tr>
		
		<tr>
			<td class="subtitle">Fecha Inicio de Actividad 1º </td>
			<td><select name="f_id_p" id="diasol" class="style11">
                    <option  value="---" >D&iacute;a</option>
                    <?php
                
              
                                $diahtml="";
                                for ($i=1; $i<32; $i++)
                                {
                                        $diahtml= $i; if ($i<10) {$diahtml= "0".$i;}
                                        echo "<option value='$diahtml'";
                                        if($fechaip[2] == $diahtml){ echo ' selected';}
                                        echo ">".$diahtml."</option>";
                                }  ?>
                  </select>
                    <select name="f_im_p" id="messol" class="style11">
                      <option  value="---">Mes</option>
                      <?php
                                 $meses= array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto',
                                        'Septiembre','Octubre','Noviembre','Diciembre');
                                $meshtml="";
                                for ($i=1;$i<13;$i++)
                               {
                                $meshtml= $i; if ($i<10) {$meshtml= "0".$i;}
                                echo "<option value='$meshtml'";
                                if($fechaip[1] == $meshtml){ echo ' selected';}
                                echo ">".$meses{$i-1}."</option>";
                                }  ?>
                    </select>
                     <select name="f_ia_p" id="anosol"  class="style11" onChange="calcular_fecha()">
                      <option  value="---">A&ntilde;o</option>
                      <?php
                        $fechaactual=strtotime('now');
                        $anioactual=substr(date('d/m/Y',$fechaactual),6,4);
                        //$anioactual=$anioactual-18;
						for ($i=1;$i<120;$i++)
                        {
                        echo "<option value='$anioactual'";
                        if($fechaip[0] == $anioactual){ echo ' selected';}
                        echo ">".$anioactual."</option>";
                        $anioactual=$anioactual-1;
                        }
                       
						
						
 
                        ?>
                     </select> </td>
		</tr>
        <tr>
<?php
mysql_data_seek($r_actividad,0);		
?>
		
			<td class="subtitle">Actividad Secundaria</td>
			<td><select name="actividad_s">
					<option value="N" selected >Sin Especificar</option>
<?php     
       
                    while ($f_actividad = mysql_fetch_array ($r_actividad))
                                             {
?>
                    <option value="<?php echo $f_actividad['id_actividad']; ?>"
<?php  
                    if ($f_actividad['id_actividad'] == $actividad_s)
					    {
						  echo "selected"; 
						}
						echo '>'.$f_actividad['id_actividad'].' - '.substr($f_actividad['nombre_actividad'],0,35);
								
			          }
?>					  
					</option>
			  </select> 		</td>
		</tr>
		
		<tr>
			<td class="subtitle">Fecha Inicio de Actividad 2º</td>
			<td><select name="f_id_s" id="diasol" class="style11">
                    <option  value="---" >D&iacute;a</option>
                    <?php
                
              
                                $diahtml="";
                                for ($i=1; $i<32; $i++)
                                {
                                        $diahtml= $i; if ($i<10) {$diahtml= "0".$i;}
                                        echo "<option value='$diahtml'";
                                        if($fechais[2] == $diahtml){ echo ' selected';}
                                        echo ">".$diahtml."</option>";
                                }  ?>
                  </select>
                    <select name="f_im_s" id="messol" class="style11">
                      <option  value="---">Mes</option>
                      <?php
                                 $meses= array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto',
                                        'Septiembre','Octubre','Noviembre','Diciembre');
                                $meshtml="";
                                for ($i=1;$i<13;$i++)
                                {
                                $meshtml= $i; if ($i<10) {$meshtml= "0".$i;}
                                echo "<option value='$meshtml'";
                                if($fechais[1] == $meshtml){ echo ' selected';}
                                echo ">".$meses{$i-1}."</option>";
                                } ?>
                    </select>
                     <select name="f_ia_s" id="anosol" class="style11" onChange="calcular_fecha()">
                      <option  value="---">A&ntilde;o</option>
                      <?php
                        $fechaactual=strtotime('now');
                        $anioactual=substr(date('d/m/Y',$fechaactual),6,4);
                        //$anioactual=$anioactual-18;
						for ($i=1;$i<120;$i++)
                        {
                        echo "<option value='$anioactual'";
                        if($fechais[0] == $anioactual){ echo ' selected';}
                        echo ">".$anioactual."</option>";
                        $anioactual=$anioactual-1;
                        }
 
                        ?>
                     </select> </td>
		</tr>
		<tr height="2px">
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr bgcolor="#EAEAEA">
			<td colspan="2"><h4>&nbsp;Datos Comerciales</h4></td>
		</tr>
		<tr height="2px">
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td class="subtitle">Fecha Contrato Social</td>
			<td><select name="f_dc" id="diasol" class="style11">
                    <option  value="---" >D&iacute;a</option>
                    <?php
                
              
                                $diahtml="";
                                for ($i=1; $i<32; $i++)
                                 {
                                        $diahtml= $i; if ($i<10) {$diahtml= "0".$i;}
                                        echo "<option value='$diahtml'";
                                        if($fechacs[2] == $diahtml){ echo ' selected';}
                                        echo ">".$diahtml."</option>";
                                }  ?>
                  </select>
                    <select name="f_mc" id="messol" class="style11">
                      <option  value="---">Mes</option>
                      <?php
                                 $meses= array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto',
                                        'Septiembre','Octubre','Noviembre','Diciembre');
                                $meshtml="";
                                for ($i=1;$i<13;$i++)
                                {
                                $meshtml= $i; if ($i<10) {$meshtml= "0".$i;}
                                echo "<option value='$meshtml'";
                                if($fechacs[1] == $meshtml){ echo ' selected';}
                                echo ">".$meses{$i-1}."</option>";
                                } ?>
                    </select>
                     <select name="f_ac" id="anosol"  class="style11" onChange="calcular_fecha()">
                      <option  value="---">A&ntilde;o</option>
                      <?php
                        $fechaactual=strtotime('now');
                        $anioactual=substr(date('d/m/Y',$fechaactual),6,4);
                        //$anioactual=$anioactual-18;
						for ($i=1;$i<120;$i++)
                        {
                        echo "<option value='$anioactual'";
                        if($fechacs[0] == $anioactual){ echo ' selected';}
                        echo ">".$anioactual."</option>";
                        $anioactual=$anioactual-1;
                        }
 
                        ?>
                     </select> </td>
		</tr>
		
		
		<tr>
			<td class="subtitle">Tipo de Sociedad</td>
			<td><select name="sociedad_tipo">
					<option value="N" selected onClick="toggle_listar(this)"  >Sin Especificar</option>
<?php     
       
                    while ($f_sociedad = mysql_fetch_array ($r_sociedad))
                           {
?>
                    <option onClick="toggle_listar(this)"  value="<?php echo $f_sociedad['id_sociedad'] ?>"
<?php
                     if ($f_sociedad['id_sociedad']==$sociedad_tipo)
					    {
						 echo 'selected';
						}
						echo '>'.$f_sociedad['nombre'];
						
					}	
				?>
			</option>
		  </select>		</td>
		</tr>
          <tr bgcolor="#EAEAEA">
			<td colspan="2"><?php if (!($sociedad_tipo=='16')){ ?> <div id="div_ute" style="display:none"><h4>&nbsp;Empresas que Integran la U.T.E </h4></div>
              
              <?php 
			  
			}
		else 
		    {
		?>		
				 <div id="div_ute" style="display:block"><h4>&nbsp;Empresas que Integran la U.T.E </h4></div>
                 <?php
			}
		?>	
		 	
              </td>
		</tr>
		<tr height="2px">
			<td colspan="2"><?php if (!($sociedad_tipo=='16')){ ?> <div id="div_ute1" style="display:none">
              
              <?php 
			  
			}
		else 
		    {
		?>		
				 <div id="div_ute1" style="display:block">
                 <?php
			}
		?>	</div></td>
		</tr>
		<tr>
		    <td colspan="2"><?php if (!($sociedad_tipo=='16')){ ?> <div id="div_ute2" style="display:none">
              
              <?php 
			  
			}
		else 
		    {
		?>		
				 <div id="div_ute2" style="display:block">
                 <?php
			}
		?>	
			    <table>
				     <tr bgcolor="#EAEAEA">
					    <td><span class="Estilo6">1-</span></td>
						<td width="21">&nbsp;  </td>
						<td><span class="Estilo6">2-</span></td>
                        <td width="21">&nbsp;  </td>
						<td><span class="Estilo6">3-</span></td>  
						
					</tr>
       <tr>	
					    <td width="353" height="28" >CUIT:
					  <input type="text" name="cuit1_u" size="11"  maxlength="11" value="<?php echo $cuit1_u; ?>"/></td>
					 <td>&nbsp;  </td>
					 <td width="354" >CUIT:
				   <input type="text" name="cuit2_u" size="11"  maxlength="11" value="<?php echo $cuit2_u; ?>"/>	</td>
                   <td>&nbsp;  </td>
                   <td width="354" >CUIT:
				   <input type="text" name="cuit3_u" size="11"  maxlength="11" value="<?php echo $cuit3_u; ?>"/>			</td>		  </tr>
					 <tr>
					 <td width="353" height="28" >Razon Social:
					  <input type="text" name="razon1_u" size="20"  maxlength="50" value="<?php echo $razon1_u; ?>" /></td>
					 <td>&nbsp;  </td>
					 <td width="353" height="28" >Razon Social:
					  <input type="text" name="razon2_u" size="20"  maxlength="50" value="<?php echo $razon2_u; ?>" /></td>
                      <td>&nbsp;  </td>
					 <td width="353" height="28" >Razon Social:
					  <input type="text" name="razon3_u" size="20"  maxlength="50" value="<?php echo $razon3_u; ?>" /></td>
					 </tr>
					 <tr>
					    <td width="353" height="28" >Domicilio:  &nbsp;&nbsp;&nbsp;&nbsp;
				       <input type="text" name="dom1_u" size="20" maxlength="50"  value="<?php echo $dom1_u; ?>"/></td>
					   <td>&nbsp;  </td>
						 <td width="353" height="28" >Domicilio:  &nbsp;&nbsp;&nbsp;&nbsp;
				       <input type="text" name="dom2_u" size="20" maxlength="50"  value="<?php echo $dom2_u; ?>"/></td>
					   <td>&nbsp;  </td>
                        <td width="353" height="28" >Domicilio:  &nbsp;&nbsp;&nbsp;&nbsp;
				       <input type="text" name="dom3_u" size="20" maxlength="50"  value="<?php echo $dom3_u; ?>"/></td>
					   </tr>
				<tr>
				 <td width="353" height="28" >Porcentaje:	 &nbsp;&nbsp;&nbsp;
				  <input type="text" name="por1_u" size="4"  value="<?php echo $por1_u; ?>"/></td>
				 <td>&nbsp;  </td>
				  <td width="353" height="28" >Porcentaje:	 &nbsp;&nbsp;&nbsp;
				  <input type="text" name="por2_u" size="4"  value="<?php echo $por2_u; ?>"/></td>
				 <td>&nbsp;  </td>
				  <td width="353" height="28" >Porcentaje:	 &nbsp;&nbsp;&nbsp;
				  <input type="text" name="por3_u" size="4"  value="<?php echo $por3_u; ?>"/></td>
				
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
					  <input type="text" name="cuit4_u" size="11"  maxlength="11" value="<?php echo $cuit4_u; ?>"/></td>
					 <td>&nbsp;  </td>
					 <td width="354" >CUIT:
				   <input type="text" name="cuit5_u" size="11"  maxlength="11" value="<?php echo $cuit5_u; ?>"/>	</td>
                   <td>&nbsp;  </td>
                   <td width="354" >CUIT:
				   <input type="text" name="cuit6_u" size="11"  maxlength="11" value="<?php echo $cuit6_u; ?>"/>			</td>		  </tr>
					 <tr>
					 <td width="353" height="28" >Razon Social:
					  <input type="text" name="razon4_u" size="20"  maxlength="50" value="<?php echo $razon4_u; ?>" /></td>
					 <td>&nbsp;  </td>
					 <td width="353" height="28" >Razon Social:
					  <input type="text" name="razon5_u" size="20"  maxlength="50" value="<?php echo $razon5_u; ?>" /></td>
                      <td>&nbsp;  </td>
					 <td width="353" height="28" >Razon Social:
					  <input type="text" name="razon6_u" size="20"  maxlength="50" value="<?php echo $razon6_u; ?>" /></td>
					 </tr>
					 <tr>
					    <td width="353" height="28" >Domicilio:  &nbsp;&nbsp;&nbsp;&nbsp;
				       <input type="text" name="dom4_u" size="20" maxlength="50"  value="<?php echo $dom4_u; ?>"/></td>
					   <td>&nbsp;  </td>
						 <td width="353" height="28" >Domicilio:  &nbsp;&nbsp;&nbsp;&nbsp;
				       <input type="text" name="dom5_u" size="20" maxlength="50"  value="<?php echo $dom5_u; ?>"/></td>
					   <td>&nbsp;  </td>
                        <td width="353" height="28" >Domicilio:  &nbsp;&nbsp;&nbsp;&nbsp;
				       <input type="text" name="dom6_u" size="20" maxlength="50"  value="<?php echo $dom6_u; ?>"/></td>
					   </tr>
				<tr>
				 <td width="353" height="28" >Porcentaje:	 &nbsp;&nbsp;&nbsp;
				  <input type="text" name="por4_u" size="4"  value="<?php echo $por4_u; ?>"/></td>
				 <td>&nbsp;  </td>
				  <td width="353" height="28" >Porcentaje:	 &nbsp;&nbsp;&nbsp;
				  <input type="text" name="por5_u" size="4"  value="<?php echo $por5_u; ?>"/></td>
				 <td>&nbsp;  </td>
				  <td width="353" height="28" >Porcentaje:	 &nbsp;&nbsp;&nbsp;
				  <input type="text" name="por6_u" size="4"  value="<?php echo $por6_u; ?>"/></td>
				
                  </tr>
				
                               
				
                        
 
                        
                       </td>
				  </tr> 
                </table>  
       </div>
       </td>
       </tr>
       <tr bgcolor="#EAEAEA">
			<td colspan="2"><h4>&nbsp;</h4></td>
		</tr>
       </tr>
		<tr>
			<td class="subtitle">Situacion frente I.V.A.</td>
			<td><select name="iva_situacion">
					<option value="N" selected >Sin Especificar</option>
<?php     
       
                    while ($f_iva = mysql_fetch_array ($r_iva))
                           {
?>
                    <option value="<?php echo $f_iva['id_iva'] ?>" 
<?php 
                          if($f_iva['id_iva']==$iva_situacion)
						     {
							   echo 'selected';
							 }
							 
							 echo '>'.$f_iva['nombre'];
						 }
		 	 
?>
               		</option>
			  </select>   	  	</td>
		</tr>
		<tr>
			<td class="subtitle">Ganancia</td>
		  <td><select name="ganancia">
					<option value="N" selected >Sin Especificar</option>
<?php     
       
                    while ($f_ganancia = mysql_fetch_array ($r_ganancia))
                           {
?>
                    <option value="<?php echo $f_ganancia['id_ganancia']; ?>" 
<?php 
                          if($f_ganancia['id_ganancia']==$ganancia)
						     {
							   echo 'selected';
							 }
							 
							 echo '>'.$f_ganancia['nombre'];
						 }
		 	 
?>
               		</option>
			  </select>   	  	</td>
		</tr>
		<!--<tr>
			<td class="subtitle">Alicuota</td>
			<td><select name="alicuota">
					<option value="N" selected >Sin Especificar</option>
<?php     
       
                    while ($f_alicuota = mysql_fetch_array ($r_alicuota))
                           {
?>
                    <option value="<?php echo $f_alicuota['id_alicuota']; ?>" 
<?php 
                          if($f_alicuota['id_alicuota']==$alicuota)
						     {
							   echo 'selected';
							 }
							 
							 echo '>'.$f_alicuota['nombre'];
						 }
		 	 
?>
               		</option>
			  </select>   	  	</td>
		</tr> -->
		<tr>
			<td class="subtitle">Ingreso Bruto</td>
			<td><select name="ingreso">
					<option value="N" selected >Sin Especificar</option>
<?php     
       
                    while ($f_ingreso = mysql_fetch_array ($r_ingreso))
                           {
?>
                    <option value="<?php echo $f_ingreso['id_ingreso']; ?>" 
<?php 
                          if($f_ingreso['id_ingreso']==$ingreso)
						     {
							   echo 'selected';
							 }
							 
							 echo '>'.$f_ingreso['nombre'];
						 }
		 	 
?>
               		</option>
			  </select>   	  	</td>
		</tr>
		
		
		
		<tr>
			<td class="subtitle" colspan="2" >Nro. Inscripcion Ingreso Bruto(Jurisdiccion la Rioja) 			
				<input type="text" name="ingreso_bruto_1" size="3" maxlength="3" value="<?php echo $ingreso_bruto1; ?>" /> 
			  - 
				<input type="text" name="ingreso_bruto_2" size="6" maxlength="6" value="<?php echo $ingreso_bruto2; ?>"> - 
		  <input type="text" name="ingreso_bruto_3" size="1" maxlength="1" value="<?php echo $ingreso_bruto3; ?>">			</td>
		</tr>

        <tr>
			<td class="subtitle" colspan="2" >Nro. Inscripcion Ingreso Bruto (Adm. Central)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  <input type="text" name="ingreso_brutoc_1" size="3" maxlength="3" value="<?php echo $ingreso_bruto_ac1; ?>"> - 
				<input type="text" name="ingreso_brutoc_2" size="6" maxlength="6" value="<?php echo $ingreso_bruto_ac2; ?>"> - 
				<input type="text" name="ingreso_brutoc_3" size="1" maxlength="1" value="<?php echo $ingreso_bruto_ac3; ?>">			</td>
		</tr>

		<tr>
			<td class="subtitle">Regimen de Convenio  </td>
			<td><select name="regimen">
					<option value="N" selected >Sin Especificar</option>
<?php     
       
                    while ($f_regimen = mysql_fetch_array ($r_regimen))
                           {
?>
                    <option value="<?php echo $f_regimen['id_regimen']; ?>" 
<?php 
                          if($f_regimen['id_regimen']==$regimen)
						     {
							   echo 'selected';
							 }
							 
							 echo '>'.substr($f_regimen['nombre'],0,50);
						 }
		 	 
?>
               		</option>
			  </select>   	  	</td>
		</tr>
		<tr>
			<td class="subtitle">Seguridad Social</td>
			<td><select name="seguridad">
					<option value="N" selected >Sin Especificar</option>
<?php     
       
                    while ($f_seguridad = mysql_fetch_array ($r_seguridad))
                           {
?>
                    <option value="<?php echo $f_seguridad['id_seguridad'] ?>" 
<?php 
                          if($f_seguridad['id_seguridad']==$seguridad)
						     {
							   echo 'selected';
							 }
							 
							 echo '>'.$f_seguridad['nombre'];
						 }
		 	 
?>
               		</option>
			  </select>   	  	</td>
		</tr>
		<tr height="2px">
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr bgcolor="#EAEAEA">
			<td colspan="2"><h4>&nbsp;Componentes de la Sociedad o Autoridades en Ejercicio</h4></td>
		</tr>
		<tr height="2px">
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
	      <td colspan="2"><table>
				     <tr bgcolor="#EAEAEA">
					    <td><span class="Estilo6">1-</span></td>
						<td width="21">&nbsp;  </td>
						<td><span class="Estilo6">2-</span></td>  
						
					</tr>
					<tr>	
					    <td width="353" height="28" >Apellido:
					  <input type="text" name="apellido1" size="20"  maxlength="50" value="<?php echo $apellido1; ?>"/>
					 <td>&nbsp;  </td>
					 <td width="354" >Apellido:
				  <input type="text" name="apellido2" size="20"  maxlength="50" value="<?php echo $apellido2; ?>"/>				  </tr>
					 <tr>
					 <td width="353" height="28" >Nombre:
					  <input type="text" name="nombre1" size="20"  maxlength="50" value="<?php echo $nombre1; ?>" /></td>
					 <td>&nbsp;  </td>
					  <td width="354" >Nombre:
					  <input type="text" name="nombre2" size="20"  maxlength="50" value="<?php echo $nombre2; ?>" /></td>
					 </tr>
					 <tr>
					    <td width="353" height="28" >D.N.I:  &nbsp;&nbsp;&nbsp;&nbsp;
				       <input type="text" name="dni1" size="8" maxlength="8"  value="<?php echo $dni1; ?>"/></td>
					   <td>&nbsp;  </td>
						<td width="354" >D.N.I:  &nbsp;&nbsp;&nbsp;&nbsp;
					<input type="text" name="dni2" size="8" maxlength="8"  value="<?php echo $dni2 ?>"/>					</tr>
				<tr>
				 <td width="353" height="28" >Cargo:	 &nbsp;&nbsp;&nbsp;
				  <input type="text" name="cargo1" size="8"  value="<?php echo $cargo1; ?>"/></td>
				 <td>&nbsp;  </td>
				 <td width="354" >Cargo:	 &nbsp;&nbsp;&nbsp;	
				  <input type="text" name="cargo2" size="8"  value="<?php echo $cargo2; ?>"/></td>
				  </tr>
					<tr>
					  <td height="28">Fec.Inicio
					    <select name="f_inicio_d1" id="diasol" class="style11">
                          <option  value="---" >D&iacute;a</option>
                          <?php
                
              
                                $diahtml="";
                                for ($i=1; $i<32; $i++)
                                 {
                                        $diahtml= $i; if ($i<10) {$diahtml= "0".$i;}
                                        echo "<option value='$diahtml'";
                                        if($fecha_inicio1[2] == $diahtml){ echo ' selected';}
                                        echo ">".$diahtml."</option>";
                                }  ?>
                        </select>
                          <select name="f_inicio_m1" id="messol" class="style11">
                            <option  value="---">Mes</option>
                            <?php
                                 $meses= array('Ene','Feb','Mar','Abr','May','Jun','Jul','Agos',
								 'Sept','Oct','Nov','Dic');
                                $meshtml="";
                                for ($i=1;$i<13;$i++)
                                {
                                $meshtml= $i; if ($i<10) {$meshtml= "0".$i;}
                                echo "<option value='$meshtml'";
                                if($fecha_inicio1[1] == $meshtml){ echo ' selected';}
                                echo ">".$meses{$i-1}."</option>";
                                } ?>
                          </select>
                          <select name="f_inicio_a1" id="anosol"  class="style11" onchange="calcular_fecha()">
                            <option  value="---">A&ntilde;o</option>
                            <?php
                        $fechaactual=strtotime('now');
                        $anioactual=substr(date('d/m/Y',$fechaactual),6,4);
                        //$anioactual=$anioactual-18;
						for ($i=1;$i<120;$i++)
                        {
                        echo "<option value='$anioactual'";
                        if($fecha_inicio1[0] == $anioactual){ echo ' selected';}
                        echo ">".$anioactual."</option>";
                        $anioactual=$anioactual-1;
                        }
 
                        ?>
                          </select>                      </td>
					  <td>&nbsp;  </td>
					  <td>Fec.Inicio
					    <select name="f_inicio_d2" id="diasol" class="style11">
                          <option  value="---" >D&iacute;a</option>
                          <?php
                
              
                                $diahtml="";
                                for ($i=1; $i<32; $i++)
                                 {
                                        $diahtml= $i; if ($i<10) {$diahtml= "0".$i;}
                                        echo "<option value='$diahtml'";
                                        if($fecha_inicio2[2] == $diahtml){ echo ' selected';}
                                        echo ">".$diahtml."</option>";
                                }  ?>
                        </select>
                          <select name="f_inicio_m2" id="messol" class="style11">
                            <option  value="---">Mes</option>
                            <?php
                                 $meses= array('Ene','Feb','Mar','Abr','May','Jun','Jul','Agos',
								 'Sept','Oct','Nov','Dic');
                                $meshtml="";
                                for ($i=1;$i<13;$i++)
                                {
                                $meshtml= $i; if ($i<10) {$meshtml= "0".$i;}
                                echo "<option value='$meshtml'";
                                if($fecha_inicio2[1] == $meshtml){ echo ' selected';}
                                echo ">".$meses{$i-1}."</option>";
                                } ?>
                          </select>
                          <select name="f_inicio_a2" id="anosol"  class="style11" onchange="calcular_fecha()">
                            <option  value="---">A&ntilde;o</option>
                            <?php
                        $fechaactual=strtotime('now');
                        $anioactual=substr(date('d/m/Y',$fechaactual),6,4);
                        //$anioactual=$anioactual-18;
						for ($i=1;$i<120;$i++)
                        {
                        echo "<option value='$anioactual'";
                        if($fecha_inicio2[0] == $anioactual){ echo ' selected';}
                        echo ">".$anioactual."</option>";
                        $anioactual=$anioactual-1;
                        }
 
                        ?>
                          </select>                      </td>
				  </tr>
				 <tr>
				 <td width="353" height="28" >Fecha Fin:
				     <select name="f_fin_d1" id="diasol" class="style11">
                          <option  value="---" >D&iacute;a</option>
                          <?php
                
              
                                $diahtml="";
                                for ($i=1; $i<32; $i++)
                                 {
                                        $diahtml= $i; if ($i<10) {$diahtml= "0".$i;}
                                        echo "<option value='$diahtml'";
                                        if($fecha_fin1[2] == $diahtml){ echo ' selected';}
                                        echo ">".$diahtml."</option>";
                                }  ?>
                        </select>
                          <select name="f_fin_m1" id="messol" class="style11">
                            <option  value="---">Mes</option>
                            <?php
                                 $meses= array('Ene','Feb','Mar','Abr','May','Jun','Jul','Agos',
								 'Sept','Oct','Nov','Dic');
                                $meshtml="";
                                for ($i=1;$i<13;$i++)
                                {
                                $meshtml= $i; if ($i<10) {$meshtml= "0".$i;}
                                echo "<option value='$meshtml'";
                                if($fecha_fin1[1] == $meshtml){ echo ' selected';}
                                echo ">".$meses{$i-1}."</option>";
                                } ?>
                          </select>
                          <select name="f_fin_a1" id="anosol"  class="style11" onchange="calcular_fecha()">
                            <option  value="---">A&ntilde;o</option>
                            <?php
                        $fechaactual=strtotime('now');
                        $anioactual='2040';
                        
						//$anioactual=$anioactual-18;
						for ($i=1;$i<120;$i++)
                        {
                        echo "<option value='$anioactual'";
                        if($fecha_fin1[0] == $anioactual){ echo ' selected';}
                        echo ">".$anioactual."</option>";
                        $anioactual=$anioactual-1;
                        }
 
                        ?>
                          </select> </td>
				 <td>&nbsp;  </td>
				 <td width="354" >Fecha Fin:
				   <select name="f_fin_d2" id="diasol" class="style11">
                          <option  value="---" >D&iacute;a</option>
                          <?php
                
              
                                $diahtml="";
                                for ($i=1; $i<32; $i++)
                                 {
                                        $diahtml= $i; if ($i<10) {$diahtml= "0".$i;}
                                        echo "<option value='$diahtml'";
                                        if($fecha_fin2[2] == $diahtml){ echo ' selected';}
                                        echo ">".$diahtml."</option>";
                                }  ?>
                        </select>
                          <select name="f_fin_m2" id="messol" class="style11">
                            <option  value="---">Mes</option>
                            <?php
                                 $meses= array('Ene','Feb','Mar','Abr','May','Jun','Jul','Agos',
								 'Sept','Oct','Nov','Dic');
                                $meshtml="";
                                for ($i=1;$i<13;$i++)
                                {
                                $meshtml= $i; if ($i<10) {$meshtml= "0".$i;}
                                echo "<option value='$meshtml'";
                                if($fecha_fin2[1] == $meshtml){ echo ' selected';}
                                echo ">".$meses{$i-1}."</option>";
                                } ?>
                          </select>
                          <select name="f_fin_a2" id="anosol"  class="style11" onchange="calcular_fecha()">
                            <option  value="---">A&ntilde;o</option>
                            <?php
                        $fechaactual=strtotime('now');
                       $anioactual='2040';
                        //$anioactual=$anioactual-18;
						for ($i=1;$i<120;$i++)
                        {
                        echo "<option value='$anioactual'";
                        if($fecha_fin2[0] == $anioactual){ echo ' selected';}
                        echo ">".$anioactual."</option>";
                        $anioactual=$anioactual-1;
                        }
 
                        ?>
                          </select></td>
				  </tr> 
				  <tr>
				     <td colspan="3">
					 </td>
				  </tr>
				   <tr bgcolor="#EAEAEA">
					    <td><span class="Estilo6">3-</span></td>
						<td>&nbsp;  </td>
						<td><span class="Estilo6">4-</span></td>  
					</tr>
					   <td width="353" height="28">Apellido:
					  <input type="text" name="apellido3" size="20"  maxlength="50" value="<?php echo $apellido3; ?>"/>
					<td>&nbsp;  </td>
					 <td width="354" >Apellido:
				  <input type="text" name="apellido4" size="20"  maxlength="50" value="<?php echo $apellido4; ?>"/>				  </tr>
					 <tr>
					 <td width="353" height="28">Nombre:
					  <input type="text" name="nombre3" size="20"  maxlength="50" value="<?php echo $nombre3; ?>" /></td>
					 <td>&nbsp;  </td>
					  <td width="354" >Nombre:
					  <input type="text" name="nombre4" size="20"  maxlength="50" value="<?php echo $nombre4; ?>" /></td>
					 </tr>
					 <tr>
					    <td width="353" height="28">D.N.I:  &nbsp;&nbsp;&nbsp;&nbsp;
				       <input type="text" name="dni3" size="8" maxlength="8"  value="<?php echo $dni3; ?>"/></td>
						<td>&nbsp;  </td>
						<td width="354" >D.N.I:  &nbsp;&nbsp;&nbsp;&nbsp;
					<input type="text" name="dni4" size="8" maxlength="8"  value="<?php echo $dni4 ?>"/>					</tr>
				<tr>
				 <td width="353" height="28">Cargo:	 &nbsp;&nbsp;&nbsp;
				  <input type="text" name="cargo3" size="8"  value="<?php echo $cargo3; ?>"/></td>
				 <td>&nbsp;  </td>
				 <td width="354" >Cargo:	 &nbsp;&nbsp;&nbsp;	
				  <input type="text" name="cargo4" size="8"  value="<?php echo $cargo4; ?>"/></td>
				  </tr>
					<tr>
					  <td height="28">Fec.Inicio
					    <select name="f_inicio_d3" id="diasol" class="style11">
                          <option  value="---" >D&iacute;a</option>
                          <?php
                
              
                                $diahtml="";
                                for ($i=1; $i<32; $i++)
                                 {
                                        $diahtml= $i; if ($i<10) {$diahtml= "0".$i;}
                                        echo "<option value='$diahtml'";
                                        if($fecha_inicio3[2] == $diahtml){ echo ' selected';}
                                        echo ">".$diahtml."</option>";
                                }  ?>
                        </select>
                          <select name="f_inicio_m3" id="messol" class="style11">
                            <option  value="---">Mes</option>
                            <?php
                                $meses= array('Ene','Feb','Mar','Abr','May','Jun','Jul','Agos',
								 'Sept','Oct','Nov','Dic');
                                $meshtml="";
                                for ($i=1;$i<13;$i++)
                                {
                                $meshtml= $i; if ($i<10) {$meshtml= "0".$i;}
                                echo "<option value='$meshtml'";
                                if($fecha_inicio3[1] == $meshtml){ echo ' selected';}
                                echo ">".$meses{$i-1}."</option>";
                                } ?>
                          </select>
                          <select name="f_inicio_a3" id="anosol"  class="style11" onchange="calcular_fecha()">
                            <option  value="---">A&ntilde;o</option>
                            <?php
                        $fechaactual=strtotime('now');
                        $anioactual=substr(date('d/m/Y',$fechaactual),6,4);
                        //$anioactual=$anioactual-18;
						for ($i=1;$i<120;$i++)
                        {
                        echo "<option value='$anioactual'";
                        if($fecha_inicio3[0] == $anioactual){ echo ' selected';}
                        echo ">".$anioactual."</option>";
                        $anioactual=$anioactual-1;
                        }
 
                        ?>
                      </select>                      </td>
					  <td>&nbsp;  </td>
					  <td>Fec.Inicio
					    <select name="f_inicio_d4" id="diasol" class="style11">
                          <option  value="---" >D&iacute;a</option>
                          <?php
                
              
                                $diahtml="";
                                for ($i=1; $i<32; $i++)
                                 {
                                        $diahtml= $i; if ($i<10) {$diahtml= "0".$i;}
                                        echo "<option value='$diahtml'";
                                        if($fecha_inicio4[2] == $diahtml){ echo ' selected';}
                                        echo ">".$diahtml."</option>";
                                }  ?>
                        </select>
                          <select name="f_inicio_m4" id="messol" class="style11">
                            <option  value="---">Mes</option>
                            <?php
                               $meses= array('Ene','Feb','Mar','Abr','May','Jun','Jul','Agos',
								 'Sept','Oct','Nov','Dic');
                                $meshtml="";
                                for ($i=1;$i<13;$i++)
                                {
                                $meshtml= $i; if ($i<10) {$meshtml= "0".$i;}
                                echo "<option value='$meshtml'";
                                if($fecha_inicio4[1] == $meshtml){ echo ' selected';}
                                echo ">".$meses{$i-1}."</option>";
                                } ?>
                          </select>
                          <select name="f_inicio_a4" id="anosol"  class="style11" onchange="calcular_fecha()">
                            <option  value="---">A&ntilde;o</option>
                            <?php
                        $fechaactual=strtotime('now');
                        $anioactual=substr(date('d/m/Y',$fechaactual),6,4);
                        //$anioactual=$anioactual-18;
						for ($i=1;$i<120;$i++)
                        {
                        echo "<option value='$anioactual'";
                        if($fecha_inicio4[0] == $anioactual){ echo ' selected';}
                        echo ">".$anioactual."</option>";
                        $anioactual=$anioactual-1;
                        }
 
                        ?>
                          </select>                      </td>
				  </tr>
				 <tr>
				 <td width="353" height="28" >Fecha Fin:
				   <select name="f_fin_d3" id="diasol" class="style11">
                          <option  value="---" >D&iacute;a</option>
                          <?php
                
              
                                $diahtml="";
                                for ($i=1; $i<32; $i++)
                                 {
                                        $diahtml= $i; if ($i<10) {$diahtml= "0".$i;}
                                        echo "<option value='$diahtml'";
                                        if($fecha_fin3[2] == $diahtml){ echo ' selected';}
                                        echo ">".$diahtml."</option>";
                                }  ?>
                        </select>
                          <select name="f_fin_m3" id="messol" class="style11">
                            <option  value="---">Mes</option>
                            <?php
                                 $meses= array('Ene','Feb','Mar','Abr','May','Jun','Jul','Agos',
								 'Sept','Oct','Nov','Dic');
                                $meshtml="";
                                for ($i=1;$i<13;$i++)
                                {
                                $meshtml= $i; if ($i<10) {$meshtml= "0".$i;}
                                echo "<option value='$meshtml'";
                                if($fecha_fin3[1] == $meshtml){ echo ' selected';}
                                echo ">".$meses{$i-1}."</option>";
                                } ?>
                          </select>
                          <select name="f_fin_a3" id="anosol"  class="style11" onchange="calcular_fecha()">
                            <option  value="---">A&ntilde;o</option>
                            <?php
                        $fechaactual=strtotime('now');
                        $anioactual='2040';
                        //$anioactual=$anioactual-18;
						for ($i=1;$i<120;$i++)
                        {
                        echo "<option value='$anioactual'";
                        if($fecha_fin3[0] == $anioactual){ echo ' selected';}
                        echo ">".$anioactual."</option>";
                        $anioactual=$anioactual-1;
                        }
 
                        ?>
                          </select></td>
				 <td>&nbsp;  </td>
				 <td width="354" >Fecha Fin:
				   <select name="f_fin_d4" id="diasol" class="style11">
                          <option  value="---" >D&iacute;a</option>
                          <?php
                
              
                                $diahtml="";
                                for ($i=1; $i<32; $i++)
                                 {
                                        $diahtml= $i; if ($i<10) {$diahtml= "0".$i;}
                                        echo "<option value='$diahtml'";
                                        if($fecha_fin4[2] == $diahtml){ echo ' selected';}
                                        echo ">".$diahtml."</option>";
                                }  ?>
                        </select>
                          <select name="f_fin_m4" id="messol" class="style11">
                            <option  value="---">Mes</option>
                            <?php
                                 $meses= array('Ene','Feb','Mar','Abr','May','Jun','Jul','Agos',
								 'Sept','Oct','Nov','Dic');
                                $meshtml="";
                                for ($i=1;$i<13;$i++)
                                {
                                $meshtml= $i; if ($i<10) {$meshtml= "0".$i;}
                                echo "<option value='$meshtml'";
                                if($fecha_fin4[1] == $meshtml){ echo ' selected';}
                                echo ">".$meses{$i-1}."</option>";
                                } ?>
                          </select>
                          <select name="f_fin_a4" id="anosol"  class="style11" onchange="calcular_fecha()">
                            <option  value="---">A&ntilde;o</option>
                            <?php
                        $fechaactual=strtotime('now');
                       $anioactual='2040';
                        //$anioactual=$anioactual-18;
						for ($i=1;$i<120;$i++)
                        {
                        echo "<option value='$anioactual'";
                        if($fecha_fin4[0] == $anioactual){ echo ' selected';}
                        echo ">".$anioactual."</option>";
                        $anioactual=$anioactual-1;
                        }
 
                        ?>
                          </select></td>
				  </tr> 
          </table></td>
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
           </select>				  			</td>
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
		<tr>
		  <td>Observacion
		  <td><input type="text" name="observacion" value="<?php echo $observacion; ?>" /></td>
		</tr>
		<tr height="2px">
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr height=20px>
			<td colspan="2"><hr></td>
		</tr>
		<tr>
	  
   	<td colspan="2" align="center">
			&nbsp;&nbsp;&nbsp;<input type="submit" value="Enviar Datos"></td>
		</tr>
</form>
  </table>
</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>


