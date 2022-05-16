<?php
error_reporting ( E_ERROR ); 
//conexion
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
    $t_c=$_POST['t_c'];
  
  //datos de identificacion
  
   $ape= strtoupper($_POST['apellido']);
   $nom = ucwords(strtolower($_POST['nombre']));   
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
   $codigo_f_postal = $_POST['codigo_postal_f'];
  
  //direccion real
  
   $direccion_r_calle = $_POST['direccion_calle_r'];
   $direccion_r_nro = $_POST['direccion_nro_r'];
   $direccion_r_piso = $_POST['direccion_piso_r'];
   $direccion_r_dpto_nro = $_POST['direccion_dpto_nro_r'];
   $direccion_r_localidad = $_POST['direccion_localidad_r'];
   $direccion_r_provincia = $_POST['direccion_provincia_r'];
   $codigo_r_postal = $_POST['codigo_postal_r'];
  
  //otros datos
  
   $telefono =split("-",$_POST['telefono']);
   $email = $_POST['email'];
   $observacion = $_POST['observacion'];
  
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

    $cargo=$_POST['cargo'];
  $saf=$_POST['saf'];
  $area=$_POST['area'];
  $fecha_c=$_POST['fecha_gestion'];
   
   }
 else
   {
    $id = $_GET['id'];
    $ssql = "SELECT * FROM `beneficiarios` WHERE id_beneficiario='$id'";
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
     $documento_tipo =$f_beneficiario['documento_tipo'];
     $documento_nro =$f_beneficiario['documento_nro'];
     $fecha_nacimiento=$f_beneficiario['fecha_nacimiento'];
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
  $cargo=$f_beneficiario['cargo'];
  $saf=$f_beneficiario['saf'];
  $area=$f_beneficiario['area'];
  $fecha_c=$f_beneficiario['fecha_gestion'];
 
  $telefono =split("-",$telefono);
    
    $cuitl= str_replace('-', '', $cuitl);
	$cuitl_1 = substr($cuitl,0,2);
	$cuitl_2 = substr($cuitl,2,8);
	$cuitl_3 = substr($cuitl,10,2);
	
	   $t_c= $f_beneficiario['cuit_tipo'];
	
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
      $cuerpo1  = "al intentar buscar sociedades";
      echo $cuerpo1;
      //.....................................................................
    }        


     $ssql = "SELECT * FROM iva ";
     if (!($r_iva= mysql_query($ssql, $conexion_mysql)))
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
<form action="indextesoreria.php?sec=tesoreria/validardatos_o&apli=tgp&per=O" method="post" >	
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
		<td >Tipo de Cuit/Cuil</td>
        <td ><select name="t_c" >
        <?php  if ($t_c=='N'){$s= " selected";}?>
              <option value="N" <?php echo $s;$s='';?>>Seleccionar</option>
              
          <?php  if ($t_c=='1'){$s= " selected";}?>
              <option value="1" <?php echo $s;$s='';?>>CUIT</option>
              
               <?php  if ($t_c=='2'){$s= " selected";}?>
              <option value="2" <?php echo $s;$s='';?>>CUIL</option>     
        </select></td>
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
     $fechan=split("-",$fecha_nacimiento);
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
                                        if($fechan[2] == $diahtml){ echo ' selected';}
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
                                if($fechan[1] == $meshtml){ echo ' selected';}
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
                        if($fechan[0] == $anioactual){ echo ' selected';}
                        echo ">".$anioactual."</option>";
                        $anioactual=$anioactual-1;
                        }
						
?>
                     </select> </td>
		</tr>
        <tr>
		<td class="subtitle">Area de Gobierno</td>
		<td><input type="text" name="area" size="50" value="<?php echo $area; ?>"></td>
	</tr>
	<tr>
		<td class="subtitle">Cargo</td>
		<td><input type="text" name="cargo" size="30" value="<?php echo $cargo; ?>"></td>
	</tr>
<?php 
     $fechac=split("-",$fecha_c); 
?>		
	<tr>
			<td class="subtitle">Fecha Inicio de Gestion</td>
			<td><select name="f_cd" id="diasol" class="style11" >
                    <option  value="--" >D&iacute;a</option>
                    <?php
                                $diahtml="";
                                for ($i=1; $i<32; $i++)
                                {
                                        $diahtml= $i; if ($i<10) {$diahtml= "0".$i;}
                                        echo "<option value='$diahtml'";
                                        if($fechac[2] == $diahtml){ echo ' selected';}
                                        echo ">".$diahtml."</option>";
                                }  ?>
                  </select>
                    <select name="f_cm" id="messol" class="style11">
                      <option  value="--">Mes</option>
                      <?php
                                 $meses= array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto',
                                        'Septiembre','Octubre','Noviembre','Diciembre');
                                $meshtml="";
                                for ($i=1;$i<13;$i++)
                                {
                                $meshtml= $i; if ($i<10) {$meshtml= "0".$i;}
                                echo "<option value='$meshtml'";
                                if($fechac[1] == $meshtml){ echo ' selected';}
                                echo ">".$meses{$i-1}."</option>";
                                } ?>
                    </select>
                     <select name="f_ca" id="anosol"  class="style11">
                      <option  value="----">A&ntilde;o</option>
                      <?php
                        $fechaactual=strtotime('now');
                        $anioactual=substr(date('d/m/Y',$fechaactual),6,4);
                       // $anioactual=$anioactual-18;
						for ($i=1;$i<90;$i++)
                        {
                       echo "<option value='$anioactual'";
                        if($fechac[0] == $anioactual){ echo ' selected';}
                        echo ">".$anioactual."</option>";
                        $anioactual=$anioactual-1;
                        }
						
?>
                     </select> </td>
		</tr>
		<tr>
		<td class="subtitle">SAF Nº</td>
		<td><input type="text" name="saf" size="30" value="<?php echo $saf; ?>"></td>
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
			<td><input type="text" name="codigo_f_postal" value="<?php echo $codigo_f_postal; ?>"  size="5" /></td>
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
			<td><input type="text" name="codigo_r_postal" size="5" value="<?php echo $codigo_r_postal; ?>"></td>
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
			<td><input type="text" name="banco_cta_nro" size="12" maxlength="11" value="<?php echo $banco_cta_nro; ?>"></td>
		</tr>
		<tr>
			<td class="subtitle">Nro. C.B.U.</td>
			<td><input type="text" name="banco_cbu" size="22" maxlength="22" value="<?php echo $cbu; ?>"></td>
		</tr>
			
		<tr height=20px>
			<td colspan="2"><hr></td>
		</tr>
		 <tr>
		  <td>Observacion
		  <td><input type="text" name="observacion" value="<?php echo $observacion; ?>"</td>
		</tr>
  <tr height=20px>
    <td colspan="2"><hr /></td>
  </tr>
		<tr>
		  <td colspan="2" align="center">
			<input type="submit" name="modi"  value="Modificar"></td>
		</tr>
		<tr>
			
		</tr>
	  </table>
</form>
</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>