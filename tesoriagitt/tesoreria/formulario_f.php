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
  $nombre_f = $f_beneficiario['nombre_f'];  
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
  $banco_nombre=$f_beneficiario['banco_nombre'];
  $banco_sucursal=$f_beneficiario['banco_sucursal'];
  $banco_cta_tipo=$f_beneficiario['banco_cta_tipo'];
  $banco_cta_nro=$f_beneficiario['banco_cta_nro'];
  $cbu=$f_beneficiario['cbu'];
  $banco_denominacion=$f_beneficiario['banco_denominacion'];
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
  $ganancia = $f_beneficiario['ganancia'];
  //$alicuota = $f_beneficiario['alicuota'];
  $ingreso = $f_beneficiario['ingreso'];
  $regimen = $f_beneficiario['regimen'];
  $seguridad = $f_beneficiario['seguridad'];
  $ingreso_bruto_ac=$f_beneficiario['ingreso_bruto_ac'];

   
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
   $observacion= $f_beneficiario['observacion'];
   
    $ganancia = $f_beneficiario['ganancia'];
  //$alicuota = $f_beneficiario['alicuota'];
  $ingreso = $f_beneficiario['ingreso'];
  $regimen = $f_beneficiario['regimen'];
  $seguridad = $f_beneficiario['seguridad'];
  $ingreso_bruto_ac=$f_beneficiario['ingreso_bruto_ac'];
   $t_c= $f_beneficiario['cuit_tipo'];
  	
	$ssql = "SELECT apellido,nombre,id_personas FROM usuarios, personas, permisos
WHERE docnro = personas_docnro
AND userid = usuarios_userid
AND aplicaciones_cod = 'tgp'";
     if (!($r_usuario= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo documento";
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
	$iva_situacion_n=$f_iva['nombre']; 
	
	
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
		
	 $ssql = "SELECT * FROM ganancias where id_ganancia='$ganancia'  order by nombre";
     if (!($r_ganancia= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }      
    $f_ganancia= mysql_fetch_array ($r_ganancia);
	$ganancia=$f_ganancia['nombre']; 	  

  $ssql = "SELECT * FROM ingreso_bruto  where id_ingreso='$ingreso' order by nombre ";
     if (!($r_ingreso= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }  
	
	 $f_ingreso= mysql_fetch_array ($r_ingreso);
	 $ingreso=$f_ingreso['nombre']; 	  
	
	$ssql = "SELECT * FROM regimen where id_regimen='$regimen' order by nombre ";
     if (!($r_regimen= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }   
	
	 $f_regimen= mysql_fetch_array ($r_regimen);
	 $regimen=$f_regimen['nombre']; 	  
	
	/*$ssql = "SELECT * FROM alicuota where id_alicuota='$alicuota'  order by nombre";
     if (!($r_alicuota= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    } 
	 $f_alicuota= mysql_fetch_array ($r_alicuota);
	$alicuota=$f_alicuota['nombre']; 	  
	*/
	
	$ssql = "SELECT * FROM seguridad_social where id_seguridad='$seguridad'  order by nombre ";
     if (!($r_seguridad= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }          
     $f_seguridad= mysql_fetch_array ($r_seguridad);
	 $seguridad=$f_seguridad['nombre']; 	  
     


 ?>   
<form action="indextesoreria.php?sec=tesoreria/aprobado" method="post">

<table border="0" align="center">
  <tr>
    <td colspan="2"><h1> Persona Fisica</h1></td>
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
			<td class="subtitle">Nombres Fantasia</td>
			<td><?php echo $nombre_f;  
				   		 
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
  </tr>
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
  <tr bgcolor="#EAEAEA">
    <td colspan="2"><h3>Datos Economicos</h3></td>
  </tr>
  <tr height=20px>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td class="subtitle">Actividad Principal</td>
    <td><?php  echo $actividad_p; ?>
    </td>
  </tr>
  <tr>
    <td class="subtitle">Fecha Inicio de Actividad 1º </td>
    <td><?php echo $fecha_p; ?>
       
    </td>
  </tr>
  <tr>
    <td class="subtitle">Actividad Secundaria</td>
    <td><?php echo $actividad_s; ?>
    </td>
  </tr>
  <tr>
    <td class="subtitle">Fecha Inicio de Actividad 2º</td>
    <td><?php  echo $fecha_s; ?>
    </td>
  </tr>
  <tr height=10px>
    <td colspan="2"></td>
  </tr>
  <tr bgcolor="#EAEAEA">
    <td colspan="2"><h3>Datos Comerciales</h3></td>
  </tr>
  <tr height=20px>
    <td colspan="2"></td>
  </tr>
  
  <tr>
    <td class="subtitle">Situacion frente I.V.A.</td>
    <td><?php echo $iva_situacion_n; ?>
    </td>
  </tr>
  <tr>
			<td class="subtitle">Ganancia</td>
		  <td><?php	echo $ganancia; ?>				  	</td>
		</tr>
	<!--	<tr>
			<td class="subtitle">Alicuota</td>
			<td>
<?php
         /*    	$f_alicuota = mysql_fetch_array ($r_alicuota);
                echo $f_alicuota['nombre'];  if ($alicuota =='N')
		          { 
?>
					  <img  src="../img/ic_advertencia.gif" border="0"></img> 
					  <font color="#FF0000">
					  <?php echo $error1;?>					  </font>
<?php                                }  			   
*/			   
?>				  	</td>
		</tr> -->
		<tr>
			<td class="subtitle">Ingreso Bruto</td>
			<td>
<?php
             	echo $ingreso; 
?>				  	</td>	  	
		</tr>
		
		
		
		<tr>
			<td class="subtitle" colspan="2" >Nro. Inscripcion Ingreso Bruto(Jurisdiccion la Rioja) 			
				<?php echo $ingreso_bruto;
			 	  
 ?>		 			</td>
		</tr>

        <tr>
			<td class="subtitle" colspan="2" >Nro. Inscripcion Ingreso Bruto (Adm. Central)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			  <?php echo $ingreso_bruto_ac;
			 
 ?>		 			</td>
		</tr>

		<tr>
			<td class="subtitle">Regimen de Convenio  </td>
			<td>
<?php
                echo $regimen;
?>				  	</td>
		</tr>
		<tr>
			<td class="subtitle">Seguridad Social</td>
			<td>
<?php
             	
                echo $seguridad;
?>				  	</td>
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
  
  <tr>
		  <td>Observacion</td>
		  
		  <td><input type="text" name="observacion" value="<?php echo $observacion; ?>" /></td>
		</tr>		
  <tr height=20px>
    <td colspan="2"><hr /></td>
  </tr>
   <tr>
		  <td>Usuarios</td>
		  
		  <td><select name="usuario">
					<option value="N" selected >Sin Especificar</option>
<?php     
       
                 while ($f_usuario = mysql_fetch_array ($r_usuario))
                      {
?>
                   <OPTION  value="<?php echo $f_usuario['id_personas']; ?>">
                    <?php echo $f_usuario['nombre'].' '.$f_usuario['apellido'];
					  ?>
					  </OPTION>
					  <?php
					   } ?>
           </select>
</td>
		</tr>		
  <tr height=20px>
    <td colspan="2"><hr /></td>
  </tr>
  <tr>
    <td align="center" colspan="2" >       

    <input type="hidden" name="id" value="<?php echo $id;?>" />
	<INPUT type="image" title="Aprobar" src="img/comprobacion.png"  name="grabar"  class="tabla_jugando" > </td>
	
  </tr>
  
</table>
</form> 
</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>