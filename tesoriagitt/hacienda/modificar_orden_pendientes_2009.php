 <?php
  error_reporting ( E_ERROR );
//conexion
	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	$aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
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
	
	if (isset($_POST['busca']) and !empty($_POST['busnom']))
			{
		 		
				$nom = $_POST['busnom'];
				$ssql = "SELECT sum(`Saldos`) as saldo,sum(`Imp_orden`) as importe,sum(`Total_Pagado`) as total,count( `Numero_OP` ) as cant 
				FROM op_pendiente_tmp where Ejercicio='$fecha_cons' and Saf='$nom' 
				and nro_ti='$nro' ";
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
		  $nom='';
		  $ssql = "SELECT sum(`Saldos`) as saldo,sum(`Imp_orden`) as importe,sum(`Total_Pagado`) as total,count( `Numero_OP` ) as cant 
		  FROM op_pendiente_tmp where Ejercicio='$fecha_cons' and nro_ti='$nro' ";
				 if (!($r_op= mysql_query($ssql, $conexion_mysql)))
				{
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar buscar area";
				 
				  //.....................................................................
				}
	  }
		



?>
<div class="content">
<h2>Modificar Ordenes Autorizadas  <?php echo $fecha_cons; ?></h2>


<br /> 
<form action="" method="post">

<table width="100%"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
<tr>
    	<td height="30" colspan="3" >Servicio Administrativo Nro.:<input  name="busnom" type="text" id="busnom" size="30" maxlength="50" />
      		<input name="busca" type="submit" class="tabla_jugando" id="busca" value="Buscar" />
            
	  		  
        </td>
         
         
    </tr>
</table>    
</form>
<table width="100%"  border="1" align="left" cellpadding="0" cellspacing="0" bgcolor="#DBE3E6" bordercolor="#EAEAEA">
   <tr align="center" class="fuframe" >
       <td width="45" height="18"><strong>Ejer.</td>
     <td width="45"><strong>SAF</td>
       <td width="95"><strong>Nro. Orden</td>
       <td width="16"><strong></td>
       <td width="90"><strong>Saldos Disp</td>
       <td width="87"><strong>Imp. Form</td>
       <td width="102"><strong>Imp. Pagado</td>
       <td width="81"><strong>Concepto</td>
       <td width="30"><strong>Int</td>
       <td width="54"><strong>Fecha</td>
       <td width="35"><strong>Fte</td>
       <td width="55"><strong>Clase</td>
   </tr>
 </table> 
<iframe src="hacienda/modificaciones_2009.php?apli=hcop&per=A&consul=<?php echo $fecha_cons; ?>&saf=<?php echo $nom; ?>" width="100%" height="400px"
style="height:400px" marginwidth="0" marginheight="0">

</iframe>
<?php
$f_orden=mysql_fetch_array($r_op);
?>
<table width="100%"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
   <tr>
    	<td height="33" colspan="2"><strong>Cantidad de Ordenes Pendietntes:</strong></td>
        <td align="right"><?php echo $f_orden['cant']; ?>
    </tr>

  <tr>
    	<td height="33" colspan="3"><strong>Importes Totales</strong></td>
        
    </tr>
    <tr>
      <td height="31" align="right"><strong>Saldos Disp.:</strong> <?php echo $f_orden['saldo']; ?> </td>
      <td align="center"><strong> Imp. Form.:</strong> <?php echo $f_orden['importe']; ?> </td>
         <td><strong>Imp.Pagado:</strong> <?php echo $f_orden['total']; ?> </td>
         </td>
    </tr>
</table>    
</div>
<div class="sidenav">
<h2></h2>
<ul>
    
	
    <li><a href="indextesoreria.php?sec=hacienda/desconfirmar_orden_pendientes_2009&consul=<?php echo $fecha_cons; ?>&apli=h&per=A">Desconfirmar Ordenes Autorizadas</a></li>
    <li><a href="indextesoreria.php?sec=hacienda/cargar_orden_pendientes_2009&consul=<?php echo $fecha_cons; ?>&apli=h&per=A">Confirmar Ordenes Pendientes</a></li>
     <li><a href="indextesoreria.php?sec=hacienda/ver_cumplase&&consul=<?php echo $fecha_cons; ?>&apli=h&per=A">Imprimir Ordenes Autorizadas</a></li>
     <li><a href="indextesoreria.php?sec=hacienda/index1&apli=h&per=A">Regresar Menu</a></li>
     
	
	<!-- <li><a href="indextesoreria.php?sec=tesoreria/saf_consulta&apli=tgpc&per=A">Beneficiarios - SAF</a> </li>-->
</ul>
</div>
<!--<div class="sidenav">
</div> -->
<div class="clearer"><span></span></div>