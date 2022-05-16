<?php
 error_reporting ( E_ERROR );
//conexion
	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');

    $id = $_GET['id'];
	$clasificador = $_POST['clasificador'];
	$fecha_m = $_POST['fecha_m'];
	$fecha_a = $_POST['fecha_a'];
	$nom = $_POST['dato'];
	 
	if(($clasificador=='N') or ($fecha_a=='N') or ($fecha_m=='N'))
	{
		?>
	<p>
                <p align="center"><font color="#CC0000" size="4" face="Verdana, Arial, Helvetica, sans-serif">Atenci&oacute;n</font></p>
                 <ul>
                         <div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" align="center"><strong> 
                          No Selecciono  CLASIFICADOR o el Periodo a Clasificar.</strong></font></div>
                 </ul>
                <p align="center">&nbsp;</p>
                        <p align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                         Para corregir este problema haga click <a href="javascript:history.back()">aquí</a>.<br>Muchas Gracias.</font></p>
                        <p align="center">&nbsp;</p>
                <?php
                          exit;
	}
	
	$fechaant = $_POST['f_ant'];
	$fechahoy = $_POST['f_hoy'];
	
	$ssql = "SELECT *  FROM orden_pago 
							  WHERE   fecha >='$fechaant' and fecha <= '$fechahoy'
							  ORDER BY ejercicio,`fecha` DESC,`orden_pago` ASC" ;
     if (!($r_max= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar garantia";
     
      //.....................................................................
    }
 $cont_item=0;
  while($fila= mysql_fetch_array($r_max))
   {
	   
	      
		  
	   
	   
	   $i=$fila['id'];
	$codigo = $_POST['C'.$i];
	$orden=$fila['orden_pago'];
	$cuit=$fila['cuit'];
	$ejercicio=$fila['ejercicio'];
	$fecha=$fila['fecha'];
	$fecha_p=$fecha_a.'-'.$fecha_m;
	$saf=$fila['saf'];
	
	
	if(!(empty ($codigo) ))
      {
		  $cont_item=1;
		   $sql = "INSERT INTO clasificacion_municipio (ejercicio,orden,saf,clasificador_id,fecha,cuit,periodo)
							 VALUE ('$ejercicio','$orden','$saf','$clasificador','$fecha','$cuit','$fecha_p')";
							
					 if (!($r_alta= mysql_query($sql, $conexion_mysql)))
								{
									//.....................................................................
									 echo "Error al dar Alta al prestamo ";
									 exit;
									//.....................................................................
								}
	  }
	  
   }
   	///insertar en base Sigcom tabla op_pendiente_tmp
if($cont_item==0)
{?>
<p>
                <p align="center"><font color="#CC0000" size="4" face="Verdana, Arial, Helvetica, sans-serif">Atenci&oacute;n</font></p>
                 <ul>
                         <div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" align="center"><strong> 
                          No Selecciono Orden a Clasificar.</strong></font></div>
                 </ul>
                <p align="center">&nbsp;</p>
                        <p align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                         Para corregir este problema haga click <a href="javascript:history.back()">aquí</a>.<br>Muchas Gracias.</font></p>
                        <p align="center">&nbsp;</p>
                <?php
                          exit;
						
			}
?>              		 
	
		
			
       				  
 <meta http-equiv='refresh' 
 content='0;url=indextesoreria.php?sec=clasificador/carga_orden_pagadas_muni&fechahoy=<?php echo $fechahoy;?>&fechaant=<?php echo $fechaant;?>&apli=tgpa&per=T'/>	 </meta>              
       

