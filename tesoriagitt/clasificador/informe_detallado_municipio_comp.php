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
	$total_s=0;
	$periodo_a    = $_POST['fecha_a'];
    $periodo_m    =$_POST['fecha_m'];
	 $municipio    =$_POST['municipio'];
	
	 $fec_d=$periodo_a.'-'.$periodo_m.'-'.'01';
	 
	 $fecha_p=$periodo_a.'-'.$periodo_m;
	 
	 $mes = $periodo_m;
	 $aa = $periodo_a;
	 $mes_a=$periodo_m-1;
	 
	  $meses= array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto',
                                        'Septiembre','Octubre','Noviembre','Diciembre');
                               // $meshtml="";
								
	 
	 if($mes_a<10)
	    {
		
		 
		 $mes_a='0'.$mes_a;
		 }
	 $fecha_p_a=$periodo_a.'-'.$mes_a;
	
	 $mes_a_l=$meses{$mes_a-1};
	  $mes_l=$meses{$mes-1};
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
		FROM beneficiarios_aprobados as b,clasificacion_municipio m
		WHERE b.cuitl='$municipio'
		and  b.cuitl=m.cuit
		group by m.cuit 
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
echo "<td height='25' style='font-size:18'  align='center' colspan='5' bgcolor='#CCCCCC'>".$mes_l.'-'.$aa."</td>";
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
				 $total_s=$total_s+$IMPORTE;
			   }
		 }
	if($aux==0)	 
		   {
			 echo "<td> 0.00</td>";  
		    }
     }
echo "<td>".$IMPORTE." </td>";  	 
echo "</tr>";


	}
 

 			
echo "<tr>";
	echo "<td bgcolor='#DBE3E6' align='right' colspan='13'>TOTAL GENERAL: ".$total_s."</td>";
echo "</tr>";
echo "</table>";
	
	
	
/// armar informe	1
 
  mysql_data_seek($r_muni,0);


$ssql = "SELECT * FROM `clasificador` where codigo='M' and `clasificador`.`id` in ('152','153','151') ORDER BY  `clasificador`.`id` ASC  ";
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
echo "<td height='25' style='font-size:18'  align='center' colspan='5' bgcolor='#CCCCCC'>FUNCIONAMIENTO INCLUIDO LO EXTRA COPARTICIPABLE ".$mes_a_l.' y '.$mes_l.'-'.$aa."</td>";
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
 echo "<td>FUNC ".$mes_a_l."</td>";
 echo "<td>FUNC ".$mes_l."</td>";
 echo "<td>DIFERENCIA</td>";
 echo "<td>PORCENTAJE</td>";

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
	  
 $sql = "SELECT DISTINCT Sum( o.total ) AS TOTAL, periodo
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
AND `clasificador`.`codigo` = 'M'
AND (
m.`periodo` >= '$fecha_p_a'
AND m.`periodo` <= '$fecha_p'
)
and m.`cuit` ='$municipio' 
AND m.`clasificador_id`
IN (
'152', '153', '151'
)
GROUP BY m.periodo
ORDER BY `m`.`periodo` ASC
";

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


//$total_s=0;


//agrego los nombres de las tablas
/*for($i=0; $i<$columnass; $i++)
{
	
	echo '<td bgcolor="#DBE3E6" align="center">'.mysql_field_name($ress,$i).'</td>';
}

echo "</tr>";*/

echo "<tr>";
echo "<td  bgcolor='#CCCCCC'>".$benef."</td>";


$cant_p = mysql_num_rows($ress1);
$mver=2;
//agrego contenido a los datos
$IMPORTE=0;
$IMPORTE_a=0;
	$IMPORTE=0;
