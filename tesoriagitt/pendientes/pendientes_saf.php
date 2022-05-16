 <?php
 error_reporting ( E_ERROR ); 
//conexion
	include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
   // include('conexion/extras.php');
	$aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
	$consop = $_GET['busnom'];
	$nrosafc = $_GET['saf'];
	$fecha_cons=$_GET['consul'];
	//echo $nom;exit;
	 
	
  if ($consop=='')
	 { 
		 $ssql = "SELECT * FROM op_pendientes where Ejercicio='$fecha_cons' and Saf='$nrosafc' ";
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
		           and Saf='$nrosafc' and Numero_OP='$consop'";
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
           
           <td width="31" align="center"><?php echo $f_orden['Saf'];?></td>
          <td width="66" align="center"><?php echo $f_orden['Numero_OP'];?></td>
          
          <td width="77" align="right"><?php echo $f_orden['Saldos'];?></td>
          
          <td width="77" align="right">&nbsp;<?php echo $f_orden['Imp_orden'];?></td>
          <td width="85" align="right">&nbsp;<?php echo $f_orden['Total_Pagado'];?></td>
           <td width="136" align="left"><font size="-5"><?php echo substr($f_orden['Beneficiario'],0,20);?></font></td>
         
          
          <td width="50" align="left">&nbsp;<?php echo $f_orden['Fecha_OP'];?></td>
         
          
          
<?php	   
     
	   
	   }
?>	   

<tr>
		<td align="center" colspan="8">
	
		</td>
	</tr>	   
</table>

