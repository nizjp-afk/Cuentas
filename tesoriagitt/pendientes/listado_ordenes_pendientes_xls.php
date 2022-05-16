<?php
 error_reporting (E_ERROR); 
 
    header("Content-type: application/ms-excel");
	header("Content-Disposition: attachment; filename=CONSULTA_PENDIENTE.xls");
    header("Pragma: no-cache"); 
    header("Expires: 0");
   /* include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
	*/
	
	  $y=$_GET['consul'];
	 
	  $nom=$_GET['nom'];
	 // $nro_s=trim($_GET['saf']);
      
	 $ejer=date("Y");
	 
	// exit;
	  if ($y<$ejer)
	  {
	  $ej_a='EA'; 
	  }
	 
	     $saf_i=$_GET['saf']; 

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

	
	
	 if($ej_a=='EA')
   { 
    
       $_pagi_sql = "SELECT `Fecha_OP` AS FECHA, op_pendientes.`Saf` AS SAF, `Ejercicio` ,Clase,Fuente, `Numero_OP` AS ORDEN, b.cuitl AS CUIT, CONCAT( b.apellido, ' ', b.nombre, ' ', b.razon_social ) AS DENOMINACION, concepto AS CONCEPTO, `Imp_orden` , `Total_Pagado` , `Saldos`,op_pendientes.estado as ESTADO
FROM op_pendientes, beneficiarios_aprobados AS b
WHERE  Ejercicio = '$y'
AND b.cuitl = cuit
ORDER BY Ejercicio DESC , Fecha_OP DESC , Numero_OP DESC ";
							  
				
	 
		
		
   }
   else
   {
	    
	  
	 $_pagi_sql = "SELECT `Fecha_OP` AS FECHA, op_pendientes.`Saf` AS SAF, `Ejercicio` ,Clase,Fuente, `Numero_OP` AS ORDEN, b.cuitl AS CUIT, CONCAT( b.apellido, ' ', b.nombre, ' ', b.razon_social ) AS DENOMINACION, concepto AS CONCEPTO, `Imp_orden` , `Total_Pagado` , `Saldos`,op_pendientes.estado as ESTADO
FROM op_pendientes, beneficiarios_aprobados AS b
WHERE  Ejercicio = '$y'
AND b.cuitl = cuit
ORDER BY Ejercicio DESC , Fecha_OP DESC , Numero_OP DESC ";

				 
	
		
		
		
	
   
   }
	
	
	
	
   
 
	  
  	 
if (!($res= mysql_query($_pagi_sql, $conexion_mysql)))
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
echo "<td align='center' colspan='13' bgcolor='#CCCCCC'>ORDENES PENDIENTES DE PAGO</td>";
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
		if(($j==9) or ($j==10) or ($j==11))
		 {
	  
		echo '<td align="right">'.$datos[mysql_field_name($res,$j)].'</td>';
 		 
		 }
		 	elseif($j==12) 
		 {
	          $estado_o=$datos[mysql_field_name($res,$j)];
			  if($estado_o=='N'){ $va_e='PENDIENTE'; }
			  if($estado_o=='C'){ $va_e='ANULADA'; }
			  if($estado_o=='R'){ $va_e='BLOQUEADA'; }
			  if($datos[mysql_field_name($res,0)] < $nuevafecha )
			   {
				   $va_e='BAJA DEC. 1804/10';
			   }
			 
		echo '<td align="right">'.$va_e.'</td>';
 		 
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