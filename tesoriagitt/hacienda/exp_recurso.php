<?php
//error_reporting ( E_ERROR );
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	
    $archivo = file("txt_hacienda/recurso.txt");
  echo  $cuantos = count($archivo);
 
	
    for ($var=0;$var<$cuantos;$var++)
	{
		$tipo_i='';
		$tipo_a='';
		$total=0;
	    $linea=  explode("\t",$archivo[$var]);
		   
		echo $cuenta= trim($linea[0]);echo "<br>";
		
		   	$cuenta=split("-",$cuenta);
		    $banco=  $cuenta[0];
		    $sucursal=  $cuenta[1];
		    $cuenta_b=  $cuenta[2];
		
		
		
		//------------
		
		
		
		echo $fecha_t= trim($linea[2]);echo '<br>';
		
		$fecha_pp=split("/",$fecha_t);
		
	 	echo $fecha=$fecha_pp[2].'-'.$fecha_pp[1].'-'.$fecha_pp[0];
		
		$mm=$fecha_pp[1];
		$aa=$fecha_pp[2];
		
		//--------------------------------
		
				
		
		   
		
		
		echo $total= trim($linea[4]);echo "<br>";
	
		
		echo $ssql = "INSERT INTO `sigcom`.`cuenta_ingreso` (`banco`, `sucursal`, `cuenta`, `fecha`, `mes`, `aa`, `monto`)  VALUES ('$banco', '$sucursal','$cuenta_b','$fecha', '$mm', '$aa','$total')";
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