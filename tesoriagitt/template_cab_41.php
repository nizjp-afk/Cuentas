<?php
    error_reporting (E_ERROR); 
    header("Content-type: application/ms-excel");
	header("Content-Disposition: attachment; filename=template.xls");
    header("Pragma: no-cache"); 
    header("Expires: 0");
    /*include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    //include('../conexion/extras.php');  	
	*/
	 include('dgti-mysql-var_dbtgp.php');
	 include('dgti-intranet-mysql_connect.php');  
	 include('dgti-intranet-mysql_select_db.php');
 //  and `inhi`!='Cta Cerrada'
    $aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
  
  
  
$sql="SELECT EJERCICIO, `LB_NUMERO` , `LB_SAOD` , `LB_SAOD` , `LB_SAOD` , `LB_SAOD` , `LB_SAOD` , `LB_NUMERO` , p.ESTADO, LB_OPERAC, LB_FECHA,LB_FECHA , LB_FECHA,LB_PAGADOR, LB_DOC_TIP, LB_DOC_NRO,LB_DOC_EJ,FUENTE, FUENTE, CLASE,LB_SIGADE, p.cuit AS beneficiario, b.cbu_entidad AS entidad_bene, b.cbu_sucursal AS sucursal_bene, b.cbu_cta AS cuenta_ben,LB_FAC_REC,LB_FAC_VTO,fecha_op, IMP_FORM, IMPORTE_A_PAGAR,  id_escritural
FROM orden_pago p, beneficiarios_aprobados b, `pr_cdp1am04` p4
WHERE LB_SAOD in('130','420')
AND `p`.`FECHA_OP` > '2014-10-15'
AND LB_FORMUL = '41'
AND p4.clave = p.clave
AND EJERCICIO = '2014'
AND p.cuit = b.cuitl
ORDER BY  p.Clave ASC

";
if (!($res= mysql_query($sql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo beneficiario";
      echo $cuerpo1;
      //.....................................................................
    }
	
 $sql="SELECT `cuentas_corrientes`.`banco_nro`  , `cuentas_corrientes`.`sucursal_nro` , `cuentas_corrientes`.`CUENTA`
FROM cuentas_corrientes, escritural_ren
 where trim(escritural_ren.id_escritural)=2
 AND (
`escritural_ren`.`ID_CORRIENTE` = cuentas_corrientes.id
)";
					if (!($res_en= mysql_query($sql, $conexion_mysql)))
						{
						  //.....................................................................
						  // informa del error producido
						  $cuerpo1  = "al intentar buscar tipo beneficiario";
						  echo $cuerpo1;
						  //.....................................................................
						} 
			   $columnas_e = mysql_num_fields($res_en);
			 

//numero de columnas
$columnas = mysql_num_fields($res);
$id_es=$columnas-1;
$id_pag=$columnas-2;

  $cl_e=$columnas_e+$columnas;
			   $l_e=0;	 
/*

$sql1="SELECT `cbu_cta` ,`cuitl` 
FROM `beneficiarios_aprobados` where id_beneficiario !='675' and estado != 'B'  order by id_beneficiario";
if (!($secion= mysql_query($sql1, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo beneficiario";
      echo $cuerpo1;
      //.....................................................................
    } 
*/
//creo tabla
echo "<table>";
echo "<tr>";

//agrego los nombres de las tablas
for($i=0; $i<$columnas-1; $i++){
	echo "<td>".mysql_field_name($res,$i)."</td>";
}
for($l_e=0; $l_e<$columnas_e; $l_e++){
	echo "<td>".mysql_field_name($res_en,$l_e)."</td>";
}

echo "</tr>";

//agrego contenido a los datos
while($datos = mysql_fetch_assoc($res))
    {
	echo "<tr>";
	for($j=0; $j<$columnas; $j++)
	{
		if($j==$id_es)
		  {
			 // echo "<td>".$datos[mysql_field_name($res,$j)]."</td>";
		      $dato_e=$datos[mysql_field_name($res,$j)];
			  $sql="SELECT `cuentas_corrientes`.`banco_nro` , `cuentas_corrientes`.`sucursal_nro` , `cuentas_corrientes`.`CUENTA`
FROM cuentas_corrientes, escritural_ren
 where trim(escritural_ren.id_escritural)=trim('$dato_e')
 AND (
`escritural_ren`.`ID_CORRIENTE` = cuentas_corrientes.id
)";
					if (!($res_es= mysql_query($sql, $conexion_mysql)))
						{
						  //.....................................................................
						  // informa del error producido
						  $cuerpo1  = "al intentar buscar tipo beneficiario";
						  echo $cuerpo1;
						  //.....................................................................
						} 
			   $columnas1 = mysql_num_fields($res_es);
			   $cl=$columnas1+$columnas;
			   $l=0;
			   
				while($datos1 = mysql_fetch_assoc($res_es))
                       {
							
							for($e=$columnas; $e<$cl; $e++)
							{
								
								
                                echo "<td>".$datos1[mysql_field_name($res_es,$l)]."</td>";
								$l=$l+1;
							}
					   }

		
		
		  }
		  elseif($j==$id_pag)
		    {
				  $dato_p=number_format(trim($datos[mysql_field_name($res,$j)]),2);
				  if(($dato_p == 0) or ($dato_p < 0))
				   {
					   
				     echo "<td>".$datos[mysql_field_name($res,$j-1)]."</td>";
				   }
				  else
				  {
					 echo "<td>0</td>";
					 } 
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