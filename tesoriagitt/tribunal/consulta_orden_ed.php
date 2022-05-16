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
	$dia = date("d-m-Y");
	 function restaFechas($dFecIni, $dFecFin)
{
    $dFecIni = str_replace("-","",$dFecIni);
    $dFecIni = str_replace("/","",$dFecIni);
    $dFecFin = str_replace("-","",$dFecFin);
    $dFecFin = str_replace("/","",$dFecFin);

    ereg( "([0-9]{1,2})([0-9]{1,2})([0-9]{2,4})", $dFecIni, $aFecIni);
    ereg( "([0-9]{1,2})([0-9]{1,2})([0-9]{2,4})", $dFecFin, $aFecFin);

    $date1 = mktime(0,0,0,$aFecIni[2], $aFecIni[1], $aFecIni[3]);
    $date2 = mktime(0,0,0,$aFecFin[2], $aFecFin[1], $aFecFin[3]);

    return round(($date2 - $date1) / (60 * 60 * 24));

    
}	
	
	
	////verifica fecha
	
	$d_fecha=date('Y-m-d');
	 $y=date('Y');

if(!isset($_POST['busca']))
{
	    $accion='Consulta Ordenes Pagadas y Pendiente de FT';
	 	$tabla='orden_pago - op_pendientes_r';
	 	include('agrego_movi.php'); 
		$bandera = $_GET['band'];
		
}
else
{
	  $bandera = $_POST['band'];
	  $nom = $_POST['busnom'];
	  
}
if(isset($_POST['ejer']))
{
	  $nom = $_POST['nom'];
	   $b_eje ='EA';
}
?>
<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
<div class="content">

<h2>Consulta de Ordenes Pendientes / Pagadas<br /> -Fondos Del Tesoro- </h2>


<br /> 
<form action="" method="post">

<table width="100%"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
<tr>
    	<td height="30" colspan="3" class="fuframe1" >O.P. :<input  name="busnom" type="text" id="busnom" size="30" maxlength="50" />
      		<input name="busca" type="submit" class="tabla_jugando" id="busca" value="Buscar" />
            <input type="hidden" name="fecha_cons" value="<?php echo  $fecha_cons; ?>" />
            <input type="hidden" name="band" value="<?php echo $bandera; ?>" /> 
            <input type="hidden" name="nom" value="<?php echo $nom; ?>" /> 
            
	  		  
        <td height="30" colspan="2" ><?php if (!($bandera=='T')) { ?>
       <input name="ejer" type="submit" class="Boton" id="ejer" title="Ordenadas por Ejercicios de generacion de O.P" value="Ejercicio Anteriores" />
        
        <a title="Imprimir Consulta" href="tribunal/listado_ordenes.php?consul=<?php echo $y ?>&nom=<?php echo $nom; ?>&ban=<?php echo $b_eje; ?>" target="_blank"  ><img src="img/pdf.png" width="35" align="" height="24" border="0"/></a>
        <a title="Imprimir Consulta" href="tribunal/listado_ordenes_xls.php?consul=<?php echo $y ?>&nom=<?php echo $nom; ?>&ban=<?php echo $b_eje; ?>" target="_blank"  ><img src="img/xls.jpg"  width="35" align="" height="24" border="0"/></a>   
		<?php } ?></td>   
         
         
    </tr>
</table>    
</form>
	