if ($cant_p >0)
{
 while($datoss = mysql_fetch_assoc($ress1))
	{  
	
		$aux=0;
        if($cant_p>1)
	 {
		 
		  $cod=$datoss[mysql_field_name($ress1,1)];
	      if($cod==$fecha_p_a)
			   {
				 $IMPORTE_a=$datoss[mysql_field_name($ress1,0)];
				 $IMPORTE_a_t=$IMPORTE_a_t+$datoss[mysql_field_name($ress1,0)];
				 echo "<td align='right'>".$datoss[mysql_field_name($ress1,0)]."</td>";  
				 $aux=1;
			   }
		  if($cod==$fecha_p)
			   {
				 $IMPORTE=$datoss[mysql_field_name($ress1,0)];
				  $IMPORTE_t=$IMPORTE_t+$datoss[mysql_field_name($ress1,0)];
				 echo "<td  align='right'>".$datoss[mysql_field_name($ress1,0)]."</td>";  
				 $aux=1;
			   }	   
		
	 }
	 
	 else
	 
	 {
		$cod=$datoss[mysql_field_name($ress1,1)];
		if($cod==$fecha_p_a)
			   {
				 $IMPORTE_a=$datoss[mysql_field_name($ress1,0)];
				 $IMPORTE_a_t=$IMPORTE_a_t+$datoss[mysql_field_name($ress1,0)];
				 echo "<td  align='right'>".$datoss[mysql_field_name($ress1,0)]."</td>";  
				 echo "<td  align='right'>0.00</td>";   
				 $IMPORTE='0.00';
			   }
		  if($cod==$fecha_p)
			   {
				    echo "<td  align='right'>0.00</td>";   
				 $IMPORTE=$datoss[mysql_field_name($ress1,0)];
				  $IMPORTE_t=$IMPORTE_t+$datoss[mysql_field_name($ress1,0)];
				 echo "<td  align='right'>".$datoss[mysql_field_name($ress1,0)]."</td>";  
				  $IMPORTE_a='0.00';
			   }
	 }
	}
	 $diferencia=$IMPORTE-$IMPORTE_a;
	// $diferencia_t= $diferencia_t+ $diferencia;
	 $por1=$diferencia/$IMPORTE_a;
	 $por = number_format($por1 * 100, 2); 
	 
	
	 echo "<td  align='right'>".$diferencia." </td>";  	 
echo "<td  align='right'>".$por."% </td>";  	 
echo "</tr>";
//$total_s=$total_s+$IMPORTE;
	

	
		
	

 
}
else

{
	 echo "<td  align='right'>0.00</td>";  
	 echo "<td  align='right'>0.00</td>";  
	echo "<td  align='right'>0.00</td>"; 
	echo "<td  align='right'>0.00</td>"; 
	
	}
 
}
 
  $diferencia_t=$IMPORTE_t-$IMPORTE_a_t;
	// $diferencia_t= $diferencia_t+ $diferencia;
	 $por1_t=$diferencia_t/$IMPORTE_a_t;
	 $por_t= number_format($por1_t * 100, 2); 
echo "<tr>";
	echo "<td>TOTALES</td>";
 echo "<td align='right'>".$IMPORTE_a_t."</td>";
 echo "<td align='right'>".$IMPORTE_t."</td>";
 echo "<td align='right'>".$diferencia_t." </td>";  	 
echo "<td align='right'>".$por_t."% </td>"; 
echo "</tr>";
 echo "<tr>";
 echo "<td align='right' colspan='5'></td>";
echo "</tr>"; 			

echo "</table>";
	
	





/// armar informe	2
 
  mysql_data_seek($r_muni,0);


$ssql = "SELECT * FROM `clasificador` where codigo='M' and `clasificador`.`id` in ('152','153') ORDER BY  `clasificador`.`id` ASC  ";
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
echo "<td height='25' style='font-size:18'  align='center' colspan='5' bgcolor='#CCCCCC'>FUNCIONAMIENTO SOLO  COPARTICIPABLE  ".$mes_a_l.' y '.$mes_l.'-'.$aa."</td>";
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
 echo "<td>FUNC ".$mes_a_l."</td>";
 echo "<td>FUNC ".$mes_l."</td>";
 echo "<td>DIFERENCIA</td>";
 echo "<td>PORCENTAJE</td>";

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
	  
 $sql = "SELECT DISTINCT Sum( o.total ) AS TOTAL, periodo
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
AND `clasificador`.`codigo` = 'M'
AND (
m.`periodo` >= '$fecha_p_a'
AND m.`periodo` <= '$fecha_p'
)
and m.`cuit` ='$municipio' 
AND m.`clasificador_id`
IN (
'152', '153'
)
GROUP BY m.periodo
ORDER BY `m`.`periodo` ASC
";

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


