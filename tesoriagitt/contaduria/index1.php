<?php
 error_reporting ( E_ERROR );  

  $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];

  include('incluir_siempre.php');
?>   
<div class="content">
<h1>Contaduria</h1>
<!-- <div class="descr">Jueves, 22 de Mayo de 2008.</div> -->
<p>
En esta seccion de Beneficiarios Ud. podra habilitarse para ingresar al Sistema de Beneficiarios, como asi tambien, realizar modificaciones en su perfil.
</p>
</div>

<div class="sidenav">

	<?php if ($nrosaf=='S')
	     {
		include('menu_acordeon_contaduria_sipaf.php');
		}
		elseif ($nrosaf=='T')
	     {
		include('menu_acordeon_tesoreria.php');
		}
		else
		 {
		 include('menu_acordeon_contaduria.php');
		 }
		  ?>

</div>

<div class="clearer"><span></span></div>