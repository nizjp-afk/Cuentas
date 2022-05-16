<?php
error_reporting (E_ERROR); 
  $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];

  include('incluir_siempre.php');
   $mostrar=date('Y');
   $anterior=date('Y')-2;
?>  
<div class="content">
<h1>Ordenes de Pago Pendientes</h1>
<!-- <div class="descr">Jueves, 22 de Mayo de 2008.</div> -->
<p>&nbsp;</p>
</div>

<div class="sidenav">

<!--/*<h2>2009</h2>	
<ul>
   <li><a href="indextesoreria.php?sec=pendientes/cargar_orden_pendientes_2009&amp;apli=tgpa&fecha_cons=2009&amp;per=A&band=T">Ordenes Pendientes de Pago</a></li>
</ul>  -->
<!--<h2>2010</h2>	<ul> 
   <li><a href="indextesoreria.php?sec=pendientes/cargar_orden_pendientes_2009&amp;apli=tgp&fecha_cons=2010&amp;per=C&band=T">Ordenes Pendientes de Pago</a></li>
</ul>-->

<h2>#</h2>	
<ul> 
   <li><a href="indextesoreria.php?sec=pendientes/cargar_orden_pendientes_2009_bd&amp;apli=tgp&fecha_cons=2010&fecha_ant=<?php echo $anterior;?>&amp;per=C&band=T">Ordenes Pendientes de Pago</a></li>
</ul>

<h2><?php echo $mostrar -1;?> </h2><ul>
    
	<li><a href="indextesoreria.php?sec=pendientes/cargar_orden_pendientes_2009&fecha_cons=<?php echo $mostrar -1;?>&apli=tgpa&per=A&band=T">Ordenes Pendientes de Pago</a></li>
	
</ul>	
<h2><?php echo $mostrar;?>  </h2>	
<ul>
    
	<li><a href="indextesoreria.php?sec=pendientes/cargar_orden_pendientes_2009&fecha_cons=<?php echo $mostrar;?>&apli=tgpa&per=A&band=T">Ordenes Pendientes de Pago</a></li>
	
</ul>	
<ul>
    

      <li><a href="indextesoreria.php?sec=tesoreria/index1&apli=tgpa&per=O">Regresar Menu</a></li>
	
	<!-- <li><a href="indextesoreria.php?sec=tesoreria/saf_consulta&apli=tgpc&per=A">Beneficiarios - SAF</a> </li>-->
</ul>

</div>

<div class="clearer"><span></span></div>