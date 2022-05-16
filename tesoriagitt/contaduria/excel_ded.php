<?php
    error_reporting (E_ERROR); 
/*	
  header("Content-type: application/ms-excel");
	header("Content-Disposition: attachment; filename=deducciones.csv");
    header("Pragma: no-cache"); 
    header("Expires: 0");
	
    /*include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    //include('../conexion/extras.php');  	
	*/
	/* include('../dgti-mysql-var_dbtgp.php');
	 include('../dgti-intranet-mysql_connect.php');  
	 include('../dgti-intranet-mysql_select_db.php');
*/
header("Cache-Control: public");
 
header('Content-Type: text/csv; charset=utf-8');
 // definimos el tipo MIME y la codificación
 
header('Content-Disposition: attachment; filename=deducciones.csv');
// Forzamos que el archivo se descargue con un nombre definido 

     include('../dgti-mysql-var_dbtgp.php');
	 include('../dgti-intranet-mysql_connect.php');  
	 include('../dgti-intranet-mysql_select_db.php');
	 
 //  and `inhi`!='Cta Cerrada'
    $aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
  
  //  include('../incluir_siempre.php');
  
$sql="SELECT `DD_EJER`,`DD_SAOD`,`DD_FORMUL`,`DD_NUMERO`,`DD_COD_DED`,`DD_IMPORTE`,Date_format( `DD_FECHA` , '%d-%m-%Y' )AS FECHA,`DD_DED_FOR` , `DD_DED_NRO`
FROM `pr_cdp1am72`
WHERE (`DD_SAOD` = '301'
OR `DD_SAOD` = '501'
OR `DD_SAOD` = '701'
OR `DD_SAOD` = '502')
ORDER BY `pr_cdp1am72`.`DD_SAOD` ASC";
if (!($res= mysql_query($sql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo beneficiario";
      echo $cuerpo1;
      //.....................................................................
    } 
while($r=mysql_fetch_array($res)){

 echo $r['DD_EJER'].";".$r['DD_SAOD'].";".$r['DD_FORMUL'].";".$r['DD_NUMERO'].";".$r['DD_COD_DED'].";".$r['DD_IMPORTE'].";".$r['FECHA'].";".$r['DD_DED_FOR'].";".$r['DD_DED_NRO']."\n";
//imprimimos la línea de datos separada por ";" o lo que se tercie
 
 }


//numero de columnas
//$columnas = mysql_num_fields($res);
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

//creo tabla
//echo "<table>";
//echo "<tr>";

//agrego los nombres de las tablas
for($i=0; $i<$columnas; $i++){
	echo mysql_field_name($res,$i);
	}
 
//echo "</tr>";
echo chr(13).chr(10);


//agrego contenido a los datos
while($datos = mysql_fetch_assoc($res))
    {
//	echo "<tr>";
	for($j=0; $j<$columnas; $j++)
	{
		echo $datos[mysql_field_name($res,$j)];
	}
	//echo "</tr>";
	echo chr(13).chr(10);

}

//echo "</table>";
*/
?>	