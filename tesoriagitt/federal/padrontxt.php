<?php

  //  error_reporting (E_ERROR); 
header("Content-Type: plain/text");
header("Content-Disposition: Attachment; filename=padron.txt");
header("Pragma: no-cache");
	
    /*include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    //include('../conexion/extras.php');  	
	*/
	
	include('../dgti-mysql-var_dbtgp.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
	
	
	
	


	
$sql="SELECT `codigo_sipaf` , `CUIT` , CONCAT( `apeynom` , `razon_social` ) AS DENOMINACION
FROM `benef_federal`
";
if (!($res_ft= mysql_query($sql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo beneficiario";
      echo $cuerpo1;
      //.....................................................................
    } 	
	



$columnas = mysql_num_fields($res_ft);


$sql="SELECT `codigo` AS codigo_sipaf, `cuit` AS CUIT, `DESCRIPCION` AS Denominacion
FROM `codigos_sipaf`";
if (!($res= mysql_query($sql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo beneficiario";
      echo $cuerpo1;
      //.....................................................................
    } 
	

	

//numero de columnas
$columnas1 = mysql_num_fields($res);




//agrego los nombres de las tablas


//agrego contenido a los datos
while($datos = mysql_fetch_assoc($res_ft))
    {
 
	
	for($j=0; $j<$columnas; $j++)
	{
		 echo $datos[mysql_field_name($res_ft,$j)],'	';

	}
	echo chr(13).chr(10);

	}

while($datos = mysql_fetch_assoc($res))
    {
 
	
	for($j=0; $j<$columnas1; $j++)
	{ echo $datos[mysql_field_name($res,$j)],'	';

	

	}

echo chr(13).chr(10);
}

?>