<?php
//conexion
error_reporting ( E_ERROR ); 
	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
  $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];
  
  include('incluir_siempre.php');
///cuando viene de validar_f
 if (isset($_POST['modi']))
    {
 
  //cuitl
  
   $cuitl_1=$_POST['cuitl_1'];
   $cuitl_2=$_POST['cuitl_2'];
   $cuitl_3=$_POST['cuitl_3'];
  
  //datos de identificacion
  
   $ape= strtoupper($_POST['apellido']);
   $nom = ucwords(strtolower($_POST['nombre'])); 
   $nombre_f = ucwords(strtolower($_POST['nombre_f'])); 
   
   $documento_tipo = $_POST['documento_tipo'];
   $documento_nro = $_POST['documento_nro'];
   $fecha_nacimiento=$_POST['fecha_nacimiento'];
   
  //direccion fisica
  
   $direccion_f_calle = $_POST['direccion_calle_f'];
   $direccion_f_nro = $_POST['direccion_nro_f'];
   $direccion_f_piso = $_POST['direccion_piso_f'];
   $direccion_f_dpto_nro = $_POST['direccion_dpto_nro_f'];
   $direccion_f_localidad = $_POST['direccion_localidad_f'];
   $direccion_f_provincia = $_POST['direccion_provincia_f'];
   $codigo_postal_f = $_POST['codigo_postal_f'];
  
  //direccion real
  
   $direccion_r_calle = $_POST['direccion_calle_r'];
   $direccion_r_nro = $_POST['direccion_nro_r'];
   $direccion_r_piso = $_POST['direccion_piso_r'];
   $direccion_r_dpto_nro = $_POST['direccion_dpto_nro_r'];
   $direccion_r_localidad = $_POST['direccion_localidad_r'];
   $direccion_r_provincia = $_POST['direccion_provincia_r'];
   $codigo_postal_r = $_POST['codigo_postal_r'];
  
  //otros datos
  
   $telefono =split("-",$_POST['telefono']);
   $email = $_POST['email'];
  
  //banco
  
   $banco_nombre = $_POST['banco_nombre'];
   $banco_sucursal = $_POST['banco_sucursal'];
   $banco_cta_tipo = $_POST['banco_cta_tipo'];
   $banco_cta_nro = $_POST['banco_cta_nro'];
   $cbu = $_POST['banco_cbu'];
  
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
 
    $iva_situacion = $_POST['iva_situacion'];
   $ingreso_bruto = $_POST['ingreso_bruto'];
   
//   $ingresobruto=split("-",$ingreso_bruto);
  
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
   
   }
 else
   {
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
	 
	 $cuitl = $f_beneficiario['cuitl'];
     $ape = $f_beneficiario['apellido'];  
     $nom = $f_beneficiario['nombre'];  
	 $nombre_f = $f_beneficiario['nombre_f'];  
     $documento_tipo =$f_beneficiario['documento_tipo'];
     $documento_nro =$f_beneficiario['documento_nro'];
     $fecha_nacimiento=$f_beneficiario['fecha_nacimiento'];
    
     $direccion_f_calle=$f_beneficiario['direccion_f_calle'];
     $direccion_f_nro=$f_beneficiario['direccion_f_nro'];
     $direccion_f_piso=$f_beneficiario['direccion_f_piso'];
     $direccion_f_dpto_nro=$f_beneficiario['direccion_f_dpto_nro'];
     $direccion_f_localidad=$f_beneficiario['direccion_f_localidad'];
     $direccion_f_provincia=$f_beneficiario['direccion_f_provincia'];
     $codigo_postal_f=$f_beneficiario['codigo_f_postal'];
     $direccion_r_calle=$f_beneficiario['direccion_r_calle'];
     $direccion_r_nro=$f_beneficiario['direccion_r_nro'];
     $direccion_r_piso=$f_beneficiario['direccion_r_piso'];
    $direccion_r_dpto_nro=$f_beneficiario['direccion_r_dpto_nro'];
    $direccion_r_provincia=$f_beneficiario['direccion_r_provincia'];
    $direccion_r_localidad=$f_beneficiario['direccion_r_localidad'];
    $codigo_postal_r=$f_beneficiario['codigo_r_postal']; 
    $telefono=$f_beneficiario['telefono'];
    $email=$f_beneficiario['email'];
    $banco_nombre=$f_beneficiario['banco_nombre'];
    $banco_sucursal=$f_beneficiario['banco_sucursal'];
    $banco_cta_tipo=$f_beneficiario['banco_cta_tipo'];
    $banco_cta_nro=$f_beneficiario['banco_cta_nro'];
    $cbu=$f_beneficiario['cbu'];
    $ingreso_bruto = $f_beneficiario['ingreso_bruto'];
	$ingreso_bruto1=substr($ingreso_bruto,0,-7);
    $ingreso_bruto2=substr($ingreso_bruto,3,-1);
    $ingreso_bruto3=substr($ingreso_bruto,-1);
  
    $ganancia = $f_beneficiario['ganancia'];
  //$alicuota = $f_beneficiario['alicuota'];
  $ingreso = $f_beneficiario['ingreso'];
  $regimen = $f_beneficiario['regimen'];
  $seguridad = $f_beneficiario['seguridad'];
  $ingreso_bruto_ac=$f_beneficiario['ingreso_bruto_ac'];
  
  $ingreso_bruto_ac1=substr($ingreso_bruto_ac,0,-7);
  $ingreso_bruto_ac2=substr($ingreso_bruto_ac,3,-1);
  $ingreso_bruto_ac3=substr($ingreso_bruto_ac,-1);
  
    $iva_situacion = $f_beneficiario['iva_situacion'];
   $telefono =split("-",$telefono);
   $cuitl= str_replace('-', '', $cuitl);
	$cuitl_1 = substr($cuitl,0,2);
	$cuitl_2 = substr($cuitl,2,8);
	$cuitl_3 = substr($cuitl,10,2);
	
	 $actividad_p=$f_beneficiario['actividad_p'];
  $fecha_p=$f_beneficiario['fecha_p'];
  $actividad_s=$f_beneficiario['actividad_s'];
  $fecha_s=$f_beneficiario['fecha_s'];
  $fechaip=split("-",$fecha_p);
  $fechais=split("-",$fecha_s);
  $observacion=$f_beneficiario['observacion'];
   }  
   $fecha=split("-",$fecha_nacimiento);
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

	 $ssql = "SELECT * FROM `actividad` where estado='A'  order by id_actividad ";
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
      $cuerpo1  = "al intentar buscar sociedades";
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
<!--script para cargar un combo deacuerdo a lo seleccionado  -->


