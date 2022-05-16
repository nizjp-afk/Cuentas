<?php
  // selecciona la base de datos
  if (!mysqli_select_db($mysql_basededatos, $conexion_mysql))
    {
      //.....................................................................
      // informa del error producido
      
      $cuerpo1  = "al intentar seleccionar la base de datos";
      $cuerpo2  = "Base de datos                 = ".$mysql_basededatos.$emaillinea;
      $asunto   = "[MYSQL-Error 2]";
      
      //.....................................................................
    }
?>
