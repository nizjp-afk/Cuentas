<?php
  //-----------------------------------------------------------------------
  // Obtiene los permisos de acceso para el usuario, en la aplicaci�n
  // especificada en el programa que llama a �ste
  // REQUIERE:
  //   * $aplicacion (establecido en el script anterior que llama a a �ste)
  //   * $usuario (lo lee de la sesi�n)
  //   * $contrasena (lo lee de la sesi�n)
  // OTROS DATOS DE LA SESION:
  //   * $error (siempre en cero)
  //   * $nombre
  //   * $fechanac
  //   * $tiempo
  // ESTABLECE:
  //   * $permisos
  //-----------------------------------------------------------------------
  $regresar = "/sigcom/index.php";
  // establece la variable que usar� el header() para regresar en caso de error
  if ((isset($_SERVER['HTTP_REFERER'])) and ($_SERVER['HTTP_REFERER'] != ""))
  {
    $regresar = $_SERVER['HTTP_REFERER'];
  }
  //session_name('valido');
  //session_start();
  if ((!isset($_SESSION['vps_usuario'])) or (!isset($_SESSION['vps_contrasena'])))
  {
    // usuario y/o clave en blanco
    session_unset();
    $_SESSION['vps_regresar'] = $regresar;
    header('location: ../mensaje_forzar_login.php');
    exit;
  } else {
    // verifica si el usuario no super� su tiempo m�ximo de inactividad
   $ahora = time();
   $limite = $ahora - 30 * 120;
    if ($_SESSION['vps_tiempo'] < $limite )
    {
      session_unset();
      $_SESSION['vps_regresar'] = $regresar;
      header('location: ../mensaje_tiempo_excedido.php');
      exit;
    } else {
      $_SESSION['vps_tiempo'] = $ahora;
    }

    // comprueba si la contrase�a es correcta y si no est� bloqueado
    $usuario = $_SESSION['vps_usuario'];
    $contrasena = $_SESSION['vps_contrasena'];
    include('2-validar_u_c.php');
    if ($error != 0)
    {
      // cuando $error es 1 (contrase�a incorrecta) � 2 (usuario bloqueado)
      session_unset();
      $_SESSION['vps_regresar'] = $regresar;
      header('location: ../mensaje_forzar_login.php');
      exit;
    } else {
      // usuario y contrase�a correctos.  Busca los permisos.
      include('4-verifica_permisos.php');
      if (!isset($permisosnecesarios))
      {
        $permisosnecesarios = "";
      }
      $senial = 0;
      for ($i=0; $i<strlen($permisosnecesarios); $i++)
      {
        if (ereg(substr($permisosnecesarios, $i, 1), $permisos))
        {
          $senial = 1;
        }
      }
      if ($permisos == "" or $senial == 0)
      {
        // sin premisos para ingresar a la aplicacion
        $_SESSION['vps_regresar'] = $regresar;
		?> 
       <table width="450" border="0" align="center" cellpadding="5" cellspacing="1">
    <tr>
      
    <td height="173" align="center" ><blockquote>
   
    </blockquote>      <p class="Estilo1"><img src="img/atencion.png" width="128" height="128"></p>
    <p ><font color="#FF0000" size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong>&iexcl;&iexcl; ATENCION !!</strong><br>
          Ud. 
            no posee autorizaci&oacute;n para<br>
            hacer uso de esta opci&oacute;n...</font></p>
    <p><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        Solic&iacute;tela al personal <br>
      <strong>Responsable del Sistema </strong></font></p>
      <p><font color="#FF0000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo '<a style="color:#FF0000 href="'.$regresar.'">' ?>Elija 
        esta opci&oacute;n<?php echo "</a>" ?> si la pantalla no cambia autom&aacute;ticamente<br>
        <br>
      </font></p>
      </td>
    </tr>
  </table>
  <?php
        exit;
      }
    }
    // registra en un archivo los usuarios activos y elimina los inactivos
    //include('3-registrar_usuarios_activos.php');
    $nombre = $_SESSION['vps_nombre'];
  }
?>