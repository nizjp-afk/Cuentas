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
	
	 $ssql = "SELECT * FROM op_pendientes where Ejercicio='$fecha_cons' ";
     if (!($r_op= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
	
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
           <td width="45" height="28" align="center"><?php echo $f_orden['Ejercicio'];?></td>
           <td width="45" align="center"><?php echo $f_orden['Saf'];?></td>
          <td width="95" align="center"><?php echo $f_orden['Numero_OP'];?></td>
          <td width="16" align="center"><a target="_parent" href="confirmar_pago.php?apli=hcop&consul=<?php echo $fecha_cons; ?>&per=A&id=<?php echo $f_orden['id']; ?>&nomb=<?php echo $nom; ?>"><img src="../img/ok.png" border="0" height="16" width="16"/></a></td>
          <td width="90" align="right"><?php echo $f_orden['Saldos'];?></td>
          
          <td width="87" align="right">&nbsp;<?php echo $f_orden['Imp_orden'];?></td>
          <td width="102" align="right">&nbsp;<?php echo $f_orden['Total_Pagado'];?></td>
          <td width="81" align="left"><?php echo substr($f_orden['Concepto'],0,20);?></td>
          <td width="30" align="left">&nbsp;<?php echo $f_orden['Numero_Int'];?></td>
          <td width="54" align="left">&nbsp;<?php echo $f_orden['Fecha_OP'];?></td>
          <td width="35" align="left">&nbsp;<?php echo $f_orden['Fuente'];?></td>
          <td width="55" align="left"><?php echo $f_orden['Clase'];?></td>
          </tr>
          
<?php	   
     
	   
	   }
?>	   

<tr>
		<td align="center" colspan="8">
	
		</td>
	</tr>	   
</table>

