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
    $cuit = $_POST['id'];
    $ssql = "SELECT * FROM `beneficiarios` WHERE cuitl='$cuit'";
     if (!($r_beneficiario= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }    
	 $f_beneficiario= mysql_fetch_array ($r_beneficiario);

    }
 else
   {
  $cuit = $_GET['id'];
 
    $ssql = "SELECT * FROM `beneficiarios` WHERE cuitl='$cuit'";
     if (!($r_beneficiario= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }    
  $f_beneficiario= mysql_fetch_array ($r_beneficiario); 
   }
  $cuitl = $f_beneficiario['cuitl'];
  $ape = $f_beneficiario['apellido'];  
  $nom = $f_beneficiario['nombre'];  
  $documento_tipo =$f_beneficiario['documento_tipo'];
  $documento_nro =$f_beneficiario['documento_nro'];
  $fecha_nacimiento=$f_beneficiario['fecha_nacimiento'];
  $fecha=split("-",$fecha_nacimiento);
  $fecha_nacimiento=$fecha[2].'-'.$fecha[1].'-'.$fecha[0]; 
  $direccion_r_calle=$f_beneficiario['direccion_r_calle'];
  $direccion_r_nro=$f_beneficiario['direccion_r_nro'];
  $direccion_r_piso=$f_beneficiario['direccion_r_piso'];
  $direccion_r_dpto_nro=$f_beneficiario['direccion_r_dpto_nro'];
  $direccion_r_provincia=$f_beneficiario['direccion_r_provincia'];
  $direccion_r_localidad=$f_beneficiario['direccion_r_localidad'];
  $codigo_r_postal=$f_beneficiario['codigo_r_postal']; 
 
    

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

//provincia

 $ssql = "SELECT * FROM `provincias` WHERE codprovincia='$direccion_r_provincia'";
     if (!($r_provincia1= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }    
	 $f_prov= mysql_fetch_array ($r_provincia1);
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
<form action="indextesoreria.php?sec=tesoreria/validardatos_s" method="post" >	
<input type="hidden" value="<?php echo $cuitl;?>"  name="cuitl" size="2" maxlength="2">
<input type="hidden" value="<?php echo $cuitl_1;?>"  name="cuitl_1" size="2" maxlength="2">
<input type="hidden" value="<?php echo $cuitl_2;?>"  name="cuitl_2" size="2" maxlength="2">
<input type="hidden" value="<?php echo $cuitl_3;?>"  name="cuitl_3" size="2" maxlength="2">


<!--datos identificacion -->
<input type="hidden" value="<?php echo $ape;?>"  name="apellido">
<input type="hidden" value="<?php echo $nom;?>" name="nombre" size="30">
<input type="hidden" value="<?php echo $documento_tipo;?>" name="documento_tipo" size="30">
<input type="hidden"  value="<?php echo $documento_nro;?>" name="documento_nro" />
<input type="hidden" value="<?php echo $fecha;?>" name="fecha_nacimiento" /><!--fecha ya concatenada -->

<!--domicilio real -->
<input type="hidden"  value="<?php echo $direccion_r_calle;?>" name="direccion_calle_r" size="30">
<input type="hidden" value="<?php echo  $direccion_r_nro;?>" name="direccion_nro_r" size="5">
<input type="hidden"  value="<?php echo $direccion_r_piso ;?>" name="direccion_piso_r" size="5">
<input type="hidden" value="<?php echo $direccion_r_dpto_nro;?>" name="direccion_dpto_nro_r" />
<input type="hidden" value="<?php echo $direccion_r_localidad ;?>" name="direccion_localidad_r" />
<input type="hidden" value="<?php echo $direccion_r_provincia; ?>" name="direccion_provincia_r" />
<input type="hidden" value="<?php echo $codigo_r_postal; ?>" name="codigo_postal_r" />

<table border="0" cellpadding="0" align="center">
	<tr>
		<td colspan="2"><h1>Alta Otros Beneficiarios</h1></td>
	</tr>
	<tr height=10px>
		<td colspan="2"><hr></td>
	</tr>
	<tr>
	<tr>
    <td class="subtitle">Nro. CUIL | CUIT</td>
    <td><?php echo $cuitl; ?></td>
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
		<td><input type="text" name="area" size="50" value="<?php echo $area; ?>"></td>
	</tr>
	<tr>
		<td class="subtitle">Cargo</td>
		<td><input type="text" name="cargo" size="30" value="<?php echo $cargo; ?>"></td>
	</tr>
<?php 
     $fechac=split("-",$fecha_cargo);
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
					
		<tr height="2px">
			<td colspan="2">&nbsp;</td>
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
			<td><input type="text" name="banco_cbu" size="22" maxlength="22" value="<?php echo $banco_cbu; ?>"></td>
		</tr>
	
		<tr height=20px>
			<td colspan="2"><hr></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" value="Enviar Datos">
				<input type="reset" value="Limpiar Datos">		
		    </td>
		</tr>
	  </table>
</form>
</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>