<script language='javascript' type='text/javascript'>

function slctr(texto,valor)
{
    this.texto = texto
    this.valor = valor
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
 
<div class="content">
<form action="indextesoreria.php?sec=contaduria/validardatos_f&apli=tgpa&per=G" method="post" >	
<table border="0" cellpadding="0" align="center">
	<tr>
		<td colspan="2"><h1>Modificar Datos Beneficiarios</h1></td>
	</tr>
	<tr height=10px>
		<td colspan="2"><hr></td>
	</tr>
	<tr>

		<td class="subtitle">Nro. CUIL | CUIT</td>
		<td>
		<input type="hidden" name="modificar" value="M" />
		<input type="text" name="cuitl_1" size="2" maxlength="2" value="<?php echo $cuitl_1; ?>" disabled /> - 
    	<input type="text" name="cuitl_2" size="8" maxlength="8" value="<?php echo $cuitl_2; ?>" disabled /> - 
		<input type="text" name="cuitl_3" size="1" maxlength="1" value="<?php echo $cuitl_3; ?>" disabled />
		<input type="hidden" name="cuitl_1" value="<?php echo $cuitl_1; ?>"> 
    	<input type="hidden" name="cuitl_2" value="<?php echo $cuitl_2; ?>" >
		<input type="hidden" name="cuitl_3" value="<?php echo $cuitl_3; ?>" >		
		<input type="hidden" name="id_bene" value="<?php echo $id; ?>" >	
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
		<td class="subtitle">Apellido</td>
		<td><input type="text" name="apellido" size="30" value="<?php echo $ape; ?>"></td>
	</tr>
	<tr>
		<td class="subtitle">Nombres</td>
		<td><input type="text" name="nombre" size="30" value="<?php echo $nom; ?>"></td>
	</tr>
    
    <tr>
		<td class="subtitle">Nombre Fantasia</td>
		<td><input type="text" name="nombre_f" size="30" value="<?php echo $nombre_f; ?>"></td>
	</tr>
    
	<tr>
		<td class="subtitle">Tipo de Documento</td>
		<td>
		<input type="hidden" name="documento_tipo" value="<?php echo $documento_tipo; ?>" />
		<select name="documento_tipo1" disabled>
					<option value="N" selected>Sin Especificar</option>
<?php     
       
                 while ($f_documento = mysql_fetch_array ($r_documento))
                      {
?>
                   <OPTION  value="<?php echo $f_documento['id_tipo'] ?>"
<?php
                                
                      if ($f_documento['id_tipo'] == $documento_tipo)
                       {
                         echo "selected";
                       }

                      echo ">".$f_documento['descripcion'];
            }

?>
                   </OPTION>
           </select>
			</td>
		</tr>
		<tr>
			<td class="subtitle">Nro. de Documento</td>
			<td><input type="text" name="documento" value="<?php echo $documento_nro;  ?>" size="8" maxlength="8" disabled>
			<input type="hidden" name="documento_nro" value="<?php echo $documento_nro;  ?>" size="8" maxlength="8" >
			    </td>
		</tr>
<?php 
     $fecha=split("-",$fecha_nacimiento);
?>	 		
		<tr>
			<td class="subtitle">Fecha de Nacimiento</td>
			<td><select name="f_nd" id="diasol" class="style11" >
                    <option  value="---" >D&iacute;a</option>
                    <?php
                                $diahtml="";
                                for ($i=1; $i<32; $i++)
                                {
                                        $diahtml= $i; if ($i<10) {$diahtml= "0".$i;}
                                        echo "<option value='$diahtml'";
                                        if($fecha[2] == $diahtml){ echo ' selected';}
                                        echo ">".$diahtml."</option>";
                                }  ?>
                  </select>
                    <select name="f_nm" id="messol" class="style11">
                      <option  value="---">Mes</option>
                      <?php
                                 $meses= array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto',
                                        'Septiembre','Octubre','Noviembre','Diciembre');
                                $meshtml="";
                                for ($i=1;$i<13;$i++)
                                {
                                $meshtml= $i; if ($i<10) {$meshtml= "0".$i;}
                                echo "<option value='$meshtml'";
                                if($fecha[1] == $meshtml){ echo ' selected';}
                                echo ">".$meses{$i-1}."</option>";
                                } ?>
                    </select>
                     <select name="f_na" id="anosol"  class="style11" onChange="calcular_fecha()">
                      <option  value="---">A&ntilde;o</option>
                      <?php
                        $fechaactual=strtotime('now');
                        $anioactual=substr(date('d/m/Y',$fechaactual),6,4);
                        $anioactual=$anioactual-18;
						for ($i=1;$i<90;$i++)
                        {
                       echo "<option value='$anioactual'";
                        if($fecha[0] == $anioactual){ echo ' selected';}
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
                    if ($f_provincia['codprovincia']==$direccion_f_provincia)
					    {
						  echo 'selected';
						 }
						echo '>'.$f_provincia['nombre'];
				}
