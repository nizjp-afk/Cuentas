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
	
	$ssql = "SELECT * FROM `control_fecha`";
     if (!($r_cf= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }	
	
	$f_cf=mysql_fetch_array($r_cf);
	$nro =$f_cf['nro_ti'];
	
	 $ssql = "SELECT * FROM op_pendiente_tmp where Ejercicio='$fecha_cons' and nro_ti='$nro' ";
     if (!($r_op= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
	
  if ($saf=='')
	 { 
		 $ssql = "SELECT * FROM op_pendiente_tmp where Ejercicio='$fecha_cons' and nro_ti='$nro' ";
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
		
		  $ssql = "SELECT * FROM op_pendiente_tmp where Ejercicio='$fecha_cons' 
		            and nro_ti='$nro' and (Saf='$nom' or Numero_OP='$nom') ";
					 if (!($r_op= mysql_query($ssql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}
	 }
$ssql = "SELECT MAX( `id` ) AS cant
         FROM op_pendiente_tmp";
				 if (!($r_max= mysql_query($ssql, $conexion_mysql)))
				{
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar buscar area";
				 
				  //.....................................................................
				}	 
	 
 $f_max=mysql_fetch_array($r_max);
 $cant=$f_max['cant'];

?>
<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
<form action="modificar_importe.php?apli=hcop&per=A&consul=<?php echo $fecha_cons; ?>" method="post" target="_parent">
<table width="100%"  border="1" align="left" cellpadding="0" cellspacing="0" bordercolor="#EAEAEA"> 
<input type="hidden" name="cantidad" value="<?php echo $cant; ?>" /> 
 <?php
 
      while ($f_orden=mysql_fetch_array($r_op))
	  {
?>	
      <input type="hidden" name="s<?php echo $f_orden['id'];?>" value="<?php echo $f_orden['Saldos'];?>"  />
	    <tr bgcolor="#F3F3F3" class="fuframe" > 
           <td height="28" align="center"><?php echo $f_orden['Ejercicio'];?></td>
           <td align="center"><?php echo $f_orden['Saf'];?></td>
          <td align="center"><?php echo $f_orden['Numero_OP'];?></td>
          <td align="center"><INPUT type="image" width="16" height="16" title="confirmar" src="../img/ok.png" /></td>
          <td align="right"><input type="text" size="8" name="i<?php echo $f_orden['id'];?>" value="<?php echo $f_orden['autorizado'];?>" /></td>
          
          <td align="right">&nbsp;<?php echo $f_orden['Imp_orden'];?></td>
          <td align="right">&nbsp;<?php echo $f_orden['Total_Pagado'];?></td>
          <td align="left"><?php echo substr($f_orden['Concepto'],0,20);?></td>
          <td align="left">&nbsp;<?php echo $f_orden['Numero_Int'];?></td>
          <td align="left">&nbsp;<?php echo $f_orden['Fecha_OP'];?></td>
          <td align="left">&nbsp;<?php echo $f_orden['Fuente'];?></td>
          <td align="left"><?php echo $f_orden['Clase'];?></td>
          </tr>
          
<?php	   
     
	   
	   }
?>	   

<tr>
		<td align="center" colspan="8">
	
		</td>
	</tr>	   
</table>

