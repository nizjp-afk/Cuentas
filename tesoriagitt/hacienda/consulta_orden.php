 <?php
  error_reporting ( E_ERROR );
//conexion
	include('dgti-mysql-var_dgti-beneficiarios.php');
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
				$fecha_cons = $_POST['fecha_cons'];
				
							  
						
					
					
			 $_pagi_sql = "SELECT * FROM op_pendientes 
				              where Numero_OP='$nom'
							  and Ejercicio >'2008' order by ejercicio ";
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

<h2>Consulta de Ordenes Pendientes / Pagadas </h2>


<br /> 
<form action="" method="post">

<table width="100%"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
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
<?php if(!($bandera=='T'))
   {
	   if ($cant>0)
	     {
?>	   
<table width="100%"  border="1" align="left" cellpadding="0" cellspacing="0" bgcolor="#DBE3E6" bordercolor="#EAEAEA">
 <tr class="fuframe" >
     <td colspan="9" align="center"><font size="+1">Orden Pendiente de Pago</font></td>
  </tr>
     
   
   <tr class="fuframe" >
    <td width="18"><strong>Ejercicio</td>
   <td width="18"><strong>SAF</td>
       <td width="25"><strong>Nr.Orden</td>
       <td width="65" align="center"><strong>Beneficiarios</td>
       <td width="65" align="center"><strong>Concepto</td>
       <td width="43"><strong>Imp. Pagado</td>
       <td width="43"><strong>Imp. Form</td>
       <td width="43"><strong>Saldos Disp</td>
        <td><strong>Estado</strong></td>
          
   </tr>

 
 
 <?php
 
      while ($f_ordenp=mysql_fetch_array($_pagi_result))
	  {
		  
		 $ejer = $f_ordenp['Ejercicio'];   
		 $d_cuit=$f_ordenp['cuit'];
		 $estado_op=$f_ordenp['estado'];
		 $inhi_v='';
		 $baja='';
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
		     
	     	  
	
 
	   if(($estado=='A') and ($inhi=='') and ($estado_op=='N'))
{
	?>	
 
	    <tr bgcolor="#F3F3F3"  class="fuframe" > 
 <?php 
   }
 else
 {
	 if($estado_op=='B')
	    {	
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
	   if ($estado_op=='R')
	     {
	      if($inhi!=''){ $inhi_v='INHI';}
	      if($estado=='B'){ $baja='BAJA';}
		  if(($inhi=='') and ($estado=='A'))
		    {
				$inhi_v='BLOQ';
			}
	   ?>		
 
	    <tr bgcolor="#CCFFFF" class="fuframe" > 
 <?php 
         }
	   }
	  
 }
?>     
  
	 
          <td width="31" align="center"><?php echo $f_ordenp['Ejercicio'];?></td> 
           <td width="31" align="center"><?php echo $f_ordenp['Saf'];?></td>
          <td width="66" align="center"><?php echo $f_ordenp['Numero_OP'];?></td>
          <td width="136" align="left"><?php echo substr($f_ordenp['Beneficiario'],0,20);?></font></td>
         <td width="136" align="left"><?php echo substr($f_ordenp['Concepto'],0,25);?></font></td>
         
          <td width="85" align="right">&nbsp;<?php echo $f_ordenp['Total_Pagado'];?></td>
           <td width="77" align="right">&nbsp;<?php echo $f_ordenp['Imp_orden'];?></td>
          <td width="77" align="right"><?php echo $f_ordenp['Saldos'];?></td>
           <td height="30"  align="center" ><strong>&nbsp;<?php if ($estado=='B') { echo $baja; } else { echo $inhi_v; }?></strong></td>
          
 
      </tr>
<tr>
		<td align="center" colspan="9">
	
		</td>
	</tr>	
        
</table>      
      
<?php	   
        $_pagi_sql1 = "SELECT * FROM orden_pago 
				              where orden_pago='$nom' 
							   and ejercicio ='$ejer'
							   and ejercicio >'2008'";
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
	   
?>


<table width="100%"  border="1" align="left" cellpadding="0" cellspacing="0" bgcolor="#DBE3E6" bordercolor="#EAEAEA">
 <br />
 <tr class="fuframe" >
     <td colspan="8" align="center"><font size="+1">Orden Pagada Parcial</font></td>
  </tr>
     
   
   <tr class="fuframe" >
        <td width="18"><strong>Ejercicio</td>
       <td width="18"><strong>SAF</td>
       <td width="25"><strong>Nr.Orden</td>
       <td width="25"><strong>Fecha Pago</td>
       <td width="65" align="center"><strong>Beneficiarios</td>
       <td width="65" align="center"><strong>Concepto</td>
       <td width="43"><strong>Imp. Pagado</td>
          
   </tr>
<?php 	    
      while ($f_ordenp=mysql_fetch_array($_pagi_result1))
	  {
		 
		 $cuil = $f_ordenp['cuit'];
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
  
	  <tr bgcolor="#F3F3F3"  class="fuframe1" > 
           
           <td width="31" align="center"><?php echo $f_ordenp['ejercicio'];?></td>
           <td width="31" align="center"><?php echo $f_ordenp['saf'];?></td>
          <td width="66" align="center"><?php echo $f_ordenp['orden_pago'];?></td>
          <td width="85" align="right"><?php echo $f_ordenp['fecha'];?></td>
          <td width="136" align="left"><?php echo $f_benef['apellido'].''.$f_benef['nombre'].''.$f_benef['razon_social'];;?></font></td>
         <td width="136" align="left"><?php echo substr($f_ordenp['concepto'],0,25);?></font></td>
         
          <td width="85" align="right">&nbsp;<?php echo $f_ordenp['total'];?></td>
           
         
         
           
          
          
<?php	   
  
	  }
	  	   
   
?>	   

<tr>
		<td align="center" colspan="8">
	
		</td>
	</tr>	
        
</table>






<?php	   
	  }


   
        $_pagi_sql1 = "SELECT * FROM orden_pago 
				              where orden_pago='$nom' 
							  and ejercicio >'2008' ";
				 if (!($_pagi_result1= mysql_query($_pagi_sql1, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}
	 							

	  
	  $cant1 = mysql_num_rows($_pagi_result1);
	  
	
  if($cant1 > 0)
     {	   
?>


<table width="100%"  border="1" align="left" cellpadding="0" cellspacing="0" bgcolor="#DBE3E6" bordercolor="#EAEAEA">
 <br />
 <tr class="fuframe" >
     <td colspan="8" align="center"><font size="+1">Orden Pagadas Total</font></td>
  </tr>
     
   
   <tr class="fuframe" >
        <td width="18"><strong>Ejercicio</td>
       <td width="18"><strong>SAF</td>
       <td width="25"><strong>Nr.Orden</td>
       <td width="25"><strong>Fecha Pago</td>
       <td width="65" align="center"><strong>Beneficiarios</td>
       <td width="65" align="center"><strong>Concepto</td>
       <td width="43"><strong>Imp. Pagado</td>
          
   </tr>
<?php 	    
      while ($f_ordenp=mysql_fetch_array($_pagi_result1))
	  {
		// echo $f_ordenp['saf'];
		 $cuil = $f_ordenp['cuit'];
		 $_pagi_sql1 = "SELECT * from beneficiarios_aprobados 
				        where cuitl='$cuil'
						";
				 if (!($_benef= mysql_query($_pagi_sql1, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}
			$f_benef=mysql_fetch_array($_benef);		
		   
?>	
  
	  <tr bgcolor="#F3F3F3"  class="fuframe1" > 
           
           <td width="31" align="center"><?php echo $f_ordenp['ejercicio'];?></td>
           <td width="31" align="center"><?php echo $f_ordenp['saf'];?></td>
          <td width="66" align="center"><?php echo $f_ordenp['orden_pago'];?></td>
          <td width="85" align="right"><?php echo $f_ordenp['fecha'];?></td>
          <td width="136" align="left"><?php echo $f_benef['apellido'].' '.$f_benef['nombre'].''.$f_benef['razon_social'];?></font></td>
         <td width="136" align="left"><?php echo substr($f_ordenp['concepto'],0,25);?></font></td>
         
          <td width="85" align="right">&nbsp;<?php echo $f_ordenp['total'];?></td>
           
         
         
           
          
          
<?php	   
  
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
 
<?php
   }
  else
     {
		 
			   
        $_pagi_sql1 = "SELECT * FROM orden_pago,beneficiarios_aprobados 
				              where orden_pago='$nom'  and cuitl=cuit
							  and ejercicio >'2008' ";
				 if (!($_pagi_result1= mysql_query($_pagi_sql1, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}			

	  
	  
	  
	
	   
?>


<table width="100%"  border="1" align="left" cellpadding="0" cellspacing="0" bgcolor="#DBE3E6" bordercolor="#EAEAEA">
 <br />
 <tr class="fuframe" >
     <td colspan="8" align="center"><font size="+1">Orden Pagada Total</font></td>
  </tr>
     
   
   <tr class="fuframe" >
        <td width="18"><strong>Ejercicio</td>
       <td width="18"><strong>SAF</td>
       <td width="25"><strong>Nr.Orden</td>
       <td width="25"><strong>Fecha Pago</td>
       <td width="65" align="center"><strong>Beneficiarios</td>
       <td width="65" align="center"><strong>Concepto</td>
       <td width="43"><strong>Imp. Pagado</td>
          
   </tr>
<?php 	    
      while ($f_ordenp=mysql_fetch_array($_pagi_result1))
	  {
		 
		 // echo $f_ordenp['saf']; 
?>	
  
	  <tr bgcolor="#F3F3F3"  class="fuframe1" > 
           
           <td width="31" align="center"><?php echo $f_ordenp['ejercicio'];?></td>
           <td width="31" align="center"><?php echo $f_ordenp[2];?></td>
          <td width="66" align="center"><?php echo $f_ordenp['orden_pago'];?></td>
          <td width="85" align="right"><?php echo $f_ordenp['fecha'];?></td>
          <td width="136" align="left"><?php echo  $f_ordenp['apellido'].' '.$f_ordenp['nombre'].''.$f_ordenp['razon_social'];;?></font></td>
         <td width="136" align="left"><?php echo substr($f_ordenp['concepto'],0,25);?></font></td>
         
          <td width="85" align="right">&nbsp;<?php echo $f_ordenp['total'];?></td>
           
         
         
           
          
          
<?php	   
  
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

    
</div>
<div class="sidenav_op">
<h2></h2>
<ul>
     <li><strong> &nbsp;BAJA: </strong>Baja de Beneficiario</li>
     <li><strong> &nbsp;BLOQ: </strong>O.P Bloqueada</li>
     <li><strong> &nbsp;INHI: </strong>Situacion Cta</li>
</ul>
</div>
<div class="sidenav_m">
<h2></h2>
<ul>
     
     <li><strong> &nbsp;&nbsp; </strong>Baja de Orden de Pago</li>
 </ul>
 </div>    
<div class="sidenav_p">
<h2></h2>
<ul>
 <?php if ($nrosaf=='C')
{
	?>

      <li><a href="indextesoreria.php?sec=tribunal/index1&apli=tgpa&per=O">Regresar Menu</a></li>
	<?php
}
else
{
		?>

     <li><a href="indextesoreria.php?sec=hacienda/index1&apli=h&per=A&band='T'">Regresar Menu</a></li>
	<?php
}
?>   

     
	
	<!-- <li><a href="indextesoreria.php?sec=tesoreria/saf_consulta&apli=tgpc&per=A">Beneficiarios - SAF</a> </li>-->
</ul>
</div>
<!--<div class="sidenav">
</div> -->
<div class="clearer"><span></span></div>