<?php
 error_reporting ( E_ERROR );
//conexion
	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');

   echo $saf = $_POST['saf'];
	
	echo $mes = $_POST['fecha_mes'];
	$ejercicio = $_POST['fecha_e'];


	 
	if(($ejercicio=='---') or ($mes == 0))
	{
		?>
	<p>
                <p align="center"><font color="#CC0000" size="4" face="Verdana, Arial, Helvetica, sans-serif">Atenci&oacute;n</font></p>
                 <ul>
                         <div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif" align="center"><strong> 
                          No Selecciono  MES o AÑO para Clasificar.</strong></font></div>
                 </ul>
                <p align="center">&nbsp;</p>
                        <p align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                         Para corregir este problema haga click <a href="javascript:history.back()">aquí</a>.<br>Muchas Gracias.</font></p>
                        <p align="center">&nbsp;</p>
                <?php
                          exit;
	}
	
	//$fechaant = $_POST['f_ant'];
	//$fechahoy = $_POST['f_hoy'];
	
 	if($saf=='N')
	{
      $ssql =  "SELECT * FROM `analisis_f`
									WHERE `mm` ='$mes'
									AND `aa` ='$ejercicio'
									
									order by total desc
									";

	 if (!($datos = mysql_query($ssql, $conexion_mysql)))
		{
		  //.....................................................................
		  // informa del error producido
		  $cuerpo1  = "al intentar buscar expediente";
		 
		  //.....................................................................
		}
	}
    else
	{
	$ssql =  "SELECT * FROM `analisis_f`
									WHERE `mm` ='$mes'
									AND `aa` ='$ejercicio'
									and entidad='$saf'
									
									order by total desc
									";

	 if (!($datos = mysql_query($ssql, $conexion_mysql)))
		{
		  //.....................................................................
		  // informa del error producido
		  $cuerpo1  = "al intentar buscar expediente";
		 
		  //.....................................................................
		}
	
	}

 $cont_item=0;
  while($fila= mysql_fetch_array($datos))
   {
	   
	       
	   
	   
	   $i=$fila['id'];
	 echo  $codigo = $_POST['C'.$i];
	  // $orden=$fila['orden_pago'];
	  // $ejercicio=$fila['ejercicio'];
	  // $fecha=$fila['fecha'];
	  // $saf=$fila['saf'];
	
	
	if($codigo=='S')
      {
		  $cont_item=1;
		   $sql = "update  analisis_f set extra ='S' where id='$i'							 ";
							
					 if (!($r_alta= mysql_query($sql, $conexion_mysql)))
								{
									//.....................................................................
									 echo "Error al dar Alta al prestamo ";
									 exit;
									//.....................................................................
								}
	  }
	else
	{
		
		$sql = "update  analisis_f set extra ='N' where id='$i'							 ";
							
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
 		$id=$i; 
	 $accion='clasificacion';
		  $tabla='beneficiarios';
		  include('agrego_movi.php'); 
	?>	
			
       				  
 <meta http-equiv='refresh' 
 content='0;url=indextesoreria.php?sec=hacienda/clasificar_periodo&apli=h&per=O'/>	 </meta>              
       

