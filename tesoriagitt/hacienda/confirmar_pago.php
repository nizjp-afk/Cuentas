<?php
 error_reporting ( E_ERROR );
//conexion
	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');

    $id = $_GET['id'];
	$nom = $_GET['nomb'];
	$fecha_cons=$_GET['consul'];	
	
	/////traer el nro de ti
	
	$ssql = "SELECT * FROM `control_fecha`";
     if (!($r_cf= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }	
	
	$f_cf=mysql_fetch_array($r_cf);
	$nro =$f_cf['nro_ti'];
	////////
	 $ssql = "SELECT * FROM op_pendientes where id='$id' ";
     if (!($r_op= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
	 
	 $f_orden=mysql_fetch_array($r_op);
	
	$Ejercicio=     $f_orden['Ejercicio'];
	$Fecha_OP =     $f_orden['Fecha_OP'];
	$Numero_OP =    $f_orden['Numero_OP'];
	$Numero_Int =   $f_orden['Numero_Int'];
	$Saf =          $f_orden['Saf'];
	$cuit_b =       $f_orden['cuit'];
	$Fuente =       $f_orden['Fuente'];
    $Clase =        $f_orden['Clase'];
	$Beneficiario = $f_orden['Beneficiario'];
	$Concepto =     $f_orden['Concepto'];
	$Imp_orden =    $f_orden['Imp_orden'];
	$Total_Pagado = $f_orden['Total_Pagado'];
	$Saldos =       $f_orden['Saldos'];
	$autorizado =   $f_orden['Saldos'];
	$estado =   $f_orden['estado'];
	$tgp =   $f_orden['tgp'];

   	///insertar en base Sigcom tabla op_pendiente_tmp
		 
		  $ssql = "INSERT INTO `op_pendiente_tmp`
		              ( `Ejercicio` , `Fecha_OP` , `Numero_OP` , `Numero_Int` , `Saf` , `Fuente` ,
					   `Clase` , `Beneficiario` ,`cuit`, `Concepto` , `Imp_orden` , `Total_Pagado` ,
					   `Saldos`,`autorizado`,`nro_ti`,`estado`,tgp)
				   VALUES ('$Ejercicio' , '$Fecha_OP' , '$Numero_OP' , '$Numero_Int' , '$Saf' , 
						   '$Fuente' ,'$Clase' , '$Beneficiario','$cuit_b' , '$Concepto' , '$Imp_orden' ,
						   '$Total_Pagado' ,'$Saldos','$autorizado','$nro','$estado','$tgp')";
				 if (!($r_orden= mysql_query($ssql, $conexion_mysql)))
				{
				
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar insertar orden pendiente";
				  echo $cuerpo1;
				  echo $orden_pago;
				   echo $ejercicio;
				  //.....................................................................
				}    
			
		$ssql = "DELETE FROM op_pendientes where id='$id' ";
     if (!($r_op= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }	
	
		
		?>						  
 <meta http-equiv='refresh' 
 content='0;url=indextesoreria.php?sec=hacienda/cargar_orden_pendientes_2009&consul=<?php echo $fecha_cons; ?>&apli=h&per=A&busnom=<?php echo $nom; ?> '/>	 </meta>              
       

