<?php
 error_reporting (E_ERROR); 
 
    header("Content-type: application/ms-excel");
	header("Content-Disposition: attachment; filename=PAGOS.xls");
    header("Pragma: no-cache"); 
    header("Expires: 0");
   /* include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
	*/
	
	//$escritural = $_POST['saf'];
	$fechaant = $_POST['firstinput'];
	$fechahoy = $_POST['secondinput']; 
				
	 include('../dgti-mysql-var_dbtgp.php');
	 include('../dgti-intranet-mysql_connect.php');  
	 include('../dgti-intranet-mysql_select_db.php');
			   
	//include('../conexion/extras.php');  	
   
   $nom=$_POST['saf'];
   
   
   if($nom !='N')
    {
	
		 					  
	
	  $sql="SELECT  `orden_pago`.`SAF`, CONCAT(`orden_pago`.`FORMULARIO`,'-',`orden_pago`.`SAF`,'-', `orden_pago`.`NUMERO`) ORDEN, `orden_pago`.`EJERCICIO`,  `orden_pago`.`FUENTE`, `orden_pago`.`CLASE`, `orden_pago`.`CUIT`, `orden_pago`.`BENEFICIARIO`, `orden_pago`.`CONCEPTO`, `orden_pago`.`IMP_FORM`, `orden_pago`.`RETENCION`, `orden_pago`.`IMPORTE_A_PAGAR` as SALDO,`pagos_web`.`FECHA_DE_PAGO`,`pagos_web`.`IMP_PAGO`, `pagos_web`.`IMP_PAGO_RET`
FROM orden_pago, pagos_web
WHERE (
       (`orden_pago`.`CLAVE` =pagos_web.clave_OP) 
	   AND (`pagos_web`.`FECHA_DE_PAGO` >='$fechaant' AND `pagos_web`.`FECHA_DE_PAGO` <='$fechahoy')
	  AND `orden_pago`.`SAF`='$nom' )
order by `orden_pago`.`SAF`,`orden_pago`.`FORMULARIO`, `orden_pago`.`NUMERO`, pagos_web.fecha_de_pago ";
   
	}
	
	if($nom =='N')
    {
	
		 					  
	
	  $sql="SELECT  `orden_pago`.`SAF`, CONCAT(`orden_pago`.`FORMULARIO`,'-',`orden_pago`.`SAF`,'-', `orden_pago`.`NUMERO`) ORDEN, `orden_pago`.`EJERCICIO`,  `orden_pago`.`FUENTE`, `orden_pago`.`CLASE`, `orden_pago`.`CUIT`, `orden_pago`.`BENEFICIARIO`, `orden_pago`.`CONCEPTO`, `orden_pago`.`IMP_FORM`, `orden_pago`.`RETENCION`, `orden_pago`.`IMPORTE_A_PAGAR` as SALDO,`pagos_web`.`FECHA_DE_PAGO`,`pagos_web`.`IMP_PAGO`, `pagos_web`.`IMP_PAGO_RET`
FROM orden_pago, pagos_web
WHERE (
       (`orden_pago`.`CLAVE` =pagos_web.clave_OP) 
	   AND (`pagos_web`.`FECHA_DE_PAGO` >='$fechaant' AND `pagos_web`.`FECHA_DE_PAGO` <='$fechahoy')
	  )
order by `orden_pago`.`SAF`,`orden_pago`.`FORMULARIO`, `orden_pago`.`NUMERO`, pagos_web.fecha_de_pago ";
   
	}
	
	
if (!($res= mysql_query($sql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo beneficiario";
      echo $cuerpo1;
      //.....................................................................
    } 

//numero de columnas
$columnas = mysql_num_fields($res);



//creo tabla
echo "<table border='1'>";
echo "<tr>";
echo "<td align='center' colspan='14' bgcolor='#CCCCCC'>ORDENES PAGADAS </td>";
echo "</tr>";
echo "<BR>";


echo "<tr>";

//agrego los nombres de las tablas
for($i=0; $i<$columnas; $i++){
	echo "<td bgcolor='#DBE3E6'>".mysql_field_name($res,$i)."</td>";
}

echo "</tr>";

//agrego contenido a los datos
while($datos = mysql_fetch_assoc($res))
    {
	echo "<tr>";
	for($j=0; $j<$columnas; $j++)
	{
	  
	 if (($j==8) or ($j==9) or ($j==10) or ($j==12) or ($j==13) )
	 	 {
			
			 echo '<td align="right">'.number_format($datos[mysql_field_name($res,$j)],2)."</td>";
		 }
	else
	  {	 
		echo "<td>".$datos[mysql_field_name($res,$j)]."</td>";
		}
	}
		
		 

	echo "</tr>";
}

echo "</table>";


?>