<?php
if (isset($_POST['busca']) and !empty($_POST['busnom']))
			{
		 		//echo 'pas0';
				
				//echo $bandera = $_POST['band'];
				$nom = $_POST['busnom'];
				$fecha_cons = $_POST['fecha_cons'];
				
							  
						
					
					
			 $_pagi_sql = "SELECT CASE op_pendientes.estado
WHEN 'N'
THEN 'P'
WHEN 'B'
THEN 'A'
WHEN 'R'
THEN 'B'
WHEN 'I'
THEN 'I' END AS estado, op_pendientes. *  FROM op_pendientes,beneficiarios_aprobados
				              where (cuit ='$nom' or concepto like '%$nom%' )
							   and Ejercicio='$y'
							   and beneficiarios_aprobados.cuitl=op_pendientes.cuit
							   and beneficiarios_aprobados.cuitl='30682472762'
							    
							   order by Ejercicio,estado asc  ";
							  
				 if (!($_pagi_result= mysql_query($_pagi_sql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}		
		$cant = mysql_num_rows($_pagi_result);
					  
					
 
			


?>
<?php
	   if ($cant>0)
	     {
?>			 
<table  border="1" align="left" cellpadding="0" cellspacing="0" bgcolor="#DBE3E6" bordercolor="#EAEAEA">
	   
 <tr class="fuframe" >
     <td colspan="10" align="center"><font size="+1">Orden Pendiente de Pago</font></td>
  </tr>
  <tr class="fuframe" >
    <td ><strong>Ejercicio</td>
	 <td ><strong>Fecha</td>
   <td  ><strong>SAF</td>
       <td ><strong>Nr.Orden</td>
       <td align="center"><strong>Beneficiarios</td>
       <td align="center"><strong>Concepto</td>
       <td ><strong>Imp. Pagado</strong></td>
       <td ><strong>Imp. Form</strong></td>
       <td><strong>Saldos Disp</strong></td>
     
        <td><strong>Estado</strong></td>
          
   </tr>
<?php
			  while ($f_ordenp=mysql_fetch_array($_pagi_result))
	            {


   if ($band=='1')
      {
		  $band='';
?>	
<table  border="1" align="left" cellpadding="0" cellspacing="0" bgcolor="#DBE3E6" bordercolor="#EAEAEA">	   
 <tr class="fuframe" >
     <td colspan="10" align="center"><font size="+1">Orden Pendiente de Pago</font></td>
  </tr>
    
   
   <tr class="fuframe" >
    <td ><strong>Ejercicio</td>
		 <td ><strong>Fecha</td>
   <td ><strong>SAF</td>
       <td ><strong>Nr.Orden</td>
       <td  align="center"><strong>Beneficiarios</td>
       <td  align="center"><strong>Concepto</td>
       <td ><strong>Imp. Pagado</strong></td>
       <td ><strong>Imp. Form</strong></td>
       <td ><strong>Saldos Disp</strong></td>
     
        <td><strong>Estado</strong></td>
          
   </tr>

 <?php
	  }

	?> 
 
 <?php
 
     
		 $ejer = $f_ordenp['Ejercicio']; 
		 $orden_p = $f_ordenp['Numero_OP'];  
		 $saf_op = $f_ordenp['Saf'];    
		 $d_cuit=$f_ordenp['cuit'];
		 $estado_op=$f_ordenp[0];
		 $inhi_v='';
		 $baja='';
		 
		  $ssql = "SELECT * FROM historial_orden
			            where numero_op='$orden_p' 
						and ejercicio='$ejer'
						and saf='$saf_op'
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
		 
		  $ssql = "SELECT * FROM beneficiarios_aprobados where cuitl='$d_cuit' ";
					 if (!($r_cb= mysql_query($ssql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}
		   $f_cb=mysql_fetch_array($r_cb);
		   
		   $estado=$f_cb['estado'];
		   $apellido_b=$f_cb['apellido'];
		   $nombre_b=$f_cb['nombre'];
		   $razon_social_b=$f_cb['razon_social'];
		   $inhi=$f_cb['inhi'];
		   
		   if($razon_social_b=='')
		     {
				 $beneficiario=$apellido_b.', '.$nombre_b;
			 }
			else
			 {
				  $beneficiario=$razon_social_b;
			 }
		     
	     	  
	       $f_g=explode("-", $f_ordenp['Fecha_OP']); 
           $fecha_ing=$f_g[2].'-'.$f_g[1].'-'.$f_g[0]; 
		   
		   $resultado_resta = restaFechas($fecha_ing,$dia);
 
	    if(($estado=='A') and ($inhi=='') and (($estado_op=='P') or ($estado_op=='I')) and ($resultado_resta < 366) )
{
	if ($estado_op=='I')
	    
		    {
				$inhi_v='IMP';
			}
	?>	
 
	    <tr bgcolor="#F3F3F3"  class="fuframe" > 
 <?php 
   }
 else
 {
 if($resultado_resta < 366)
   {
   	 if($estado_op=='A')
	    {	 $baja='BAJR';
?>		
 
	    <tr bgcolor="#FFCB97" class="fuframe" > 
 <?php 
       } 
	 else 
	   {  
	  
	if(($inhi!='') or ($estado=='B') )
	   {	
	   if($inhi!=''){ $inhi_v='BENC';}
	   if($estado=='B'){ $baja='BENB';}
?>		
 
	    <tr bgcolor="#CCFFFF" class="fuframe" > 
 <?php 
       }
	   if ($estado_op=='B')
	     {
	      if($inhi!=''){ $inhi_v='BENC';}
	      if($estado=='B'){ $baja='BENB';}
		  if(($inhi=='') and ($estado=='A'))
		    {
				$baja='BLOR';
			}
	   ?>		
 
	      <tr bgcolor="#FFCB97" class="fuframe" > 
 <?php 
         }
		
	  }
	  }
	else
	 {
	  $baja='BAJD';
	 ?>		
 
	    <tr bgcolor="#FFFF99" class="fuframe" > 
		
		
 <?php 
       } 
}
	  
 
?>	
	  
  
	 
          <td height="25" ><?php echo $f_ordenp['Ejercicio'];?></td> 
		    <td  ><?php echo $f_ordenp['Fecha_OP'];?></td> 
           <td ><?php echo $f_ordenp['Saf'];?></td>
          <td   title="<?php echo $obser; ?>"><?php echo $f_ordenp['Numero_OP'];?></td>
          <td  title="<?php echo $obser; ?>" align="left"><?php echo substr($f_ordenp['Beneficiario'],0,20);?></font></td>
         <td   title="<?php echo $obser; ?>" align="left"><?php echo substr($f_ordenp['Concepto'],0,25);?></font></td>
         
          <td  align="right">&nbsp;<?php echo $f_ordenp['Total_Pagado'];?></td>
           <td  align="right">&nbsp;<?php echo $f_ordenp['Imp_orden'];?></td>
          <td  align="right"><?php echo $f_ordenp['Saldos'];?></td>
          
           <td  title="<?php echo $obser; ?>"  align="center" >
           <strong>&nbsp;<?php  if($resultado_resta > 366){echo $baja;} 
		                                                            else
																	{ 
		                                                          if($baja!='') { echo $baja; } 
		                                                        elseif ($inhi_v !='')echo $inhi_v; }?></strong></td>
          
 
      </tr>

  
<?php	   
   



 }
?>	
<tr>
		<td align="center" colspan="10">
	
		</td>
	</tr>	
        
    </table>	   
	   
	   


<br />
<br />


<?php
   }////pendientes de pago
   
 
		 
			   
        $_pagi_sql1 = "SELECT ejercicio, o.saf, orden_pago, fecha, apellido, nombre, razon_social, concepto, total
FROM orden_pago AS o, beneficiarios_aprobados AS b
				                where (cuit ='$nom' or concepto like '%$nom%' )
							      and cuitl=cuit
								  and b.cuitl='30682472762'
							
							      and ejercicio ='$y' ORDER BY fecha DESC ";
				 if (!($_pagi_resultp= mysql_query($_pagi_sql1, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}			

	  
	  
	  
	
	   
?>



<?php 
$ci=0;	    
$cant = mysql_num_rows($_pagi_resultp);
if($cant > 0)

{
	      while ($f_ord=mysql_fetch_array($_pagi_resultp))
	  {
		  
		  
		  
		    $ejer = $f_ord['ejercicio']; 
		    $orden_p = $f_ord['orden_pago'];  
		    $saf_op = $f_ord['saf'];    
		
		 
		  $ssql = "SELECT * FROM op_pendientes
			            where Numero_Op='$orden_p' 
						and Ejercicio='$ejer'
						and Saf='$saf_op'
						";
			 if (!($r_conp= mysql_query($ssql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar tipo de iva";
					  echo $cuerpo1;
					  //.....................................................................
					}  
	
	      $cant_p = mysql_num_rows($r_conp);
		 
		 // echo $f_ordenp['saf']; 
		
			  if($ci==0)
			  {
				  $ci=1;
			  ?>
			  <table width="100%"  border="1" align="left" cellpadding="0" cellspacing="0" bgcolor="#DBE3E6" bordercolor="#EAEAEA">
 <br />
 <tr class="fuframe" >
     <td colspan="10" align="center"><font size="+1">Detalle de Ordenes Pagadas</font></td>
  </tr>
     
   
   <tr class="fuframe" >
       <td ><strong>Ejercicio</strong></td>
       <td ><strong>SAF</strong></td>
       <td ><strong>Nr.Orden</strong></td>
       <td ><strong>Fecha Pago</strong></td>
       <td  align="center" colspan="2"><strong>Beneficiarios</strong></td>
       <td align="center" colspan="3"><strong>Concepto</strong></td>
       <td ><strong>Imp. Pagado</strong></td>
          
   </tr>
   <tr bgcolor="#F3F3F3"  class="fuframe1" > 
           
           <td height="25"  align="center"><?php echo $f_ord['ejercicio'];?></td>
           <td  align="center"><?php echo $f_ord['saf'];?></td>
          <td  align="center"><?php echo $f_ord['orden_pago'];?></td>
          <td  align="right"><?php echo $f_ord['fecha'];?></td>
          <td  align="left" colspan="2"><?php echo  $f_ord['apellido'].' '.$f_ord['nombre'].''.$f_ord['razon_social'];;?></font></td>
         <td  align="left" colspan="3"><?php echo substr($f_ord['concepto'],0,25);?></font></td>
         
          <td  align="right">&nbsp;<?php echo $f_ord['total'];?></td>
           
         
         
           
      </tr>
	<?php
			  }
		else
		{
		?>		  
  
	  <tr bgcolor="#F3F3F3"  class="fuframe1" > 
           
           <td  align="center"><?php echo $f_ord['ejercicio'];?></td>
           <td  align="center"><?php echo $f_ord['saf'];?></td>
          <td  align="center"><?php echo $f_ord['orden_pago'];?></td>
          <td  align="right"><?php echo $f_ord['fecha'];?></td>
          <td  align="left" colspan="2"><?php echo  $f_ord['apellido'].' '.$f_ord['nombre'].''.$f_ord['razon_social'];;?></font></td>
         <td  align="left" colspan="3"><?php echo substr($f_ord['concepto'],0,25);?></font></td>
         
          <td  align="right">&nbsp;<?php echo $f_ord['total'];?></td>
           
         </tr>
         
           
          
          
<?php	   
		  }
 	 
	  }
	  ?>
 <tr>
		<td align="center" colspan="10">
	
		</td>
	</tr>	
        
</table>
<?php
	  
}
						}
	if (isset($_POST['ejer']) and !empty($_POST['nom']))
	{
		
			//echo 'pas0';
				
				//echo $bandera = $_POST['band'];
				$nom = $_POST['nom'];
				$fecha_cons = $_POST['fecha_cons'];
				
							  
						
					
					
			 $_pagi_sql = "SELECT CASE op_pendientes.estado
WHEN 'N'
THEN 'P'
WHEN 'B'
THEN 'A'
WHEN 'R'
THEN 'B'
WHEN 'I'
THEN 'I' END AS estado, op_pendientes. *  FROM op_pendientes,beneficiarios_aprobados 
				               where (cuit ='$nom' or concepto like '%$nom%' )
							   and Ejercicio <'$y'
							   and beneficiarios_aprobados.cuitl=op_pendientes.cuit
							    and beneficiarios_aprobados.cuitl='30682472762'
							    
							   order by Ejercicio DESC,Fecha_OP desc";
							  
				 if (!($_pagi_result= mysql_query($_pagi_sql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}		
		$cant = mysql_num_rows($_pagi_result);
					  
					
 
			



	   if ($cant>0)
	     {
?>			 
<table  border="1" align="left" cellpadding="0" cellspacing="0" bgcolor="#DBE3E6" bordercolor="#EAEAEA">
	   
 <tr class="fuframe" >
     <td colspan="10" align="center"><font size="+1">Orden Pendiente de Pago</font></td>
  </tr>
  <tr class="fuframe" >
    <td ><strong>Ejercicio</td>
	 <td ><strong>Fecha</td>
   <td  ><strong>SAF</td>
       <td ><strong>Nr.Orden</td>
       <td align="center"><strong>Beneficiarios</td>
       <td align="center"><strong>Concepto</td>
       <td ><strong>Imp. Pagado</strong></td>
       <td ><strong>Imp. Form</strong></td>
       <td><strong>Saldos Disp</strong></td>
     
        <td><strong>Estado</strong></td>
          
   </tr>
<?php
			  while ($f_ordenp=mysql_fetch_array($_pagi_result))
	            {


   if ($band=='1')
      {
		  $band='';
?>		   
 <table  border="1" align="left" cellpadding="0" cellspacing="0" bgcolor="#DBE3E6" bordercolor="#EAEAEA">	   
 <tr class="fuframe" >
     <td colspan="10" align="center"><font size="+1">Orden Pendiente de Pago</font></td>
  </tr>
    
   
   <tr class="fuframe" >
    <td ><strong>Ejercicio</td>
		 <td ><strong>Fecha</td>
   <td ><strong>SAF</td>
       <td ><strong>Nr.Orden</td>
       <td  align="center"><strong>Beneficiarios</td>
       <td  align="center"><strong>Concepto</td>
       <td ><strong>Imp. Pagado</strong></td>
       <td ><strong>Imp. Form</strong></td>
       <td ><strong>Saldos Disp</strong></td>
     
        <td><strong>Estado</strong></td>
          
   </tr>

 <?php
	  }
	?> 
 
 <?php
 
     
		 $ejer = $f_ordenp['Ejercicio']; 
		 $orden_p = $f_ordenp['Numero_OP'];  
		 $saf_op = $f_ordenp['Saf'];    
		 $d_cuit=$f_ordenp['cuit'];
		 $estado_op=$f_ordenp[0];
		 $inhi_v='';
		 $baja='';
		 
		  $ssql = "SELECT * FROM historial_orden
			            where numero_op='$orden_p' 
						and ejercicio='$ejer'
						and saf='$saf_op'
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
		 
		  $ssql = "SELECT * FROM beneficiarios_aprobados where cuitl='$d_cuit' ";
					 if (!($r_cb= mysql_query($ssql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}
		   $f_cb=mysql_fetch_array($r_cb);
		   
		   $estado=$f_cb['estado'];
		   $apellido_b=$f_cb['apellido'];
		   $nombre_b=$f_cb['nombre'];
		   $razon_social_b=$f_cb['razon_social'];
		   $inhi=$f_cb['inhi'];
		   
		   if($razon_social_b=='')
		     {
				 $beneficiario=$apellido_b.', '.$nombre_b;
			 }
			else
			 {
				  $beneficiario=$razon_social_b;
			 }
		     
	     	  
	       $f_g=explode("-", $f_ordenp['Fecha_OP']); 
           $fecha_ing=$f_g[2].'-'.$f_g[1].'-'.$f_g[0]; 
		   
		   $resultado_resta = restaFechas($fecha_ing,$dia);
 
	    if(($estado=='A') and ($inhi=='') and (($estado_op=='P') or ($estado_op=='I')) and ($resultado_resta < 366) )
{
	if ($estado_op=='I')
	    
		    {
				$inhi_v='IMP';
			}
	?>	
 
	    <tr bgcolor="#F3F3F3"  class="fuframe" > 
 <?php 
   }
 else
 {
 if($resultado_resta < 366)
   {
   	 if($estado_op=='A')
	    {	 $baja='BAJR';
?>		
 
	    <tr bgcolor="#FFCB97" class="fuframe" > 
 <?php 
       } 
	 else 
	   {  
	  
	if(($inhi!='') or ($estado=='B') )
	   {	
	   if($inhi!=''){ $inhi_v='BENC';}
	   if($estado=='B'){ $baja='BENB';}
?>		
 
	    <tr bgcolor="#CCFFFF" class="fuframe" > 
 <?php 
       }
	   if ($estado_op=='B')
	     {
	      if($inhi!=''){ $inhi_v='BENC';}
	      if($estado=='B'){ $baja='BENB';}
		  if(($inhi=='') and ($estado=='A'))
		    {
				$baja='BLOR';
			}
	   ?>		
 
	      <tr bgcolor="#FFCB97" class="fuframe" > 
 <?php 
         }
		
	  }
	  }
	else
	 {
	  $baja='BAJD';
	 ?>		
 
	    <tr bgcolor="#FFFF99" class="fuframe" > 
		
		
 <?php 
       } 
}
	  
 
?>	
	  
  
	 
          <td height="25" ><?php echo $f_ordenp['Ejercicio'];?></td> 
		    <td  ><?php echo $f_ordenp['Fecha_OP'];?></td> 
           <td ><?php echo $f_ordenp['Saf'];?></td>
          <td   title="<?php echo $obser; ?>"><?php echo $f_ordenp['Numero_OP'];?></td>
          <td  title="<?php echo $obser; ?>" align="left"><?php echo substr($f_ordenp['Beneficiario'],0,20);?></font></td>
         <td   title="<?php echo $obser; ?>" align="left"><?php echo substr($f_ordenp['Concepto'],0,25);?></font></td>
         
          <td  align="right">&nbsp;<?php echo $f_ordenp['Total_Pagado'];?></td>
           <td  align="right">&nbsp;<?php echo $f_ordenp['Imp_orden'];?></td>
          <td  align="right"><?php echo $f_ordenp['Saldos'];?></td>
          
           <td  title="<?php echo $obser; ?>"  align="center" >
           <strong>&nbsp;<?php  if($resultado_resta > 366){echo $baja;} 
		                                                            else
																	{ 
		                                                          if($baja!='') { echo $baja; } 
		                                                        elseif ($inhi_v !='')echo $inhi_v; }?></strong></td>
          
 
      </tr>
<tr>
		<td align="center" colspan="10">
	
		</td>
	</tr>	
        
      
<?php	   
     
	  
	
 



 }
?>	
<tr>
		<td align="center" colspan="10">
	
		</td>
	</tr>	
        
    </table>	   
	   
	   


<br />
<br />

<?php
   }////pendientes de pago
   
 
		 
			   
        $_pagi_sql1 = "SELECT ejercicio, o.saf, orden_pago, fecha, apellido, nombre, razon_social, concepto, total
FROM orden_pago AS o, beneficiarios_aprobados AS b
				                where (cuit ='$nom' or concepto like '%$nom%' )
							      and cuitl=cuit
								    and b.cuitl='30682472762'
								  
							      and ejercicio <'$y' ORDER BY fecha DESC ";
				 if (!($_pagi_resultp= mysql_query($_pagi_sql1, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}			

	  
	  
	  
	
	   
?>



<?php

$ci=0;	    
$cant = mysql_num_rows($_pagi_resultp);
if($cant > 0)

{
	      while ($f_ord=mysql_fetch_array($_pagi_resultp))
	        {
		      $ejer = $f_ord['ejercicio']; 
		      $orden_p = $f_ord['orden_pago'];  
		      $saf_op = $f_ord['saf']; 
		    
		  
		  
		
		 
		  $ssql = "SELECT * FROM op_pendientes
			            where Numero_Op='$orden_p' 
						and Ejercicio='$ejer'
						and Saf='$saf_op'
						";
			 if (!($r_conp= mysql_query($ssql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar tipo de iva";
					  echo $cuerpo1;
					  //.....................................................................
					}  
	
	      $cant_p = mysql_num_rows($r_conp);
		 
		 // echo $f_ordenp['saf']; 
		
			  if($ci==0)
			  {
				  $ci=1;
			  ?>
			  <table width="100%"  border="1" align="left" cellpadding="0" cellspacing="0" bgcolor="#DBE3E6" bordercolor="#EAEAEA">
 <br />
 <tr class="fuframe" >
     <td colspan="10" align="center"><font size="+1">Detalle de Ordenes Pagadas</font></td>
  </tr>
     
   
   <tr class="fuframe" >
       <td ><strong>Ejercicio</strong></td>
       <td ><strong>SAF</strong></td>
       <td ><strong>Nr.Orden</strong></td>
       <td ><strong>Fecha Pago</strong></td>
       <td  align="center" colspan="2"><strong>Beneficiarios</strong></td>
       <td align="center" colspan="3"><strong>Concepto</strong></td>
       <td ><strong>Imp. Pagado</strong></td>
          
   </tr>
   <tr bgcolor="#F3F3F3"  class="fuframe1" > 
           
           <td height="25"  align="center"><?php echo $f_ord['ejercicio'];?></td>
           <td  align="center"><?php echo $f_ord['saf'];?></td>
          <td  align="center"><?php echo $f_ord['orden_pago'];?></td>
          <td  align="right"><?php echo $f_ord['fecha'];?></td>
          <td  align="left" colspan="2"><?php echo  $f_ord['apellido'].' '.$f_ord['nombre'].''.$f_ord['razon_social'];;?></font></td>
         <td  align="left" colspan="3"><?php echo substr($f_ord['concepto'],0,25);?></font></td>
         
          <td  align="right">&nbsp;<?php echo $f_ord['total'];?></td>
           
         
         
           
      </tr>
	<?php
			  }
		else
		{
		?>		  
  
	  <tr bgcolor="#F3F3F3"  class="fuframe1" > 
           
           <td height="25"  align="center"><?php echo $f_ord['ejercicio'];?></td>
           <td  align="center"><?php echo $f_ord['saf'];?></td>
          <td  align="center"><?php echo $f_ord['orden_pago'];?></td>
          <td  align="right"><?php echo $f_ord['fecha'];?></td>
          <td  align="left" colspan="2"><?php echo  $f_ord['apellido'].' '.$f_ord['nombre'].''.$f_ord['razon_social'];;?></font></td>
         <td  align="left" colspan="3"><?php echo substr($f_ord['concepto'],0,25);?></font></td>
         
          <td  align="right">&nbsp;<?php echo $f_ord['total'];?></td>
           
         </tr>
         
         
           
          
          
<?php	   
		  }
 	  
	 
	 
	  }
	 ?>
 <tr>
		<td align="center" colspan="10">
	
		</td>
	</tr>	
        
</table>
<?php  
	  
   }
}

	
	
?>	   

<br />
<br />
<br />
<br />
<br />
<br />

    
</div>
<div class="sidenav_op">
<h2></h2>
<ul>
     <li><strong> &nbsp;BENB: </strong>Beneficiario Inhabilitado</li>
    
     <li><strong> &nbsp;BENC: </strong>Cuenta Cerrada</li>
</ul>
</div>
<div class="sidenav_m">
<h2></h2>
<ul>
      <li><strong> &nbsp;BLOR: </strong>Bloqueada/Retenciones</li>
     <li><strong> &nbsp;BAJR: </strong>Baja/Retenciones</li>
 </ul>
 </div>    
 <div class="sidenav_p">
<h2></h2>
<ul>
      <li><strong> &nbsp;IMP: </strong>Control de Impuesto.</li>
     
 </ul>
 </div>    
 <div class="sidenav_e">
<h2></h2>
<ul>
      <li><strong> &nbsp;BAJD:  </strong>Segun Decreto Nº 1804/10 ... Supera los 365 dias</li>
   
 </ul>
 </div>  
 
<div class="sidenav_p">
<h2></h2>
<ul>


      <li><a href="indextesoreria.php?sec=tribunal/index1&apli=tgpa&per=L">Regresar Menu</a></li>
	
</ul>
</div>
<!--<div class="sidenav">
</div> -->
<div class="clearer"><span></span></div>