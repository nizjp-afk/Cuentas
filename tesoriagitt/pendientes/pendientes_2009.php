 <?php
 error_reporting ( E_ERROR ); 
//conexion
	include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
   // include('conexion/extras.php');
	$aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
	$saf = $_GET['saf'];
	$nom=trim($saf);
	$fecha_cons=$_GET['consul'];
	
	 
	
  if ($saf=='')
	 { 
		 $ssql = "SELECT * FROM op_pendientes where Ejercicio='$fecha_cons' ";
			 if (!($r_op= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar area";
			 
			  //.....................................................................
			}
	 }
	else
	 {
		
		  $ssql = "SELECT * FROM op_pendientes where Ejercicio='$fecha_cons' 
		           and (Saf='$nom' or Numero_OP='$nom')";
					 if (!($r_op= mysql_query($ssql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}
	 }


?>
<link href="../css/estilos.css" rel="stylesheet" type="text/css" />

<table width="100%"  border="1" align="left" cellpadding="0" cellspacing="0" bordercolor="#EAEAEA"> 
 
 <?php
 
      while ($f_orden=mysql_fetch_array($r_op))
	  {
?>	
  
	    <tr bgcolor="#F3F3F3" class="fuframe" > 
           
           <td width="28" align="center"><?php echo $f_orden['Saf'];?></td>
          <td width="60" align="center"><?php echo $f_orden['Numero_OP'];?></td>
          
          <td width="70" align="right"><?php echo $f_orden['Saldos'];?></td>
          
          <td width="70" align="right">&nbsp;<?php echo $f_orden['Imp_orden'];?></td>
          <td width="70" align="right">&nbsp;<?php echo $f_orden['Total_Pagado'];?></td>
           <td width="130" align="left"><font size="-5"><?php echo substr($f_orden['Beneficiario'],0,20);?></font></td>
          <td width="60" align="left"><font size="-5"><?php echo substr($f_orden['Concepto'],0,15);?></font></td>
          
          <td width="64" align="left">&nbsp;<?php echo $f_orden['Fecha_OP'];?></td>
         
          
          
<?php	   
     
	   
	   }
?>	   

<tr>
		<td align="center" colspan="8">
	
		</td>
	</tr>	   
</table>

