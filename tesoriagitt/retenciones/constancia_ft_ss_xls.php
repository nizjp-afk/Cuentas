<?php
 error_reporting (E_ERROR); 
 
    header("Content-type: application/ms-excel");
	header("Content-Disposition: attachment; filename=CONSTANCIA_FT_SS.xls");
    header("Pragma: no-cache"); 
    header("Expires: 0");
   /* include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
	*/
	
	  $y=$_GET['consul'];
	 
	  $nom=$_GET['nom'];
	 // $nro_s=trim($_GET['saf']);
      $ej_a=$_GET['ban']; 

	///////////////////
	
	$f=strftime("%Y-%m-%d");
    $dia = date("d/m/Y");
    $hora =date("h:i");
    $diaa = date("d-m-Y");
				
	include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
    
	//include('../conexion/extras.php');  	
	
	 $fechaant = $_GET['firstinput'];
	$fechahoy = $_GET['secondinput'];    
    $id = $_GET['id'];
	    
	
	   
        $ssql = "SELECT p.fecha AS FECHA, CONCAT( b.apellido, ' ', b.nombre, ' ', b.razon_social ) AS DENOMINACION,s.numero_ss AS NRO_CONSTANCIA,d.importe AS IMPORTE, p.orden_pago AS ORDEN, p.cuit AS CUIT
						FROM orden_pago AS p, sicore_ss AS s, anexoss AS r,beneficiarios_aprobados as b,localidades as l ,provincias as v,dd_retenciones as d
						WHERE p.orden_pago = s.orden
						AND b.cuitl=p.cuit
						AND p.ejercicio = s.ejercicio
						AND p.saf = s.saf
						AND r.id_ss = s.ss_id
						AND (b.direccion_f_localidad = l.id_localidades)  
						AND (b.direccion_f_provincia = v.codprovincia)
						AND (p.fecha >='$fechaant' and p.fecha <= '$fechahoy')
						AND p.orden_pago = d.orden
AND p.ejercicio = d.ejercicio
AND p.saf = d.saf
AND s.numero_ss > 0						
AND (d.dd_codigo = '99' or d.dd_codigo = '172' or d.dd_codigo = '6' or d.dd_codigo = '11' or d.dd_codigo = '10' or d.dd_codigo = '1') 
ORDER BY s.numero_ss  ";
  	 
if (!($res= mysql_query($ssql, $conexion_mysql)))
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
echo "<td align='center' colspan='6' bgcolor='#CCCCCC'>CONSTANCIA DE RETENCION CONTRIBUCIONES PATRONALES </td>";
echo "</tr>";
echo "<BR>";
echo "<tr>";

//agrego los nombres de las tablas
for($i=0; $i<$columnas; $i++){
	echo '<td bgcolor="#DBE3E6" align="center">'.mysql_field_name($res,$i).'</td>';
}

echo "</tr>";

//agrego contenido a los datos
while($datos = mysql_fetch_assoc($res))
    {
	echo "<tr>";
	for($j=0; $j<$columnas; $j++)
	{
		if(($j==7) or ($j==8) or ($j==9))
		 {
	  
		echo '<td align="right">'.$datos[mysql_field_name($res,$j)].'</td>';
 		 
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