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
 
   // id
    $id=$_POST['id_bene'];
 
  //cuitl
  
   $cuitl_1=$_POST['cuitl_1'];
   $cuitl_2=$_POST['cuitl_2'];
   $cuitl_3=$_POST['cuitl_3'];
  
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
 
   $ingreso_bruto = $_POST['ingreso_bruto'];
   $iva_situacion = $_POST['iva_situacion'];
   $convenio_tipo = $f_beneficiario['convenio_tipo'];
   $convenio_nro = $f_beneficiario['convenio_nro'];  
    $ingreso_bruto1=substr($ingreso_bruto,0,-7);
    $ingreso_bruto2=substr($ingreso_bruto,3,-1);
    $ingreso_bruto3=substr($ingreso_bruto,-1);
   
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
    $banco_nombre=$f_beneficiario['banco_nombre'];
    $banco_sucursal=$f_beneficiario['banco_sucursal'];
    $banco_cta_tipo=$f_beneficiario['banco_cta_tipo'];
    $banco_cta_nro=$f_beneficiario['banco_cta_nro'];
    $cbu=$f_beneficiario['cbu'];
     $ingreso_bruto = $f_beneficiario['ingreso_bruto'];
	 $ingreso_bruto1=substr($ingreso_bruto,0,-7);
    $ingreso_bruto2=substr($ingreso_bruto,3,-1);
    $ingreso_bruto3=substr($ingreso_bruto,-1);
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
<form action="indextesoreria.php?sec=contaduria/validardatoscta&apli=tgpa&per=M" method="post" >	
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
		<input type="hidden" value="<?php echo $ape;?>"  name="apellido">
        <input type="hidden" value="<?php echo $nom;?>" name="nombre" size="30">
        <input type="hidden" value="<?php echo $documento_tipo;?>" name="documento_tipo" size="30"> 
        <input type="hidden"  value="<?php echo $documento_nro;?>" name="documento_nro" />
        <input type="hidden" value="<?php echo $fecha;?>" name="fecha_nacimiento" /><!--fecha ya concatenada -->

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
		<td><input type="text" name="apellido" size="30" value="<?php echo $ape; ?>" disabled></td>
	</tr>
	<tr>
		<td class="subtitle">Nombres</td>
		<td><input type="text" name="nombre" size="30" value="<?php echo $nom; ?>" disabled></td>
	</tr>
	<tr>
		<td class="subtitle">Tipo de Documento</td>
		<td>
		<input type="hidden" name="documento_tipo" value="<?php echo $documento_tipo; ?>" disabled/>
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
			<td><input type="text" name="banco_cbu" size="22" maxlength="22" value="<?php echo $cbu; ?>"></td>
		</tr>
			
		<tr height=20px>
			<td colspan="2"><hr></td>
		</tr>
		<tr>
		  <td colspan="2" align="center">
		  <a href="indextesoreria.php?sec=tesoreria/beneficiarios_aprobado_modi&apli=tgpa&per=A"><img src="img/cancelar.jpg" width="60" height="20" border="0"/></a>
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