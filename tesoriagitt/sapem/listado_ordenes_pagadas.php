<?php
 error_reporting (E_ERROR); 
 
    header("Content-type: application/ms-excel");
	header("Content-Disposition: attachment; filename=PAGOS.xls");
    header("Pragma: no-cache"); 
    header("Expires: 0");
   /* include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
	*/
	
	//$escritural = $_POST['saf'];
	$fechaant = $_POST['firstinput'];
	$fechahoy = $_POST['secondinput']; 
	
	 $sub=trim($_POST['tipo']);
				
	include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
    
	//include('../conexion/extras.php');  	
   
 if($sub=='N')
 {
 
	  $sql="SELECT  o.fecha as FECHA,o.saf AS SAF,o.ejercicio AS EJERCICIO,o.orden_pago AS ORDEN,o.fuente as FF ,b.cuitl AS CUIT,CONCAT (b.apellido,' ',b.nombre,' ',b.razon_social) AS DENOMINACION, o.concepto AS CONCEPTO,o.total AS TOTAL
				  		      FROM orden_pago as o,nro_saf as s,beneficiarios_aprobados as b
							  WHERE  o.saf = s.numero 
							  and fecha >='$fechaant' and fecha <= '$fechahoy'
							  and b.cuitl=o.cuit
							  and b.sociedad_tipo='30'
							 
							  ORDER BY FECHA DESC ,ejercicio,`fecha` DESC,o.saf,`orden_pago` ASC";
 }
if($sub=='C')
  {
	
 $sql="SELECT  o.fecha as FECHA,o.saf AS SAF,o.ejercicio AS EJERCICIO,o.orden_pago AS ORDEN,o.fuente as FF ,b.cuitl AS CUIT,CONCAT (b.apellido,' ',b.nombre,' ',b.razon_social) AS DENOMINACION, o.concepto AS CONCEPTO,o.total AS TOTAL
				  		      FROM orden_pago as o,nro_saf as s,beneficiarios_aprobados as b
							  WHERE  o.saf = s.numero 
							  and fecha >='$fechaant' and fecha <= '$fechahoy'
							  and b.cuitl=o.cuit
							  and b.sociedad_tipo='30'
							  and cuitl in('33711935679','33679911509','30711807272') 			
							  ORDER BY FECHA DESC ,ejercicio,`fecha` DESC,o.saf,`orden_pago` ASC";
	
	
	  
  }
 
  	 
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
echo "<td align='center' colspan='".$columnas."' bgcolor='#CCCCCC'>ORDENES PAGADAS</td>";
echo "</tr>";
echo "<BR>";


echo "<tr>";

//agrego los nombres de las tablas
for($i=0; $i<$columnas; $i++){
	echo "<td bgcolor='#DBE3E6'>".mysql_field_name($res,$i)."</td>";
}

echo "</tr>";

//agrego contenido a los datos
while($datos = mysql_fetch_assoc($res))
    {
	echo "<tr>";
	for($j=0; $j<$columnas; $j++)
	{
	  
		 if($j==8)
		 {
	  
		echo '<td align="right"  >'.$datos[mysql_field_name($res,$j)].'</td>';
 		 
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