?>
                  </option>
			  </select>		   
	      			</td>
	   
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
                    if ($f_departamento['id_localidades']==$direccion_f_localidad)
					    {
						  echo 'selected';
						 }
						echo '>'.$f_departamento['descripcion'];
				}
?>
                  </option>
			  </select>	

		 </td>
		</tr>
		
		<tr>
			<td class="subtitle">Codigo Postal</td>
			<td><input type="text" name="codigo_postal_f" value="<?php echo $codigo_postal_f; ?>"  size="5" /></td>
		</tr>
			
		<tr height="2px">
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr bgcolor="#EAEAEA">
			<td colspan="2"><h4>&nbsp;Domicilio Real</h4></td>
		</tr>
		<tr height="2px">
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td class="subtitle">Calle</td>
			<td><input type="text" name="direccion_calle_r" size="30" value="<?php echo $direccion_r_calle; ?>"></td>
		</tr>
		<tr>
			<td class="subtitle">Numero</td>
			<td><input type="text" name="direccion_nro_r" value="<?php echo $direccion_r_nro; ?>" size="5"></td>
		</tr>
		<tr>
			<td class="subtitle">Piso</td>
			<td><input type="text" name="direccion_piso_r" size="5" value="<?php echo $direccion_r_piso; ?>"></td>
		</tr>
		<tr>
			<td class="subtitle">Departamento Nro.</td>
			<td><input type="text" name="direccion_dpto_nro_r" value="<?php echo $direccion_r_dpto_nro; ?>" size="5"></td>
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
                    if ($f_provincia['codprovincia']==$direccion_r_provincia)
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
                    if ($f_departamento['id_localidades']==$direccion_r_localidad)
					    {
						  echo 'selected';
						 }
						echo '>'.$f_departamento['descripcion'];
				}
?>
                  </option>
			  </select>	
	</td>
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
			<td><input type="text" name="telefono1" maxlength="5" size="5" value="<?php echo $telefono[0];?>">                -<input type="text" name="telefono2" size="9"  maxlength="9" value="<?php echo $telefono[1];?>">
			</td>
		</tr>
		<tr>
			<td class="subtitle">Direccion E-mail</td>
			<td><input type="text" name="email" size="30" value="<?php echo $email; ?>"></td>
		</tr>
		<tr height="2px">
			<td colspan="2">&nbsp;</td>
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
			  </select>		
 
				  	</td>
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
			  </select>		
 		</td>
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
			<td class="subtitle">Situacion frente I.V.A.</td>
			<td><select name="iva_situacion">
					
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
			  </select>		
   	  	</td>
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
		
		<tr height=20px>
    <td colspan="2"><hr /></td>
  </tr>
 <tr>
		  <td>Observacion</td>
		  
		  <td><textarea name="observacion" cols="35" rows="1"  ><?php echo $observacion; ?> </textarea></td>
		</tr>		
		<tr height=20px>
			<td colspan="2"><hr></td>
		</tr>
		<tr>
		  <td colspan="2" align="center">
			<a href="indextesoreria.php?sec=contaduria/beneficiarios_aprobado&apli=tgpa&per=A"><img src="img/cancelar.jpg" width="60" height="20" border="0"/></a>
			&nbsp;&nbsp;&nbsp;<input type="submit" name="modi"  value="Modificar"></td>
		</tr>
		<tr>
			
		</tr>
	  </table>
</form>
</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>