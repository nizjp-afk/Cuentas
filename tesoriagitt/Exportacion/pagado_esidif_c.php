<?php
//error_reporting ( E_ERROR );


    $archivo = file("ret_pagado.txt");
  echo  $cuantos = count($archivo);
	
    for ($var=0;$var<$cuantos;$var++)
	{
				
	    $linea=  explode("\t",$archivo[$var]);
		
	
		
	 	
		 echo $ejercicio= trim($linea[2]);echo "<br>";
		 
		 echo $saf= trim($linea[0]);echo "<br>";
	
		 $tipo= trim($linea[3]);echo "<br>";
		 
		if(($tipo =='C41') or ($tipo=='C42'))
		  {
			$tipo=substr($tipo,1,3);   
		  }
		 
		 $nro_op= trim($linea[4]);
		echo $orden_pago=$tipo.'-'.$saf.'-'.$nro_op;echo "<br>";
		echo $fecha_p= trim($linea[1]);echo "<br>";
		
		$fecha_pp=split("/",$fecha_p);
	 	echo $fecha=$fecha_pp[2].'-'.$fecha_pp[1].'-'.$fecha_pp[0];echo "<br>";	
		
	
		
		echo $total_f= trim($linea[6]);echo "<br>";	
		echo $total=number_format($total_f,2, '.', '');
		
		echo $total_f1= trim($linea[5]);echo "<br>";	
		echo $total_b=number_format($total_f1,2, '.', '');
	
			 
			 
			 echo $clave=$ejercicio.''.$saf.''.$tipo.''.$nro_op;
		
		if($total> 0)	
		  { 
             include('dgti-mysql-var_dbtgp.php');
	         include('dgti-intranet-mysql_connect.php');  
	         include('dgti-intranet-mysql_select_db.php');
			 
			 
	 $ssql = "update `pagos_web` set  `IMP_PAGO_RET`='$total' where clave_OP='$clave' and `FECHA_DE_PAGO`='$fecha' ";
 				 
				  
     	 if (!($r_pago= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar ordenes para pago tgp";
			  echo $cuerpo1;
			  //.....................................................................
			} 



    echo $ssql = "update `orden_pago` set  `RETENCION`= RETENCION +'$total',importe_a_pagar=IMPORTE_A_PAGAR-'$total' where CLAVE='$clave' and estado!='C' ";
 				 
				  
     	 if (!($r_pago_r= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar ordenes para pago tgp";
			  echo $cuerpo1;
			  //.....................................................................
			} 
			
	echo $ssql = "update `orden_pago` set  `RETENCION`= RETENCION +'$total' where CLAVE='$clave' and estado='C' ";
 				 
				  
     	 if (!($r_pago_r= mysql_query($ssql, $conexion_mysql)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar ordenes para pago tgp";
			  echo $cuerpo1;
			  //.....................................................................
			}		


		
		  }
			
		echo "<br>";
		
		
		
		include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	
	
	 $sql = "update sicore_ib set bruto= '$total_b',neto= '$total_b' where orden='$orden_pago' and ejercicio='$ejercicio' and  saf='$saf' and `fecha_io`='$fecha'  ";
	  	  
			if (!($r_control= mysql_query($sql, $conexion_mysql)))
			{
			  //..informa del error producido...................
			  $cuerpo1  = "al buscar saf1";
			  echo $cuerpo1;
			  //...............................................
			} 
			
	 $sql = "update sicore_ss set neto= '$total_b' where orden='$orden_pago' and ejercicio='$ejercicio' and  saf='$saf'  and `fecha_io`='$fecha' ";
	  	  
			if (!($r_control= mysql_query($sql, $conexion_mysql)))
			{
			  //..informa del error producido...................
			  $cuerpo1  = "al buscar saf1";
			  echo $cuerpo1;
			  //...............................................
			} 		
	
		
		 include('dgti-mysql-var_dbtgp.php');
	         include('dgti-intranet-mysql_connect.php');  
	         include('dgti-intranet-mysql_select_db.php');
			
					
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