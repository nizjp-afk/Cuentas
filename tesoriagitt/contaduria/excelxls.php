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
   
 
$sql="SELECT `beneficiarios_aprobados`.`id_beneficiario`, `beneficiarios_aprobados`.`cuitl`, CONCAT(`beneficiarios_aprobados`.`apellido` ,' ', `beneficiarios_aprobados`.`nombre`,' ', `beneficiarios_aprobados`.`razon_social`)AS Denominacion, `beneficiarios_aprobados`.`banco_cta_nro` as Cuenta, `bancos`.`nombre` AS Banco, `bancos_cuentas`.`nombre` AS Tipo , `beneficiarios_aprobados`.`cbu` as CBU, `beneficiarios_aprobados`.`fecha_aprobacion`,inhi as Situacion,motivo,`cbu_entidad` , `cbu_sucursal` ,  `verificador1` , `cbu_tipo_cta` , `cbu_cta` , 
`verificador2` ,CONCAT(`beneficiarios_aprobados`.`direccion_f_calle` ,' ',`beneficiarios_aprobados`.`direccion_f_nro`) as Direccion , `localidades`.`descripcion` as Localidades, `provincias`.`nombre` as provincia , `beneficiarios_aprobados`.`codigo_f_postal`, `beneficiarios_aprobados`.`telefono`, `beneficiarios_aprobados`.`saf`,`fecha_contrato`,sociedades.nombre as sociedad,
`persona_tipo`,`ingreso_bruto`,iva.nombre as iva,actividad.nombre_actividad,
`fecha_p`,`apellido1`,`nombre1`,`dni1`,`cargo1`,`duracion1` as Fecha_Finalizacion ,`apellido2`,`nombre2`,
`dni2`,`cargo2`,`apellido3`,`nombre3`,`dni3`,`cargo3`,`area`,`cargo`,`fecha_gestion`,usuario_alta,usuario_aprobo,sipaf_m,codigo_esidif,case estado WHEN 'B' THEN 'BAJA DE BENEFICIARIO' END AS estado
FROM `beneficiarios_aprobados`, `bancos`, `bancos_cuentas`,`localidades` , `provincias` ,`tipo_documento`,sociedades,iva,actividad
WHERE (
(`beneficiarios_aprobados`.`banco_nombre` =bancos.id_banco)
 AND (`beneficiarios_aprobados`.`banco_cta_tipo` =bancos_cuentas.id_ban_cta)
 AND(`beneficiarios_aprobados`.`direccion_f_localidad` = localidades.id_localidades ) 
AND ( `beneficiarios_aprobados`.`documento_tipo` = tipo_documento.id_tipo ) 
AND ( `beneficiarios_aprobados`.`direccion_f_provincia` = provincias.codprovincia)
AND ( `beneficiarios_aprobados`.`sociedad_tipo` = sociedades.id_sociedad)
AND ( `beneficiarios_aprobados`.`iva_situacion` = iva.id_iva)
AND ( `beneficiarios_aprobados`.`actividad_p` = actividad.id_actividad)) ORDER BY `beneficiarios_aprobados`.`id_beneficiario`, `beneficiarios_aprobados`.`fecha_aprobacion` ASC";
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
	   if ($j==3)
	      {
		 echo "<td>".$datos[mysql_field_name($res,$j)]."</td>";
 		 
		  }
		 elseif ($j==6)
	      {
		 echo "<td>'".$datos[mysql_field_name($res,$j)]."</td>";
 		 
		  }
		elseif ($j==8)
	      {
			  $k=48;
			  if($datos[mysql_field_name($res,$k)]=='BAJA DE BENEFICIARIO')
			   {
				   
		         echo "<td>".$datos[mysql_field_name($res,$k)]."</td>";
			   }
 		   else
		     {
				 echo "<td>".$datos[mysql_field_name($res,$j)]."</td>";
			 }
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