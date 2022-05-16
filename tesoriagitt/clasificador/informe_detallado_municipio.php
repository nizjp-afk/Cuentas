<?php
 //error_reporting (E_ERROR); 
 
    header("Content-type: application/ms-excel");
	header("Content-Disposition: attachment; filename=INFORME_MUNICIPIO_.xls");
    header("Pragma: no-cache"); 
    header("Expires: 0");
   /* include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
	*/
	
	$periodo_a    = $_POST['fecha_a'];
    $periodo_m    =$_POST['fecha_m'];
	 $municipio    =$_POST['municipio'];
	
	 $fec_d=$periodo_a.'-'.$periodo_m.'-'.'01';
	 
	 $fecha_p=$periodo_a.'-'.$periodo_m;
	 
	 $mes = $periodo_m;
	 $aa = $periodo_a;
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

	if ($municipio=='N')
    {
		$ssql = "SELECT b.nombre,b.apellido,b.razon_social,b.cuitl
		FROM beneficiarios_aprobados as b,clasificacion_municipio m
		WHERE b.cuitl=m.cuit
		group by m.cuit 
		  ";
	}
	else
	{
  
	$ssql = "SELECT b.nombre,b.apellido,b.razon_social,b.cuitl
		FROM beneficiarios_aprobados as b
		WHERE b.cuitl='$municipio'
		  ";
	}
	
				 if (!($r_muni= mysql_query($ssql, $conexion_mysql)))
				{
				  
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar buscar area";
				 
				  //.....................................................................
				}

