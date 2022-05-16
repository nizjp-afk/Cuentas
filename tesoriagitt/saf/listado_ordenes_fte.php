<?php
    
    header("Content-type: application/ms-excel");
	header("Content-Disposition: attachment; filename=PAGOS.xls");
    header("Pragma: no-cache"); 
    header("Expires: 0");
    
   	/*include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
	*/
	
	include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');

    //include('conexion/extras.php');*/
 	
	///////////////////////////////////////////////////////
   $fechaant = $_POST['firstinput'];
   $fechahoy = $_POST['secondinput'];  
	
	$saf=$_POST['saf']; 
    $origen = $_POST['origen'];	

	///////////////////
	if($saf!='N')
	  {
		  $n_saf='SAF '.$saf;
	  }
	 else
	  {
		   $n_saf='';
	  }
   $f=strftime("%Y-%m-%d");
   $dia = date("d/m/Y");
   $hora =date("h:i");
   
   ////////////////////////////
	
   if($saf=='N')
       {
		
		 
		 $ssql = "SELECT *  FROM `saf_escritural` where origen='$origen' ORDER BY `ESCRITURAL` ASC";
			 if (!($r_saf= mysql_query($ssql, $conexion_mysql)))
			{
			  
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar area";
			 
			  //.....................................................................
		   }
	   }
	else
	  {
		
		
		 $ssql = "SELECT *  FROM `saf_escritural` where ID='$saf' ORDER BY `ESCRITURAL` ASC";
			 if (!($r_saf= mysql_query($ssql, $conexion_mysql)))
			{
			  
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar area";
			 
			  //.....................................................................
		   }
		   
		   $f_saf= mysql_fetch_array ($r_saf);

		  $n_saf=$f_saf['SAF'];
		  
		  
		

		   $_pagi_sql = "SELECT  o.fecha as FECHA,o.saf AS SAF,o.ejercicio AS EJERCICIO,o.orden_pago AS ORDEN,o.fuente as FF ,b.cuitl AS CUIT,CONCAT (b.apellido,' ',b.nombre,' ',b.razon_social) AS DENOMINACION, o.concepto AS CONCEPTO,o.total AS TOTAL
		               FROM orden_pago o, nro_saf s,beneficiarios_aprobados as b
					   WHERE (o.saf='$n_saf')
					   AND o.cuit=b.cuitl
					   AND o.saf = s.numero
					   AND fecha >='$fechaant' and fecha <= '$fechahoy'
					  ORDER BY o.ejercicio,  `FECHA` DESC , orden ASC ";
	  
		
			 if (!($res= mysql_query($_pagi_sql, $conexion_mysql)))
			{
			
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar ordenes";
			  echo $cuerpo1;
			  //.....................................................................
			}  
			
						  
	  }
		
$columnas = mysql_num_fields($res);



//creo tabla
echo "<table border='1'>";
echo "<tr>";
echo "<td align='center' colspan='".$columnas."' bgcolor='#CCCCCC'>ORDENES PAGADAS SAF ".$n_saf." </td>";
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