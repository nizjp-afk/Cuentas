<?php 
 include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    
	$ssql = "INSERT INTO `movimiento` ( `usuario` , `accion` ,`cuitl` , `tabla` , `fecha`)
          VALUES ('$usuario', '$accion','$cuitl','$tabla', NOW())";
  
 if (!($r_mov = mysqli_query($conexion_mysql,$ssql)))
     {
      
      //.....................................................................
      // informa del error producido
           echo "ERROR EN INSERTAR EN TABLA MOVIMIENTO";
           exit;
      //.....................................................................
     }
  
?>
