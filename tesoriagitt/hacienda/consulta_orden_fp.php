 <?php
  error_reporting ( E_ERROR );
//conexion
	 include('dgti-mysql-var_dbtgp.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	
	$aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
	$bandera = $_GET['band'];
	
	////verifica fecha
	
	$d_fecha=date('Y-m-d');
	
	
if (isset($_POST['busca']) and !empty($_POST['busnom']))
			{
		 		//echo 'pas0';
				
				$bandera = $_POST['band'];
				 $nom = $_POST['busnom'];
				 $op =explode("-",$nom);
				 $op_n=$op[2];
				 $op_s=$op[1];
				 $op_f=$op[0];
				
				$fecha_cons = $_POST['fecha_cons'];
				
							  
						
					
					
			 $_pagi_sql = "SELECT *, (IMP_FORM - RETENCION - IMPORTE_A_PAGAR) AS pagado, (IMP_FORM - RETENCION )as Imp_orden  FROM orden_pago
				              where ((NUMERO='$op_n' and FORMULARIO='$op_f' AND SAF='$op_s') or CUIT ='$nom' )
							  and ESTADO!='C'
							   order by EJERCICIO ";
							  
				 if (!($_pagi_result= mysql_query($_pagi_sql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}		
		$cant = mysql_num_rows($_pagi_result);
					  
					
 }
			  


?>
<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
<div class="content">

<h2>Consulta de Ordenes Pendientes / Pagadas -Fondos Propios- </h2>


<br /> 
<form action="" method="post">

<table width="110%"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
<tr>
    	<td height="30" colspan="3" class="fuframe1" >O.P. :<input  name="busnom" type="text" id="busnom" size="30" maxlength="50" />
      		<input name="busca" type="submit" class="tabla_jugando" id="busca" value="Buscar" />
            <input type="hidden" name="fecha_cons" value="<?php echo  $fecha_cons; ?>" />
            <input type="hidden" name="band" value="O" /> 
            
	  		  
        <td height="30" colspan="2" ><?php if (!($bandera=='T')) { ?><a title="Listado de Orden de Pago" href="pendientes/listado_ordenes_pendientes_dir.php?consul=<?php echo $fecha_cons ?>&nom=<?php echo $nom; ?>" target="_blank"  ><img src="img/print_odp.jpg" width="35" align="" height="24" border="0"/></a>   
		<?php } ?></td>   
         
         
    </tr>
</table>    
</form>
<?php
	   if ($cant>0)
	     {
?>			 
<table width="110%"  border="1" cellpadding="0" cellspacing="0"  >	   
 <tr class="fuframe1" >
     <td colspan="9" align="center"><font size="+1">Orden Pendiente de Pago</font></td>
  </tr>
  <tr class="fuframe1" >
    <td><strong>Ejercicio</strong></td>
   <td ><strong>SAF</strong></td>
       <td ><strong>Nr.Orden</strong></td>
       <td ><strong>Beneficiarios</strong></td>
       <td ><strong>Concepto</strong></td>
       <td ><strong>Imp. Pagado</strong></td>
       <td ><strong>Imp. Form</strong></td>
       <td><strong>Saldos Disp</strong></td>
     
        <td><strong>Estado</strong></td>
          
   </tr>
<?php
			  while ($f_ordenp=mysql_fetch_array($_pagi_result))
	            {


   if ($bandera=='1')
      {
		  $bandera=='';
?>		   
 <tr class="fuframe1" >
     <td colspan="9" align="center"><font size="+1">Orden Pendiente de Pago</font></td>
  </tr>
    
   
   <tr class="fuframe1" >
    <td><strong>Ejercicio</strong></td>
   <td ><strong>SAF</strong></td>
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
		
		 $saf_op = $f_ordenp['SAF'];    
		 $d_cuit=$f_ordenp['CUIT'];
		 $estado_op=$f_ordenp['ESTADO'];
		   $IMP1= number_format($f_ordenp['IMP_FORM'],2);
		   $IMP2=number_format($f_ordenp['RETENCION'],2);
		   $IMP3=number_format($f_ordenp['IMPORTE_A_PAGAR'],2);
		    $Imp_orden=number_format($f_ordenp['Imp_orden'],2);
           $Total_Pagado=$f_ordenp['pagado'];
		   
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
		     
	     	  
	
 
	 if(($estado=='A') and ($inhi=='') and (($estado_op=='P') or ($estado_op=='I')) )
{
	 if ($estado_op=='I')
	    
		    {
				$inhi_v='IMPUESTO';
			}
	?>	
 
	    <tr bgcolor="#F3F3F3"  class="fuframe" > 
 <?php 
   }
 else
 {
	  if($estado_op=='A')
	    {
			$inhi_v='B';	
?>		
 
	    <tr bgcolor="#FFCB97" class="fuframe" > 
 <?php 
       } 
	 else 
	   {  
	  
	if(($inhi!='') or ($estado=='B') )
	   {	
	   if($inhi!=''){ $inhi_v='INHI';}
	   if($estado=='B'){ $baja='BAJA';}
?>		
 
	    <tr bgcolor="#CCFFFF" class="fuframe" > 
 <?php 
       }
	   if ($estado_op=='B')
	     {
	      if($inhi!=''){ $inhi_v='INHI';}
	      if($estado=='B'){ $baja='BAJA';}
		  if(($inhi=='') and ($estado=='A'))
		    {
				$inhi_v='BLOQ';
			}
	   ?>		
 
	    <tr bgcolor="#FFCB97" class="fuframe" > 
 <?php 
         }
	   }
	  
 }
?>	
  
	 
          <td  height="30" align="center"><?php echo $ejer;?></td> 
           <td  align="center"><?php echo $saf_op;?></td>
          <td  title="<?php echo $obser; ?>"><?php echo $orden_p;?></td>
          <td   title="<?php echo $obser; ?>" align="left"><?php echo substr($beneficiario,0,30);?></font></td>
         <td    title="<?php echo $obser; ?>" align="left"><?php echo substr($f_ordenp['CONCEPTO'],0,20);?></font></td>
          <td  align="right">&nbsp;<?php echo $Total_Pagado;?></td>
           <td  align="right">&nbsp;<?php echo $Imp_orden;?></td>
        <td  align="right"><?php echo $IMP3 ;?></td>
          
        
          
           <td height="30" title="<?php echo $obser; ?>"  align="center" ><strong>&nbsp;<?php 
		   if ($estado=='B') 
		   { echo $baja; } 
		   else 
		   { echo $inhi_v; }?></strong></td>
          
 
      </tr>
<tr>
		<td align="center" colspan="9">
	
		</td>
	</tr>	
        
      
<?php	   
  include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
	
        $_pagi_sql1 = "SELECT * FROM orden_pago_fp 
				              where orden_pago='$orden_p' 
							   and ejercicio ='$ejer'
							   and saf='$saf_op'";
				 if (!($_pagi_result1= mysql_query($_pagi_sql1, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}			

	  
	  $cantp = mysql_num_rows($_pagi_result1);
	  
	
  if($cantp > 0)
	  
	  {
	   $bandera=1;
?>



 <tr class="fuframe1" >
     <td colspan="9" align="center"><font size="+1">Orden Pagada Parcial</font></td>
  </tr>
     
   
   <tr class="fuframe1" >
        <td> <strong>Ejercicio</td>
       <td> <strong>SAF</td>
       <td> <strong>Nr.Orden</td>
       <td><strong>Fecha Pago</td>
       <td><strong>Beneficiarios</td>
       <td ><strong>Concepto</td>
       <td  colspan="3"><strong>Imp. Pagado</td>
          
   </tr>
<?php 	    
      while ($f_orden=mysql_fetch_array($_pagi_result1))
	  {
		 
		 $cuil = $f_orden['cuit'];
		 $sql = "SELECT * From beneficiarios_aprobados 
				        where cuitl='$cuil'	";
				 if (!($_benef= mysql_query($sql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}
			$f_benef=mysql_fetch_array($_benef);		
		   
?>	
  
	  <tr bgcolor="#F3F3F3"  class="fuframe" > 
           
           <td width="31" align="center"><?php echo $f_orden['ejercicio'];?></td>
           <td width="31" align="center"><?php echo $f_orden['saf'];?></td>
          <td width="66" align="center"><?php echo $f_orden['orden_pago'];?></td>
          <td width="85" align="right"><?php echo $f_orden['fecha'];?></td>
          <td width="136" align="left"><?php echo substr($beneficiario,0,30)?></font></td>
         <td width="136" align="left"><?php echo substr($f_orden['concepto'],0,25);?></font></td>
         
          <td width="85" align="right" colspan="3">&nbsp;<?php echo $f_orden['total'];?></td>
           
         
         
           
          </tr>
          
<?php	   
  
	  }
	  	   
   
?>	   

<tr>
		<td align="center" colspan="8">
	
		</td>
	</tr>	
        







<?php	   
	  }



 }
	
	   
	   
	   
?>

<br />
<br />
 </table>
<?php
   }////pendientes de pago
  else
  {
 
	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
			   
        $_pagi_sql1 = "SELECT ejercicio, o.saf, orden_pago, fecha, apellido, nombre, razon_social, concepto, total
FROM orden_pago_fp AS o, beneficiarios_aprobados AS b
				              where (orden_pago='$nom' or cuit ='$nom') 
							      and cuitl=cuit
							      and ejercicio >'2008' ORDER BY fecha DESC ";
				 if (!($_pagi_resultp= mysql_query($_pagi_sql1, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}			

	  
	  
	  
	
	   
?>


<table width="110%"  border="1" align="left" cellpadding="0" cellspacing="0" bgcolor="#DBE3E6" bordercolor="#EAEAEA">
 <br />
 <tr class="fuframe1" >
     <td colspan="9" align="center"><font size="+1">Orden Pagada Total</font></td>
  </tr>
     
   
   <tr class="fuframe" >
       <td width="18"><strong>Ejercicio</strong></td>
       <td width="18"><strong>SAF</strong></td>
       <td width="25"><strong>Nr.Orden</strong></td>
       <td width="25"><strong>Fecha Pago</strong></td>
       <td width="65" align="center"><strong>Beneficiarios</strong></td>
       <td width="65" align="center"><strong>Concepto</strong></td>
       <td width="43" colspan="3"><strong>Imp. Pagado</strong></td>
          
   </tr>
<?php 	    
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
		 
		 // echo $f_ordenp['saf']; 
		 if($cant_p > 0)
		  {
?>	
  
	  <tr bgcolor="#F3F3F3"  class="fuframe1" > 
           
           <td width="31" align="center"><?php echo $f_ord['ejercicio'];?></td>
           <td width="31" align="center"><?php echo $f_ord['saf'];?></td>
          <td width="66" align="center"><?php echo $f_ord['orden_pago'];?></td>
          <td width="85" align="right"><?php echo $f_ord['fecha'];?></td>
          <td width="136" align="left"><?php echo  $f_ord['apellido'].' '.$f_ord['nombre'].''.$f_ord['razon_social'];?></font></td>
         <td width="136" align="left"><?php echo substr($f_ord['concepto'],0,25);?></font></td>
         
          <td width="85" align="right" colspan="3">&nbsp;<?php echo $f_ord['total'];?></td>
           
         
         
           
          
          
<?php	   
		  }
 	  }
  }
   
?>	   

<tr>
		<td align="center" colspan="8">
	
		</td>
	</tr>	
        
</table>



    
</div>
<div class="sidenav_op">
<h2></h2>
<ul>
     <li><strong> &nbsp;BAJA: </strong>Baja de Beneficiario</li>
    
     <li><strong> &nbsp;INHI: </strong>Situacion Cta</li>
</ul>
</div>
<div class="sidenav_m">
<h2></h2>
<ul>
      <li><strong> &nbsp;BLOQ: </strong>O.P Bloqueada</li>
     <li><strong> &nbsp;B: </strong>Baja de Orden de Pago</li>
 </ul>
 </div> 
 <div class="sidenav_p">
<h2></h2>
<ul>
      <li><strong> &nbsp;IMPUESTO: </strong>Control de Reten.</li>
     
 </ul>
 </div>    
<div class="sidenav_p">
<h2></h2>
<ul>
    

      <li><a href="indextesoreria.php?sec=hacienda/index1&apli=h&per=A">Regresar Menu</a></li>
	
	<!-- <li><a href="indextesoreria.php?sec=tesoreria/saf_consulta&apli=tgpc&per=A">Beneficiarios - SAF</a> </li>-->
</ul>
</div>
<!--<div class="sidenav">
</div> -->
<div class="clearer"><span></span></div>