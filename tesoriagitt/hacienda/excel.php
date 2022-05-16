<?php
  // error_reporting (E_ERROR); 
  header("Content-type: application/ms-excel");
	header("Content-Disposition: attachment; filename=DETALLE DE ORDEN.xls");
    header("Pragma: no-cache"); 
    header("Expires: 0");
   /* include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    //include('../conexion/extras.php');  	*/
	
	include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');

 //  and `inhi`!='Cta Cerrada'
    
$aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
  
  // include('../incluir_siempre.php');

   $mes = $_GET['mm'];	
$ejercicio = $_GET['aa']; 
 $saf_b = $_GET['id']; 

if($saf_b=='')
{
	 $_pagi_sql = "SELECT entidad AS SAF, mm AS MES, aa AS EJERCICIO,fecha_p as FECHA, CONCAT( tipo_o, '-', nro_o, '-', ejer_o ) AS ORDEN, ente AS Beneficiario, obs_o AS OBSERVACION, total AS IMPORTE, extra as Marca, ff as FFin
      FROM `analisis_f`
									WHERE mm ='$mes'
									AND `aa` ='$ejercicio'									
									ORDER BY fecha_p desc";
							  
	
}
else
	
{
	

  $_pagi_sql = "SELECT entidad AS SAF, mm AS MES, aa AS EJERCICIO,fecha_p as FECHA, CONCAT( tipo_o, '-', nro_o, '-', ejer_o ) AS ORDEN, ente AS Beneficiario, obs_o AS OBSERVACION, total AS IMPORTE,extra as Marca, ff as FFin
FROM `analisis_f`
									WHERE mm ='$mes'
									AND `aa` ='$ejercicio'
									and entidad='$saf_b'
									ORDER BY fecha_p desc";
							  

}
   
				 if (!($res= mysql_query($_pagi_sql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
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