<?php
 error_reporting (E_ERROR); 
 
    header("Content-type: application/ms-excel");
	header("Content-Disposition: attachment; filename=CONSULTA_PAGADO_PENDIENTE.xls");
    header("Pragma: no-cache"); 
    header("Expires: 0");
   /* include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
	*/
	
	 include('../dgti-mysql-var_dbtgp.php');
    include('../dgti-intranet-mysql_connect.php');  
	include('../dgti-intranet-mysql_select_db.php');
    //include('conexion/extras.php')
	
	  $y=$_GET['consul'];
	 
	  $nom=$_GET['nom'];
	 // $nro_s=trim($_GET['saf']);
      $ej_a=$_GET['ban']; 

	///////////////////
	
	$f=strftime("%Y-%m-%d");
    $dia = date("d/m/Y");
    $hora =date("h:i");
    $diaa = date("d-m-Y");
				
	
    
	//include('../conexion/extras.php');  	
	
	 $fecha = date('Y-m-d');
	$nuevafecha = strtotime ( '-1 year' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
$op =explode("-",$nom);
				 $op_n=$op[2];
				 $op_s=$op[1];
				 $op_f=$op[0];
	
	 if($ej_a=='EA')
   { 
       $_pagi_sql = "SELECT orden_pago.FECHA_OP, ESCRITURAL, orden_pago.EJERCICIO, FUENTE, CLASE, CONCAT( FORMULARIO, '-', orden_pago.SAF, '-', FORMULARIO ) as ORDEN , CUIT, BENEFICIARIO, CONCEPTO, (
IMP_FORM - RETENCION - IMPORTE_A_PAGAR + IMP_DESAF
) AS PAGADO, (
IMP_FORM - RETENCION + IMP_DESAF
) AS IMPO_ORDEN, IMPORTE_A_PAGAR AS SALDO, orden_pago.ESTADO AS ESTADO
FROM orden_pago, escritural AS e
WHERE (
(
NUMERO = '$op_n'
AND FORMULARIO = '$op_f'
AND orden_pago.SAF = '$op_s'
)
OR CUIT = '$nom' or concepto like '%$nom%' 
)
AND orden_pago.ESTADO != 'C'
AND e.ID = orden_pago.id_escritural
AND EJERCICIO < '$y'
ORDER BY EJERCICIO DESC , FECHA_OP DESC ";
							  

		
		
   }
   else
   {
	  
	$_pagi_sql = "SELECT orden_pago.FECHA_OP, ESCRITURAL, orden_pago.EJERCICIO, FUENTE, CLASE, CONCAT( FORMULARIO, '-', orden_pago.SAF, '-', FORMULARIO ) as ORDEN , CUIT, BENEFICIARIO, CONCEPTO, (
IMP_FORM - RETENCION - IMPORTE_A_PAGAR + IMP_DESAF
) AS PAGADO, (
IMP_FORM - RETENCION + IMP_DESAF
) AS IMPO_ORDEN, IMPORTE_A_PAGAR AS SALDO, orden_pago.ESTADO AS ESTADO
FROM orden_pago, escritural AS e
WHERE (
(
NUMERO = '$op_n'
AND FORMULARIO = '$op_f'
AND orden_pago.SAF = '$op_s'
)
OR CUIT = '$nom' or concepto like '%$nom%' 
)
AND orden_pago.ESTADO != 'C'
AND e.ID = orden_pago.id_escritural
AND EJERCICIO = '$y'
ORDER BY EJERCICIO DESC , FECHA_OP DESC ";

	
   }
	

	
   
 
	  
  	 
if (!($res= mysql_query($_pagi_sql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar pendiente";
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
		if(($j==10) or ($j==11) or ($j==9))
		 {
	  
		echo '<td align="right">'.number_format($datos[mysql_field_name($res,$j)],2).'</td>';
 		 
		 }
		 
		elseif($j==12) 
		 {
	          $estado_o=$datos[mysql_field_name($res,$j)];
			  if($estado_o=='P'){ $va_e='PENDIENTE'; }
			  if($estado_o=='A'){ $va_e='ANULADA'; }
			  if($estado_o=='B'){ $va_e='BLOQUEADA'; }
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


include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');

if($ej_a=='EA')
   {   
        $_pagi_sql1 = "SELECT  fecha AS FECHA, ESCRITURAL,ejercicio AS EJERCICIO, FUENTE,CLASE,orden_pago AS ORDEN, b.cuitl AS CUIT,  CONCAT( b.apellido, ' ', b.nombre, ' ', b.razon_social ) AS DENOMINACION, concepto AS CONCEPTO, total AS TOTAL
FROM orden_pago_fp AS o,saf_escritural AS e, beneficiarios_aprobados AS b
				              where (orden_pago='$nom' or cuit ='$nom' or concepto like '%$nom%' ) 
							      and cuitl=cuit
								   AND e.ID = o.clave_escritural
							      and ejercicio <'$y' ORDER BY fecha DESC ";
						
 
 
        }
   else
   {
	       $_pagi_sql1 = "SELECT fecha AS FECHA, ESCRITURAL,ejercicio AS EJERCICIO, FUENTE,CLASE,orden_pago AS ORDEN, b.cuitl AS CUIT, CONCAT( b.apellido, ' ', b.nombre, ' ', b.razon_social ) AS DENOMINACION,  concepto AS CONCEPTO, total AS TOTAL 
FROM orden_pago_fp AS o,saf_escritural AS e, beneficiarios_aprobados AS b
				              where (orden_pago='$nom' or cuit ='$nom' or concepto like '%$nom%' ) 
							      and cuitl=cuit
								   AND e.ID = o.clave_escritural
							      and ejercicio ='$y' ORDER BY fecha DESC ";
						
 
 
    			 
   }
   
   
   if (!($res= mysql_query($_pagi_sql1, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo beneficiario";
      echo $cuerpo1;
      //.....................................................................
    } 

//numero de columnas
$columnas = mysql_num_fields($res);

echo "<BR>";


//creo tabla
echo "<table border='1'>";
echo "<tr>";
echo "<td align='center' colspan='10' bgcolor='#CCCCCC'>ORDENES PAGADAS</td>";
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
	  if($j==9)
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