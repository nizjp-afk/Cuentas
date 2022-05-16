<?php
 error_reporting (E_ERROR); 
    header("Content-type: application/ms-excel");
	header("Content-Disposition: attachment; filename=beneficiarios.xls");
    header("Pragma: no-cache"); 
    header("Expires: 0");
   /* include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
	*/
	 include('../dgti-mysql-var_dbtgp.php');
	 include('../dgti-intranet-mysql_connect.php');  
	 include('../dgti-intranet-mysql_select_db.php');
    
	//include('../conexion/extras.php');  	
   
 
$sql="SELECT cuitl,NRO_CUIT, CONCAT( `apellido` , ' ', `nombre` , ' ', razon_social ) AS Denominacion, `FEC_TRAN` , `CBU_HAS`,cbu
FROM `transferencia` , beneficiarios_aprobados
WHERE `FEC_TRAN` > '2012-12-31'
AND `NRO_CUIT` = cuitl
ORDER BY `transferencia`.`FEC_TRAN` ASC";
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
echo "<table>";
echo "<tr>";

//agrego los nombres de las tablas
for($i=0; $i<$columnas; $i++){
	echo "<td>".mysql_field_name($res,$i)."</td>";
}

echo "</tr>";

//agrego contenido a los datos
while($datos = mysql_fetch_assoc($res))
    {
	if(!($datos[mysql_field_name($res,4)] == $datos[mysql_field_name($res,5)]))
	 {
	
	echo "<tr>";
	
	for($j=0; $j<$columnas; $j++)
	{
	   if ($j==4)
	      {
		 echo "<td>'".$datos[mysql_field_name($res,$j)]."</td>";
 		 
		  }
		elseif ($j==5)
	      {
		 echo "<td>'".$datos[mysql_field_name($res,$j)]."</td>";
 		 
		  }  
		else
		   {
		echo "<td>".$datos[mysql_field_name($res,$j)]."</td>";
 		 
		  }
		 
}
	echo "</tr>";
}
}
echo "</table>";


?>