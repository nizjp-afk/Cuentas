 <?php
  error_reporting ( E_ERROR );
//conexion
	 include('dgti-mysql-var_dbtgp.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	
	$aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
	 $id_saf = $nrosaf;
	
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
	
if(!isset($_POST['busca']))
{
	    $accion='Consulta Ordenes Pagadas y Pendiente de FP';
	 	$tabla='orden_pago_fp - dbtgp.orden_pago ';
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

 $y=date('Y');
 
 
 ?>
 <link href="../css/estilos.css" rel="stylesheet" type="text/css" />
<div class="content">

<h2>Consulta de Ordenes Pendientes / Pagadas -Fondos Propios- </h2>


<br /> 
<form action="" method="post">

<table width="100%"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
<tr>
    	<td height="30"  class="fuframe1" >O.P. :<input  name="busnom" type="text" id="busnom" size="30" maxlength="50" />
      		<input name="busca" type="submit" class="tabla_jugando" id="busca" value="Buscar" />
            <input type="hidden" name="fecha_cons" value="<?php echo  $fecha_cons; ?>" />
            <input type="hidden" name="band" value="<?php echo $bandera;?>" /> 
             <input type="hidden" name="nom" value="<?php echo $nom; ?>" /> 
            
	  		  
        <td height="30"  ><?php if (!($bandera=='T')) { ?>
        <input name="ejer" type="submit" class="Boton" id="ejer" title="Ordenadas por Ejercicios de generacion de O.P" value="Ejercicio Anteriores" />
        
        <a title="Listado de Orden de Pago" href="saf/listado_ordenes_pendientes_fpn.php?consul=<?php echo $y ?>&nom=<?php echo $nom; ?>&ban=<?php echo $b_eje; ?>&saf=<?php echo $id_saf; ?>" target="_blank"  ><img src="img/print_odp.jpg" width="35" align="" height="24" border="0"/></a>   
		<?php } ?></td>   
         
         
    </tr>
</table>    
</form>
<?php
	
if (isset($_POST['busca']) and !empty($_POST['busnom']))
			{
		 		//echo 'pas0';
				
				
				 $nom = $_POST['busnom'];
				 $op =explode("-",$nom);
				 $op_n=$op[2];
				 $op_s=$op[1];
				 $op_f=$op[0];
				
				$fecha_cons = $_POST['fecha_cons'];
				
							  
						
					
					
			 $_pagi_sql = "SELECT orden_pago.*, (IMP_FORM - RETENCION - IMPORTE_A_PAGAR) AS pagado, (IMP_FORM - RETENCION )as Imp_orden,escritural.ESCRITURAL  FROM orden_pago,escritural
				              where ((NUMERO='$op_n' and FORMULARIO='$op_f' AND orden_pago.SAF='$op_s') or CUIT ='$nom' )
							  and orden_pago.ESTADO!='C'
							  and escritural.ID=id_escritural
							  and EJERCICIO='$y'
							  and orden_pago.SAF='$id_saf'
							  order by FORMULARIO ASC,NUMERO DESC";
							  
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
<table width="100%"  border="1" cellpadding="0" cellspacing="0"  >	   
 <tr class="fuframe1" >
     <td colspan="10" align="center"><font size="+1">Orden Pendiente de Pago</font></td>
  </tr>
  <tr class="fuframe1" >
    <td><strong>Ejercicio</strong></td>
	 <td width="25"><strong>Fecha</td>
   <td ><strong>Escritural</strong></td>
       <td ><strong>Nr.Orden</strong></td>
       <td ><strong>Beneficiarios</strong></td>
       <td ><strong>Concepto</strong></td>
          <td ><strong>Imp. Form</strong></td>
       <td ><strong> Pagados</strong></td>
    
       <td><strong>Saldos </strong></td>
     
        <td><strong>Estado</strong></td>
          
   </tr>
<?php
			  while ($f_ordenp=mysql_fetch_array($_pagi_result))
	            {


   if ($ban=='1')
      {
		  $ban=='';
?>	
<table width="100%"  border="1" cellpadding="0" cellspacing="0"  >	   
	   
 <tr class="fuframe1" >
     <td colspan="10" align="center"><font size="+1">Orden Pendiente de Pago</font></td>
  </tr>
    
   
   <tr class="fuframe1" >
    <td><strong>Ejercicio</strong></td>
	 <td width="25"><strong>Fecha</td>
   <td ><strong>Escritural</strong></td>
       <td ><strong>Nr.Orden</strong></td>
       <td ><strong>Beneficiarios</strong></td>
       <td ><strong>Concepto</strong></td>
       <td ><strong>Imp. Pagado</strong></td>
       <td ><strong>Imp. Form</strong></td>
       <td><strong>Saldos Disp</strong></td>
     
        <td><strong>Estado</strong></td>
          
   </tr>

 <?php
	  }
	?> 
 
 <?php
 
     
		 $ejer = $f_ordenp['EJERCICIO']; 
		 //$orden_p = $f_ordenp['FORMULARIO'].'-'.$f_ordenp['SAF'].'-'.$f_ordenp['NUMERO'];  
		 $orden=$f_ordenp['NUMERO'];
		 $num=$f_ordenp['FORMULARIO']; 
		
		 $ESCRITURAL = $f_ordenp['ESCRITURAL'];    
		  $saf_op = $f_ordenp['SAF'];    
		 $d_cuit=$f_ordenp['CUIT'];
		 $estado_op=$f_ordenp['ESTADO'];
		   $IMP1= number_format($f_ordenp['IMP_FORM'],2);
		   $IMP2=number_format($f_ordenp['RETENCION'],2);
		   $IMP3=number_format($f_ordenp['IMPORTE_A_PAGAR'],2);
		    $Imp_orden=number_format($f_ordenp['Imp_orden'],2);
           $Total_Pagado=number_format($f_ordenp['pagado'],2);
		   
		   $orden_p=$num.'-'.$saf_op.'-'.$orden;
		 $inhi_v='';
		 $baja='';
		 
		 
		 include('dgti-mysql-var_dgti-beneficiarios.php');
         include('dgti-intranet-mysql_connect.php');  
         include('dgti-intranet-mysql_select_db.php');
	
		 
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
		     
	     	  
	        $f_g=explode("-", $f_ordenp['FECHA_OP']); 
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
	  

	 
          <td  height="30" align="center"><?php echo $ejer;?></td> 
		  <td  height="30" align="center"><?php echo $f_ordenp['FECHA_OP'];?></td> 
           <td  align="center"><?php echo $ESCRITURAL;?></td>
          <td  title="<?php echo $obser; ?>"><?php echo $orden_p;?></td>
          <td   title="<?php echo $obser; ?>" align="left"><?php echo substr($beneficiario,0,30);?></font></td>
         <td    title="<?php echo $obser; ?>" align="left"><?php echo substr($f_ordenp['CONCEPTO'],0,20);?></font></td>
           <td  align="right">&nbsp;<?php echo $Imp_orden;?></td>
          <td  align="right">&nbsp;<?php echo $Total_Pagado;?></td>
         
        <td  align="right"><?php echo $IMP3 ;?></td>
          
        
          
            <td height="30" title="<?php echo $obser; ?>"  align="center" >
           <strong>&nbsp;<?php   if($resultado_resta > 366){echo $baja;} 
		                                                            else
																	{ 
		                                                          if($baja!='') { echo $baja; } 
		                                                        elseif ($inhi_v !='')echo $inhi_v; }?></strong></td>
    <?php
   } //while
?>      
 
      <tr>
		<td align="center" colspan="10">
	
		</td>
	</tr>	
        
    </table>	   
	   
	   


<br />
<br />
<?php
 }  //// if cant pendientes de pago
   
    
	   


   ////pendientes de pago

			
	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');



			   
        $_pagi_sql1 = "SELECT ejercicio, o.saf, orden_pago, fecha, apellido, nombre, razon_social, concepto, total,e.ESCRITURAL
FROM orden_pago_fp AS o, beneficiarios_aprobados AS b,saf_escritural as e
				              where (orden_pago='$nom' or cuit ='$nom' ) 
							      and cuitl=cuit
							      and ejercicio ='$y'
								   and o.saf='$id_saf'
								  and e.ID=clave_escritural
								  ORDER BY fecha DESC ";
				 if (!($_pagi_resultp= mysql_query($_pagi_sql1, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}			

	  
	$a=0;  
	   $cantpag = mysql_num_rows($_pagi_resultp);
if($cantpag > 0)
	{
		
	   

 	    
      while ($f_ord=mysql_fetch_array($_pagi_resultp))
	  {
		  
		  
		  
		    $ejer = $f_ord['ejercicio']; 
		    $orden = $f_ord['orden_pago'];  
		    $saf_op = $f_ord['saf'];    
			$orden_p =split("-",$orden);
			  $orden_f =$orden_p[0];
			  $orden_s=$orden_p[1];
			  $orden_n=$orden_p[2];
			
			
			
			 include('dgti-mysql-var_dbtgp.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
		
		 
		  $ssql = "SELECT * FROM orden_pago
			            where NUMERO='$orden_n' 
						AND FORMULARIO='$orden_f'
						and EJERCICIO='$ejer'
						and SAF='$orden_s'
						
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
		  $f_pendiente=mysql_fetch_array($r_conp);
		 $valore=$f_pendiente['ESTADO'];
		 // echo $f_ordenp['saf']; 
		 //if(($cant_p > 0))
		  //{
			  
			    
			  
?>	


<?php if($a==0){ $a=1; ?>

<table width="110%"  border="1" align="left" cellpadding="0" cellspacing="0" bgcolor="#DBE3E6" bordercolor="#EAEAEA">

 <tr class="fuframe1" >
    <?php if ($valore=='P'){?> <td colspan="9" align="center"><font size="+1">PAGOS</font></td> <?php }  if ($valore=='C'){?> <td colspan="9" align="center"><font size="+1">ORDEN PAGADA </font></td> <?php } ?>
	
  </tr>
     
   
   <tr class="fuframe" >
       <td width="18"><strong>Ejercicio</strong></td>
       <td width="18"><strong>Escritural</strong></td>
       <td width="25"><strong>Nr.Orden</strong></td>
       <td width="25"><strong>Fecha Pago</strong></td>
       <td width="65" align="center"><strong>Beneficiarios</strong></td>
       <td width="65" align="center"><strong>Concepto</strong></td>
       <td width="43" colspan="3"><strong>Imp. Pagado</strong></td>
          
   </tr>
 <?php } ?> 
	  <tr bgcolor="#F3F3F3"  class="fuframe1" > 
           
           <td width="31" align="center"><?php echo $f_ord['ejercicio'];?></td>
           <td width="31" align="center"><?php echo $f_ord['ESCRITURAL'];?></td>
          <td width="66" align="center"><?php echo $f_ord['orden_pago'];?></td>
          <td width="85" align="right"><?php echo $f_ord['fecha'];?></td>
          <td width="136" align="left"><?php echo  $f_ord['apellido'].' '.$f_ord['nombre'].''.$f_ord['razon_social'];?></font></td>
         <td width="136" align="left"><?php echo substr($f_ord['concepto'],0,25);?></font></td>
         
          <td width="85" align="right" colspan="3">&nbsp;<?php echo $f_ord['total'];?></td>
           
         
         
           
          
          
<?php	   
		  //}
 	  }
 
   
?>	   

<tr>
		<td align="center" colspan="8">
	
		</td>
	</tr>	
        
</table>

<?php
	}
	
  
  }
if (isset($_POST['ejer']) and !empty($_POST['nom']))
			{
		 		
				
				 $nom = $_POST['nom'];
				 $op =explode("-",$nom);
				 $op_n=$op[2];
				 $op_s=$op[1];
				 $op_f=$op[0];
				
				$fecha_cons = $_POST['fecha_cons'];
				
							  
					 include('dgti-mysql-var_dbtgp.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');	
					
					
			 $_pagi_sql = "SELECT orden_pago.*, (IMP_FORM - RETENCION - IMPORTE_A_PAGAR) AS pagado, (IMP_FORM - RETENCION )as Imp_orden,escritural.ESCRITURAL  FROM orden_pago,escritural
				              where ((NUMERO='$op_n' and FORMULARIO='$op_f' AND orden_pago.SAF='$op_s') or CUIT ='$nom' )
							  and orden_pago.ESTADO!='C'
							  and escritural.ID=id_escritural
							  and EJERCICIO <'$y'
							   and orden_pago.SAF='$id_saf'
							  order by EJERCICIO, FECHA_OP DESC ";
							  
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
<table width="100%"  border="1" cellpadding="0" cellspacing="0"  >	   
 <tr class="fuframe1" >
     <td colspan="10" align="center"><font size="+1">Orden Pendiente de Pago</font></td>
  </tr>
  <tr class="fuframe1" >
    <td><strong>Ejercicio</strong></td>
	 <td width="25"><strong>Fecha</td>
   <td ><strong>Escritural</strong></td>
       <td ><strong>Nr.Orden</strong></td>
       <td ><strong>Beneficiarios</strong></td>
       <td ><strong>Concepto</strong></td>
          <td ><strong>Imp. Form</strong></td>
       <td ><strong> Pagados</strong></td>
    
       <td><strong>Saldos </strong></td>
     
        <td><strong>Estado</strong></td>
          
   </tr>
<?php
			  while ($f_ordenp=mysql_fetch_array($_pagi_result))
	            {


   if ($ban=='1')
      {
		  $ban=='';
?>	
<table width="100%"  border="1" cellpadding="0" cellspacing="0"  >	   
	   
 <tr class="fuframe1" >
     <td colspan="10" align="center"><font size="+1">Orden Pendiente de Pago</font></td>
  </tr>
    
   
   <tr class="fuframe1" >
    <td><strong>Ejercicio</strong></td>
	 <td width="25"><strong>Fecha</td>
   <td ><strong>Escritural</strong></td>
       <td ><strong>Nr.Orden</strong></td>
       <td ><strong>Beneficiarios</strong></td>
       <td ><strong>Concepto</strong></td>
       <td ><strong>Imp. Pagado</strong></td>
       <td ><strong>Imp. Form</strong></td>
       <td><strong>Saldos Disp</strong></td>
     
        <td><strong>Estado</strong></td>
          
   </tr>

 <?php
	  }
	?> 
 
 <?php
 
     
		 $ejer = $f_ordenp['EJERCICIO']; 
		 //$orden_p = $f_ordenp['FORMULARIO'].'-'.$f_ordenp['SAF'].'-'.$f_ordenp['NUMERO'];  
		 $orden=$f_ordenp['NUMERO'];
		 $num=$f_ordenp['FORMULARIO']; 
		
		 $ESCRITURAL = $f_ordenp['ESCRITURAL'];    
		  $saf_op = $f_ordenp['SAF'];    
		 $d_cuit=$f_ordenp['CUIT'];
		 $estado_op=$f_ordenp['ESTADO'];
		   $IMP1= number_format($f_ordenp['IMP_FORM'],2);
		   $IMP2=number_format($f_ordenp['RETENCION'],2);
		   $IMP3=number_format($f_ordenp['IMPORTE_A_PAGAR'],2);
		    $Imp_orden=number_format($f_ordenp['Imp_orden'],2);
           $Total_Pagado=number_format($f_ordenp['pagado'],2);
		   
		   $orden_p=$num.'-'.$saf_op.'-'.$orden;
		 $inhi_v='';
		 $baja='';
		 
		 
		 include('dgti-mysql-var_dgti-beneficiarios.php');
         include('dgti-intranet-mysql_connect.php');  
         include('dgti-intranet-mysql_select_db.php');
	
		 
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
		     
	     	  
	        $f_g=explode("-", $f_ordenp['FECHA_OP']); 
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
				$inhi_v='BLOR';
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
	  

	 
          <td  height="30" align="center"><?php echo $ejer;?></td> 
		  <td  height="30" align="center"><?php echo $f_ordenp['FECHA_OP'];?></td> 
           <td  align="center"><?php echo $ESCRITURAL;?></td>
          <td  title="<?php echo $obser; ?>"><?php echo $orden_p;?></td>
          <td   title="<?php echo $obser; ?>" align="left"><?php echo substr($beneficiario,0,30);?></font></td>
         <td    title="<?php echo $obser; ?>" align="left"><?php echo substr($f_ordenp['CONCEPTO'],0,20);?></font></td>
           <td  align="right">&nbsp;<?php echo $Imp_orden;?></td>
          <td  align="right">&nbsp;<?php echo $Total_Pagado;?></td>
         
        <td  align="right"><?php echo $IMP3 ;?></td>
          
        
          
            <td height="30" title="<?php echo $obser; ?>"  align="center" >
           <strong>&nbsp;<?php   if($resultado_resta > 366){echo $baja;} 
		                                                            else
																	{ 
		                                                          if($baja!='') { echo $baja; } 
		                                                        elseif ($inhi_v !='')echo $inhi_v; }?></strong></td>
          
 
      <tr>
		<td align="center" colspan="10">
	
		</td>
	</tr>	
<?php        
     } //while
?>	
<tr>
		<td align="center" colspan="10">
	
		</td>
	</tr>	
        
    </table>	

<br />
<br />
<?php
  
 }  //// if cant pendientes de pago
   
 
      

 
	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');



			   
        $_pagi_sql1 = "SELECT ejercicio, o.saf, orden_pago, fecha, apellido, nombre, razon_social, concepto, total,e.ESCRITURAL
FROM orden_pago_fp AS o, beneficiarios_aprobados AS b,saf_escritural as e
				              where (orden_pago='$nom' or cuit ='$nom' ) 
							      and cuitl=cuit
							      and ejercicio <'$y'
								   and o.saf='$id_saf'
								  and e.ID=clave_escritural
								  ORDER BY fecha DESC ";
				 if (!($_pagi_resultp= mysql_query($_pagi_sql1, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}			

	  
	  $a=0;
	  $cantpag = mysql_num_rows($_pagi_resultp);
if($cantpag > 0)
	{
		
	   

 	    
      while ($f_ord=mysql_fetch_array($_pagi_resultp))
	  {
		  
		  
		  
		    $ejer = $f_ord['ejercicio']; 
		    $orden = $f_ord['orden_pago'];  
		    $saf_op = $f_ord['saf'];    
			$orden_p =split("-",$orden);
			$orden_f =$orden_p[0];
			$orden_s=$orden_p[1];
			$orden_n=$orden_p[2];
			
			
			
			 include('dgti-mysql-var_dbtgp.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
		
		 
		  $ssql = "SELECT * FROM orden_pago
			            where NUMERO='$orden_n' 
						AND FORMULARIO='$orden_f'
						and EJERCICIO='$ejer'
						and SAF='$orden_s'
						
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
		  $f_pendiente=mysql_fetch_array($r_conp);
		 $valore=$f_pendiente['ESTADO'];
		 // echo $f_ordenp['saf']; 
		 //if(($cant_p > 0))
		  //{
			  
			    
			  
?>	


<?php if($a==0){ $a=1; ?>

<table width="110%"  border="1" align="left" cellpadding="0" cellspacing="0" bgcolor="#DBE3E6" bordercolor="#EAEAEA">

 <tr class="fuframe1" >
    <?php if ($valore=='P'){?> <td colspan="9" align="center"><font size="+1">PAGOS</font></td> <?php }  if ($valore=='C'){?> <td colspan="9" align="center"><font size="+1">ORDEN PAGADA </font></td> <?php } ?>
	
  </tr>
     
   
   <tr class="fuframe" >
       <td width="18"><strong>Ejercicio</strong></td>
       <td width="18"><strong>Escritural</strong></td>
       <td width="25"><strong>Nr.Orden</strong></td>
       <td width="25"><strong>Fecha Pago</strong></td>
       <td width="65" align="center"><strong>Beneficiarios</strong></td>
       <td width="65" align="center"><strong>Concepto</strong></td>
       <td width="43" colspan="3"><strong>Imp. Pagado</strong></td>
          
   </tr>
 <?php } ?> 
	  <tr bgcolor="#F3F3F3"  class="fuframe1" > 
           
           <td width="31" align="center"><?php echo $f_ord['ejercicio'];?></td>
           <td width="31" align="center"><?php echo $f_ord['ESCRITURAL'];?></td>
          <td width="66" align="center"><?php echo $f_ord['orden_pago'];?></td>
          <td width="85" align="right"><?php echo $f_ord['fecha'];?></td>
          <td width="136" align="left"><?php echo  $f_ord['apellido'].' '.$f_ord['nombre'].''.$f_ord['razon_social'];?></font></td>
         <td width="136" align="left"><?php echo substr($f_ord['concepto'],0,25);?></font></td>
         
          <td width="85" align="right" colspan="3">&nbsp;<?php echo $f_ord['total'];?></td>
           
         
         
           
          
          
<?php	   
		  //}
 	  }
 
   
?>	   

<tr>
		<td align="center" colspan="8">
	
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
      <li><a href="indextesoreria.php?sec=saf/index1&apli=s&per=C">Regresar Menu</a></li>

	<!-- <li><a href="indextesoreria.php?sec=tesoreria/saf_consulta&apli=tgpc&per=A">Beneficiarios - SAF</a> </li>-->
</ul>
</div>
<!--<div class="sidenav">
</div> -->
<div class="clearer"><span></span></div>