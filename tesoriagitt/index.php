<?php
    include('conexion/extras.php');
	$incluir = "prueba21.html";
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
		<div class="left" >
			
		<!-- Cerrar Top|Encabezado|Izquierdo -->	
		</div>
		<!-- Abrir Top|Encabezado|Derecho -->
		<div class="right">
		     
		<!--<h2 align="left"> -->
		<!-- Cerrar Top|Encabezado|Derecho -->
		</div>
	<!-- Cerrar Top|Encabezado -->	
	
	</div>
<!-- Cerrar Top --></div>

<!-- Abrir Cuerpo -->
<div class="container">	
	<!-- Abrir Cuerpo|Menu -->
	<div class="navigation">
		<a href="index.php">Principal</a>	
		<!-- <a href="index.php">Empresas</a> -->
		<!-- <a href="index.php">Instituciones</a> -->
		<!-- <a href="index.php">Municipios</a> -->
        <a href="index.php?sec=beneficiario/alta&valor=f">Persona Fisica</a>
          <a href="index.php?sec=beneficiario/alta&valor=j">Persona Juridica</a>
          <a href="index.php?sec=bienvenidon">Novedades</a>
           <a href="index.php?sec=bienvenidoc">Contacto</a>
        
		<a href="index.php?sec=index-login1b" >Portal Web</a> 
       <!-- <a href="index.php?sec=index-login1">Intranet</a>-->
      <!-- <h3 align="right"><?php// include($incluir); ?></h3>-->
      <h3 align="left"><strong><font color="#CC6699"></font></strong></h3>
		
		<div class="clearer"><span></span></div>
	<!-- Cerrar Cuerpo|Menu -->
	</div>
	<!-- Abrir Cuerpo|Principal -->
	<div class="main">		
		<!-- Abrir Cuerpo|Principal|Contenido -->
		<!-- ============================================================== -->
<?php
      if(!isset($_GET['sec']))
         {
            include("bienvenido.php");
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
?>
		<!-- ============================================================== -->
	<!-- Cerrar Cuerpo|Principal -->
	</div>
	<!-- Abrir Cuerpo|Pie -->
	<div class="footer">
	 2008 Sistema de Beneficiarios  -  Tesoreria General de la Provincia de la Rioja - Area Informatica tgp.informatica@tgplarioja.com.ar
	<!-- Cerrar Cuerpo|Pie -->
	</div>
<!-- Cerrar Cuerpo -->
</div>
</body>
</html>