//$total_s=0;


//agrego los nombres de las tablas
/*for($i=0; $i<$columnass; $i++)
{
	
	echo '<td bgcolor="#DBE3E6" align="center">'.mysql_field_name($ress,$i).'</td>';
}

echo "</tr>";*/

echo "<tr>";
echo "<td  bgcolor='#CCCCCC'>".$benef."</td>";


$cant_p = mysql_num_rows($ress1);
$mver=2;
//agrego contenido a los datos
$IMPORTE=0;
$IMPORTE_a=0;
	$IMPORTE=0;
if ($cant_p >0)
{
 while($datoss = mysql_fetch_assoc($ress1))
	{  
	
		$aux=0;
        if($cant_p>1)
	 {
		 
		  $cod=$datoss[mysql_field_name($ress1,1)];
	      if($cod==$fecha_p_a)
			   {
				 $IMPORTE_a=$datoss[mysql_field_name($ress1,0)];
				 $IMPORTE_a_t=$IMPORTE_a_t+$datoss[mysql_field_name($ress1,0)];
				 echo "<td align='right'>".$datoss[mysql_field_name($ress1,0)]."</td>";  
				 $aux=1;
			   }
		  if($cod==$fecha_p)
			   {
				 $IMPORTE=$datoss[mysql_field_name($ress1,0)];
				  $IMPORTE_t=$IMPORTE_t+$datoss[mysql_field_name($ress1,0)];
				 echo "<td  align='right'>".$datoss[mysql_field_name($ress1,0)]."</td>";  
				 $aux=1;
			   }	   
		
	 }
	 
	 else
	 
	 {
		$cod=$datoss[mysql_field_name($ress1,1)];
		if($cod==$fecha_p_a)
			   {
				 $IMPORTE_a=$datoss[mysql_field_name($ress1,0)];
				 $IMPORTE_a_t=$IMPORTE_a_t+$datoss[mysql_field_name($ress1,0)];
				 echo "<td  align='right'>".$datoss[mysql_field_name($ress1,0)]."</td>";  
				 echo "<td  align='right'>0.00</td>";   
				 $IMPORTE='0.00';
			   }
		  if($cod==$fecha_p)
			   {
				    echo "<td  align='right'>0.00</td>";   
				 $IMPORTE=$datoss[mysql_field_name($ress1,0)];
				  $IMPORTE_t=$IMPORTE_t+$datoss[mysql_field_name($ress1,0)];
				 echo "<td  align='right'>".$datoss[mysql_field_name($ress1,0)]."</td>";  
				  $IMPORTE_a='0.00';
			   }
	 }
	}
	 $diferencia=$IMPORTE-$IMPORTE_a;
	// $diferencia_t= $diferencia_t+ $diferencia;
	 $por1=$diferencia/$IMPORTE_a;
	 $por = number_format($por1 * 100, 2); 
	 
	
	 echo "<td  align='right'>".number_format($diferencia,2)." </td>";
echo "<td  align='right'>".$por."% </td>";  	 
echo "</tr>";
//$total_s=$total_s+$IMPORTE;
	

	
		
	

 
}
else

{
	 echo "<td  align='right'>0.00</td>";  
	 echo "<td  align='right'>0.00</td>";  
	echo "<td  align='right'>0.00</td>"; 
	echo "<td  align='right'>0.00</td>"; 
	
	}
 
}
 
  $diferencia_t=$IMPORTE_t-$IMPORTE_a_t;
	// $diferencia_t= $diferencia_t+ $diferencia;
	 $por1_t=$diferencia_t/$IMPORTE_a_t;
	 $por_t= number_format($por1_t * 100, 2); 
echo "<tr>";
	echo "<td>TOTALES</td>";
 echo "<td align='right'>".$IMPORTE_a_t."</td>";
 echo "<td align='right'>".$IMPORTE_t."</td>";
 echo "<td align='right'>".$diferencia_t." </td>";  	 
echo "<td align='right'>".$por_t."% </td>"; 
echo "</tr>";
 			
echo "<tr>";
 echo "<td align='right' colspan='5'></td>";
echo "</tr>"; 
echo "</table>";
	
	

/// armar informe	3
 
  mysql_data_seek($r_muni,0);


