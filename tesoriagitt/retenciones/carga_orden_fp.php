<?php
//conexion
 error_reporting (E_ERROR); 
$aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
	 include('incluir_siempre.php');
	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');

     $ssql = "SELECT * FROM iva ";
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

$band=$_GET['band'];
  
///cuando viene de validar_f
 if (isset($_POST['aceptar']))
    {
	 $id=$_POST['orden'];
		 
		
	
	
    }
else
    {
	if ($band=='M')
	   {
	    $id=$_POST['orden'];
		 
	   }
	else
	   {
	   $orden='';
	   }
	}	
?>	 
<div class="content">
<?php
   if($id=='')
     {
		 include('dgti-mysql-var_dbtgp.php');
		 include('dgti-intranet-mysql_connect.php');  
		 include('dgti-intranet-mysql_select_db.php');
		 
		 
		 
		 $ssql = "SELECT * FROM orden_pago
		          where EJERCICIO > 2009
				  AND (ESTADO !='C' )
		          order by FORMULARIO,SAF,NUMERO";
     if (!($r_retenciones= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de cargar orden de pago tgp";
      echo $cuerpo1;
      //.....................................................................
    } 
		 
?>	 	
<form action="indextesoreria.php?sec=retenciones/carga_orden_fp&apli=cr&per=R" method="post" >	

<table border="0" cellpadding="0" align="center">
	<tr>
		<td colspan="3"><h1>Seleccionar Orden de Pago</h1></td>
	</tr>
	<tr height=10px>
		<td colspan="3"><hr></td>
	</tr>
	<tr>
		<td width="130" class="subtitle">OP NUMERO</td>
		<td width="244">
		<select name="orden"  <?php if (!($id=='')){?>disabled <?php } ?> >
               <option value="N" selected >Sin Especificar</option>
<?php     
     //   echo "La sentencia se ejecut� correctamente";
       while ($fila =  mysql_fetch_array($r_retenciones))
	   {
	     //echo 'paso';
		  $id=$fila['CLAVE'];
		  $orden=$fila['NUMERO'];
          $ejer=$fila['EJERCICIO'];
		  $saf_dd=$fila['SAF'];
		  $num=$fila['FORMULARIO'];
?>
           <OPTION value="<?php echo $id;?>" 
<?php		   		  
		  
		  if ($orden == $op_numero) 
		    {
     	       echo "selected";
         
          	 }
		   
             echo ">".$num.'-'.$saf_dd.'-'.$orden.' - '.$ejer;
          
      }
?>
    </OPTION>
</select>
                                     
 
    <td><input type="submit" name="aceptar" value="Aceptar" />
	</td>               
	</tr>
	<tr height=10px>
		<td colspan="3"><hr></td>
	</tr>
</table>
</form>
<?php 
}
if ((isset($_POST['aceptar'])) or ($band=='M'))
   {


              //conexion a dbtgp
			  include('dgti-mysql-var_dbtgp.php');
		      include('dgti-intranet-mysql_connect.php');  
		      include('dgti-intranet-mysql_select_db.php');
		 
		 
		     $ssql = "SELECT * FROM orden_pago
			            where CLAVE='$id' 
						";
			 if (!($r_ord= mysql_query($ssql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar tipo de orden de pago";
					  echo $cuerpo1;
					  //.....................................................................
					}  
	
	        $f_orden =  mysql_fetch_array($r_ord);
			
		 
			 
			 $cuit=$f_orden['CUIT'];
			 $orden=$f_orden['NUMERO'];
			 $op_saf=$f_orden['SAF'];
			 $ejer_op=$f_orden['EJERCICIO'];
			   $num=$f_orden['FORMULARIO']; 
			    $est=$f_orden['ESTADO']; 
			 
			 if($est=='A'){$valor='BAJA';}
			 if($est=='B'){$valor='BLOQUEADA';}
			  if($est=='I'){$valor='IMPUESTO';}
			    if($est=='P'){$valor='PENDIENTE';}
			  
			 
			 $orden1=$num.'-'.$op_saf.'-'.$orden;
				//conexion beneficiarios
				include('dgti-mysql-var_dgti-beneficiarios.php');
				include('dgti-intranet-mysql_connect.php');  
				include('dgti-intranet-mysql_select_db.php');
				
			 $ssql = "SELECT * FROM historial_orden
			            where numero_op='$orden1'
						and ejercicio='$ejer_op'
						and saf='$op_saf'
						";
			 if (!($r_hist= mysql_query($ssql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar tipo de iva";
					  echo $cuerpo1;
					  //.....................................................................
					}  
	
	        $f_hist =  mysql_fetch_array($r_hist);
			$obser = nl2br($f_hist['observacion']);
			
		
		
		  
	  $ssql = "SELECT * FROM `beneficiarios_aprobados` WHERE cuitl='$cuit'";
     if (!($r_beneficiario= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }    
	 $f_beneficiario= mysql_fetch_array ($r_beneficiario);

	      $id_b = $f_beneficiario['id_beneficiario'];  
		  $cuitl = $f_beneficiario['cuitl'];
		  $ape = $f_beneficiario['apellido'];  
		  $nom = $f_beneficiario['nombre'];
		  $razon_social = $f_beneficiario['razon_social'];   
		  $iva_situacion = $f_beneficiario['iva_situacion'];	  
		  $ganancia = $f_beneficiario['ganancia'];	  
		//  $alicuota = $f_beneficiario['alicuota'];	  
		  $ingreso = $f_beneficiario['ingreso'];
          $regimen = $f_beneficiario['regimen'];
		  $seguridad = $f_beneficiario['seguridad'];	
		  
		  
		  
	
			
			 $cant = mysql_num_rows($r_ord);
			 
			 /*if ($cant > 0)
			   {*/
			
			  $total=$f_orden['IMP_FORM'];
			  $fecha=$f_orden['FECHA_OP'];	    
			//   }
			   
			/*    $ssql = "SELECT * FROM op_pendientes_fp_ch
			            where Numero_op='$orden'
						and Ejercicio='$ejercicio'
						and Saf='$op_saf'";
			 if (!($r_ord_fp= mysql_query($ssql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar tipo de iva";
					  echo $cuerpo1;
					  //.....................................................................
					}  
	
	        $f_orden_fp =  mysql_fetch_array($r_ord_fp);
			
			 $cant_fp = mysql_num_rows($r_ord_fp);
			 
			 if ($cant_fp > 0)
			   {
			
			 $total=$f_orden_fp['importe'];
			  $fecha=$f_orden_fp['fecha'];	    
			   }*/

?>	
<br />
<br />

  
<form action="indextesoreria.php?sec=retenciones/generar_liquidacion_fp&apli=cr&per=R" method="post" >	

<table border="0" align="center" width="80%" >
  
<input type="hidden" name="orden" value="<?php echo $orden; ?>" /> 
<input type="hidden" name="id_b" value="<?php echo $id_b; ?>" />
<input type="hidden" name="id_o" value="<?php echo $id; ?>" />
<input type="hidden" name="band" value="<?php echo $band; ?>" />  
<input type="hidden" name="ganancia_b" value="<?php echo $ganancia; ?>" />  
<input type="hidden" name="ingreso_bruto_b" value="<?php echo $ingreso; ?>" />  
<input type="hidden" name="fecha_t" value="<?php echo $fecha ; ?>" />  

    <tr height=10px>
    <td colspan="2"><hr /></td>
  </tr>
   <tr>
    <td colspan="2"><h1 align="center"> ORDEN DE PAGO</h1></td>
  </tr>
   <tr height=10px>
    <td colspan="2"><hr /></td>
  </tr>
  <tr>
      <td width="140" class="subtitle">OP</td>
	  <td width="208"><?php echo $orden;?></td>
  </tr>
  <TR> 	  
	  <td class="subtitle">Fecha </td>
	  <td><?php echo $fecha;?></td>
  </TR>
  <TR>	  
      <td class="subtitle">Saf </td>
	  <td><?php echo $op_saf;?></td>
  </TR>
  <TR>	  
      <td class="subtitle">Nro. CUIL | CUIT</td>
	  <td><?php echo $cuit;?></td>
  </TR>
  <TR>	  
      <td class="subtitle">Beneficiario</td>
      <td><?php if ($razon_social==''){ echo $ape.','.$nom; }else { echo $razon_social; }?></td>
  </tr>

   <TR>	  
      <td class="subtitle">Observacion</td>
	  <td> <textarea name="obser_ant" rows="3" cols="35" disabled><?php echo $obser ?></textarea></td>
  </TR>
    <TR bgcolor="#FFCB97">	  
      <td  class="subtitle">Estado</td>
	  <td ><strong> <?php echo $valor ?></strong></td>
  </TR>


<TR>
   <TD colspan="2">&nbsp;</TD>
</TR>
<tr> <td colspan="2"> <?php if($est=='A' or $est=='P' )
{
?>
 <tr><td colspan="2" align="center">
  
  <input type="button" value="Regresar" onclick="javascript:window.history.back()"    /> </td></tr>
 
 <?php 
 }
 ?>
</table>
<?php 
   if($est=='I' or $est=='B')
    {
?>	 
<table border="0" align="center">
 <tr height=10px>
    <td colspan="2">&nbsp; </td>
  </tr>
<tr>
    <td colspan="2" width="80%"><h1 align="center"> SITUACION DEL CONTRIBUYENTE</h1></td>
  </tr>
   <tr height=10px>
    <td colspan="2"><hr /></td>
  </tr>
   <tr>
			<td width="353" class="subtitle">Situacion frente I.V.A.</td>
			<td width="180"><select name="iva_situacion" <?php if (!($band=='M')){?>disabled <?php }?>>
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
		  <td><select name="ganancia" <?php if (!($band=='M')){?>disabled <?php }?>>
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
		<tr>
			<td class="subtitle">Ingreso Bruto</td>
			<td><select name="ingreso" <?php if (!($band=='M')){?>disabled <?php }?>>
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
			<td class="subtitle">Regimen de Convenio  </td>
			<td><select name="regimen" <?php if (!($band=='M')){?>disabled <?php }?>>
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
			<td><select name="seguridad" <?php if (!($band=='M')){?>disabled <?php }?>>
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

		<tr>
			<td colspan="2" align="center">
				<?php if ($band=='M')
				    {
				?>
				 <input type="submit" value="Modificar - Generar Liquidacion" name="generar">               <?php
					}
				   else
				    {
				 ?>
				  	<input type="submit" value="Generar Liquidacion" name="generar">
                    
                <?php 
					}
				?>
       </td>
      </tr> 
     </table>     
     
</form> 
 
<?php if (!($band=='M'))
				    {
?>						
<form action="indextesoreria.php?sec=retenciones/carga_orden_fp&apli=cr&per=R&band=M" method="post" >
<input type="hidden" name="orden" value="<?php echo $orden; ?>" /> 
<input type="hidden" name="id_b" value="<?php echo $id_b; ?>" />
<input type="hidden" name="orden" value="<?php echo $id; ?>" />

<table border="0" align="center" width="102%">           	
               <tr>
               
                 <td align="center">
                  <input type="submit" value="Modificar Datos" name="modificar">
                 </td>
               </tr>
</table>                  
</form>                    
		
<?php	   
		}
     }
}	 
?>	
</div>

<div class="sidenav">
<h2></h2>
<ul>
 
      <li><a href="indextesoreria.php?sec=tesoreria/index1&apli=tgp&per=C">Regresar Menu</a></li>
	
	<!-- <li><a href="indextesoreria.php?sec=tesoreria/saf_consulta&apli=tgpc&per=A">Beneficiarios - SAF</a> </li>-->
</ul>
</div>

<div class="clearer"><span></span></div>