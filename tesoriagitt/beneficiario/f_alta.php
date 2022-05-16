<?php
error_reporting ( E_ERROR );
//conexion
	 include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');

///cuando viene de validar_f
 if (isset($_POST['modi']))
    {
 
  //cuitl
  
   $cuitl_1=$_POST['cuitl_1'];
   $cuitl_2=$_POST['cuitl_2'];
   $cuitl_3=$_POST['cuitl_3'];
   $t_c=$_POST['t_c'];
  
  //datos de identificacion
  
   $apellido= strtoupper($_POST['apellido']);
   $nombre = ucwords(strtolower($_POST['nombre']));   
   $nombre_f = ucwords(strtolower($_POST['nombre_f']));   
   $documento_tipo = $_POST['documento_tipo'];
   $documento_nro = $_POST['documento_nro'];
   $fecha_nacimiento=$_POST['fecha_nacimiento'];
   
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
   $banco_denominacion = $_POST['banco_denominacion'];
  
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
    $cuitl_1= base64_decode($_GET['c1']);
    $cuitl_2=base64_decode($_GET['c2']);
    $cuitl_3=base64_decode ($_GET['c3']);
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

	 $ssql = "SELECT * FROM `actividad` where estado='A'  order by id_actividad";
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


     $ssql = "SELECT * FROM iva  where id_iva !=4";
     if (!($r_iva= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
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
<form action="index.php?sec=beneficiario/validardatos_f" method="post" >	
<table border="0" cellpadding="0" align="center">
	<tr>
		<td colspan="2"><h1>Alta Persona Fisica</h1></td>
	</tr>
	<tr height=10px>
		<td colspan="2"><hr></td>
	</tr>
	<tr>
		<td class="subtitle">Nro. CUIL | CUIT</td>
		<td>
		<input type="text" name="cuitl_1" size="2" maxlength="2" value="<?php echo $cuitl_1; ?>" disabled /> - 
    	<input type="text" name="cuitl_2" size="8" maxlength="8" value="<?php echo $cuitl_2; ?>" disabled /> - 
		<input type="text" name="cuitl_3" size="1" maxlength="1" value="<?php echo $cuitl_3; ?>" disabled />
		<input type="hidden" name="cuitl_1" value="<?php echo $cuitl_1; ?>"> 
    	<input type="hidden" name="cuitl_2" value="<?php echo $cuitl_2; ?>" >
		<input type="hidden" name="cuitl_3" value="<?php echo $cuitl_3; ?>" >		</td>
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
		<td><input type="text" name="apellido" size="30" value="<?php echo $apellido; ?>"></td>
	</tr>
	<tr>
		<td class="subtitle">Nombres</td>
		<td><input type="text" name="nombre" size="30" value="<?php echo $nombre; ?>"></td>
	</tr>
    
    <tr>
		<td class="subtitle">Nombre Fantasia</td>
		<td><input type="text" name="fantasia" size="30" value="<?php echo $nombre_f; ?>"></td>
	</tr>
    
	<tr>
		<td class="subtitle">Tipo de Documento</td>
		<td>
		<select name="documento_tipo">
					<option value="N" selected >Sin Especificar</option>
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
          </select>		</td>
	  </tr>
		<tr>
			<td class="subtitle">Nro. de Documento</td>
			<td><input type="text" name="documento_nro1" value="<?php echo $cuitl_2;  ?>" size="8" maxlength="8" disabled>
			    <input type="hidden" name="documento_nro" value="<?php echo $cuitl_2;  ?>" size="8" maxlength="8"> </td>
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
			  </select>		  </td>
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
			<td colspan="2"><h4>&nbsp;Domicilio Real</h4></td>
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
			<td><input type="text" name="direccion_nro_r" value="<?php echo $direccion_nro_r; ?>" size="5"></td>
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
			<td colspan="2"><h4>&nbsp;Datos Económicos</h4></td>
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
			  </select>	  	  </td>
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
                                        if($fechais[2] == $diahtml){ echo 'selected';}
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
                                if($fechais[1] == $meshtml){ echo 'selected';}
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
                        if($fechais[0] == $anioactual){ echo 'selected';}
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
					<option value="4" selected >Sin Especificar</option>
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
				<input type="text" name="ingreso_bruto_2"  value="<?php echo $ingreso_bruto2; ?>"> - 
		  <input type="text" name="ingreso_bruto_3" size="2" maxlength="2" value="<?php echo $ingreso_bruto3; ?>">			</td>
		</tr>

        <tr>
			<td class="subtitle" colspan="2" >Nro. Inscripcion Ingreso Bruto (Adm. Central)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  <input type="text" name="ingreso_brutoc_1" size="3" maxlength="3" value="<?php echo $ingreso_bruto_ac1; ?>"> - 
				<input type="text" name="ingreso_brutoc_2"  value="<?php echo $ingreso_bruto_ac2; ?>"> - 
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
           </select>		  </td>
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
			<td height="31" class="subtitle">Denominacion de Cta</td>
		  <td><input type="text" name="banco_denominacion" size="22" maxlength="50" value="<?php echo $banco_denominacion; ?>"></td>
	  </tr>
        
	    <tr height=20px>
			<td colspan="2"><hr></td>
		</tr>
        
    <tr>
		  <td>Observacion</td>
		  
		  <td><input type="text" name="observacion" size="45"/></td>
		</tr>
		<tr height=20px>
			<td colspan="2"><hr></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" value="Enviar Datos">
				<input type="reset" value="Limpiar Datos">		    </td>
		</tr>
    </table>
</form>
</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>