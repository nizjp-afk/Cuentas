<?php
//error_reporting ( E_ERROR );
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	
    $archivo = file("txt_hacienda/limite.txt");
  echo  $cuantos = count($archivo);
 
	
    for ($var=0;$var<$cuantos;$var++)
	{
				
	    $linea=  explode("\t",$archivo[$var]);
		   
		echo $saf1= trim($linea[0]);echo "<br>";
		
		echo	$saf=ltrim(substr($saf1,4,6)); 
		
		//------------
		
		
		
		echo $total= trim($linea[1]);echo "<br>";
		
		
		
		$mm=trim($linea[2]);echo "<br>";
		$aa=trim($linea[3]);echo "<br>";
		
		//--------------------------------
		
				
		
		 
		   
		
		
		
			 
		
		 $ssql = "INSERT INTO `sigcom`.`limites_f` (`entidad`, `mm`,`aa`, `total`) VALUES ('$saf', '$mm','$aa','$total')";
				 if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
				{
				
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar buscar provincia";
				  echo $cuerpo1;
				  echo $orden_pago;
				   echo $ejercicio;
				  //.....................................................................
				}
				
		
	}
	exit;   
?>
	
<meta http-equiv='refresh' content='3;url=indextesoreria.php?sec=hacienda/index1&apli=h&per=C'> 
	 
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