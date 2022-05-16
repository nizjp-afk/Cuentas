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
		include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
    
    
	//include('../conexion/extras.php');  	
   
 
$sql="SELECT `cuitl` , CONCAT( `beneficiarios_aprobados`.`apellido` , ' ', `beneficiarios_aprobados`.`nombre` , ' ', `beneficiarios_aprobados`.`razon_social` ) AS Denominacion,
CASE `persona_tipo`
WHEN 'j'
THEN 'J'
WHEN 'f'
THEN ''
END AS persona, `cbu` ,cbu_entidad , `cbu_sucursal` AS Cod,
CASE `banco_cta_tipo`
WHEN '1'
THEN '2'
WHEN '2'
THEN '1'
END AS Tipo_cuenta, `cbu_cta` AS Cuenta
FROM `beneficiarios_aprobados`
WHERE (
`persona_tipo` = 'J'
OR `persona_tipo` = 'F'
)
AND `estado` = 'A'
AND `inhi` = ''
";
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
	if ($j==1)
	      {
		 echo "<td>".substr($datos[mysql_field_name($res,$j)],0,60)."</td>";
 		 
		  }
	  elseif ($j==3)
	      {
		 echo "<td>'".$datos[mysql_field_name($res,$j)]."</td>";
 		 
		  }
		elseif ($j==4)
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

echo "</table>";


?>