<?php
 //error_reporting (E_ERROR); 
 
    header("Content-type: application/ms-excel");
	header("Content-Disposition: attachment; filename=INFORME_SAPEM_.xls");
    header("Pragma: no-cache"); 
    header("Expires: 0");
   /* include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
	*/
	
	$fechaant = $_POST['firstinput'];
	$fechahoy = $_POST['secondinput']; 
	
	$Y_p = date ( "Y" , strtotime($fechaant) );
	$me_p = date ( "m" , strtotime($fechaant) );
	$Y_pa = date ( "Y" , strtotime($fechahoy) );
	$me_pa = date ( "m" , strtotime($fechahoy) );
	$fechahoy1 = date ( 'Y-m' , $fechahoy );
	///////////////////
	
	$f=strftime("%Y-%m-%d");
    $dia = date("d/m/Y");
    $hora =date("h:i");
    $diaa = date("d-m-Y");
				
	include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
    
	//include('../conexion/extras.php');  	
	
	  $ssql = "SELECT  MONTH( fecha ) mes, year( fecha ) aa
FROM orden_pago AS o
WHERE fecha >='$fechaant' and fecha <= '$fechahoy'
GROUP BY MONTH( fecha ),year( fecha )
ORDER BY `aa` ASC
		  ";
	
	
				 if (!($r_periodo= mysql_query($ssql, $conexion_mysql)))
				{
				  
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar buscar area";
				 
				  //.....................................................................
				}

	
		$ssql = "SELECT b.apellido, ' ', b.nombre, ' ', b.razon_social,b.cuitl
		FROM beneficiarios_aprobados as b,orden_pago AS o
		WHERE  b.cuitl = o.cuit
		AND b.sociedad_tipo = '30'
		group by o.cuit 
		  ";
	
	
				 if (!($r_muni= mysql_query($ssql, $conexion_mysql)))
				{
				  
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar buscar area";
				 
				  //.....................................................................
				}


$ver=$columnass-1;
//creo tabla
echo "<table border='1'>";

echo "<tr>";
echo "<td height='25' style='font-size:18'  align='center' colspan='14' bgcolor='#CCCCCC'> SAPEM ".$me_p.'/'.$Y_p.' - '.$me_pa.'/'.$Y_pa."</td>";
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
 echo "<td>SAPEM</td>";
 $meses= array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto',
                                        'Septiembre','Octubre','Noviembre','Diciembre');
while ($f_periodo = mysql_fetch_array ($r_periodo))
              {
				 $mm=$f_periodo['mes'];
	             $aa=$f_periodo['aa'];
				 
				  echo '<td align="right"  >'.$meses{$mm-1}.'-'.$aa.'</td>';
				 
	
	}
 echo "<td>TOTAL</td>";	
echo "</tr>";
$total_s=0;
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
	  
 


//numero de columnas
$columnass1 = mysql_num_rows($ress1);


$cnt = mysql_num_rows($ress);








echo "<tr>";
echo "<td  bgcolor='#CCCCCC'>".$benef."</td>";



$mver=13;
//agrego contenido a los datos
$IMPORTE=0;
 mysql_data_seek($r_periodo,0);
while ($f_periodo = mysql_fetch_array ($r_periodo))
              {
				 $mm=$f_periodo['mes'];
	             $aa=$f_periodo['aa'];

	 $sql = "SELECT   sum( o.total ) AS TOTAL,MONTH( fecha ) mes,YEAR( fecha ) aa
                FROM orden_pago AS o
				WHERE  fecha >='$fechaant' and fecha <= '$fechahoy'
				AND o.cuit ='$municipio' 
				AND MONTH( fecha ) ='$mm'
				AND YEAR( fecha ) ='$aa'
				GROUP BY MONTH( fecha ) , YEAR( fecha )
				ORDER BY `aa` ASC, mes asc ";

          if (!($ress1= mysql_query($sql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar tipo beneficiario1";
					  echo $cuerpo1;
					  //.....................................................................
					} 
	 $aux=0;
	//exit;
    while($datoss = mysql_fetch_assoc($ress1))
        {
		  $cod=$datoss[mysql_field_name($ress1,1)];
		  $coda=$datoss[mysql_field_name($ress1,2)];
	      if(($cod==$mm) and ($coda==$aa))
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
	
	
	
	




?>