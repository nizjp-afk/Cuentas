<?php 
   error_reporting (E_ERROR); 
$aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
	 include('incluir_siempre.php');
	
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	
    $fecha_r=date('Y-m-d');
	$bandera=0;
	$observacion=$_POST['observ'];
	$obser_1=$_POST['obser_1'];	
	$estado = $_POST['estado'];
	$cuit_bene = $_POST['cuit'];
	$mono = $_POST['mono'];
	$ganancia = $_POST['ganancia'];
	$seguridad = $_POST['seguridad'];
	$monto_ss = $_POST['retencionss'];
	$monto_ib = $_POST['retencionib'];
	$ss = $_POST['ss'];
	$fecha_t=$_POST['fecha_t'];

	$neto_ss = $_POST['imponibless'];
	$neto = $_POST['neto'];
	 $neto_ib = $_POST['imponibleib'];
    $alicuota = $_POST['alicuotaib'];
	$bruto = $_POST['monto'];
	
	if($ganancia==4)
	  {
		  if(($mono=='S') and ($neto >400000.00))
		    {
				$bandera=1;
			}
		elseif(($mono=='V') and ($neto >600000.00))
		   {
			   $bandera=1;
		   }
	     	   
		else
		   {
			   $bandera=0;
		   }	 
		   
	  }
	if($ganancia==1 or $ganancia==2)
	   {
		   $bandera=1;
	   }
	
    $orden = $_POST['orden']; 
	$saf = $_POST['saf']; 
    $ejercicio = $_POST['ejercicio'];
    $monto = $_POST['retencion'];

     $r830 = $_POST['rgh'];
	 $fecha_io = $_POST['firstinput'];
	 
	
	  if(($ss=='N') and ($seguridad==1) )
	
	  {
		  ?>
                   <center><h1>Error!</h1></center>
                        <meta http-equiv='refresh' content='80;url=javascript:window.history.back()'>
                        <center><img src="img/messagebox_critical.png" width="128" height="128" />
                        <p>Se ha detectado un error.
                        Ud. no  Selecciono  <b> Regimen de Seguridad Social.</code>
                        <code>Espere unos segundos el Sistema se redirigir&aacute; automaticamente.
                        O haga click <a href='javascript:window.history.back()'>aqu&iacute;</a>.</code>	  
                
				<?php  
				exit;  
		  
	  }
	 
	 if(empty ($mono) and $ganancia==4 )
	
	  {
		  ?>
                   <center><h1>Error!</h1></center>
                        <meta http-equiv='refresh' content='80;url=javascript:window.history.back()'>
                        <center><img src="img/messagebox_critical.png" width="128" height="128" />
                        <p>Se ha detectado un error.
                        Ud. no  Selecciono  <b> concepto de Facturacion.</code>
                        <code>Espere unos segundos el Sistema se redirigir&aacute; automaticamente.
                        O haga click <a href='javascript:window.history.back()'>aqu&iacute;</a>.</code>	  
                
				<?php  
				exit;  
		  
	  }

	if(empty ($fecha_io) and ($estado=='N'))
	
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
	  
	 if($fecha_io > $fecha_t)
	
	  {
		  ?>
                   <center><h1>Error!</h1></center>
                        <meta http-equiv='refresh' content='80;url=javascript:window.history.back()'>
                        <center><img src="img/messagebox_critical.png" width="128" height="128" />
                        <p>Se ha detectado un error.
                        Datos incorrecto en la fecha de Inicio de Orden   <b> Fecha de orden de Pago.</code>
                        <code>Espere unos segundos el Sistema se redirigir&aacute; automaticamente.
                        O haga click <a href='javascript:window.history.back()'>aqu&iacute;</a>.</code>	  
                
				<?php  
				exit;  
		  
	  }
	   
	
	  if(empty ($r830) and ($bandera==1) )
	
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
	
	$dato_h=$fecha_r.': Orden Visada -'.$observacion;
/////////////////Estado de la Orden///////////////////////////////////////
	

$sql="update op_pendientes set estado='$estado',tgp='M'
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
if($estado=='B'){$est='A';}
	if($estado=='R'){$est='B';}	
		if($estado=='N'){$est='P';}	
