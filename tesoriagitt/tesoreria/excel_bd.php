<?php
 error_reporting (E_ERROR); 
    header("Content-type: application/ms-excel");
	header("Content-Disposition: attachment; filename=orden_venc.xls");
    header("Pragma: no-cache"); 
    header("Expires: 0");
  /*  include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
	*/
		include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
    
    $dia = date("d-m-Y");
	 function restaFechas($dFecIni, $dFecFin)
{
    $dFecIni = str_replace("-","",$dFecIni);
    $dFecIni = str_replace("/","",$dFecIni);
    $dFecFin = str_replace("-","",$dFecFin);
    $dFecFin = str_replace("/","",$dFecFin);

    ereg( "([0-9]{1,2})([0-9]{1,2})([0-9]{2,4})", $dFecIni, $aFecIni);
    ereg( "([0-9]{1,2})([0-9]{1,2})([0-9]{2,4})", $dFecFin, $aFecFin);

    $date1 = mktime(0,0,0,$aFecIni[2], $aFecIni[1], $aFecIni[3]);
    $date2 = mktime(0,0,0,$aFecFin[2], $aFecFin[1], $aFecFin[3]);

    return round(($date2 - $date1) / (60 * 60 * 24));

    
}	
	
		
	
	
	//include('../conexion/extras.php');  	
   
 
$sql="SELECT *
FROM op_pendientes
WHERE Ejercicio = '2012'
AND (
estado = 'N'
OR estado = 'R'
)
ORDER BY  FECHA_OP DESC , Numero_OP
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
for($i=1; $i<$columnas; $i++){
	echo "<td>".mysql_field_name($res,$i)."</td>";
}

echo "</tr>";

//agrego contenido a los datos
while($datos = mysql_fetch_assoc($res))
    {
	
	  $fecha_d=$datos[mysql_field_name($res,2)] ;
	  $f_g=explode("-", $fecha_d); 
      $fecha_ing=$f_g[2].'-'.$f_g[1].'-'.$f_g[0]; 
	  $resultado_resta = restaFechas($fecha_ing,$dia);
	if($resultado_resta > 365)
	  {
	echo "<tr>";
	
	for($j=1; $j<$columnas; $j++)
	{
	   
		 
		 
		 
		echo "<td>".$datos[mysql_field_name($res,$j)]."</td>";
 		 
		 
		 
}
	echo "</tr>";
}
}

echo "</table>";


?>