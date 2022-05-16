<?php
  //-----------------------------------------------------------------------
  // Valida si el usuario existe y si la contrase�a corresponde.  Detecta
  // si se encuentra bloqueado y adem�s busca el nombre completo y fecha
  // de nacimiento del usuario.
  // REQUIERE:
  //           * $usuario (le�do de la sesi�n)
  //           * $contrasena (le�do de la sesi�n)
  //           * $usuarioqueintenta (le�do de la sesi�n)
  //           * $equivocacion (le�do de la sesi�n)
  // ESTABLECE:
  //           * $error
  //           * $usuarioqueintenta
  //           * $equivocacion
  //           * $bloqueo
  //           * $bloqueofecha
  //           * $nombre
  //           * $fechanac
  //-----------------------------------------------------------------------
  // establece la variable que usar� el header() para regresar en caso de error
  $regresar = "/sigcom";
  if ((isset($_SERVER['HTTP_REFERER'])) and ($_SERVER['HTTP_REFERER'] != ""))
    {
      $regresar = $_SERVER['HTTP_REFERER'];
    }
  $bandera = 0;
  // establece las variables que se usar�n en el mail en caso de error
  $emaillinea = chr(13).chr(10);
  $emailadmin = "alobos@gmail.com";
  $emailaplic = "sigcom - 2-validar_u_c.php";
  // conecta al servidor
/////////////////CONEXION DB///////////////////
     include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
//////////////////////////////////////////////////
  // busca si el usuario indicado existe

  $ssql = "SELECT * FROM usuarios WHERE userid = '$usuario'";
  if (!($resultado = mysqli_query($conexion_mysql,$ssql)))
    {
      //.....................................................................
      // informa del error producido
      /*$cuerpo1  = "al intentar seleccionar el registro";
      $cuerpo2  = "Base de datos                 = ".$basedatos.$emaillinea;
      $cuerpo2 .= "Sentencia sql                 = ".$ssql.$emaillinea;
      $asunto   = "[Error 3]";  
      include('2-validar_u_c-error-a.php');
      include('2-validar_u_c-error-b.php');*/
	  echo "ERROR EN LECTURA DE TBL USUARIOS";exit;
      //.....................................................................
    }
  // La variable $error ser� usada para indicar que tipo de error se
  // produjo y poder ser utilizada en el programa que incluy� a �ste.

  if (mysqli_num_rows($resultado) == 0)
    {
      // no encontr� ningun usuario coincidente
      $error = 1;
    }
  else
    {
      $fila = mysqli_fetch_array($resultado);
      $bloqueo = $fila['bloqueo'];
      $bloqueofecha = "";
      // determina si el usuario se encuentra bloqueado
      if ($bloqueo != 0)
        {
          // usuario bloqueado
          $error = 2;
          $bloqueofechaaux = $fila['bloqueofecha'];  // date('Y-m-d H:i:s') --> 2004-01-24 20:01:39
          $bloqueofecha  = substr($bloqueofechaaux, 8, 2)."-".substr($bloqueofechaaux, 5, 2)."-";
          $bloqueofecha .= substr($bloqueofechaaux, 0, 4)." ".substr($bloqueofechaaux, 11,8);
        }
      else
        {

        // determina si se ingres� incorrectamente la contrase�a
          if ($fila['encriptado'] != $contrasena)
            {
              if ($usuarioqueintenta == $usuario)
                {
                  $equivocacion ++;
                }
              else
                {
                  $usuarioqueintenta = $usuario;
                  $equivocacion = 1;
                }
              // si contabiliza el tercer intento fallido, bloquea al usuario
              if ($equivocacion < 3)
                {
                  // contrase�a incorrecta
                  $error = 1;
                }
              else
                {
                  $bloqueofecha = date('Y-m-d H:i:s');     // date('Y-m-d H:i:s') --> 2004-01-24 20:01:39
                  $ssql = "UPDATE usuarios SET bloqueo = 1, bloqueoip = '".$_SERVER['REMOTE_ADDR']."', 
                           bloqueofecha = '$bloqueofecha' WHERE userid = '$usuario'";
                  if (!($resultado = mysqli_query($conexion_mysql,$ssql)))
                    {
                      //.....................................................................
                      // informa del error producido
                      /*$cuerpo1  = "al intentar bloquear al usuario despues de sus intentos err�neos";
                      $cuerpo2  = "Base de datos                 = ".$basedatos.$emaillinea;
                      $cuerpo2 .= "Sentencia sql                 = ".$ssql.$emaillinea;
                      $asunto   = "[Error 4]";
                      include('2-validar_u_c-error-a.php');
                      include('2-validar_u_c-error-b.php');*/
   	                  echo "ERROR EN ACTUALIZAR USUARIOS";exit;
					  //.....................................................................
                    }
                  $error = 2;
                  $bandera = 1;
                }
            }
          else
            {
              // usuario y clave correctos
              $error = 0;
              // busca en la tabla de personas el nombre del usuario y su fecha de nacimiento
              $nombre = " *** NO DEFINIDO *** ";
              $fechanac = "";
              $personas_docnro = $fila['personas_docnro'];
 
              $ssql = "SELECT * FROM personas WHERE docnro = '$personas_docnro'";
              if (!($resultado = mysqli_query($conexion_mysql,$ssql)))
                {
                  //.....................................................................
                  // informa del error producido
                  /*$cuerpo1  = "al buscar el apellido y nombre en el archivo de personas";
                  $cuerpo2  = "Base de datos                 = ".$basedatos.$emaillinea;
                  $cuerpo2 .= "Tipo de documento             = ".$personas_doctipo.$emaillinea;
                  $cuerpo2 .= "N�mero de documento           = ".$personas_docnro.$emaillinea;
                  $cuerpo2 .= "Subn�mero de documento        = ".$personas_docsubnro.$emaillinea;
                  $cuerpo2 .= "Sentencia sql                 = ".$ssql.$emaillinea;
                  $asunto   = '[Error 5]';
                  include('2-validar_u_c-error-a.php');
                  $bandera = 1;*/
                  echo "ERROR EN LECTURA DE TBL PERSONAS";exit;
                  //.....................................................................
                }

              if (mysqli_num_rows($resultado) != 0)
                {
                  $fila = mysqli_fetch_array($resultado);
                  $cuil = $fila['docnro'];
				          $saf_dir = $fila['saf_id'];
				          $nrosaf = $fila['saf'];
				          $sub_nrosaf = $fila['sub_saf'];
                  $nombre = trim($fila['nombre'])." ".trim($fila['apellido']);
				          $razon = $fila['razon_social'];
				  
                  $fechanac = $fila['fechanac'];
                  $fechanac = substr($fechanac, 8, 2)."-".substr($fechanac, 5, 2)."-".substr($fechanac, 0, 4);
                }
            }
        }
    }
  if ($bandera == 0)
    {
      mysqli_free_result($resultado);
    }
  mysqli_close($conexion_mysql);
?>