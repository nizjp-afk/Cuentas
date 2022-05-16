<?
error_reporting ( E_ERROR );
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	
	  $sql = "TRUNCATE TABLE `tem_ss`";
					  if (!($r_borrar= mysql_query($sql, $conexion_mysql)))
							{
							
							  //.....................................................................
							  // informa del error producido
							  $cuerpo1  = "al intentar buscar beneficiario";
							  echo $cuerpo1;
							  //.....................................................................
							}  
	
	
    $archivo = file("txt_afip/ss.txt");
    $cuantos = count($archivo);
    for ($var=0;$var<$cuantos;$var++)
	{
	    echo $linea= $archivo[$var];   //TODO EN ARCHIVO EN UNA LINEA
		echo '<br>';
		 $codigo=substr($linea,0,3);
		
		
		 $cuit=substr($linea,3,14);
		
	
		
		
		echo $fecha_io=substr($linea,23,-25);
		
	echo '<br>';
		
		echo $imp=substr($linea,36,-16);
		     $impo1=split(",",$imp);  
		echo '<br>';
		echo $importe=$impo1[0].'.'.$impo1[1];
	echo '<br>';	
		
		
		echo $nro=substr($linea,42);
		
		echo '<br>';
		
		
		
		$fecha_i=split("/",$fecha_io);
		
	 	echo $fecha_io=$fecha_i[2].'-'.$fecha_i[1].'-'.$fecha_i[0];

		echo '<br>';
		 
		 		
	    $sql = "INSERT INTO `tem_ss` ( `codigo` , `cuit` ,  `fecha` , `importe` , `numero` )
                              VALUES ('$codigo', '$cuit', '$fecha_io', '$importe', '$nro');";
					  if (!($r_upd= mysql_query($sql, $conexion_mysql)))
							{
							
							  //.....................................................................
							  // informa del error producido
							  $cuerpo1  = "al intentar buscar beneficiario";
							  echo $cuerpo1;
							  //.....................................................................
							}  
							
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