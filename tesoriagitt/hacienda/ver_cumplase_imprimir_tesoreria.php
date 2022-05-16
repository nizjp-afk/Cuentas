<?php
  error_reporting ( E_ERROR );
//conexion
$nro =$_GET['cumpla'];

    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');

$ssql = "SELECT * FROM `op_pendiente_tmp` where nro_ti='$nro' and tesoreria=''" ;
     if (!($r_cf= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }	
	
	echo $visto = mysql_num_rows($r_cf);
	
	
if ($visto > 0)
    {

		$ssql = "UPDATE `op_pendiente_tmp` SET tesoreria='V' where  nro_ti='$nro'";
			 if (!($r_cf= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar area";
			 
			  //.....................................................................
			}

mail("manuelfuentesoro@gmail.com,aurora.lobos@gmail.com","Recibido TGP","Visto el cumplase ");   
	}






	
   // include('conexion/extras.php');
	$aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
	$saf = $_GET['saf'];
	//$fecha_cons=$_GET['consul'];	
	
	 include('incluir_siempre.php');
	
	
	$ssql = "SELECT * FROM op_pendiente_tmp where nro_ti='$nro' order by Saf,Numero_OP ASC  ";
	 if (!($r_op= mysql_query($ssql, $conexion_mysql)))
		{
		  
		  //.....................................................................
		  // informa del error producido
		  $cuerpo1  = "al intentar buscar area";
		 
		  //.....................................................................
		}
	
	
	 $ssql = "SELECT * FROM op_pendiente_tmp where nro_ti='$nro' group by Ejercicio order by Ejercicio ";
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
<h2>Cumplase Autorizado <?php echo $nro;?></h2>
<br />
<br />
<br />
<br />
<form action="hacienda/imprimir_cumplase_confirmado.php?apli=hcop&per=A&cumpla=<?php echo $nro;?>" method="post"  target="_blank">
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
     <td width="3%" align="center">Saf</td>
     <td colspan="2" width="8%">Formulario</td>
     <td width="5%" >Fuente</td>
     <td width="5%" align="center">Clase</td>
     <td width="18%" align="center">Beneficiario</td>
     <td width="9%" align="center">Concepto</td>
     <td width="8%" align="center">Imp del Form</td>
     <td width="8%" align="center">Pagados</td>
     <td width="7%" align="center">Saldo</td>
     <td width="10%" align="center">Autorizado</td>
     <td width="10%" align="center">Nuevo Saldo</td>
     
     
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
	   if($f_orden['Ejercicio']==$Ejercicio)
	      {
			  
				   $orden= split("-",$f_orden['Numero_OP']);  
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
						 
						 <td colspan="7" ><?php echo 'Total del Servicio :' .$i; ?>
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

        <tr bgcolor="#F3F3F3" class="taframe" > 
           <td height="28" align="center"><?php echo $f_orden['Saf'];?></td>
           <td width="4%" align="center"><?php echo $orden[0];?></td>
           <td width="6%" align="center"><?php echo $orden[1];?></td>
           <td align="left">&nbsp;<?php echo $f_orden['Fuente'];?></td>
           <td align="left"><?php echo $f_orden['Clase'];?></td>
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
						 
						 <td colspan="7" ><?php echo 'Total del Servicio :' .$i; ?>
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
<table width="100%"  border="0" align="left" cellpadding="0" cellspacing="0" bordercolor="#EAEAEA"> 
<?php
   if ($cant >0)
     {
?>		 
    <tr>
       <td height="43"  align="center" ><INPUT type="image" title="Aprobar" src="img/aprobado.png" name="grabar" class="tabla_jugando" >&nbsp;&nbsp;<a href="contaduria/excel_cumplase.php?apli=h&per=C&cumpla=<?php echo $nro;?>"><img src="img/cargar_d.png"  border="0" /></a></td>
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