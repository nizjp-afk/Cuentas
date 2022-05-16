<?php
  error_reporting ( E_ERROR );
//conexion
$nro =$_GET['cumpla'];

    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');


	
	

   // include('conexion/extras.php');
	$aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
	$saf = $_GET['saf'];
	//$fecha_cons=$_GET['consul'];	
	
	 include('incluir_siempre.php');
	
	
	$ssql = "SELECT * FROM op_pendiente_tmp_saf 
	             order by Saf,Numero_OP ASC  ";
	 if (!($r_op= mysql_query($ssql, $conexion_mysql)))
		{
		  
		  //.....................................................................
		  // informa del error producido
		  $cuerpo1  = "al intentar buscar area";
		 
		  //.....................................................................
		}
	
	
	 $ssql = "SELECT * FROM op_pendiente_tmp_saf 
	          group by Ejercicio order by Ejercicio ";
     if (!($r_ope= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }

$cant= mysql_num_rows($r_op);

 

	



?>
<link href="css/estilos.css" rel="stylesheet" type="text/css" />
<div class="content">
<br />
<br />
<h2>SOLICITUD DE PAGO DE LOS SERVICIOS ADMINISTRATIVOS FINANCIEROS</h2>
<br />
<br />
<br />
<br />
<form action="consolidada/imprimir_cumplase_confirmado_tgp.php?apli=s&per=A" method="post"  target="_blank">
<?php
 
 while($row = mysql_fetch_array($r_ope))
    {
		$Ejercicio =$row['Ejercicio'];
       
 ?>        
   

<table width="100%"  border="1" align="left" cellpadding="0" cellspacing="0" bordercolor="#EAEAEA"> 
<tr>
	<td colspan="12"><strong>Ejercicio <?php echo $Ejercicio; ?> </strong></td>
</tr>

<tr>
     <td align="center">Saf</td>
     <td >Formulario</td>
     <td  align="center">Beneficiario</td>
     <td align="center">Concepto</td>
     <td  align="center">Imp del Form</td>
     <td align="center">Pagados</td>
     <td  align="center">Saldo</td>
     <td  align="center">Autorizado</td>
     <td align="center">Nuevo Saldo</td>
     
     
</tr>

 <?php
 $imp = 0;
 $pagado = 0;
 $saldo = 0;
 $autorizado = 0;
 $nuevo = 0;
 $aux='';
 $i=0;
 mysql_data_seek($r_op,0);
     while ($f_orden=mysql_fetch_array($r_op))
	  {
		  $d_cuit=$f_orden['cuit'];
		  
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
		   
		   if($razon_social_b=='')
		     {
				 $beneficiario=$apellido_b.', '.$nombre_b;
			 }
			else
			 {
				  $beneficiario=$razon_social_b;
			 }
		     
	   if($f_orden['Ejercicio']==$Ejercicio)
	      {
			  
				   $orden=$f_orden['Numero_OP'];  
				   $sa= $f_orden['Saldos'];
				   $au=$f_orden['autorizado'];
				   $nue_saldo=$sa-$au;
				   $saf=$f_orden['Saf'];
				   if ($aux=='')
					 {
						  $aux=$saf;
					 }
				   if($aux==$saf)
					 {
						 
						 $imp=$imp+$f_orden['Imp_orden'];
						 $pagado=$pagado+$f_orden['Total_Pagado'];
						 $saldo = $saldo+$f_orden['Saldos'];
						 $autorizado=$autorizado+$f_orden['autorizado'];
						 $nuevo=$nuevo+$nue_saldo;
						 $i++;
				   
					 }
					else
					 {
			?>
					 <tr align="right" bgcolor="#CCCCCC">
						 
						 <td colspan="4" ><?php echo 'Total del Servicio :' .$i; ?>
						 </td>
						 <td><?php echo number_format($imp,2); ?></td>
						 <td><?php echo number_format($pagado,2); ?></td>
						 <td><?php echo number_format($saldo,2); ?></td>
						 <td><?php echo number_format($autorizado,2); ?></td>
						 <td><?php echo number_format($nuevo,2); ?></td>
					  </tr>   
						 
			<?php			 
						$imp = 0;
						$pagado = 0;
						$saldo = 0;
						$autorizado = 0;
						$nuevo = 0; 
						$i=0;
						$imp=$imp+$f_orden['Imp_orden'];
						$pagado=$pagado+$f_orden['Total_Pagado'];
						$saldo = $saldo+$f_orden['Saldos'];
						$autorizado=$autorizado+$f_orden['autorizado'];
						$nuevo=$nuevo+$nue_saldo;
						$aux=$f_orden['Saf'];
						$i++;
					 }



        	   if($estado=='A')
{
	?>	
 
	    <tr bgcolor="#F3F3F3"  class="taframe"    > 
 <?php 
   }
 else
 {
?>	
 
	    <tr  bgcolor="#CCFFFF" class="taframe" > 
 <?php 
   }
   ?>           <td height="28" align="center"><?php echo $f_orden['Saf'];?></td>
           <td align="center"><?php echo $orden;?></td>

          
           <td align="left"><?php echo $f_orden['Beneficiario'];?></td>
           <td align="left"><?php echo substr($f_orden['Concepto'],0,20);?></td>
           <td align="right">&nbsp;<?php echo number_format($f_orden['Imp_orden'],2);?></td>
           <td align="right">&nbsp;<?php echo number_format($f_orden['Total_Pagado'],2);?></td>  
           <td align="right">&nbsp;<?php echo number_format($f_orden['Saldos'],2);?></td> 
           <td align="right">&nbsp;<?php echo number_format($f_orden['autorizado'],2);?></td>  
           <td align="right">&nbsp;<?php echo number_format($nue_saldo,2);?></td>
          
          
          </tr>


<?php		 
		  }
		  
		
		  
	}
?>	   


<tr>
		<td align="center" colspan="8">
	
		</td>
	</tr>			 

 <tr align="right" bgcolor="#CCCCCC">
						 
						 <td colspan="4" ><?php echo 'Total del Servicio :' .$i; ?>
						 </td>
						 <td><?php echo number_format($imp,2); ?></td>
						 <td><?php echo number_format($pagado,2); ?></td>
						 <td><?php echo number_format($saldo,2); ?></td>
						 <td><?php echo number_format($autorizado,2); ?></td>
						 <td><?php echo number_format($nuevo,2); ?></td>
					  </tr>   
						 
			<?php			 
						$imp = 0;
						$pagado = 0;
						$saldo = 0;
						$autorizado = 0;
						$nuevo = 0; 
						$i=0;
						$imp=$imp+$f_orden['Imp_orden'];
						$pagado=$pagado+$f_orden['Total_Pagado'];
						$saldo = $saldo+$f_orden['Saldos'];
						$autorizado=$autorizado+$f_orden['autorizado'];
						$nuevo=$nuevo+$nue_saldo;
						$aux=$f_orden['Saf'];
						$i++;


	 
	 
	 }
	
?>	
</table>
<table width="100%"  border="0" align="left" cellpadding="0" cellspacing="0" bordercolor="#EAEAEA"> 
<tr>
<?php
   if ($cant >0)
     {
?>		 
    <tr>
       <td height="43"  align="center" ><INPUT type="image" title="Aprobar" src="img/imprimir2.jpg" name="grabar" class="tabla_jugando" > </td>
    </tr>
<?php
	 }
?>	 
</table>
 

 
</form>
</div>

<div class="sidenav">
<h2></h2>
<ul>
   
    <li><?php if ($permisosnecesarios=='A')
	               {
		?>			   
	<a href="indextesoreria.php?sec=hacienda/index1&apli=h&per=A">Regresar Menu</a>
    
    
        <?php 
				   }
		else
		     {
		   ?>
		 		 <a href="indextesoreria.php?sec=tesoreria/index1&apli=tgp&per=C">Regresar Menu</a>
           <?php
			 }
		?>	 
	</li>		 
                   
	
	<!-- <li><a href="indextesoreria.php?sec=tesoreria/saf_consulta&apli=tgpc&per=A">Beneficiarios - SAF</a> </li>-->
</ul>
</div>

<div class="clearer"><span></span></div>