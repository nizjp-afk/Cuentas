<?php
 error_reporting (E_ERROR); 
 
    header("Content-type: application/ms-excel");
	header("Content-Disposition: attachment; filename=modificacion.xls");
    header("Pragma: no-cache"); 
    header("Expires: 0");
   /* include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
	*/
	
	$fechaant = $_POST['firstinput'];
	$fechahoy = $_POST['secondinput']; 
				
	include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
    
	//include('../conexion/extras.php');  	
   
 
$sql="SELECT DISTINCT `cbu` , id_beneficiario, b.cuitl, CONCAT(b.apellido ,' ', b.nombre,' ',b.razon_social)AS Denominacion, `banco_cta_nro` ,m.fecha,usuario
FROM `movimiento` AS m, beneficiarios_aprobados AS b
WHERE `accion` = 'Cambio datos Cta Bancaria'
AND m.cuitl = b.`cuitl`
AND m.fecha >='$fechaant' and m.fecha <= '$fechahoy'
ORDER BY `b`.`id_beneficiario` ASC ,m.fecha ASC";
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
	   if ($j==0)
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

echo "</table>";


?>