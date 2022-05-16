<?php
error_reporting ( E_ERROR );
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	
    $archivo = file("txt_afip/sicore.txt");
    $cuantos = count($archivo);
    for ($var=0;$var<$cuantos;$var++)
	{
	    $linea= $archivo[$var];   //TODO EN ARCHIVO EN UNA LINEA
		echo $fecha_io=substr($linea,2,-149);echo "<br>";
		
		$fecha_i=split("/",$fecha_io);
	 	$fecha_io=$fecha_i[2].'-'.$fecha_i[1].'-'.$fecha_i[0];

		echo $op_v=substr($linea,12,-130);echo "<br>";
		echo $neto=substr($linea,28,-117); echo "<br>";
		
		echo $regim=substr($linea,48,3); echo "<br>";
	
		echo  $regimen=(string)(int)$regim;
		 
		$ssql = "SELECT id_rg FROM anexorg830 where codigo='$regimen'  ";
				 if (!($r_rg= mysql_query($ssql, $conexion_mysql)))
				{
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar buscar tipo de iva";
				  echo $cuerpo1;
				  //.....................................................................
				}   
		
		 $f_rg= mysql_fetch_array ($r_rg);
		  $reg = $f_rg['id_rg']; 
		
		
		
		 $op_v=trim(ltrim($op_v,'0')); echo "<br>";
		
		 $tipo=substr($op_v,0,3);  
		
   	    $nro_v=substr($linea,131);
		$nro=ltrim($nro_v,'0');
		$nro_a=substr($nro,0,4); 
		$nro_n=substr($nro,5); 
        $nro='0000'.'-'.$nro_a.'-'.$nro_n;
	
	
	    /*if($tipo=='41-') 
		 {
			 echo 'paso 41-140-3557';
		 		
	   echo $sql = "update sicore set numero='$nro' WHERE orden='$op_v'
		                                        AND ejercicio='2015'
                                                AND numero=''
												AND op_saf=''";
					  if (!($r_upd= mysql_query($sql, $conexion_mysql)))
							{
							
							  //.....................................................................
							  // informa del error producido
							  $cuerpo1  = "al intentar buscar beneficiario";
							  echo $cuerpo1;
							  //.....................................................................
							}  
							
		 $sql = "update sicore set neto='$neto' WHERE numero='$nro'
		                                       AND   neto='0'";
					  if (!($r_upd= mysql_query($sql, $conexion_mysql)))
							{
							
							  //.....................................................................
							  // informa del error producido
							  $cuerpo1  = "al intentar buscar beneficiario";
							  echo $cuerpo1;
							  //.....................................................................
							}  	
							
		  $sql = "update sicore set numero='$nro',neto='$neto',regimen830_id='$reg' WHERE orden='$op_v'
		                                        AND   ejercicio='2015'
                                                AND numero=''
												AND op_saf !=''
												";
					  if (!($r_upd= mysql_query($sql, $conexion_mysql)))
							{
							
							  //.....................................................................
							  // informa del error producido
							  $cuerpo1  = "al intentar buscar beneficiario";
							  echo $cuerpo1;
							  //.....................................................................
							} 					
											
		 }
		 else
		 {*/
			 echo 'paso';
			echo $sql = "update sicore set numero='$nro',neto='$neto',regimen830_id='$reg' WHERE op_saf='$op_v'
		                                        AND   fecha_io='$fecha_io'
                                                AND numero=''
												";
					  if (!($r_upd= mysql_query($sql, $conexion_mysql)))
							{
							
							  //.....................................................................
							  // informa del error producido
							  $cuerpo1  = "al intentar buscar beneficiario";
							  echo $cuerpo1;
							  //.....................................................................
							}   
			 
		// }
		 
		//   echo $fecha_io;
		  // echo '<br>';
	     echo '<br>';
		   echo $op_v;
		   echo '<br>';
	    
		   echo $nro;
		   echo '<br>';
	   

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