///////////////////////////////////////////////////////////
 if($estado=='R' or $estado=='B')
   {
 
 $ssql = "SELECT * FROM num_nota_ret" ;
     if (!($r_num= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar garantia";
     
      //.....................................................................
    }
	
	$f_num = mysql_fetch_array ($r_num);
	
	$numero=$f_num['numero'];     
	
	
	 $sql="INSERT INTO nota_retencion (orden,saf,numero,observacion,fecha,accion)
        VALUES('$orden','$saf','$numero','$observacion','$fecha_r','$est')";

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
		
		
		
		
 $consulta = "UPDATE num_nota_ret SET numero = numero+1"; 
    if (!($r_remito = mysql_query($consulta, $conexion_mysql)))
    {
      //.....................................................................
      // INFORMA  DE ERROR PRODUCIDO//
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar sumar remito";
           
      echo $cuerpo1;
      exit;
      //.....................................................................
      //.....................................................................
    }		
	
		
		
 
 
 }
 
 
 
 
   
/* if ($estado=='N') 
    {
		$observacion='Orden Visada ';
	}

		*/
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
     $dato=$obser_1.'\r\n'.$fecha_r.': Orden Visada -'.$observacion;
     
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
    $dato_h=$fecha_r.': Orden Visada -'.$observacion;
	
///////////////////antecedente
   $sql="INSERT INTO historial_orden (ejercicio,numero_op,saf,observacion)
        VALUES('$ejercicio','$orden','$saf','$dato_h')";

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

 if ($estado=='N') 
{
$ssql = "SELECT * FROM sicore where ejercicio='$ejercicio' AND  saf='$saf' AND orden='$orden' ";
     if (!($r_sicore= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }  
	
	$cant = mysql_num_rows($r_sicore);
	
	if($cant > 0)
	
		{
		  $sql="UPDATE sicore SET monto='$monto',
		                          fecha_io='$fecha_io',
								  regimen830_id='$r830',
								  neto='$neto'
                where ejercicio='$ejercicio'
				AND  saf='$saf'
				AND orden='$orden' ";

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
	else
     	{
			
			
			
		

 $sql="INSERT INTO sicore (ejercicio,orden,saf,monto,fecha_io,regimen830_id,neto)
        VALUES('$ejercicio','$orden','$saf','$monto','$fecha_io','$r830','$neto')";

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
		
if (!($ss=='N'))
  {
		 
		 $ssql = "SELECT * FROM sicore_ss where ejercicio='$ejercicio' AND  saf='$saf' AND orden='$orden' ";
     if (!($r_sicore_ss= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }  
	
	$cant_ss = mysql_num_rows($r_sicore_ss);
	
	if($cant_ss > 0)
	
		{
		  $sql="UPDATE sicore_ss SET monto='$monto_ss',
		                          fecha_io='$fecha_io',
								  ss_id='$ss',
								  neto='$neto_ss'
                where ejercicio='$ejercicio'
				AND  saf='$saf'
				AND orden='$orden' ";

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
		else
		{ 
		 
$sql="INSERT INTO sicore_ss (ejercicio,orden,saf,monto,fecha_io,ss_id,neto)
        VALUES('$ejercicio','$orden','$saf','$monto_ss','$fecha_io','$ss','$neto_ss')";

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
  }
  
  
  $ssql = "SELECT * FROM sicore_ib where ejercicio='$ejercicio' AND  saf='$saf' AND orden='$orden' ";
     if (!($r_sicore_ib= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }  
	
	$cant = mysql_num_rows($r_sicore_ib);
	
	if($cant > 0)
	
		{
		  $sql="UPDATE sicore_ib SET bruto='$bruto',
		                             monto='$monto_ib',
		                          fecha_io='$fecha_io',
								   neto='$neto_ib',
								   alicuota='$alicuota'
                where ejercicio='$ejercicio'
				AND  saf='$saf'
				AND orden='$orden' ";

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
	else
     	{
			
			
			
		

 $sql="INSERT INTO sicore_ib (ejercicio,orden,saf,monto,fecha_io,alicuota,bruto,neto)
        VALUES('$ejercicio','$orden','$saf','$monto_ib','$fecha_io','$alicuota','$bruto','$neto_ib')";

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
 
}

  $accion='Cambio Estado OP'.': '.$orden.' ,'.'estado'.' = '.$est;
		  $tabla='orden_pago'.' - '.'op_pendientes';
		  include('agrego_movi.php'); 


?>
<?php
  if($estado=='N')
    {
?>
<meta http-equiv='refresh' content='3;url=indextesoreria.php?sec=retenciones/carga_orden&apli=cr&per=R'> 
	 
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
 
 <?php 	}
	else
	{
?>
<meta  http-equiv='refresh' content='5;url=indextesoreria.php?sec=retenciones/carga_orden&apli=cr&per=R'> 
	 
	<table width="60%" border="0" align="left">
     <tr>
     <td align="center">
	 <p class="Estilo2 style1 Estilo1"><img src="img/loader_guardando.gif" width="100" height="100" /></p>
      <p class="Estilo2 style1">
<code>Si desea Imprimir, <b>Por favor</b> haga click 
<a target="_blank"  href='retenciones/imprimir_nota_e.php?apli=cr&per=R&id=<?php echo $numero; ?>'>aqu&iacute;</a>.</code>
<code>O haga click <a href='indextesoreria.php?sec=retenciones/carga_orden&apli=cr&per=R'>aqu&iacute;</a> para regresar.</code>
	  <br><br>
      Gracias
	  </font>
	  </p>
	  </td>
     </tr>
   </table>


<?php
	}
?>	 