$ssql = "SELECT * FROM `clasificador` where codigo='M' and `clasificador`.`id` in ('146','147','148','149','150','151','152','153','154') ORDER BY  `clasificador`.`id` ASC  ";
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
echo "<td height='25' style='font-size:18'  align='center' colspan='5' bgcolor='#CCCCCC'>TOTAL COPARTICIPACION SUELDOS, FUNC. Y EXTRACOPARTIC.  ".$mes_a_l.' y '.$mes_l.'-'.$aa."</td>";
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
 echo "<td>FUNC ".$mes_a_l."</td>";
 echo "<td>FUNC ".$mes_l."</td>";
 echo "<td>DIFERENCIA</td>";
 echo "<td>PORCENTAJE</td>";

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
	  
 $sql = "SELECT DISTINCT Sum( o.total ) AS TOTAL, periodo
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
AND `clasificador`.`codigo` = 'M'
AND (
m.`periodo` >= '$fecha_p_a'
AND m.`periodo` <= '$fecha_p'
)
and m.`cuit` ='$municipio' 
AND m.`clasificador_id`
IN (
'146','147','148','149','150','151','152','153','154'
)
GROUP BY m.periodo
ORDER BY `m`.`periodo` ASC
";

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


//$total_s=0;


//agrego los nombres de las tablas
/*for($i=0; $i<$columnass; $i++)
{
	
	echo '<td bgcolor="#DBE3E6" align="center">'.mysql_field_name($ress,$i).'</td>';
}

echo "</tr>";*/

echo "<tr>";
echo "<td  bgcolor='#CCCCCC'>".$benef."</td>";


$cant_p = mysql_num_rows($ress1);
$mver=2;
//agrego contenido a los datos
$IMPORTE=0;
$IMPORTE_a=0;
	$IMPORTE=0;
if ($cant_p >0)
{
 while($datoss = mysql_fetch_assoc($ress1))
	{  
	
		$aux=0;
        if($cant_p>1)
	 {
		 
		  $cod=$datoss[mysql_field_name($ress1,1)];
	      if($cod==$fecha_p_a)
			   {
				 $IMPORTE_a=$datoss[mysql_field_name($ress1,0)];
				 $IMPORTE_a_t=$IMPORTE_a_t+$datoss[mysql_field_name($ress1,0)];
				 echo "<td align='right'>".$datoss[mysql_field_name($ress1,0)]."</td>";  
				 $aux=1;
			   }
		  if($cod==$fecha_p)
			   {
				 $IMPORTE=$datoss[mysql_field_name($ress1,0)];
				  $IMPORTE_t=$IMPORTE_t+$datoss[mysql_field_name($ress1,0)];
				 echo "<td  align='right'>".$datoss[mysql_field_name($ress1,0)]."</td>";  
				 $aux=1;
			   }	   
		
	 }
	 
	 else
	 
	 {
		$cod=$datoss[mysql_field_name($ress1,1)];
		if($cod==$fecha_p_a)
			   {
				 $IMPORTE_a=$datoss[mysql_field_name($ress1,0)];
				 $IMPORTE_a_t=$IMPORTE_a_t+$datoss[mysql_field_name($ress1,0)];
				 echo "<td  align='right'>".$datoss[mysql_field_name($ress1,0)]."</td>";  
				 echo "<td  align='right'>0.00</td>";   
				 $IMPORTE='0.00';
			   }
		  if($cod==$fecha_p)
			   {
				    echo "<td  align='right'>0.00</td>";   
				 $IMPORTE=$datoss[mysql_field_name($ress1,0)];
				  $IMPORTE_t=$IMPORTE_t+$datoss[mysql_field_name($ress1,0)];
				 echo "<td  align='right'>".$datoss[mysql_field_name($ress1,0)]."</td>";  
				  $IMPORTE_a='0.00';
			   }
	 }
	}
	 $diferencia=$IMPORTE-$IMPORTE_a;
	// $diferencia_t= $diferencia_t+ $diferencia;
	 $por1=$diferencia/$IMPORTE_a;
	 $por = number_format($por1 * 100, 2); 
	 
	
	  echo "<td  align='right'>".number_format($diferencia,2)." </td>";
echo "<td  align='right'>".$por."% </td>";  	 
echo "</tr>";
//$total_s=$total_s+$IMPORTE;
	

	
		
	

 
}
else

