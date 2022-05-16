<?
//error_reporting ( E_ERROR );
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	//Exportacion/retenciones_esidifcorrecccion d&apli=cgp&per=X
    $archivo = file("retencion.txt");
  echo  $cuantos = count($archivo);
 
	
    for ($var=0;$var<$cuantos;$var++)
	{
				
	    $linea=  explode("\t",$archivo[$var]);
		   
		echo $codigo= trim($linea[0]);echo '<br>';
		
		echo $saf= trim($linea[1]);echo '<br>';
		
		echo $fecha_p= trim($linea[2]);echo '<br>';
		
				
		 $tipo= trim($linea[3]);echo '<br>';
		if(($tipo =='C41') or ($tipo=='C42'))
		  {
			$tipo=substr($tipo,1,3);   
		  }
		 
		 $nro_op= trim($linea[4]);
		
		echo $orden_pago=$tipo.'-'.$saf.'-'.$nro_op;echo "<br>";
		
		$fecha_pp=split("/",$fecha_p);
	 	echo $fecha=$fecha_pp[2].'-'.$fecha_pp[1].'-'.$fecha_pp[0];
		
		
		echo $total_f1= trim($linea[5]);echo "<br>";
		echo $total_retencion=number_format($total_f1,2, '.', '');
		
		echo $op_saf= trim($linea[6]);echo "<br>";
		
		echo $ejercicio= trim($linea[7]);echo "<br>";
		
		echo $nro_es= trim($linea[8]);echo "<br>";
		
		
		
			
		


/////////////////////********************************/////////////////////////////////////////
		
		
		if(($codigo=='4') or ($codigo=='5'))
		{
		
		
		
		 $sql = "update  sicore set monto='$total_retencion'  where orden='$orden_pago' and ejercicio='$ejercicio' and  saf='$saf' and fecha_io ='$fecha' ";
	  	  
			if (!($r_control= mysql_query($sql, $conexion_mysql)))
			{
			  //..informa del error producido...................
			  $cuerpo1  = "al buscar saf1";
			  echo $cuerpo1;
			  //...............................................
			} 
		
		}
			if($codigo=='7')
		{
				
		 $sql = "update sicore_ib  set monto='$total_retencion' where orden='$orden_pago' and ejercicio='$ejercicio' and  saf='$saf' and fecha_io ='$fecha'";
	  	  
			if (!($r_control= mysql_query($sql, $conexion_mysql)))
			{
			  //..informa del error producido...................
			  $cuerpo1  = "al buscar saf1";
			  echo $cuerpo1;
			  //...............................................
			} 
		
		  
		}
		
			if(($codigo=='6') or ($codigo=='11') or ($codigo=='10') or ($codigo=='1'))
		{
		 $sql = "update sicore_ss set monto='$total_retencion'  where orden='$orden_pago' and ejercicio='$ejercicio' and  saf='$saf' and fecha_io ='$fecha'";
	  	  
			if (!($r_control= mysql_query($sql, $conexion_mysql)))
			{
			  //..informa del error producido...................
			  $cuerpo1  = "al buscar saf1";
			  echo $cuerpo1;
			  //...............................................
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