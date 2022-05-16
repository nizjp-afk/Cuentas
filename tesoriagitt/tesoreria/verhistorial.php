<?php
error_reporting ( E_ERROR ); 
 
    header("Content-type: application/ms-excel");
	header("Content-Disposition: attachment; filename=historial.xls");
    header("Pragma: no-cache"); 
    header("Expires: 0");
   ///*
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
	/*/
	include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
    //include('../conexion/extras.php');  	*/
 
 $cuitl=$_GET['id'];  
 
$sql="SELECT `beneficiarios_historial`.`id_beneficiario`, `beneficiarios_historial`.`cuitl`, CONCAT(`beneficiarios_historial`.`apellido` ,' ', `beneficiarios_historial`.`nombre`,' ', `beneficiarios_historial`.`razon_social`)AS Denominacion, `tipo_documento`.`descripcion` as Tipo_Dni,`beneficiarios_historial`.`documento_nro` as DNI,`beneficiarios_historial`.`banco_cta_nro` as Cuenta, `bancos`.`nombre` AS Banco, `bancos_cuentas`.`nombre` AS Tipo , `beneficiarios_historial`.`cbu` as CBU, `beneficiarios_historial`.`fecha_aprobacion`,CONCAT(`beneficiarios_historial`.`direccion_f_calle` ,' ',`beneficiarios_historial`.`direccion_f_nro`) as Direccion , `localidades`.`descripcion` as Localidades, `provincias`.`nombre` as provincia , `beneficiarios_historial`.`codigo_f_postal`, `beneficiarios_historial`.`telefono`, `beneficiarios_historial`.`saf`,`fecha_contrato`,sociedades.nombre as Sociedad,
`persona_tipo`,`ingreso_bruto`,iva.nombre as IVA,actividad.nombre_actividad,
`fecha_p`,`apellido1`,`nombre1`,`dni1`,`cargo1`,`apellido2`,`nombre2`,
`dni2`,`cargo2`,`apellido3`,`nombre3`,`dni3`,`cargo3`,`area`,`cargo`,`fecha_gestion`,usuario_alta,
usuario_aprobo,fecha_aprobacion,inhi,usuario_modifico,fecha_modi
FROM `beneficiarios_historial`, `bancos`, `bancos_cuentas`,`localidades` , `provincias` ,`tipo_documento`,sociedades,iva,actividad
WHERE (
(`beneficiarios_historial`.`banco_nombre` =bancos.id_banco)
 AND (`beneficiarios_historial`.`banco_cta_tipo` =bancos_cuentas.id_ban_cta)
 AND(`beneficiarios_historial`.`direccion_f_localidad` = localidades.id_localidades ) 
AND ( `beneficiarios_historial`.`documento_tipo` = tipo_documento.id_tipo ) 
AND ( `beneficiarios_historial`.`direccion_f_provincia` = provincias.codprovincia)
AND ( `beneficiarios_historial`.`sociedad_tipo` = sociedades.id_sociedad)
AND ( `beneficiarios_historial`.`iva_situacion` = iva.id_iva)
AND ( `beneficiarios_historial`.`actividad_p` = actividad.id_actividad)
AND (beneficiarios_historial.cuitl='$cuitl')) ORDER BY  `beneficiarios_historial`.`fecha_aprobacion` ASC";

//$sql="select * from beneficiarios_historial where cuitl='$cuitl'";
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


   for($j=1; $j<$columnas; $j++)
	  {
	     mysql_data_seek($res,0);
	  //agrego los nombres de las tablas
	  echo "<td>".mysql_field_name($res,$j)."</td>";
	//agrego contenido a los datos 	
      while($datos = mysql_fetch_assoc($res))
        {
	     //echo "<tr>";
		 echo "<td>'".$datos[mysql_field_name($res,$j)]."</td>";
	    }
	echo "</tr>";		
	}	

echo "</table>";


?>