if ($municipio=='N')
{
	
									  
	$ssql = "SELECT * FROM `clasificador` where codigo='M' ORDER BY  `clasificador`.`id` ASC  ";
     if (!($ress= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }	
	
$columnass = mysql_num_fields($ress);
$ver=$columnass-1;
//creo tabla
echo "<table border='1'>";

echo "<tr>";
echo "<td height='25' style='font-size:18'  align='center' colspan='13' bgcolor='#CCCCCC'>".$mes.'-'.$aa."</td>";
echo "</tr>";
echo "<BR>";
echo "<tr>";

//agrego los nombres de las tablas
/*for($i=0; $i<$columnass; $i++)
{
	
	echo '<td bgcolor="#DBE3E6" align="center">'.mysql_field_name($ress,$i).'</td>';
}

echo "</tr>";*/
echo "<tr>";
 echo "<td>MUNICIPIO</td>";
while($datos = mysql_fetch_assoc($ress))
    {
	 
		for($j=1; $j<$ver; $j++)
		    {
		
				echo "<td>".$datos[mysql_field_name($ress,$j)]."</td>";
	
	         }
	
	}
 echo "<td>TOTAL</td>";	
echo "</tr>";

while ($f_cui = mysql_fetch_array ($r_muni))
            {
				          
							   $nombre_be=$f_cui['nombre'];
	                           $apellido=$f_cui['apellido'];
	                           $razon=$f_cui['razon_social'];
							   $municipio    =$f_cui['cuitl'];
							
							   if ($razon=='')
		                            {   $benef=$apellido.','.$nombre_be;}
			                   else
			                         {  $benef=$razon;}
	  
 $sql = "SELECT DISTINCT Sum(o.total) AS TOTAL,clasificador.id

FROM clasificacion_municipio m, clasificador, orden_pago AS o
WHERE (
(
m.`saf` = o.saf
)
AND (
m.`ejercicio` = o.ejercicio
)
AND (
m.`orden` = o.orden_pago
)
AND (
m.`clasificador_id` = clasificador.id
)
)
AND (
m.`fecha` = o.fecha
)
AND  `clasificador`.`codigo` =  'M'

and m.`periodo` ='$fecha_p' 
and m.`cuit` ='$municipio' 

group by clasificador.id
order by clasificador.id ";

if (!($ress1= mysql_query($sql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo beneficiario";
      echo $cuerpo1;
      //.....................................................................
    } 


//numero de columnas
$columnass1 = mysql_num_rows($ress1);


$cnt = mysql_num_rows($ress);


$total_s=0;


//agrego los nombres de las tablas
/*for($i=0; $i<$columnass; $i++)
{
	
	echo '<td bgcolor="#DBE3E6" align="center">'.mysql_field_name($ress,$i).'</td>';
}

echo "</tr>";*/
echo "<tr>";
echo "<td  bgcolor='#CCCCCC'>".$benef."</td>";



$mver=157;
//agrego contenido a los datos
$IMPORTE=0;
for($m=146; $m<$mver; $m++)
 {
	 $aux=0;
	  mysql_data_seek($ress1,0);
    while($datoss = mysql_fetch_assoc($ress1))
        {
		  $cod=$datoss[mysql_field_name($ress1,1)];
	      if($cod==$m)
			   {
				 $IMPORTE=$IMPORTE+$datoss[mysql_field_name($ress1,0)];
				 echo "<td>".$datoss[mysql_field_name($ress1,0)]."</td>";  
				 $aux=1;
			   }
		 }
	if($aux==0)	 
		   {
			 echo "<td> 0.00</td>";  
		    }
     }
echo "<td>".$IMPORTE." </td>";  	 
echo "</tr>";
$total_s=$total_s+$IMPORTE;

	}
 

 			
echo "<tr>";
	echo "<td bgcolor='#DBE3E6' align='right' colspan='13'>TOTAL GENERAL: ".$total_s."</td>";
echo "</tr>";
echo "</table>";
	
	
	
	
}
else
{
				$f_cui = mysql_fetch_array ($r_muni);
                           
							   $nombre_be=$f_cui['nombre'];
	                           $apellido=$f_cui['apellido'];
	                           $razon=$f_cui['razon_social'];
							
							   if ($razon=='')
		                            {   $benef=$apellido.','.$nombre_be;}
			                   else
			                         {  $benef=$razon;} 
	$ssql = "SELECT * FROM `clasificador` where codigo='M' ORDER BY  `clasificador`.`id` ASC  ";
     if (!($ress= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }	
	  
 $sql = "SELECT DISTINCT Sum(o.total) AS TOTAL,clasificador.id

FROM clasificacion_municipio m, clasificador, orden_pago AS o
WHERE (
(
m.`saf` = o.saf
)
AND (
m.`ejercicio` = o.ejercicio
)
AND (
m.`orden` = o.orden_pago
)
AND (
m.`clasificador_id` = clasificador.id
)
)
AND (
m.`fecha` = o.fecha
)
AND  `clasificador`.`codigo` =  'M'

and m.`periodo` ='$fecha_p' 
and m.`cuit` ='$municipio' 

group by clasificador.id
order by clasificador.id ";

if (!($ress1= mysql_query($sql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo beneficiario";
      echo $cuerpo1;
      //.....................................................................
    } 


//numero de columnas
$columnass1 = mysql_num_rows($ress1);
$columnass = mysql_num_fields($ress);

$cnt = mysql_num_rows($ress);
$ver=$columnass-1;

$total_s=0;

//creo tabla
echo "<table border='1'>";

echo "<tr>";
echo "<td height='25' style='font-size:18'  align='center' colspan='13' bgcolor='#CCCCCC'>".$benef.'  '.$mes.'-'.$aa."</td>";
echo "</tr>";
echo "<BR>";
echo "<tr>";

//agrego los nombres de las tablas
/*for($i=0; $i<$columnass; $i++)
{
	
	echo '<td bgcolor="#DBE3E6" align="center">'.mysql_field_name($ress,$i).'</td>';
}

echo "</tr>";*/
echo "<tr>";
while($datos = mysql_fetch_assoc($ress))
    {
	
	for($j=1; $j<$ver; $j++)
	{
		
		
		
		echo "<td>".$datos[mysql_field_name($ress,$j)]."</td>";
	
	}
	
}
echo "</tr>";
echo "<tr>";
$mver=157;
//agrego contenido a los datos

for($m=146; $m<$mver; $m++)
 {
	 $aux=0;
	  mysql_data_seek($ress1,0);
    while($datoss = mysql_fetch_assoc($ress1))
        {
		  $cod=$datoss[mysql_field_name($ress1,1)];
	      if($cod==$m)
			   {
				 echo "<td>".$datoss[mysql_field_name($ress1,0)]."</td>";  
				 $aux=1;
			   }
		 }
	if($aux==0)	 
		   {
			 echo "<td> 0.00</td>";  
		    }
}
echo "</tr>";
echo "<tr>";
	echo "<td bgcolor='#DBE3E6' align='right' colspan='13'>TOTAL GENERAL: ".$total_s."</td>";
echo "</tr>";
echo "</table>";


}




?>