{
	 echo "<td  align='right'>0.00</td>";  
	 echo "<td  align='right'>0.00</td>";  
	echo "<td  align='right'>0.00</td>"; 
	echo "<td  align='right'>0.00</td>"; 
	
	}
 
}
 
  $diferencia_t=$IMPORTE_t-$IMPORTE_a_t;
	// $diferencia_t= $diferencia_t+ $diferencia;
	 $por1_t=$diferencia_t/$IMPORTE_a_t;
	 $por_t= number_format($por1_t * 100, 2); 
echo "<tr>";
	echo "<td>TOTALES</td>";
 echo "<td align='right'>".$IMPORTE_a_t."</td>";
 echo "<td align='right'>".$IMPORTE_t."</td>";
 echo "<td align='right'>".$diferencia_t." </td>";  	 
echo "<td align='right'>".$por_t."% </td>"; 
echo "</tr>";
 echo "<tr>";
 echo "<td align='right' colspan='5'></td>";
echo "</tr>"; 			

echo "</table>";
	
	


/// armar informe	4
 
  mysql_data_seek($r_muni,0);


$ssql = "SELECT * FROM `clasificador` where codigo='M' and `clasificador`.`id` in ('156') ORDER BY  `clasificador`.`id` ASC  ";
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
echo "<td height='25' style='font-size:18'  align='center' colspan='5' bgcolor='#CCCCCC'>TOTAL FONDO SOJERO  ".$mes_a_l.' y '.$mes_l.'-'.$aa."</td>";
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
 echo "<td>FUNC ".$mes_a_l."</td>";
 echo "<td>FUNC ".$mes_l."</td>";
 echo "<td>DIFERENCIA</td>";
 echo "<td>PORCENTAJE</td>";

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
	  
 $sql = "SELECT DISTINCT Sum( o.total ) AS TOTAL, periodo
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
AND `clasificador`.`codigo` = 'M'
AND (
m.`periodo` >= '$fecha_p_a'
AND m.`periodo` <= '$fecha_p'
)
and m.`cuit` ='$municipio' 
AND m.`clasificador_id`
IN ('156')
GROUP BY m.periodo
ORDER BY `m`.`periodo` ASC
";

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


//$total_s=0;


//agrego los nombres de las tablas
/*for($i=0; $i<$columnass; $i++)
{
	
	echo '<td bgcolor="#DBE3E6" align="center">'.mysql_field_name($ress,$i).'</td>';
}

echo "</tr>";*/

echo "<tr>";
echo "<td  bgcolor='#CCCCCC'>".$benef."</td>";


$cant_p = mysql_num_rows($ress1);
$mver=2;
//agrego contenido a los datos
$IMPORTE=0;
$IMPORTE_a=0;
	$IMPORTE=0;
if ($cant_p >0)
{
 while($datoss = mysql_fetch_assoc($ress1))
	{  
	
		$aux=0;
        if($cant_p>1)
	 {
		 
		  $cod=$datoss[mysql_field_name($ress1,1)];
	      if($cod==$fecha_p_a)
			   {
				 $IMPORTE_a=$datoss[mysql_field_name($ress1,0)];
				 $IMPORTE_a_t=$IMPORTE_a_t+$datoss[mysql_field_name($ress1,0)];
				 echo "<td align='right'>".$datoss[mysql_field_name($ress1,0)]."</td>";  
				 $aux=1;
			   }
		  if($cod==$fecha_p)
			   {
				 $IMPORTE=$datoss[mysql_field_name($ress1,0)];
				  $IMPORTE_t=$IMPORTE_t+$datoss[mysql_field_name($ress1,0)];
				 echo "<td  align='right'>".$datoss[mysql_field_name($ress1,0)]."</td>";  
				 $aux=1;
			   }	   
		
	 }
	 
	 else
	 
	 {
		$cod=$datoss[mysql_field_name($ress1,1)];
		if($cod==$fecha_p_a)
			   {
				 $IMPORTE_a=$datoss[mysql_field_name($ress1,0)];
				 $IMPORTE_a_t=$IMPORTE_a_t+$datoss[mysql_field_name($ress1,0)];
				 echo "<td  align='right'>".$datoss[mysql_field_name($ress1,0)]."</td>";  
				 echo "<td  align='right'>0.00</td>";   
				 $IMPORTE='0.00';
			   }
		  if($cod==$fecha_p)
			   {
				    echo "<td  align='right'>0.00</td>";   
				 $IMPORTE=$datoss[mysql_field_name($ress1,0)];
				  $IMPORTE_t=$IMPORTE_t+$datoss[mysql_field_name($ress1,0)];
				 echo "<td  align='right'>".$datoss[mysql_field_name($ress1,0)]."</td>";  
				  $IMPORTE_a='0.00';
			   }
	 }
	}
	 $diferencia=$IMPORTE-$IMPORTE_a;
	// $diferencia_t= $diferencia_t+ $diferencia;
	 $por1=$diferencia/$IMPORTE_a;
	 $por = number_format($por1 * 100, 2); 
	 
	
	  echo "<td  align='right'>".number_format($diferencia,2)." </td>";
echo "<td  align='right'>".$por."% </td>";  	 
echo "</tr>";
//$total_s=$total_s+$IMPORTE;
	

	
		
	

 
}
else

