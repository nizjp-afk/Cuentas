<?php
    error_reporting (E_ERROR); 
    header("Content-type: application/ms-excel");
	header("Content-Disposition: attachment; filename=excel.html");
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
    $aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
  
    include('../incluir_siempre.php');
  
$sql="SELECT `cbu_entidad` , `cbu_sucursal` ,  `verificador1` , `cbu_tipo_cta` , `cbu_cta` , `verificador2` ,`cuitl` , CONCAT(`apellido`,' ',`nombre`)AS Denominacion ,CONCAT(`direccion_f_calle`,' ',`direccion_f_nro`,' ',`direccion_f_piso`) AS Domicilio,`razon_social`,`cbu`,`banco_nombre`,`banco_cta_tipo`,`area`,`apellido1`,
`nombre1`,`inhi`,bene_cesion,cuit_tipo
FROM `beneficiarios_aprobados` where id_beneficiario !='675' and estado != 'B'  order by id_beneficiario";
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