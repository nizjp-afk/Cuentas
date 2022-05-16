<?php
error_reporting ( E_ERROR ); 
  $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];

  include('incluir_siempre.php');
?>  
<div class="content">
<h1><font color="#456">Modulo de Impuestos y Retenciones </font></h1>
<!-- <div class="descr">Jueves, 22 de Mayo de 2008.</div> -->
<p>
<!-- En esta seccion de Beneficiarios Ud. podra habilitarse para ingresar al Sistema de Beneficiarios, como asi tambien, realizar modificaciones en su perfil.-->
</p>
</div>

<div class="sidenav">

<ul>
    
	<li><a href="indextesoreria.php?sec=retenciones_saf/beneficiarios_consulta_aprobado&apli=s&per=C">Consulta de Pagos <br />Acumulados </a></li>
	<li><a href="indextesoreria.php?sec=retenciones/beneficiarios_consulta_constancia_gs&apli=orden&per=C&band=CBG"> Constancia de Retencion Ganancia</a></li>
<li><a href="indextesoreria.php?sec=retenciones/beneficiarios_consulta_constancia_sss&apli=orden&per=C&band=CBG">  Constancias de Retencion Contribucion Patronales</a></li>
<li><a href="indextesoreria.php?sec=retenciones/beneficiarios_consulta_constancia_is&apli=orden&per=C&band=CBG"> Constancia de Retencion Ingresos Brutos</a></li>
  
</ul>

</div>

<div class="clearer"><span></span></div>