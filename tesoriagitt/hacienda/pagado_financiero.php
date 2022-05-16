<?php
//error_reporting ( E_ERROR );
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	
    $archivo = file("txt_hacienda/pagado.txt");
  echo  $cuantos = count($archivo);
 
	
    for ($var=0;$var<$cuantos;$var++)
	{
		$tipo_i='';
		$tipo_a='';
		$total=0;
	    $linea=  explode("\t",$archivo[$var]);
		   
		echo $saf1= trim($linea[0]);echo "<br>";
		
		echo	$saf=ltrim(substr($saf1,4,6)); 
		
		//------------
		
		
		
		echo $fecha_p= trim($linea[1]); echo '<br>';
		
		$fecha_pp=split("/",$fecha_p);
		
	 	echo $fecha=$fecha_pp[2].'-'.$fecha_pp[1].'-'.$fecha_pp[0];
		
		$mm=$fecha_pp[1];
		$aa=$fecha_pp[2];
		
		//--------------------------------
		
				
		 $tipo_i= trim($linea[2]);echo '<br>';
		if($tipo_i !=='') 
		  {
			$inciso=$tipo_i;   
		  }

		 $tipo_a= trim($linea[3]);echo '<br>';
		if($tipo_a !=='') 
		  {
			$inciso=$tipo_a;   
		  }
		 
		   
		
		
		echo $total= trim($linea[9]);echo "<br>";
		echo $ente= trim($linea[10]);echo "<br>";
		echo $tipo_o= trim($linea[11]);echo "<br>";
		echo $ejer_o= trim($linea[12]);echo "<br>";
		echo $nro_o= trim($linea[13]);echo "<br>";
		echo $ejer_p= trim($linea[14]);echo "<br>";
		echo $nro_p= trim($linea[15]);echo "<br>";
		echo $obs_o= trim($linea[17]);echo "<br>";
		echo $ff= trim($linea[16]);echo "<br>";
		echo $orden_pago=$tipo_o.'-'.$saf.'-'.$nro_o;echo "<br>";
		
		/*
			  $ssql = "SELECT * FROM analisis_f  WHERE  nro_p='$nro_p' AND ejer_p = '$ejer_p' and inciso_axt='$inciso'"; 
			if (!($r_pg= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al buscar Pago";
			  //.....................................................................
			} 
		 	 $cantp= mysql_num_rows($r_pg); 
	   
		 if($cantp == '0')
             { */
		
		echo $ssql = "INSERT INTO `sigcom`.`analisis_f` (`entidad`, `fecha_p`,`mm`,`aa`, `inciso_axt`, `total`, `ente`, `tipo_o`, `ejer_o`, `nro_o`, `obs_o`,`ejer_p`,`nro_p`,`ff`) VALUES ('$saf', '$fecha','$mm','$aa', '$inciso', '$total','$ente', '$tipo_o', '$ejer_o', '$nro_o', '$obs_o','$ejer_p','$nro_p','$ff')";
				 if (!($r_orden= mysqli_query($conexion_mysql,$ssql)))
				{
				
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar buscar provincia";
				  echo $cuerpo1;
				  echo $orden_pago;
				   echo $ejercicio;
				  //.....................................................................
				}
				
		
//	}

	}
//$file=txt_hacienda/pagado.txt;

$files = glob('txt_hacienda/*.txt'); //obtenemos todos los nombres de los ficheros
foreach($files as $file){
    if(is_file($file))
    unlink($file); //elimino el fichero
}

//unlink($file); //elimino el fichero

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