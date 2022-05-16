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
   
 
$sql="SELECT `beneficiarios_aprobados`.`id_beneficiario`, `beneficiarios_aprobados`.`cuitl`, CONCAT(`beneficiarios_aprobados`.`apellido` ,' ', `beneficiarios_aprobados`.`nombre`,' ', `beneficiarios_aprobados`.`razon_social`)AS Denominacion, 
CONCAT(`beneficiarios_aprobados`.`direccion_f_calle` ,' ',`beneficiarios_aprobados`.`direccion_f_nro`) as Direccion , `localidades`.`descripcion` as Localidades, `provincias`.`nombre` as provincia , `beneficiarios_aprobados`.`codigo_f_postal`, `beneficiarios_aprobados`.`telefono`,sociedades.nombre as Sociedad,
`persona_tipo`,case estado WHEN 'B' THEN 'BAJA DE BENEFICIARIO' END AS estado
FROM `beneficiarios_aprobados`,`localidades` , `provincias` ,`tipo_documento`,sociedades
WHERE (

(`beneficiarios_aprobados`.`direccion_f_localidad` = localidades.id_localidades ) 
AND ( `beneficiarios_aprobados`.`documento_tipo` = tipo_documento.id_tipo ) 
AND ( `beneficiarios_aprobados`.`direccion_f_provincia` = provincias.codprovincia)
AND ( `beneficiarios_aprobados`.`sociedad_tipo` = sociedades.id_sociedad)

) ORDER BY `beneficiarios_aprobados`.`id_beneficiario`, `beneficiarios_aprobados`.`fecha_aprobacion` ASC";
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