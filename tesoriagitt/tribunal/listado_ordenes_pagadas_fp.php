<?php
 error_reporting (E_ERROR); 
 
    header("Content-type: application/ms-excel");
	header("Content-Disposition: attachment; filename=PAGOS_FONDOS_PROPIOS.xls");
    header("Pragma: no-cache"); 
    header("Expires: 0");
   /* include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
	*/
	
	//$escritural = $_POST['saf'];
	$fechaant = $_POST['firstinput'];
	$fechahoy = $_POST['secondinput']; 
	$nom=$_POST['saf'];
				
	include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
    
	//include('../conexion/extras.php');  	
   
		if ($nom=='N' )
    {
 
	  $sql="SELECT  o.fecha as FECHA,o.saf AS SAF,s.ESCRITURAL as ESCRITURAL, o.ejercicio AS EJERCICIO,o.orden_pago AS ORDEN ,b.cuitl AS CUIT,CONCAT (b.apellido,' ',b.nombre,' ',b.razon_social) AS DENOMINACION, o.concepto AS CONCEPTO,o.total AS TOTAL
				  		      FROM orden_pago_fp as o,saf_escritural AS s,beneficiarios_aprobados as b
							  WHERE  o.`clave_escritural` = s.ID 
							  and fecha >='$fechaant' and fecha <= '$fechahoy'
							  and b.cuitl=o.cuit
							  ORDER BY ejercicio,`fecha` DESC,o.saf,`orden_pago` ASC";
	  
	}
	else
	{
		$sql="SELECT  o.fecha as FECHA,o.saf AS SAF,s.ESCRITURAL as ESCRITURAL,o.ejercicio AS EJERCICIO,o.orden_pago AS ORDEN ,b.cuitl AS CUIT,CONCAT (b.apellido,' ',b.nombre,' ',b.razon_social) AS DENOMINACION, o.concepto AS CONCEPTO,o.total AS TOTAL
				  		     FROM orden_pago_fp as o,saf_escritural AS s,beneficiarios_aprobados as b
							  WHERE o.`clave_escritural` = s.ID 
							  and o.saf = '$nom'
							  and b.cuitl=o.cuit
							  and fecha >='$fechaant' and fecha <= '$fechahoy'
							  ORDER BY ejercicio,`fecha` DESC,o.saf,`orden_pago` ASC";
	  
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
echo "<td align='center' colspan=".$columnas." bgcolor='#CCCCCC'>ORDENES PAGADAS FONDOS PROPIOS</td>";
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
	  
		 if($j==7)
		 {
	  
		echo '<td align="right"  >'.$datos[mysql_field_name($res,$j)].'</td>';
 		 
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