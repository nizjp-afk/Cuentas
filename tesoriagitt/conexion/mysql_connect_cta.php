<?php
  // conecta al servidor
  if (!($conexion_mysql = mysqli_connect($conexion_mysql_host, $conexion_mysql_usuario, $conexion_mysql_contrasena)))
    {
      //.....................................................................
      // informa del error producido
      
      $cuerpo1  = "al intentar conectar al servidor con los parametros:";
      $cuerpo2  = "";
      $asunto   = "[MYSQL-Error 1]";
    
      //.....................................................................
    }
?>