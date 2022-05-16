<html>
<div class="content">
<table border="0" align="center" width="90%" >
 <tr height=10px>
    <td colspan="2">&nbsp; </td>
  </tr>
  <tr>
		<td height="43" colspan="2" ><h2 align="center"><font color="#456"> MODULO DE IMPUESTOS Y RETENCIONES</font></h2></td>
        
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
		 
		if($can>0)
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
	  	  
	  
		
?>
 
 <tr>
  
		<td height="27" colspan="2">TOTAL RETENCIONES</td>
        
        <td align="right"><strong><?php echo $sumret; ?></strong></td>
	</tr>

 <tr height=10px>
    <td colspan="3">&nbsp; </td>
  </tr>
  
  <tr>
  
		<td height="29" colspan="2">TOTAL NETO</td>
        
        <td align="right"><strong><?php echo $dd_bruto; ?></strong></td>
	</tr>
    <tr height=10px>
    <td height="9" colspan="3"><hr /></td>
  </tr>  
  <tr>
  
		<td height="27" colspan="2">TOTAL FACTURADO</td>
        
        <td align="right"><strong><?php echo $dd_neto; ?></strong></td>
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
<h2>Fecha de Consulta</h2>
 <ul>      <li><?php echo $fechaa.'  al  '.$fechah ?><br></li>

     <li><a title="Constancia" href="retenciones_saf/listado_saf.php" target="_blank"  ><img src="img/print_saf.jpg" width="35" align="" height="24" border="0"/></a>  </li> 
</div>

<div class="clearer"><span></span></div>

</html>
