<?php
 error_reporting ( E_ERROR );
//conexion
	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');

    $id = $_GET['id'];
	
	
	
	$ssql = "UPDATE beneficiarios_aprobados SET valor_e='A' where id_beneficiario='$id' ";
					 if (!($r_cb= mysql_query($ssql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}
		 
		?>						  
 <meta http-equiv='refresh' 
 content='0;url=indextesoreria.php?sec=tesoreria/beneficiarios_consulta_estado_a&apli=tgpai&per=A'/>	 </meta>              
       

