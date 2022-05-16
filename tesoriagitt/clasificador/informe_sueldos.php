<?php
 error_reporting (E_ERROR); 
 
    header("Content-type: application/ms-excel");
	header("Content-Disposition: attachment; filename=INFORME_SUELDO.xls");
    header("Pragma: no-cache"); 
    header("Expires: 0");
   /* include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
	*/
	
	$periodo_a    = $_POST['anio'];
    $periodo_m    =$_POST['mes'];
	
	 $fec_d=$periodo_a.'-'.$periodo_m.'-'.'01';
	 
	 $fec_h=$periodo_a.'-'.$periodo_m.'-'.'31';
	 
	 $mes = $periodo_m;
	 $aa = $periodo_a;
	///////////////////
	
	$f=strftime("%Y-%m-%d");
    $dia = date("d/m/Y");
    $hora =date("h:i");
    $diaa = date("d-m-Y");
				
	include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
    
	//include('../conexion/extras.php');  	
	
	 $fecha = date('Y-m-d');
	$nuevafecha = strtotime ( '-1 year' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-d' , $nuevafecha );

	
		
	  
	$sql = "SELECT  `clasificador`.`concepto` AS CONCEPTO, SUM(  `orden_pago`.total ) AS IMPORTE
FROM clasificacion_orden, clasificador, orden_pago
WHERE (
(
`clasificacion_orden`.`saf` = orden_pago.saf
)
AND (
`clasificacion_orden`.`ejercicio` = orden_pago.ejercicio
)
AND (
`clasificacion_orden`.`orden` = orden_pago.orden_pago
)
AND (
`clasificacion_orden`.`clasificador_id` = clasificador.id
)
)
AND (
`clasificacion_orden`.`fecha` = orden_pago.fecha
)
AND  `clasificador`.`codigo` =  'S'
and `clasificacion_orden`.`fecha` >='$fec_d' and `clasificacion_orden`.`fecha` <= '$fec_h'
group by  `clasificador`.id
order by `clasificador`.`concepto` ";

if (!($ress= mysql_query($sql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo beneficiario";
      echo $cuerpo1;
      //.....................................................................
    } 


//numero de columnas
$columnass = mysql_num_fields($ress);
$cnt = mysql_num_rows($ress);


$total_s=0;

//creo tabla
echo "<table border='1'>";

echo "<tr>";
echo "<td align='center' colspan='2' bgcolor='#CCCCCC'>OTROS CONCEPTOS SALARIALES ".$mes.'-'.$aa."</td>";
echo "</tr>";
echo "<BR>";
echo "<tr>";

//agrego los nombres de las tablas
for($i=0; $i<$columnass; $i++)
{
	
	echo '<td bgcolor="#DBE3E6" align="center">'.mysql_field_name($ress,$i).'</td>';
}

echo "</tr>";

//agrego contenido a los datos
while($datoss = mysql_fetch_assoc($ress))
    {
	echo "<tr>";
	for($j=0; $j<$columnass; $j++)
	{
		if($j==1)
	    {
		  $total_s=$total_s+$datoss[mysql_field_name($ress,$j)];
		}
		echo "<td>".$datoss[mysql_field_name($ress,$j)]."</td>";
	}
	echo "</tr>";
}
echo "<tr>";
	echo "<td bgcolor='#DBE3E6' align='right' colspan='2'>TOTAL GENERAL: ".$total_s."</td>";
echo "</tr>";
echo "</table>";




   
        $_pagi_sql1 = "SELECT  `clasificador`.`concepto` AS CONCEPTO, SUM(  `orden_pago`.total ) AS IMPORTE
FROM clasificacion_orden, clasificador, orden_pago
WHERE (
(
`clasificacion_orden`.`saf` = orden_pago.saf
)
AND (
`clasificacion_orden`.`ejercicio` = orden_pago.ejercicio
)
AND (
`clasificacion_orden`.`orden` = orden_pago.orden_pago
)
AND (
`clasificacion_orden`.`clasificador_id` = clasificador.id
)
)
AND (
`clasificacion_orden`.`fecha` = orden_pago.fecha
)
AND  `clasificador`.`codigo` =  'P'
and `clasificacion_orden`.`fecha` >='$fec_d' and `clasificacion_orden`.`fecha` <= '$fec_h'
group by  `clasificador`.id
order by `clasificador`.`concepto` ";
						
   
   
   if (!($res= mysql_query($_pagi_sql1, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo beneficiario";
      echo $cuerpo1;
      //.....................................................................
    } 

//numero de columnas
 $columnas = mysql_num_fields($res);
$total_p=0;
echo "<BR>";


//creo tabla
echo "<table border='1'>";
echo "<tr>";
echo "<td align='center' colspan='2' bgcolor='#CCCCCC'>PROGRAMAS SOCIALES ".$mes.'-'.$aa."</td>";
echo "</tr>";
echo "<BR>";


echo "<tr>";

//agrego los nombres de las tablas
for($i=0; $i<$columnas; $i++){
	echo "<td bgcolor='#DBE3E6' align='center'>".mysql_field_name($res,$i)."</td>";
}

echo "</tr>";

//agrego contenido a los datos
while($datos = mysql_fetch_assoc($res))
    {
	echo "<tr>";
	for($j=0; $j<$columnas; $j++)
	{
		if($j==1)
	    {
		  $total_p=$total_p+$datos[mysql_field_name($res,$j)];
		}
		echo "<td>".$datos[mysql_field_name($res,$j)]."</td>";
	}
	echo "</tr>";
}
echo "<tr>";
	echo "<td bgcolor='#DBE3E6' align='right' colspan='2'>TOTAL GENERAL: ".$total_p."</td>";
echo "</tr>";
echo "</table>";





?>