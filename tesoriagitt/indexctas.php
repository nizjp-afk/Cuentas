<?php
    include('conexion/extras.php');
	
	 // session_cache_limiter('nocache,private'); // � private_no_expire en php.ini
  session_name('valido');
  session_start();

  if(!function_exists('ereg'))            { function ereg($pattern, $subject, &$matches = []) { return preg_match('/'.$pattern.'/', $subject, $matches); } }
if(!function_exists('eregi'))           { function eregi($pattern, $subject, &$matches = []) { return preg_match('/'.$pattern.'/i', $subject, $matches); } }
if(!function_exists('ereg_replace'))    { function ereg_replace($pattern, $replacement, $string) { return preg_replace('/'.$pattern.'/', $replacement, $string); } }
if(!function_exists('eregi_replace'))   { function eregi_replace($pattern, $replacement, $string) { return preg_replace('/'.$pattern.'/i', $replacement, $string); } }
if(!function_exists('split'))           { function split($pattern, $subject, $limit = -1) { return preg_split('/'.$pattern.'/', $subject, $limit); } }
if(!function_exists('spliti'))          { function spliti($pattern, $subject, $limit = -1) { return preg_split('/'.$pattern.'/i', $subject, $limit); } }

  // pregunta si es la primera vez
  if (!isset($_SESSION['vps_error']))
    {
      $error = -1;
      $_SESSION['vps_equivocacion'] = 0;
      $_SESSION['vps_usuarioqueintenta'] = "";
    }
  else
    {
      $error = $_SESSION['vps_error'];
    }
  // alterna login1.php y logout1.php seg�n corresponda
  if ($error != 0)
    {
      if ($error ==2)
        {
          $bloqueofecha = $_SESSION['vps_bloqueofecha'];
        }
      $incluir    = "index-logout1.php";
      $equivocacion = $_SESSION['vps_equivocacion'];
      $usuarioqueintenta = $_SESSION['vps_usuarioqueintenta'];
      session_unset();
      $_SESSION['vps_equivocacion'] = $equivocacion;
      $_SESSION['vps_usuarioqueintenta'] = $usuarioqueintenta;
    }
  else
    {
      $incluir = "index-logout1.php";
      $error = $_SESSION['vps_error'];
      $usuario = $_SESSION['vps_usuario'];
      $cuil = $_SESSION['vps_cuil'];
	  $saf_dir = $_SESSION['vps_saf_dir'];
	  $nrosaf = $_SESSION['vps_saf'];
	  $sub_nrosaf = $_SESSION['vps_sub_saf'];
      $contrasena = $_SESSION['vps_contrasena'];
      $nombre = $_SESSION['vps_nombre'];
	  $razon = $_SESSION['vps_razon_social'];
      $fechanac = $_SESSION['vps_fechanac'];
      $tiempo = $_SESSION['vps_tiempo'];
      session_unset();
      $_SESSION['vps_error'] = $error;
      $_SESSION['vps_usuario'] = $usuario;
      $_SESSION['vps_cuil'] = $cuil;
	  $_SESSION['vps_saf_dir']=  $saf_dir;
	  $_SESSION['vps_saf'] = $nrosaf;
	  $_SESSION['vps_sub_saf'] = $sub_nrosaf;
      $_SESSION['vps_contrasena'] = $contrasena;
      $_SESSION['vps_nombre'] = $nombre;
	  $_SESSION['vps_razon_social'] = $razon;
      $_SESSION['vps_fechanac'] = $fechanac;
      $_SESSION['vps_tiempo'] = time();
    }
	  $img = 'img/exit1.png';
      $logout = 'index-logout2.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tesoreria General de la Provincia</title>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="stylesctas.css">
</head>

<body>
    <div class="header"></div>
    <div class="container">
        <!-- Scroll Reveal -->
        <script src="https://unpkg.com/scrollreveal"></script>
        <script src="main.js"></script>

<?php
 if ($error == 0)
     {
      if(!isset($_GET['sec']))
         {
            include("indexctas1.php");
         }
       else
         {
            if(file_exists($_GET['sec'].".php")){
                include($_GET['sec'].".php");
               }
            elseif(file_exists($sec.".html"))
               {
                 include($sec.".html");
               }
            else
               {
                 echo 'Perd&oacute;n pero la p&aacute;gina solicitada no existe';
               }
         }

     }  
    
	if ($error == 1)
    {
      // contrase&ntilde;a incorrecta
?>
<br>
<p></p>
<br>
<table width="350" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#EEEEEE">
    <tr>
        <td height="173" align="center">
            <blockquote>
                <blockquote>
                    <img src="img/atencion.png" width="128" height="128">
                    <p class="Estilo1">
                        <font size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong>&iexcl;&iexcl;
                                <u>ATENCION</u> !!</strong></font>
                    </p>
                </blockquote>
            </blockquote>
            <p class="Estilo1">
                <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Usuario inexistente<br>
                    y/o contrase&ntilde;a incorrecta.</font>
            </p>
            <p class="Estilo1">
                <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> De continuar el problema<br>
                    comun&iacute;quese con personal T&eacute;cnico</font>
            </p>
        </td>
    </tr>
</table>
<br>
<?php
    }  elseif ($error == 2)
    {
      // usuario bloqueado
?>
<br>
<br>
<table width="350" border="0" align="center" cellpadding="5" cellspacing="1">
    <tr>
        <td height="173" align="center" bgcolor="#FFFFFF">
            <img src="img/out.png" width="160" height="155">
            <p class="Estilo2">
                <font size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong> Usuario con <br>
                        acceso bloqueado</strong></font>
            </p>
            <p class="Estilo2">
                <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Usted se encuentra<br>
                    bloqueado para ingresar al sistema<br>
                    desde fecha
                    <?php
               echo substr($bloqueofecha, 0, 10)." a las ".substr($bloqueofecha, 11, 8)." hs.";
?>
                    <br>
                    <br>
                    Por favor, comun&iacute;quese con personal t&eacute;cnico
                </font>
            </p>
        </td>
    </tr>
</table>
<br>
<?php
    } elseif ($error == 3)
    {
      // usuario y/o clave en blanco
?>
<br>
<table width="300" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF">
    <tr>
        <td height="173" align="center">
            <img src="img/stop1.png" width="98" height="100">
            <p class="Estilo1">
                <font size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong> Se ha producido un error</strong>
                </font>
            </p>
            <p>
                <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> El nombre de usuario y/o la
                    contrase&ntilde;a<br>
                    no pueden estar en blanco.</font>
            </p>
            <p>
                <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Ingrese correctamente<br>
                    los datos por favor.</font>
            </p>
        </td>
    </tr>
</table>
<?php
    } elseif ($error == 99)
    {
      // usuario y/o clave en blanco
?>
<p>&nbsp;</p>

<table width="300" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#FFFF66">
    <tr>
        <td height="173" align="center" bgcolor="#FFFF66">
            <img src="img/fallo.png" width="160" height="54">
            <p class="Estilo1">
                <font size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong> Error al intentar verificar<br>
                        los datos ingresados</strong></font>
            </p>
            <p>
                <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Por favor, aguarde unos minutos<br>
                    e int&eacute;ntelo nuevamente.</font>
            </p>
            <p>
                <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> De continuar el problema<br>
                    comun&iacute;quese con personal t&eacute;cnico</font>
            </p>
        </td>
    </tr>
</table>
<?php
    }
?></td>
</body>
</html>