<?php
    include('conexion/extras.php');
	 // session_cache_limiter('nocache,private'); // ó private_no_expire en php.ini
  session_name('valido');
  session_start();
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
  // alterna login1.php y logout1.php según corresponda
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
      $contrasena = $_SESSION['vps_contrasena'];
      $nombre = $_SESSION['vps_nombre'];
      $fechanac = $_SESSION['vps_fechanac'];
      $tiempo = $_SESSION['vps_tiempo'];
      session_unset();
      $_SESSION['vps_error'] = $error;
      $_SESSION['vps_usuario'] = $usuario;
      $_SESSION['vps_cuil'] = $cuil;
      $_SESSION['vps_contrasena'] = $contrasena;
      $_SESSION['vps_nombre'] = $nombre;
      $_SESSION['vps_fechanac'] = $fechanac;
      $_SESSION['vps_tiempo'] = time();
    }
	  $img = 'img/exit1.png';
      $logout = 'index-logout2.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
	<meta name="description" content="description"/>
	<meta name="keywords" content="keywords"/> 
	<meta name="author" content="author"/> 
	<link rel="stylesheet" type="text/css" href="css/estilos.css" media="screen"/>
    <link type="image/x-icon" href="css/img/favicon.gif" rel="shortcut icon" />
	<title>Sistema de Beneficiarios</title>
	
</head>
<body >
<!-- Abrir Top -->	
<div class="top">
	<!-- Abrir Top|Encabezado -->	
	<div class="header">
		<!-- Abrir Top|Encabezado|Izquierdo -->
		<div class="left">
			Sistema de Beneficiarios
		<!-- Cerrar Top|Encabezado|Izquierdo -->	
		</div>
		<!-- Abrir Top|Encabezado|Derecho -->
	  <div class="right">
			<h2>Fecha: <?php echo $dia."<br> Hora: ".$hora; ?></h2>
			<h3><?php echo $nombre; ?></h3>
			<h2><?php include($incluir); ?></h2>
		<!-- Cerrar Top|Encabezado|Derecho -->
		</div>
	<!-- Cerrar Top|Encabezado -->	
	
	</div>
<!-- Cerrar Top -->
</div>

<!-- Abrir Cuerpo -->
<div class="container">	
	<!-- Abrir Cuerpo|Menu -->
	<div class="navigation">
	    <a href="index.php">Principal</a>
		<a href="indextesoreria.php?sec=tesoreria/index1">Tesoreria</a>	
		<!-- <a href="index.php">Empresas</a> -->
		<!-- <a href="index.php">Instituciones</a> -->
		<!-- <a href="index.php">Municipios</a> -->
		<a href="indextesoreria.php?sec=contaduria/index1&apli=cgp&per=C">Configuracion</a>
		
		<div class="clearer"><span></span></div>
	<!-- Cerrar Cuerpo|Menu -->
	</div>
	<!-- Abrir Cuerpo|Principal -->
	<div class="main">		
		<!-- Abrir Cuerpo|Principal|Contenido -->
		<!-- ============================================================== -->

<?php
 if ($error == 0)
     {
      if(!isset($_GET['sec']))
         {
            include("bienvenidotes.php");
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
				  <img src="img/atencion.png" width="160" height="136">
                    <p class="Estilo1"> <font size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong>&iexcl;&iexcl; <u>ATENCION</u> !!</strong></font></p>
                  </blockquote>
                </blockquote>
                <p class="Estilo1"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Usuario inexistente<br>
  y/o contrase&ntilde;a incorrecta.</font></p>
                <p class="Estilo1"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> De continuar el problema<br>
  comun&iacute;quese con personal T&eacute;cnico</font></p></td>
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
                <p class="Estilo2"><font size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong> Usuario con <br>
              acceso bloqueado</strong></font></p>
                <p class="Estilo2"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Usted se encuentra<br>
              bloqueado para ingresar al sistema<br>
              desde fecha
              <?php
               echo substr($bloqueofecha, 0, 10)." a las ".substr($bloqueofecha, 11, 8)." hs.";
?>
              <br>
              <br>
              Por favor, comun&iacute;quese con personal t&eacute;cnico</font></p></td>
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
              <td height="173" align="center" >
			  <img src="img/stop1.png" width="98" height="100">
                <p class="Estilo1"><font size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong> Se ha producido un error</strong></font></p>
                <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> El nombre de usuario y/o la contrase&ntilde;a<br>
              no pueden estar en blanco.</font></p>
                <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Ingrese correctamente<br>
              los datos por favor.</font></p></td>
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
                <p class="Estilo1"><font size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong> Error al intentar verificar<br>
              los datos ingresados</strong></font></p>
                <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Por favor, aguarde unos minutos<br>
  e int&eacute;ntelo nuevamente.</font></p>
                <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> De continuar el problema<br>
  comun&iacute;quese con personal t&eacute;cnico</font></p></td>
            </tr>
          </table>
          <?php
    }
?></td>
          </tr>
          <tr>
            <td height="25" align="left" valign="top" >
		  	</td>
          </tr>
          <tr>
            <td align="left" valign="top"></td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td width="80" height="60" class="g_inf_centro_001c">&nbsp;</td>
        <td height="60" class="g_centro_inf_002c">&nbsp;</td>
        <td width="80" height="60" class="g_centro_inf_002c">&nbsp;</td>
      </tr>
    </table></td>
    <td width="30" valign="top" bgcolor="#768238" class="g_inf_der_002a">
	<div class="g_sup_der_001d">&nbsp;</div></td>
  </tr>
  <tr>
    <td width="30" height="100%" valign="bottom" bgcolor="#768238" class="g_inf_izq_002a">
	<div class="g_inf_izq_001b">&nbsp;</div></td>
    <td width="30" valign="bottom" bgcolor="#768238" class="g_inf_der_002a">
	<div class="g_inf_der_001b">&nbsp;</div></td>
  </tr>
  <tr bgcolor="#768238">
    <td width="30" height="40" class="g_inf_izq_001a">&nbsp;</td>
    <td height="40" class="g_inf_centro_001a"><table width="100%" height="40" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="110" class="g_inf_centro_001b">&nbsp;</td>
        <td>&nbsp;</td>
        <td width="100">&nbsp;</td>
      </tr>
    </table></td>
    <td width="30" height="40" class="g_inf_der_001a">&nbsp;</td>
  </tr>
</table>
		<!-- ============================================================== -->
	<!-- Cerrar Cuerpo|Principal -->
	</div>
	<!-- Abrir Cuerpo|Pie -->
	<div class="footer">
	<a href="usuario/copyright.php">&copy;</a> 2008 Sistema de Beneficiarios - Unidad de Informatica - Contaduría General de la Provincia de la Rioja
	<!-- Cerrar Cuerpo|Pie -->
	</div>
<!-- Cerrar Cuerpo -->
</div>
</body>
</html>