<?php
 error_reporting ( E_ERROR ); 
    header("Content-type: application/ms-excel");
	header("Content-Disposition: attachment; filename=beneficiarios.xls");
    header("Pragma: no-cache"); 
    header("Expires: 0");
	
    include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
	
    //include('../conexion/extras.php');  	
   

$sql="SELECT (`beneficiarios_aprobados`.`id_beneficiario`) as numero ,`beneficiarios_aprobados`.`cuitl`, `tipo_documento`.`descripcion`, `beneficiarios_aprobados`.`documento_nro`, LTRIM(CONCAT(`beneficiarios_aprobados`.`apellido` ,' ', `beneficiarios_aprobados`.`nombre` , `beneficiarios_aprobados`.`razon_social`)) as Denominacion , CONCAT(`beneficiarios_aprobados`.`direccion_f_calle` ,' ',`beneficiarios_aprobados`.`direccion_f_nro`) as Direccion , `localidades`.`descripcion` as Localidades, `provincias`.`id_provincia` as provincia , `pais_f` as Pais, `beneficiarios_aprobados`.`codigo_f_postal`, `beneficiarios_aprobados`.`telefono`, `beneficiarios_aprobados`.`saf`, `beneficiarios_aprobados`.`persona_tipo`, `beneficiarios_aprobados`.`actividad_p` as Lucrativa, `beneficiarios_aprobados`.`sociedad_tipo` as Actividad, `beneficiarios_aprobados`.`cbu_cta` as Cuenta, `beneficiarios_aprobados`.`iva_situacion` as Iva , `beneficiarios_aprobados`.`ingreso_bruto`, `beneficiarios_aprobados`.`convenio_nro`, `beneficiarios_aprobados`.`estado_sipaf`,`beneficiarios_aprobados`.`tipo_cuit`,`beneficiarios_aprobados`.`fecha_aprobacion`,`beneficiarios_aprobados`.`fecha_aprobacion`,`beneficiarios_aprobados`.`fecha_aprobacion`,`beneficiarios_aprobados`.`fecha_aprobacion` ,`beneficiarios_aprobados`.`n_ganancia` ,sipaf_m
FROM `beneficiarios_aprobados` , `localidades` , `provincias` ,`tipo_documento` 
WHERE (
 ( `beneficiarios_aprobados`.`direccion_f_localidad` = localidades.id_localidades ) 
AND ( `beneficiarios_aprobados`.`documento_tipo` = tipo_documento.id_tipo ) 
AND ( `beneficiarios_aprobados`.`direccion_f_provincia` = provincias.codprovincia )
 AND ( `beneficiarios_aprobados`.`v_sipaf` = 'N' ) ) order by id_beneficiario";
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

//agrego los nombres de las tablas

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



$sql="UPDATE `beneficiarios_aprobados` SET v_sipaf='S' where `v_sipaf`='N'";

if (!($res= mysql_query($sql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo beneficiario";
      echo $cuerpo1;
      //.....................................................................
    } 
?>