{
	 echo "<td  align='right'>0.00</td>";  
	 echo "<td  align='right'>0.00</td>";  
	echo "<td  align='right'>0.00</td>"; 
	echo "<td  align='right'>0.00</td>"; 
	
	}
 
}
 
  $diferencia_t=$IMPORTE_t-$IMPORTE_a_t;
	// $diferencia_t= $diferencia_t+ $diferencia;
	 $por1_t=$diferencia_t/$IMPORTE_a_t;
	 $por_t= number_format($por1_t * 100, 2); 
echo "<tr>";
	echo "<td>TOTALES</td>";
 echo "<td align='right'>".$IMPORTE_a_t."</td>";
 echo "<td align='right'>".$IMPORTE_t."</td>";
 echo "<td align='right'>".$diferencia_t." </td>";  	 
echo "<td align='right'>".$por_t."% </td>"; 
echo "</tr>";
 			
echo "<tr>";
 echo "<td align='right' colspan='5'></td>";
echo "</tr>"; 
echo "</table>";




/// armar informe	5
 
  mysql_data_seek($r_muni,0);


$ssql = "SELECT * FROM `clasificador` where codigo='M' and `clasificador`.`id` in ('146','148') ORDER BY  `clasificador`.`id` ASC  ";
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
echo "<td height='25' style='font-size:18'  align='center' colspan='5' bgcolor='#CCCCCC'>TOTAL COPARTICIPACION SUELDOS (SIN S.A.C.), FUNC. Y EXTRACOPARTIC.  ".$mes_a_l.' y '.$mes_l.'-'.$aa."</td>";
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
 echo "<td>FUNC ".$mes_a_l."</td>";
 echo "<td>FUNC ".$mes_l."</td>";
 echo "<td>DIFERENCIA</td>";
 echo "<td>PORCENTAJE</td>";

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
	  
 $sql = "SELECT DISTINCT Sum( o.total ) AS TOTAL, periodo
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
AND `clasificador`.`codigo` = 'M'
AND (
m.`periodo` >= '$fecha_p_a'
AND m.`periodo` <= '$fecha_p'
)
and m.`cuit` ='$municipio' 
AND m.`clasificador_id`
IN ('146','148')
GROUP BY m.periodo
ORDER BY `m`.`periodo` ASC
";

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


//$total_s=0;


//agrego los nombres de las tablas
/*for($i=0; $i<$columnass; $i++)
{
	
	echo '<td bgcolor="#DBE3E6" align="center">'.mysql_field_name($ress,$i).'</td>';
}

echo "</tr>";*/

echo "<tr>";
echo "<td  bgcolor='#CCCCCC'>".$benef."</td>";


$cant_p = mysql_num_rows($ress1);
$mver=2;
//agrego contenido a los datos
$IMPORTE=0;
$IMPORTE_a=0;
	$IMPORTE=0;
