<?php
 error_reporting (E_ERROR); 
 
    header("Content-type: application/ms-excel");
	header("Content-Disposition: attachment; filename=escritural.xls");
    header("Pragma: no-cache"); 
    header("Expires: 0");
   /* include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
	*/
	
	$escritural = $_POST['saf'];
	$fechaant = $_POST['firstinput'];
	$fechahoy = $_POST['secondinput']; 
				
	include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
    
	//include('../conexion/extras.php');  	
   
 if($escritural=='N')
  {
	  $sql="SELECT `esc_cuenta` AS Escritural, `num_cuenta` AS Cuenta, `descripcion` AS Movimiento, `fecha` , `detalle_1` AS Beneficiario, `detalle_2` AS Concepto, `debito` AS DEBITO, `retenciones` AS RETENCIONES, `credito` AS CREDITO,orden
FROM escritural where 
	        fecha >='$fechaant' and fecha <= '$fechahoy'
			 
			ORDER BY `esc_cuenta` ASC , fecha ASC , `cod_proceso` ASC";
	  
  }
  else
  {
	  
  
$sql="SELECT `esc_cuenta` AS Escritural, `num_cuenta` AS Cuenta, `descripcion` AS Movimiento, `fecha` , `detalle_1` AS Beneficiario, `detalle_2` AS Concepto, `debito` AS DEBITO, `retenciones` AS RETENCIONES, `credito` AS CREDITO,orden
FROM escritural where  esc_cuenta='$escritural'
	         AND fecha >='$fechaant' and fecha <= '$fechahoy'
			 
			 ORDER BY `esc_cuenta` ASC ,fecha asc, `cod_proceso` ASC";
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
	echo "<tr>";
	for($j=0; $j<$columnas; $j++)
	{
	  
		echo "<td>".$datos[mysql_field_name($res,$j)]."</td>";
 		 
		
		 
}
	echo "</tr>";
}

echo "</table>";


?>