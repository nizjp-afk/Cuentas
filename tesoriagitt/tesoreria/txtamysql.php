<?
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	
    $archivo = file("txt_afip/sicore.txt");
    $cuantos = count($archivo);
    for ($var=0;$var<$cuantos;$var++)
	{
	    $linea= $archivo[$var];   //TODO EN ARCHIVO EN UNA LINEA
		$fecha_io=substr($linea,2,-148);
		$fecha_i=split("/",$fecha_io);
	 	$fecha_io=$fecha_i[2].'-'.$fecha_i[1].'-'.$fecha_i[0];

		$op_v=substr($linea,12,-136);
		
		$op_v=ltrim($op_v,'0'); 
		
		
   	    $nro_v=substr($linea,131);
		$nro=ltrim($nro_v,'0');
		$nro_a=substr($nro,0,4); 
		$nro_n=substr($nro,5); 
        $nro='0000'.'-'.$nro_a.'-'.$nro_n;
		 
		 		
	    $sql = "update sicore set numero='$nro' WHERE orden='$op_v'
		                                        AND   fecha_io='$fecha_io'
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
	    
		   echo $op_V;
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