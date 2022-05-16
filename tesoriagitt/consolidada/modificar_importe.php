<?php
 error_reporting ( E_ERROR );
//conexion
	include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');

    $cantidad=$_POST['cantidad'];
	$saf=$_POST['saf'];
	$cant=$cantidad+1;
	$fecha_cons=$_GET['consul'];
	for ($l=1; $l<$cant; $l++)
        {
		 $valor[$l]=$_POST[i.$l];
		 $saldo[$l]=$_POST[s.$l];
        if (!($valor[$l]==''))
		  {		
		   $importe=$valor[$l];
		   $total=$saldo[$l];
		   if (($importe < $total) or ($importe == $total))
			   {
				
				   $sql = "UPDATE op_pendiente_tmp_saf SET autorizado='$importe' 
				    WHERE id = '$l'";
				   if (!$r_OP= mysql_query($sql,$conexion_mysql))
					{
					 echo "ERROR EN modificar Saldo op";
					 exit;
					}
			   }
			 else
			  {
				?>
                   <center><h1>Error!</h1></center>
                        <meta http-equiv='refresh' content='80;url=javascript:window.history.back()'>
                        <center><img src="../img/messagebox_critical.png" width="128" height="128" />
                        <p>Se ha detectado un error.
                        Ud. a ingresado un  <b> Importe Incorecto.</code>
                        <code>Espere unos segundos el Sistema se redirigir&aacute; automaticamente.
                        O haga click <a href='javascript:window.history.back()'>aqu&iacute;</a>.</code>	  
                
				<?php  
				exit;  
			  }
		  }
		  
		}

		?>						  
 <meta http-equiv='refresh' 
 content='0;url=../indextesoreria.php?sec=consolidada/modificar_orden_consolidada&apli=s&per=A&saf=<?php echo $saf; ?> '/>	 </meta>              
       

