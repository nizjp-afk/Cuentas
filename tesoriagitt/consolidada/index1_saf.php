<?php
error_reporting ( E_ERROR ); 
  $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];

   $accion='Consulta Ordenes Pendientes';
   $tabla='op_pendiente';
   include('agrego_movi.php'); 
  include('incluir_siempre.php');
?>  
<div class="content">
<h1>Ordenes de Pago Pendientes -Fondo Propio- </h1>
<!-- <div class="descr">Jueves, 22 de Mayo de 2008.</div> -->
<p>&nbsp;</p>
</div>

<div class="sidenav">


<h2>2010</h2>	
<ul> 
   <li><a href="indextesoreria.php?sec=consolidada/cargar_orden_pendientes_saf&amp;apli=s&fecha_cons=2010&amp;per=A&band=T">Ordenes Pendientes </a></li>
</ul>
<h2>2011</h2>	
<ul> 
   <li><a href="indextesoreria.php?sec=consolidada/cargar_orden_pendientes_saf&amp;apli=s&fecha_cons=2011&amp;per=A&band=T">Ordenes Pendientes </a></li>
</ul>

<ul>
    

      <li><a href="indextesoreria.php?sec=saf/index1&apli=s&per=C">Regresar Menu</a></li>
	
	<!-- <li><a href="indextesoreria.php?sec=tesoreria/saf_consulta&apli=tgpc&per=A">Beneficiarios - SAF</a> </li>-->
</ul>

</div>

<div class="clearer"><span></span></div>