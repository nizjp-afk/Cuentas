<?php
 
  /////////////////CONEXION DB///////////////////
   include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
       
//////////////////////////////////////////////////
  // busca los permisos del usuario para la aplicacion especificada
  $ssql = "SELECT permisospart FROM permisos 
           WHERE usuarios_userid = '$usuario' AND aplicaciones_cod = '$aplicacion'";
  if (!($resultado = mysqli_query($conexion_mysql ,  $ssql )))
    {
      //.....................................................................
      // informa del error producido
	  /*$cuerpo1  = "al intentar seleccionar el registro y encontrar los permisos";
      $cuerpo2  = "Base de datos                 = ".$basedatos.$emaillinea;
      $cuerpo2 .= "Sentencia sql                 = ".$ssql.$emaillinea;
      $asunto   = "[Error 3]";
      include('2-validar_u_c-error-a.php');
	  include('2-validar_u_c-error-b.php');*/
	  echo "ERROR EN LECTURA DE TBL USUARIOS";exit;
      //.....................................................................
    }
  // Determino si tiene o no permisos
  $permisos = "";
  if (mysqli_num_rows($resultado) != 0)
    {
      $fila = mysqli_fetch_array($resultado);
      $permisos = $fila['permisospart'];
    }
?>