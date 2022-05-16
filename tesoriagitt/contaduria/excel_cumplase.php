<?php
    error_reporting (E_ERROR); 
	  $aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
    $nro =$_GET['cumpla'];
   
   include('../incluir_siempre.php');
   
    header("Content-type: application/ms-excel");
	header("Content-Disposition: attachment; filename=cumplase.html");
    header("Pragma: no-cache"); 
    header("Expires: 0");
   /*
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    //include('../conexion/extras.php');  	
	*/
	
	include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
 //  and `inhi`!='Cta Cerrada'
  
    
$sql="SELECT Ejercicio,Numero_OP,Saf,Autorizado
FROM op_pendiente_tmp where nro_ti='$nro' ";
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
		echo "<td>".$datos[mysql_field_name($res,$j)]."</td>";
	}
	echo "</tr>";
}

while($datos = mysql_fetch_assoc($res1))
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