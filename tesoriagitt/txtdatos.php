<?
 
//error_reporting ( E_ERROR );
 include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');

    $archivo = file("txt_hacienda/fuente.txt");
    $cuantos = count($archivo);
    for ($var=0;$var<$cuantos;$var++)
	{
	 
	    $linea=  explode("\t",$archivo[$var]);
		   
		echo $saf1= trim($linea[0]);echo "<br>";
		
		//saf
		
		echo	$saf=ltrim(substr($saf1,4,6)); 
		
		
		
		
		
		echo $fecha_p= trim($linea[1]);echo '<br>';
		
		$fecha_pp=split("/",$fecha_p);
		
		//fecha pago
		
	 	echo $fecha=$fecha_pp[2].'-'.$fecha_pp[1].'-'.$fecha_pp[0];
		
		$mm=$fecha_pp[1];
		$aa=$fecha_pp[2];
		
		//--------------------------------
		
				
		
		
		echo $tipo_o= trim($linea[11]);echo "<br>";
		echo $ejer_o= trim($linea[12]);echo "<br>";
		echo $nro_o= trim($linea[13]);echo "<br>";
			
		echo $ff= trim($linea[16]);echo "<br>";
		echo $orden_pago=$tipo_o.'-'.$saf.'-'.$nro_o;echo "<br>";
		
		
		
		
		
	  $sql = "update `analisis_f` set `ff`='$ff'
									WHERE `fecha_p` ='$fecha' and `tipo_o`='$tipo_o' and `ejer_o`='$ejer_o' and  `nro_o`='$nro_o' and `entidad`='$saf'
									";
					  if (!($error_b= mysql_query($sql, $conexion_mysql)))
							{
							
							  //.....................................................................
							  // informa del error producido
							  $cuerpo1  = "al intentar buscar beneficiario";
							  echo $cuerpo1;
							  //.....................................................................
							}
			echo '<br>';
     }
?>