if ($cant_p >0)
{
 while($datoss = mysql_fetch_assoc($ress1))
	{  
	
		$aux=0;
        if($cant_p>1)
	 {
		 
		  $cod=$datoss[mysql_field_name($ress1,1)];
	      if($cod==$fecha_p_a)
			   {
				 $IMPORTE_a=$datoss[mysql_field_name($ress1,0)];
				 $IMPORTE_a_t=$IMPORTE_a_t+$datoss[mysql_field_name($ress1,0)];
				 echo "<td align='right'>".$datoss[mysql_field_name($ress1,0)]."</td>";  
				 $aux=1;
			   }
		  if($cod==$fecha_p)
			   {
				 $IMPORTE=$datoss[mysql_field_name($ress1,0)];
				  $IMPORTE_t=$IMPORTE_t+$datoss[mysql_field_name($ress1,0)];
				 echo "<td  align='right'>".$datoss[mysql_field_name($ress1,0)]."</td>";  
				 $aux=1;
			   }	   
		
	 }
	 
	 else
	 
	 {
		$cod=$datoss[mysql_field_name($ress1,1)];
		if($cod==$fecha_p_a)
			   {
				 $IMPORTE_a=$datoss[mysql_field_name($ress1,0)];
				 $IMPORTE_a_t=$IMPORTE_a_t+$datoss[mysql_field_name($ress1,0)];
				 echo "<td  align='right'>".$datoss[mysql_field_name($ress1,0)]."</td>";  
				 echo "<td  align='right'>0.00</td>";   
				 $IMPORTE='0.00';
			   }
		  if($cod==$fecha_p)
			   {
				    echo "<td  align='right'>0.00</td>";   
				 $IMPORTE=$datoss[mysql_field_name($ress1,0)];
				  $IMPORTE_t=$IMPORTE_t+$datoss[mysql_field_name($ress1,0)];
				 echo "<td  align='right'>".$datoss[mysql_field_name($ress1,0)]."</td>";  
				  $IMPORTE_a='0.00';
			   }
	 }
	}
	 $diferencia=$IMPORTE-$IMPORTE_a;
	// $diferencia_t= $diferencia_t+ $diferencia;
	 $por1=$diferencia/$IMPORTE_a;
	 $por = number_format($por1 * 100, 2); 
	 
	
	 echo "<td  align='right'>".number_format($diferencia,2)." </td>";  	 
echo "<td  align='right'>".$por."% </td>";  	 
echo "</tr>";
//$total_s=$total_s+$IMPORTE;
	

	
		
	

 
}
else

{
	 echo "<td  align='right'>0.00</td>";  
	 echo "<td  align='right'>0.00</td>";  
	echo "<td  align='right'>0.00</td>"; 
	echo "<td  align='right'>0.00</td>"; 
	
	}
 
}
 
  $diferencia_t=$IMPORTE_t-$IMPORTE_a_t;
	// $diferencia_t= $diferencia_t+ $diferencia;
	 $por1_t=$diferencia_t/$IMPORTE_a_t;
	 $por_t= number_format($por1_t * 100, 2); 
echo "<tr>";
	echo "<td>TOTALES</td>";
 echo "<td align='right'>".$IMPORTE_a_t."</td>";
 echo "<td align='right'>".$IMPORTE_t."</td>";
 echo "<td align='right'>".$diferencia_t." </td>";  	 
echo "<td align='right'>".$por_t."% </td>"; 
echo "</tr>";
echo "<tr>";
 echo "<td align='right' colspan='5'></td>";
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
$total_s=$total_s+$IMPORTE;
echo "</tr>";
echo "<tr>";
	echo "<td bgcolor='#DBE3E6' align='right' colspan='13'>TOTAL GENERAL: ".$total_s."</td>";
echo "</tr>";
echo "</table>";


$columnass = mysql_num_fields($ress);

/// armar informe	
 
  mysql_data_seek($r_muni,0);


