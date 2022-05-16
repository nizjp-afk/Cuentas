 <?php
error_reporting ( E_ERROR ); 
//conexion
	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	
	
   $fechaant = $_POST['firstinput'];
   $fechahoy = $_POST['secondinput']; 
	
	
   $fechaa= date("d-m-Y", strtotime("$fechaant"));  
    $fechah= date("d-m-Y", strtotime("$fechahoy"));
	 
	//$fechaa = $_POST['diad'].'-'.$_POST['mesd'].'-'.$_POST['anod'];
   // $fechah = $_POST['diah'].'-'.$_POST['mesh'].'-'.$_POST['anoh']; 
 	$id = $_POST['id'];
  
	
	$ssql = "SELECT *
FROM `codigo_retencion` ";
     if (!($r_codigo= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar codigo";
      echo $cuerpo1;
      //.....................................................................
    }   
	
	$ssql = "SELECT *
FROM `ret_esidif` ";
     if (!($r_e_codigo= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar codigo";
      echo $cuerpo1;
      //.....................................................................
    }    
	 
	
	
	$ssql = "SELECT * FROM `beneficiarios_aprobados` WHERE id_beneficiario='$id'";
     if (!($r_beneficiario= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar beneficiario";
      echo $cuerpo1;
      //.....................................................................
    }    
	 $f_beneficiario= mysql_fetch_array ($r_beneficiario);

	   
  $cuitl = $f_beneficiario['cuitl'];
  $ape = $f_beneficiario['apellido'];  
  $nom = $f_beneficiario['nombre'];  
  $razon_social = $f_beneficiario['razon_social'];  
 
 
  $ingreso_bruto = $f_beneficiario['ingreso_bruto'];
  $iva_situacion = $f_beneficiario['iva_situacion'];
  $ganancia = $f_beneficiario['ganancia'];
  $ingreso = $f_beneficiario['ingreso'];
  $regimen = $f_beneficiario['regimen'];
  $seguridad = $f_beneficiario['seguridad'];
  $ingreso_bruto_ac=$f_beneficiario['ingreso_bruto_ac'];



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
     
   
	
///////////////////////////////////////////////////////////////////////////////////////

    
$ssql="SELECT  DISTINCT orden_pago, orden_pago.total FROM `orden_pago`
		WHERE (
		(
		orden_pago.`cuit` ='$cuitl'
		)
        AND (
		`orden_pago`.`fecha` >= '$fechaant'
		)
		AND (
		`orden_pago`.`fecha` <= '$fechahoy'
		)
		
		
)";


 if (!($r_tn= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar total retencion";
      echo $cuerpo1;
      //.....................................................................
    }          

$ssql="SELECT DISTINCT orden_pago,orden_pago.importe FROM `orden_pago`
		WHERE (
		(
		orden_pago.`cuit` ='$cuitl'
		)
        AND (
		`orden_pago`.`fecha` >= '$fechaant'
		)
		AND (
		`orden_pago`.`fecha` <= '$fechahoy'
		)
		
		
)";


 if (!($r_tb= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar total retencion1";
      echo $cuerpo1;
      //.....................................................................
    }          
///////////////////////////
$ssql="SELECT  DISTINCT orden_pago, orden_pago_fp.total FROM `orden_pago_fp`
		WHERE (
		(
		orden_pago_fp.`cuit` ='$cuitl'
		)
        AND (
		`orden_pago_fp`.`fecha` >= '$fechaant'
		)
		AND (
		`orden_pago_fp`.`fecha` <= '$fechahoy'
		)
		
		
)";


 if (!($r_pn= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar total retencion";
      echo $cuerpo1;
      //.....................................................................
    }          

$ssql="SELECT DISTINCT orden_pago,orden_pago_fp.importe FROM `orden_pago_fp`
		WHERE (
		(
		orden_pago_fp.`cuit` ='$cuitl'
		)
        AND (
		`orden_pago_fp`.`fecha` >= '$fechaant'
		)
		AND (
		`orden_pago_fp`.`fecha` <= '$fechahoy'
		)
		
		
)";


 if (!($r_pb= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar total retencion1";
      echo $cuerpo1;
      //.....................................................................
    }          



/*$ssql="SELECT `orden_pago`.`orden_pago` , `dd_retenciones`.`dd_codigo` ,`orden_pago`.total as impneto
		FROM `dd_retenciones` , `orden_pago`
		WHERE (
		`orden_pago`.`cuit` = dd_retenciones.dd_cuit
		)
		AND (
		`dd_retenciones`.`dd_cuit` ='$cuitl'
		)
		AND orden_pago.orden_pago = dd_retenciones.orden
		AND (
		`orden_pago`.`fecha` >= '$fechaant'
		)
		AND (
		`orden_pago`.`fecha` <= '$fechahoy'
		)
		AND (orden_pago.ejercicio = dd_retenciones.ejercicio)
	    ";

		 if (!($r_ddn= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar deduccion";
			  echo $cuerpo1;
			  //.....................................................................
			}        
	
	   
	   while ($f_ddn= mysql_fetch_array ($r_ddn))
	      {
			 $neto=$f_ddn['impneto'];
			 $dd_tn=$dd_tn+$neto;
		  }
*/

?>

<html>
<div class="content">
<table border="0" align="center" width="90%" >
 <tr height=10px>
    <td colspan="2">&nbsp; </td>
  </tr>
  <tr>
		<td height="43" colspan="2" ><h2 align="center"><font color="#456"> MODULO DE IMPUESTOS Y RETENCIONES</font></h2>  </td>
   </tr>
     
   <tr height=10px>
    <td colspan="2"><hr /></td>
  </tr>
   <tr>
          <td colspan="2" class="subtitle"><div align="left" ><strong> Nro. CUIL | CUIT :<?php echo $cuitl; ?></strong></div></td>
    </TR><br>
   <TR>	  
      <td colspan="2" class="subtitle"><br><div align="left"><strong>
        <?php if ($razon_social=='')
	               {
				    echo $ape.' '.$nom; 
								
					}
				else 
				   {
				    echo $razon_social;
					}
			?>
         </strong></div></td>
         </tr>
        
   <tr height=10px>
    <td colspan="2"><hr /></td>
  </tr>
   <tr>
			<td width="255" class="subtitle">Situacion frente I.V.A.:</td>
			<td width="420"><?php echo $iva_situacion_n; ?>	</td>
	</tr>
	 <tr height=10px>
    <td colspan="2"><hr /></td>
  </tr>
		<tr>
			<td class="subtitle">Ganancia:</td>
		  <td><?php echo $ganancia; ?></td>
		</tr>
	 <tr height=10px>
    <td colspan="2"><hr /></td>
  </tr>	
		<tr>
			<td class="subtitle">Ingreso Bruto:</td>
			<td><?php echo $ingreso; ?>  	</td>
		</tr>
		
		 <tr height=10px>
    <td colspan="2"><hr /></td>
  </tr>		

		<tr>
			<td class="subtitle">Regimen de Convenio: </td>
			<td><?php echo $regimen; ?></td>
		</tr>
		 <tr height=10px>
    <td colspan="2"><hr /></td>
  </tr>
		<tr>
			<td class="subtitle">Seguridad Social:</td>
			<td><?php echo $seguridad; ?>   	  	</td>
		</tr>
		
		
		
		
 </tr>
	 <tr height=10px>
    <td colspan="2"><hr /></td>
  </tr>
	
</table>

<table border="0" align="center" width="90%" >
 <tr height=10px>
    <td colspan="3">&nbsp; </td>
  </tr>
 
  <tr>
  
		<td width="310" align="center" class="subtitle"><strong>Denominacion</strong></td>
        <td width="80" align="center" class="subtitle"><strong>Codigo</strong></td>
        <td width="120" align="center" class="subtitle"><strong>Importe</strong></td>
	</tr>
  	 <tr height=10px>
    <td colspan="3"><hr /></td>
  </tr>  
  
<?php
$sumret=0;
$bruto=0;
$liquido=0;

$dd_tb=0;
while ($f_codigo= mysql_fetch_array ($r_codigo))
   {
	    $sumcod=0;
	   	$codigo=$f_codigo['codigo'];
		$dd_nombre=$f_codigo['nombre'];
	  
	   $ssql="SELECT DISTINCT `orden_pago`.`orden_pago` , `dd_retenciones`.`dd_codigo` , `dd_retenciones`.`importe` as impret , `dd_retenciones`.`dd_nombre`
		FROM `dd_retenciones` , `orden_pago`
		WHERE (
		`orden_pago`.`cuit` = dd_retenciones.dd_cuit
		)
		AND (
		`dd_retenciones`.`dd_cuit` ='$cuitl'
		)
		AND orden_pago.orden_pago = dd_retenciones.orden
		AND (
		`orden_pago`.`fecha` >= '$fechaant'
		)
		AND (
		`orden_pago`.`fecha` <= '$fechahoy'
		)
		AND (orden_pago.ejercicio = dd_retenciones.ejercicio)
		AND orden_pago.ejercicio <= '2014'
	    AND (`dd_retenciones`.`dd_codigo`='$codigo')";

		 if (!($r_dd= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar deduccion";
			  echo $cuerpo1;
			  //.....................................................................
			}        
	
	   $can=mysql_num_rows($r_dd);
	   while ($f_dd= mysql_fetch_array ($r_dd))
	       {
			   
			 $codigoa=$codigo;
			 $importe=$f_dd['impret'];
			// $bruto=$f_dd['impbruto'];
			 $sumcod=$sumcod+$importe;
			// $sumbruto=$sumbruto + $bruto;
			 
		   }
		   
		   $ssql="SELECT DISTINCT `orden_pago_fp`.`orden_pago` , `dd_retenciones`.`dd_codigo` , `dd_retenciones`.`importe` as impret , `dd_retenciones`.`dd_nombre`
		FROM `dd_retenciones` , `orden_pago_fp`
		WHERE (
		`orden_pago_fp`.`cuit` = dd_retenciones.dd_cuit
		)
		AND (
		`dd_retenciones`.`dd_cuit` ='$cuitl'
		)
		AND orden_pago_fp.orden_pago = dd_retenciones.orden
		AND (
		`orden_pago_fp`.`fecha` >= '$fechaant'
		)
		AND (
		`orden_pago_fp`.`fecha` <= '$fechahoy'
		)
		AND (orden_pago_fp.ejercicio = dd_retenciones.ejercicio)
		AND orden_pago_fp.ejercicio <= '2014'
	    AND (`dd_retenciones`.`dd_codigo`='$codigo')";

		 if (!($r_dd_fp= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar deduccion";
			  echo $cuerpo1;
			  //.....................................................................
			}        
	
	   $can_fp=mysql_num_rows($f_dd_fp);
	   while ($f_dd_fp= mysql_fetch_array ($r_dd_fp))
	       {
			   
			 $codigoa=$codigo;
			 $importe=$f_dd_fp['impret'];
			// $bruto=$f_dd['impbruto'];
			 $sumcod=$sumcod+$importe;
			// $sumbruto=$sumbruto + $bruto;
			 
		   }
		   
		   
		 
		if(($can>0) or ($can_fp >0))
		  {
			  
?>	   
	 
 <tr> 
  
		<td><?php echo $dd_nombre; ?></td>
        <td align="center"><?php echo $codigo; ?></td>
        <td align="right" ><strong><?php echo $sumcod; ?></strong></td>
	</tr>
    <tr height=10px>
    <td colspan="3"><hr /></td>
  </tr>  
<?php
		
		 
	   
	 
  }
  $sumret=$sumret+$sumcod;
 // $dd_tb=$dd_tb +$sumbruto;
 
}
$can=0;
$can_fp=0;

while ($f_codigo= mysql_fetch_array ($r_e_codigo))
   {
	    $sumcod=0;
	   	$codigo=$f_codigo['codigo'];
		$dd_nombre=$f_codigo['nombre'];
	  
	   $ssql="SELECT DISTINCT `orden_pago`.`orden_pago` , `dd_retenciones`.`dd_codigo` , `dd_retenciones`.`importe` as impret , `dd_retenciones`.`dd_nombre`
		FROM `dd_retenciones` , `orden_pago`
		WHERE (
		`orden_pago`.`cuit` = dd_retenciones.dd_cuit
		)
		AND (
		`dd_retenciones`.`dd_cuit` ='$cuitl'
		)
		AND orden_pago.orden_pago = dd_retenciones.orden
		AND (
		`orden_pago`.`fecha` >= '$fechaant'
		)
		AND (
		`orden_pago`.`fecha` <= '$fechahoy'
		)
		AND (orden_pago.ejercicio = dd_retenciones.ejercicio)
		AND orden_pago.ejercicio > '2014'
	    AND (`dd_retenciones`.`dd_codigo`='$codigo')";

		 if (!($r_dd= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar deduccion1";
			  echo $cuerpo1;
			  //.....................................................................
			}        
	
	   $can=mysql_num_rows($r_dd);
	   while ($f_dd= mysql_fetch_array ($r_dd))
	       {
			   
			 $codigoa=$codigo;
			 $importe=$f_dd['impret'];
			// $bruto=$f_dd['impbruto'];
			 $sumcod=$sumcod+$importe;
			// $sumbruto=$sumbruto + $bruto;
			 
		   }
		   
		   $ssql="SELECT DISTINCT `orden_pago_fp`.`orden_pago` , `dd_retenciones`.`dd_codigo` , `dd_retenciones`.`importe` as impret , `dd_retenciones`.`dd_nombre`
		FROM `dd_retenciones` , `orden_pago_fp`
		WHERE (
		`orden_pago_fp`.`cuit` = dd_retenciones.dd_cuit
		)
		AND (
		`dd_retenciones`.`dd_cuit` ='$cuitl'
		)
		AND orden_pago_fp.orden_pago = dd_retenciones.orden
		AND (
		`orden_pago_fp`.`fecha` >= '$fechaant'
		)
		AND (
		`orden_pago_fp`.`fecha` <= '$fechahoy'
		)
		AND (orden_pago_fp.ejercicio = dd_retenciones.ejercicio)
		AND orden_pago_fp.ejercicio > '2014'
	    AND (`dd_retenciones`.`dd_codigo`='$codigo')";

		 if (!($r_dd_fp= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar deduccion1";
			  echo $cuerpo1;
			  //.....................................................................
			}        
	
	   $can_fp=mysql_num_rows($f_dd_fp);
	   while ($f_dd_fp= mysql_fetch_array ($r_dd_fp))
	       {
			   
			 $codigoa=$codigo;
			 $importe=$f_dd_fp['impret'];
			// $bruto=$f_dd['impbruto'];
			 $sumcod=$sumcod+$importe;
			// $sumbruto=$sumbruto + $bruto;
			 
		   }
		   
		   
		 
		if(($can>0) or ($can_fp >0))
		  {
			  
?>	   
	 
 <tr> 
  
		<td><?php echo $dd_nombre; ?></td>
        <td align="center"><?php echo $codigo; ?></td>
        <td align="right" ><strong><?php echo $sumcod; ?></strong></td>
	</tr>
    <tr height=10px>
    <td colspan="3"><hr /></td>
  </tr>  
<?php
		
		 
	   
	 
  }
  $sumret=$sumret+$sumcod;
 // $dd_tb=$dd_tb +$sumbruto;
 
}


?>	   
   <tr height=10px>
    <td colspan="3"><hr /></td>
  </tr>
 
 <?php
 $dd_bruto=0;
  while ($f_tt= mysql_fetch_array ($r_tb))
     {
	    $dd_tb=$f_tt['importe'];
	   
	     $dd_bruto=$dd_bruto+$dd_tb;
	 }
 
$dd_neto=0;
  while ($f_tt= mysql_fetch_array ($r_tn))
     {
	    $dd_tn=$f_tt['liquido'];
	   
	     $dd_neto=$dd_neto+$dd_tn;
	 }
	  	  
	 while ($f_pt= mysql_fetch_array ($r_pb))
     {
	    $dd_tb=$f_pt['importe'];
	   
	     $dd_bruto=$dd_bruto+$dd_tb;
	 }
 

  while ($f_pt= mysql_fetch_array ($r_pn))
     {
	    $dd_tn=$f_pt['liquido'];
	   
	     $dd_neto=$dd_neto+$dd_tn;
	 }  
		
?>
 
 <tr>
  
		<td height="27" colspan="2">TOTAL RETENCIONES</td>
        
        <td align="right"><strong><?php echo number_format($sumret,2); ?></strong></td>
	</tr>

 <tr height=10px>
    <td colspan="3">&nbsp; </td>
  </tr>
  
  <tr>
  
		<td height="29" colspan="2">TOTAL NETO</td>
        
        <td align="right"><strong><?php echo number_format($dd_bruto-$sumret,2); ?></strong></td>
	</tr>
    <tr height=10px>
    <td height="9" colspan="3"><hr /></td>
  </tr>  
  <tr>
  
		<td height="27" colspan="2">TOTAL  FACTURADO</td>
        
        <td align="right"><strong><?php echo number_format($dd_bruto,2); ?></strong></td>
	</tr>
        <tr height=10px>
    <td height="9" colspan="3"><hr /></td>
  </tr>  

  
  <tr height=10px>
    <td colspan="3"><hr /></td>
  </tr>    
 </table> 
 </div>

<div class="sidenav">
<h2>Periodo de Consulta</h2>
 <ul>      <li><?php echo $fechaa.'  al  '.$fechah ?><br></li>
           <li><a title="Constancia" href="ordenes/constancias.php?fechad=<?php  echo $fechaant;  ?>&fechah=<?php  echo $fechahoy;  ?>&id=<?php echo $id; ?>" target="_blank"  ><img src="img/print_saf.jpg" width="35" align="" height="24" border="0"/></a></li> 
  </ul>  
<h2>Datos</h2>
<ul>
    
    <li>Categoria   I<br> Ingreso Bruto Anual $400.000</li><br>
    
    <li>Categoria   L*<br>Ingreso Bruto Anual $600.000</li><br>
    
</ul>    
 <h5>*Aplicable unicamente para venta de bienes muebles     </h5>
</div>

<div class="clearer"><span></span></div>

</html>
