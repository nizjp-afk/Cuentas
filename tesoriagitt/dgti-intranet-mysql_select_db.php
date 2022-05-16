<?php
  // selecciona la base de datos
  if (!mysqli_select_db($conexion_mysql,$mysql_basededatos))
    {
      //.....................................................................
      // informa del error producido
      
      $cuerpo1  = "al intentar seleccionar la base de datos";
      $cuerpo2  = "Base de datos                 = ".$mysql_basededatos.$emaillinea;
      $asunto   = "[MYSQL-Error 2]";
      
      //.....................................................................
    }
?>
