<?php

 
	
	error_reporting (E_ERROR); 
 
    header("Content-type: application/ms-excel");
	header("Content-Disposition: attachment; filename=ingresos_brutosres_fp.xls");
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
	
	$fechaant = $_POST['firstinput'];
	$fechahoy = $_POST['secondinput']; 
	
	
 //  and `inhi`!='Cta Cerrada'
    $aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
  
 //   include('../incluir_siempre.php');
  

	

$sql="SELECT distinct  p.fecha AS FECHA,s.orden as OP, p.cuit AS CUIT,s.numero AS CERTIFICADO,b.ingreso_bruto as INSCRIPCION,CONCAT(b.apellido,' ', b.nombre,' ',b.razon_social)AS BENEFICIARIO,CONCAT(b.direccion_f_calle ,' ',b.direccion_f_nro) as DOMICILIO, s.bruto AS IMPORTE,s.alicuota AS ALICUOTA, s.neto AS BASE_IMPONIBLE,s.monto AS RETENCION
FROM orden_pago_fp AS p, sicore_ib AS s,beneficiarios_aprobados as b
WHERE p.orden_pago = s.orden
AND p.fecha = s.fecha_io
AND b.cuitl=p.cuit
AND p.ejercicio = s.ejercicio
AND p.saf = s.saf
AND (p.fecha >='$fechaant' and p.fecha <= '$fechahoy')

AND s.numero!=''

ORDER BY p.fecha,numero  ASC
";
if (!($res_fp= mysql_query($sql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo beneficiario";
      echo $cuerpo1;
      //.....................................................................
    } 	
	



$columnas = mysql_num_fields($res_fp);
//creo tabla
echo "<table>";
echo "<tr>";
for($i=0; $i<$columnas; $i++){
	echo "<td>".mysql_field_name($res_fp,$i)."</td>";
}

echo "</tr>";

//agrego contenido a los datos
while($datos = mysql_fetch_assoc($res_fp))
    {
	echo "<tr>";
	for($j=0; $j<$columnas; $j++)
	{
	   if ($j==6)
	      {
		 echo "<td>".$datos[mysql_field_name($res_fp,$j)]."</td>";
 		 
		  }
		else
		   {
		echo "<td>".$datos[mysql_field_name($res_fp,$j)]."</td>";
 		 
		  }
		 
}
	echo "</tr>";
}

	
$sql="SELECT DISTINCT  p.fecha AS FECHA, s.orden AS OP, p.cuit AS CUIT,s.numero AS CERTIFICADO, b.ingreso_bruto AS INSCRIPCION, CONCAT( b.apellido, ' ', b.nombre, ' ', b.razon_social ) AS BENEFICIARIO, CONCAT( b.direccion_f_calle, ' ', b.direccion_f_nro ) AS DOMICILIO, s.bruto AS IMPORTE, s.alicuota AS ALICUOTA, s.neto AS BASE_IMPONIBLE, s.monto AS RETENCION
FROM orden_pago AS p, sicore_ib AS s, beneficiarios_aprobados AS b
WHERE p.orden_pago = s.orden
AND p.fecha = s.fecha_io
AND b.cuitl = p.cuit
AND p.ejercicio = s.ejercicio
AND p.saf = s.saf
AND s.numero!=''
AND (p.fecha >='$fechaant' and p.fecha <= '$fechahoy')

ORDER BY p.fecha,s.numero  ASC
";
if (!($res= mysql_query($sql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo beneficiario";
      echo $cuerpo1;
      //.....................................................................
    } 	
	



$columnas = mysql_num_fields($res);




//creo tabla

 /*?>echo "<tr>";

//agrego los nombres de las tablas
for($i=0; $i<$columnas; $i++){
	echo "<td>".mysql_field_name($res,$i)."</td>";
}

echo "</tr>";<?php */

//agrego contenido a los datos
while($datos = mysql_fetch_assoc($res))
    {
	echo "<tr>";
	for($j=0; $j<$columnas; $j++)
	{
	   if ($j==6)
	      {
		 echo "<td>".$datos[mysql_field_name($res,$j)]."</td>";
 		 
		  }
		else
		   {
		echo "<td>".$datos[mysql_field_name($res,$j)]."</td>";
 		 
		  }
		 
}
	echo "</tr>";
}


echo "</tr>";




?>