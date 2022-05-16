<?php
error_reporting ( E_ERROR );
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	
    $archivo = file("txt_afip/ingresos.txt");
   echo $cuantos = count($archivo);
  
	for ($var=1;$var<$cuantos;$var++)
	{
	    $linea=  explode("\t",$archivo[$var]);  //TODO EN ARCHIVO EN UNA LINEA
		echo $fecha_io=$linea[0];
		$fecha_pi=split("/",$fecha_io);
	 	$fecha_p=$fecha_pi[2].'-'.$fecha_pi[1].'-'.$fecha_pi[0];
		echo $orden=$linea[1];
		echo  $nro=$linea[3];
		echo  $cuit=$linea[2];
		
		
		$sql = "SELECT * FROM `orden_pago` where `orden_pago`='$orden' and `fecha`='$fecha_p' and cuit='$cuit'";
					  if (!($r_cord_t= mysql_query($sql, $conexion_mysql)))
							{
							
							  //.....................................................................
							  // informa del error producido
							  $cuerpo1  = "al intentar buscar beneficiario";
							  echo $cuerpo1;
							  //.....................................................................
							}  
							
		echo $cant_t= mysql_num_rows($r_cord_t);					
							
		$sql = "SELECT * FROM `orden_pago_fp` where `orden_pago`='$orden' and `fecha`='$fecha_p' and cuit='$cuit'";
					  if (!($r_cord_p= mysql_query($sql, $conexion_mysql)))
							{
							
							  //.....................................................................
							  // informa del error producido
							  $cuerpo1  = "al intentar buscar beneficiario";
							  echo $cuerpo1;
							  //.....................................................................
							}  					
		echo  $cant_p= mysql_num_rows($r_cord_p);
		  
		  if($cant_t > 0)		
		    {
				$f_cord_t=mysql_fetch_array($r_cord_t);
				$ejercicio=$f_cord_t['ejercicio'];
				
			}
			
			
			if($cant_p > 0)		
		    {
				$f_cord_p=mysql_fetch_array($r_cord_p);
				$ejercicio=$f_cord_p['ejercicio'];
				
			}
		 		
	    $sql = "update sicore_ib set numero='$nro' WHERE orden='$orden'
		                                        AND   ejercicio='$ejercicio'
                                                AND numero=''";
					  if (!($r_upd= mysql_query($sql, $conexion_mysql)))
							{
							
							  //.....................................................................
							  // informa del error producido
							  $cuerpo1  = "al intentar buscar beneficiario";
							  echo $cuerpo1;
							  //.....................................................................
							}  
							
							
		//   echo $fecha_io;
		  // echo '<br>';
	     echo '<br>';
		   echo $orden;
		   echo '<br>';
	    
		   echo $nro;
		   echo '<br>';
	    

		} 
   
?>
	
<meta http-equiv='refresh' content='3;url=indextesoreria.php?sec=tesoreria/index1&apli=tgp&per=C'> 
	 
	<table width="60%" border="0" align="left">
     <tr>
     <td align="center">
     <center><h1>Guardando</h1></center>
	 <p class="Estilo2 style1 Estilo1"><img src="img/loader_guardando.gif" width="100" height="100" /></p>
      
      <p class="Estilo2 style1">
      <p>Sus datos fueron grabados con exito.</p></center>
	  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Espere unos segundos el Sistema se Redirigir&aacute; automaticamente
	  <br><br>
      Gracias
	  </font>
	  </p>
	  </td>
     </tr>
   </table>