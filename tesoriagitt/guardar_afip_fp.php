<?php 
   
	
   include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	
    $fecha_r=date('Y-m-d');
	
	$observacion=$_POST['observ'];
	$obser_1=$_POST['obser_1'];	
	$estado = $_POST['estado'];

    $orden = $_POST['orden']; 
	$saf = $_POST['saf']; 
    $ejercicio = $_POST['ejercicio'];
     $monto = $_POST['retencion'];

      $r830 = $_POST['rgh'];
	 $fecha_io = $_POST['firstinput'];

	if(empty ($fecha_io) and $estado=='N' )
	
	  {
		  ?>
                   <center><h1>Error!</h1></center>
                        <meta http-equiv='refresh' content='80;url=javascript:window.history.back()'>
                        <center><img src="img/messagebox_critical.png" width="128" height="128" />
                        <p>Se ha detectado un error.
                        Ud. no  ingreso   <b> Fecha de orden de Pago.</code>
                        <code>Espere unos segundos el Sistema se redirigir&aacute; automaticamente.
                        O haga click <a href='javascript:window.history.back()'>aqu&iacute;</a>.</code>	  
                
				<?php  
				exit;  
		  
	  }
	  
	  
	  if(empty ($r830) and $estado=='N' )
	
	  {
		  ?>
                   <center><h1>Error!</h1></center>
                        <meta http-equiv='refresh' content='80;url=javascript:window.history.back()'>
                        <center><img src="img/messagebox_critical.png" width="128" height="128" />
                        <p>Se ha detectado un error.
                        Ud. no  ingreso   <b> Codigo de Regimen de Ganancias.</code>
                        <code>Espere unos segundos el Sistema se redirigir&aacute; automaticamente.
                        O haga click <a href='javascript:window.history.back()'>aqu&iacute;</a>.</code>	  
                
				<?php  
				exit;  
		  
	  }
	
	////////////////////////////
	
	$dato_h=$fecha_r.':'.$observacion;
/////////////////Estado de la Orden///////////////////////////////////////
	
if (!($estado=='N'))
    {
$sql="update op_pendientes_fp_r set estado='$estado' 
			            where numero_op='$orden'
						and ejercicio='$ejercicio'
						and saf='$saf'";

       if (!($r_obser = mysql_query($sql, $conexion_mysql)))
         {
            //.....................................................................
            // INFORMA  DE ERROR PRODUCIDO//
            $cuerpo1  = "al intentar insertar select";
            $cuerpo2  = "Base de datos                 = ".$mysql_basededatos.$emaillinea;
            $cuerpo2 .= "Sentencia sql                 = ".$ssql.$emaillinea;
           echo $cuerpo1;
            exit;
            //.....................................................................
         }  
	}
///////////////////////////////////////////////////////////
 
   
 if ($estado=='N') 
    {
		$observacion='Orden Visada ';
	}

		
$sql="SELECT * FROM historial_orden
			            where numero_op='$orden'
						and ejercicio='$ejercicio'
						and saf='$saf'";

       if (!($r_obser = mysql_query($sql, $conexion_mysql)))
         {
            //.....................................................................
            // INFORMA  DE ERROR PRODUCIDO//
            $cuerpo1  = "al intentar insertar select";
            $cuerpo2  = "Base de datos                 = ".$mysql_basededatos.$emaillinea;
            $cuerpo2 .= "Sentencia sql                 = ".$ssql.$emaillinea;
           echo $cuerpo1;
            exit;
            //.....................................................................
         }  
 
$cant= mysql_num_rows($r_obser);
if ($cant >0)
   {
     $dato=$obser_1.'\r\n'.$fecha_r.':'.$observacion;
     
     $sql="UPDATE historial_orden SET observacion ='$dato'  where numero_op='$orden'
						and ejercicio='$ejercicio'
						and saf='$saf'";

       if (!($r_ef = mysql_query($sql, $conexion_mysql)))
         {
            //.....................................................................
            // INFORMA  DE ERROR PRODUCIDO//
            $cuerpo1  = "al intentar insertar update";
            $cuerpo2  = "Base de datos                 = ".$mysql_basededatos.$emaillinea;
            $cuerpo2 .= "Sentencia sql                 = ".$ssql.$emaillinea;
           echo $cuerpo1;
            exit;
            //.....................................................................
         }  
 }
 else
  {
    $dato=$fecha_r.':'.$observacion;
///////////////////antecedente
   $sql="INSERT INTO historial_orden (ejercicio,numero_op,saf,observacion)
        VALUES('$ejercicio','$orden','$saf','$dato')";

       if (!($r_ef = mysql_query($sql, $conexion_mysql)))
         {
            //.....................................................................
            // INFORMA  DE ERROR PRODUCIDO//
            $cuerpo1  = "al intentar insertar historial";
            $cuerpo2  = "Base de datos                 = ".$mysql_basededatos.$emaillinea;
            $cuerpo2 .= "Sentencia sql                 = ".$ssql.$emaillinea;
           echo $cuerpo1;
            exit;
            //.....................................................................
         }  

}    


 $sql="INSERT INTO sicore (ejercicio,orden,saf,monto,fecha_io,regimen830_id)
        VALUES('$ejercicio','$orden','$saf','$monto','$fecha_io','$r830')";

       if (!($r_ef = mysql_query($sql, $conexion_mysql)))
         {
            //.....................................................................
            // INFORMA  DE ERROR PRODUCIDO//
            $cuerpo1  = "al intentar insertar historial";
            $cuerpo2  = "Base de datos                 = ".$mysql_basededatos.$emaillinea;
            $cuerpo2 .= "Sentencia sql                 = ".$ssql.$emaillinea;
           echo $cuerpo1;
            exit;
            //.....................................................................
         }    
	
?>
<meta http-equiv='refresh' content='3;url=indextesoreria.php?sec=retenciones/carga_orden&apli=tgpa&per=A'> 
	 
	<table width="60%" border="0" align="left">
     <tr>
     <td align="center">
	 <p class="Estilo2 style1 Estilo1"><img src="img/loader_guardando.gif" width="100" height="100" /></p>
      <p class="Estilo2 style1">
	  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Espere unos segundos el Sistema se Redirigir&aacute; automaticamente
	  <br><br>
      Gracias
	  </font>
	  </p>
	  </td>
     </tr>
   </table>