$ssql = "SELECT * FROM `clasificador` where codigo='M' and `clasificador`.`id` in ('152','153','151') ORDER BY  `clasificador`.`id` ASC  ";
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
echo "<td height='25' style='font-size:18'  align='center' colspan='5' bgcolor='#CCCCCC'>FUNCIONAMIENTO INCLUIDO LO EXTRA COPARTICIPABLE ".$mes_a.' y '.$mes.'-'.$aa."</td>";
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
 echo "<td>FUNC ".$mes_a."</td>";
 echo "<td>FUNC ".$mes."</td>";
 echo "<td>DIFERENCIA</td>";
 echo "<td>PORCENTAJE</td>";

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
	  
 $sql = "SELECT DISTINCT Sum( o.total ) AS TOTAL, periodo
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
AND `clasificador`.`codigo` = 'M'
AND (
m.`periodo` >= '$fecha_p_a'
AND m.`periodo` <= '$fecha_p'
)
and m.`cuit` ='$municipio' 
AND m.`clasificador_id`
IN (
'152', '153', '151'
)
GROUP BY m.periodo
ORDER BY `m`.`periodo` ASC
";

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



echo "<tr>";
echo "<td  bgcolor='#CCCCCC'>".$benef."</td>";


$cant_p = mysql_num_rows($ress1);
$mver=2;
//agrego contenido a los datos
$IMPORTE=0;
if ($cant_p >0)
{
 while($datoss = mysql_fetch_assoc($ress1))
	{  
	$IMPORTE_a=0;
	$IMPORTE=0;
		$aux=0;
        if($cant_p>1)
	 {
		  $cod=$datoss[mysql_field_name($ress1,1)];
	      if($cod==$fecha_p_a)
			   {
				 $IMPORTE_a=$datoss[mysql_field_name($ress1,0)];
				 $IMPORTE_a_t=$IMPORTE_a_t+$datoss[mysql_field_name($ress1,0)];
				 echo "<td>".$datoss[mysql_field_name($ress1,0)]."</td>";  
				 $aux=1;
			   }
		  if($cod==$fecha_p)
			   {
				 $IMPORTE=$datoss[mysql_field_name($ress1,0)];
				  $IMPORTE_t=$IMPORTE_t+$datoss[mysql_field_name($ress1,0)];
				 echo "<td>".$datoss[mysql_field_name($ress1,0)]."</td>";  
				 $aux=1;
			   }	   
		
	if($aux==0)	 
		   {
			  echo "<td>0.00</td>";   
		    }
    
	 $diferencia=$IMPORTE-$IMPORTE_a;
	// $diferencia_t= $diferencia_t+ $diferencia;
	 $por1=$diferencia/$IMPORTE_a;
	 $por = number_format($por1 * 100, 2); 
	 
	
	 echo "<td>".$diferencia." </td>";  	 
echo "<td>".$por."% </td>";  	 
echo "</tr>";
//$total_s=$total_s+$IMPORTE;
	}

	else
	  
	{
		$cod=$datoss[mysql_field_name($ress1,1)];
		if($cod==$fecha_p_a)
			   {
				 $IMPORTE_a=$datoss[mysql_field_name($ress1,0)];
				 $IMPORTE_a_t=$IMPORTE_a_t+$datoss[mysql_field_name($ress1,0)];
				 echo "<td>".$datoss[mysql_field_name($ress1,0)]."</td>";  
				 echo "<td>0.00</td>";   
			   }
		  if($cod==$fecha_p)
			   {
				    echo "<td>0.00</td>";   
				 $IMPORTE=$datoss[mysql_field_name($ress1,0)];
				  $IMPORTE_t=$IMPORTE_t+$datoss[mysql_field_name($ress1,0)];
				 echo "<td>".$datoss[mysql_field_name($ress1,0)]."</td>";  
				 
			   }
		
		
	}
 }
 
}
else

{
	 echo "<td>0.00</td>";  
	  echo "<td>0.00</td>";  
	   echo "<td>0.00</td>";  
	    echo "<td>0.00</td>";  
	
	}
 
}
 
  $diferencia_t=$IMPORTE_t-$IMPORTE_a_t;
	// $diferencia_t= $diferencia_t+ $diferencia;
	 $por1_t=$diferencia_t/$IMPORTE_a_t;
	 $por_t= number_format($por1_t * 100, 2); 
echo "<tr>";
	echo "<td>TOTALES</td>";
 echo "<td>".$IMPORTE_a_t."</td>";
 echo "<td>".$IMPORTE_t."</td>";
 echo "<td>".$diferencia_t." </td>";  	 
echo "<td>".$por_t."% </td>"; 
echo "</tr>";
 			

echo "</table>";
	
	
}




?>