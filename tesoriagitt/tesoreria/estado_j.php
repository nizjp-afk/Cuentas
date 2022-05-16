<?php
error_reporting ( E_ERROR ); 
 $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];

  include('incluir_siempre.php');
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    //include('conexion/extras.php');
    
    $id = $_GET['id'];
	 $ssql = "SELECT * FROM beneficiarios_aprobados  ";
     if (!($r_cesion= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }    
	
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
   $ingreso_bruto = $f_beneficiario['ingreso_bruto'];
   $iva_situacion = $f_beneficiario['iva_situacion'];
   $convenio_tipo = $f_beneficiario['convenio_tipo'];
   $convenio_nro = $f_beneficiario['convenio_nro'];
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
   $inhi= $f_beneficiario['inhi'];
    $bene_cesion= $f_beneficiario['bene_cesion'];

  	

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

 ?>   
<form action="indextesoreria.php?sec=tesoreria/update_estado&apli=tgpc&per=H" method="post">

<input type="hidden" name="id_bene" value="<?php echo $id;?>" >
<input type="hidden" name="cuit" value="<?php echo $cuitl;?>" >

<table border="0" align="center">
  <tr>
    <td colspan="2"><h1> Persona Juridica</h1></td>
  </tr>
  <tr height=10px>
    <td colspan="2"><hr /></td>
  </tr>
  <tr>
    <td class="subtitle">Nro. CUIL | CUIT</td>
    <td><?php echo $cuitl; ?></td>
  </tr>
  <tr height=10px>
    <td colspan="2"><hr /></td>
  </tr>
  <tr bgcolor="#D6DFE3">
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
 
 
 
  
  <tr height=20px>
    <td colspan="2"></td>
  </tr>
  <tr bgcolor="#D6DFE3">
    <td colspan="2"><h3>Componentes de la Sociedad o Autoridades en Ejercicio </h3></td>
  </tr>
  <tr height=20px>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td colspan="2"><table width="365" height="89" border="0" >
      <tr>
        <td width="110" height="28" align="center">Apellido</td>
        <td align="center" width="120">Nombre</td>
        <td align="center" width="42">D.N.I</td>
        <td align="center" width="42">Cargo</td>
      </tr>
      <tr> 
      <td colspan="4"> <hr /></td>
      </tr>
    <tr>
      <tr>
        <td height="15"><?php echo $apellido1; ?>
        </td>
        <td><?php echo $nombre1; ?>
        </td>
        <td><?php echo $dni1; ?>
        </td>
        <td><?php echo $cargo1; ?>
        </td>
      </tr>
      <tr>
        <td height="15"><?php echo $apellido2; 	    
?>
        </td>
        <td><?php  echo $nombre2;
				
?>
        </td>
        <td><?php echo $dni2; 
				
?>
        </td>
        <td><?php  echo $cargo2;
				
?>
        </td>
      </tr>
      <tr>
        <td height="15"><?php
                    echo $apellido3; 
			?>
        </td>
        <td><?php
                    echo $nombre3; 
			?>
        </td>
        <td><?php
                    echo $dni3; 
			?>
        </td>
        <td><?php
                    echo $cargo3;
					
?>
        </td>
      </tr>
      <tr>
        <td height="15"><?php
                    echo $apellido4; 
				?>
        </td>
        <td><?php
                    echo $nombre4; 
				?>
        </td>
        <td><?php
                    echo $dni4; 
				?>
        </td>
        <td><?php
                    echo $cargo4;
					
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
    <td></td>
  </tr>
  <tr>
    <td class="subtitle">Nro. C.B.U.</td>
    <td><?php echo $cbu; ?></td>
  </tr>
  <tr>
    <td class="subtitle">Inhibicion</td>
    <td><?php if ($inhi=='')
    {
?>		

    
   <select name="inhi" size="1">
	         
			 <option value="Notificado" selected>Notificado</option>
			 <option value="Inhibido">Inhibido</option>
		</select>	
        
<?php
	}
else 
   {
?>
   <select name="inhi" size="1">
	       
			 <option value="Notificado" <?php if ($inhi=='Notificado') { echo "selected"; }?> >Notificado</option>
			          
			 <option value="Inhibido" <?php if ($inhi=='Inhibido') { echo "selected"; }?> >Inhibido</option>
		</select>	
<?php	   
	   
   }
?>	
	 </td>
  </tr>
  
  <tr>
		  <td>Motivo
		  <td><input type="text" name="motivo" size="50"  /></td>
		</tr>
  <tr height=20px>
    <td colspan="2"><hr /></td>
  </tr>
  
 <tr>
    <td align="center" colspan="2"><input type="submit" name="modi" value="Modificar" /></a></td>
  </tr>
  
</table>
</form> 
</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>