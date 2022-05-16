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
		  
		  
		

		   $_pagi_sql = "SELECT o.fecha,o.saf, s.ESCRITURAL,o.ejercicio, o.orden_pago,o.fuente,o.cuit,CONCAT (b.apellido,' ',b.nombre,' ',b.razon_social) AS DENOMINACION, o.concepto, o.total
				  		      FROM orden_pago_fp as o,saf_escritural AS s,beneficiarios_aprobados as b
							  WHERE o.`clave_escritural` = s.ID 
							  and o.saf = '$n_saf'
							  and b.cuitl=o.cuit
							 and o.clave_escritural not in ('158','159','160','161','162','163','164','165','166','167','168','169','170','171','172','173','174','175','176','177','178','179','180','181','182','183','184','185','186','187','188','189','190','191','192','193','194','195','197')
							  and fecha >='$fechaant' and fecha <= '$fechahoy'
							  ORDER BY ejercicio,`fecha` DESC,o.saf,`orden_pago` ASC ";
	  
		
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