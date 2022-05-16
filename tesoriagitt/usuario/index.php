<?php
    include('../conexion/extras.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
	<meta name="description" content="description"/>
	<meta name="keywords" content="keywords"/> 
	<meta name="author" content="author"/> 
	<link rel="stylesheet" type="text/css" href="../css/estilos.css" media="screen"/>
	<title>Sistema de Gestion de Compras</title>
</head>
<body>
<div class="top">
	<div class="header">
		<div class="left">
			Sistema de Gestion de Compras
		</div>
		<div class="right">
			<h2>Fecha: <?php echo $dia." Hora: ".$hora; ?></h2>
			<!-- 
			<p>[usuario]</p>
			<p>[Cerrar Sesion]</p>
			-->
		</div>
</div>
<div class="container">	
	<div class="navigation">
		<a href="../index.php">Principal</a>
		<a href="index.php">Empresas</a>
		<a href="index.php">Instituciones</a>
		<a href="index.php">Municipios</a>
		<a href="index.php">Beneficiarios</a>
		<a href="index.php">Usuarios</a>
		<div class="clearer">
			<span></span>
		</div>
	</div>
	<div class="main">		
		<div class="content">

<!-- ======================================================================= -->
			<h1>Usuarios</h1>
<!-- ======================================================================= -->

<div class="descr">Lunes, 02 de Junio de 2008.</div>

<p>
En esta seccion de Usuarios Ud. podra habilitar diferentes USUARIOS para ingresar al SIGCOM, como asi tambien, realizar sus modificaciones en su perfil.
</p>

<p>
Actualmente este Sistema denominado SIGCOM (Sistema de Gestion de Compras) se encuentra en desarrollo.
</p>

<!-- ======================================================================= -->

	  </div>
		<div class="sidenav">
			<h2>Beneficiarios</h2>
			<ul>
				<li><a href="altas.php">Altas</a></li>
				<li><a href="index.php">Bajas</a></li>
				<li><a href="index.php">Modificar</a></li>
				<li><a href="index.php">Consultas</a></li>
				<li><a href="index.php">Listados</a></li>
			</ul>


		</div>

		<div class="clearer"><span></span></div>

	</div>

	<div class="footer"><a href="usuario/copyright.php">&copy;</a> 2008 Sistema de Gestion de Compras - Unidad de Informatica - Contaduría General de la Provincia de la Rioja</div>

</div>

</body>

</html>