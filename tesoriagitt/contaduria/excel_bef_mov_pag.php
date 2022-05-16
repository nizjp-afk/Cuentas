<?php
    error_reporting (E_ERROR); 
    header("Content-type: application/ms-excel");
	header("Content-Disposition: attachment; filename=bene_pago.html");
    header("Pragma: no-cache"); 
    header("Expires: 0");
    /*include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    //include('../conexion/extras.php');  	
	*/
	include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
 //  and `inhi`!='Cta Cerrada'
   
  
  
  
$sql="SELECT MAX( orden_pago.fecha ) ,`persona_tipo` as Personeria, `beneficiarios_aprobados`.`cuitl`, CONCAT(`beneficiarios_aprobados`.`apellido` ,' ', `beneficiarios_aprobados`.`nombre`,' ', `beneficiarios_aprobados`.`razon_social`)AS Denominacion,nombre_f as FANTASIA,documento_nro as DNI,t.descripcion as TIPO,CONCAT(`beneficiarios_aprobados`.`direccion_f_calle` ,' ',`beneficiarios_aprobados`.`direccion_f_nro`) as Direccion , `localidades`.`descripcion` as Localidades, `provincias`.`nombre` as provincia , `beneficiarios_aprobados`.`codigo_f_postal`, `beneficiarios_aprobados`.`telefono`,`bancos`.`nombre` AS Banco, `bancos_cuentas`.`nombre` AS Tipo_Cta,`cbu_entidad` as Cod_Ent , `cbu_sucursal` as Cod_Sucu ,`cbu_cta` as CUENTA , `beneficiarios_aprobados`.`cbu` as CBU, inhi as Situacion_Cta,motivo,sociedades.nombre as Sociedad,
iva.nombre as IVA,actividad.nombre_actividad as Act_Econ,`area`,`cargo`,case estado WHEN 'B' THEN 'BAJA DE BENEFICIARIO' END AS estado,`beneficiarios_aprobados`.`fecha_aprobacion`
FROM `beneficiarios_aprobados`, `bancos`, `bancos_cuentas`,`localidades` , `provincias` ,sociedades,iva,actividad,orden_pago,tipo_documento as t
WHERE (
(`beneficiarios_aprobados`.`banco_nombre` =bancos.id_banco)
AND (orden_pago.fecha >  '2012-12-31')
AND (t.id_tipo=documento_tipo)
 AND (`beneficiarios_aprobados`.`banco_cta_tipo` =bancos_cuentas.id_ban_cta)
 AND(`beneficiarios_aprobados`.`direccion_f_localidad` = localidades.id_localidades ) 
AND ( `beneficiarios_aprobados`.`direccion_f_provincia` = provincias.codprovincia)
AND ( `beneficiarios_aprobados`.`sociedad_tipo` = sociedades.id_sociedad)
AND ( `beneficiarios_aprobados`.`iva_situacion` = iva.id_iva)
AND ( `beneficiarios_aprobados`.`actividad_p` = actividad.id_actividad)
AND (cuit = cuitl))
GROUP BY cuit";
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
/*

$sql1="SELECT `cbu_cta` ,`cuitl` 
FROM `beneficiarios_aprobados` where id_beneficiario !='675' and estado != 'B'  order by id_beneficiario";
if (!($secion= mysql_query($sql1, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo beneficiario";
      echo $cuerpo1;
      //.....................................................................
    } 
*/
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