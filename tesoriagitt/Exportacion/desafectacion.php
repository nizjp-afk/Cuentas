<?
//error_reporting ( E_ERROR );
    include('dgti-mysql-var_dbtgp.php');
	         include('dgti-intranet-mysql_connect.php');  
	         include('dgti-intranet-mysql_select_db.php');
	
    $archivo = file("desafectacion.txt");
    $cuantos = count($archivo);
    for ($var=0;$var<$cuantos;$var++)
	{
		
		 include('dgti-mysql-var_dbtgp.php');
	         include('dgti-intranet-mysql_connect.php');  
	         include('dgti-intranet-mysql_select_db.php');
	
				
	    $linea=  explode("\t",$archivo[$var]);
		
	    echo $ejercicio= trim($linea[1]);echo "<br>";
		
		//echo $saf= trim($linea[1]);echo "<br>";
		
		 $saf1= trim($linea[0]);echo "<br>";
		
		echo	$saf=ltrim(substr($saf1,4,6)); echo "<br>";
		
		echo $tipo= trim($linea[2]);echo "<br>";
		
				
		echo $nro_op= trim($linea[3]);echo "<br>";
		
		
		echo $orden_pago=$tipo.'-'.$saf.'-'.$nro_op;echo "<br>";
		
				
		
			
		
		echo $total= abs( trim($linea[4]));echo "<br>";
		
		echo $total_d=number_format($total,2, '.', '');
		
		echo $clave=$ejercicio.''.$saf.''.$tipo.''.$nro_op;
		
		
		$ssql = "SELECT * FROM `orden_pago`  WHERE `clave` = '$clave'  ";
 				 
				  
     	 if (!($r_pago= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar ordenes para pago tgp";
			  echo $cuerpo1;
			  //.....................................................................
			}		
			
			
		 $can1=mysql_num_rows($r_pago);
			
			 				  
			if($can1 > 0)
			  
		 { 
		 echo 'paso';   echo	'<br>'	;
		 $f_pago=mysql_fetch_array($r_pago);
		 
		
		echo $IMP_FORM = $f_pago['IMP_FORM'];
		 
		 if ($total_d==$IMP_FORM)
		   {
			  echo  $ssql = "UPDATE `orden_pago` SET  IMP_DESAF='$total_d', ESTADO='A'
												 
												  WHERE `clave` = '$clave' ";
 				 
				  
				 if (!($r_pago_d= mysql_query($ssql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar ordenes para modificar tgp";
					  echo $cuerpo1;
					  //.....................................................................
					} 
			echo '<br>';		
		   }
		 else
		  {
			//  echo $IMP_FORM; echo	'<br>'	;
			    echo $total_d; echo	'<br>'	;	  
		  }
		 
		    
			
		 }
		 
	}

		
	exit;   
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