<?php
error_reporting ( E_ERROR ); 
  $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];

   $accion='Consulta Ordenes Pendientes Fondos Propios';
   $tabla='op_pendiente_fp_ch';
   include('agrego_movi.php'); 
  include('incluir_siempre.php');
  
  $mostrar=date('Y');
    $anterior=date('Y')-2;
  
  
?>  
<div class="content">
<h1>Ordenes de Pago Pendientes Fondos Propios</h1>
<!-- <div class="descr">Jueves, 22 de Mayo de 2008.</div> -->
<p>&nbsp;</p>
</div>

<div class="sidenav">

<?php 
  if($sub_nrosaf=='N')
    {
?>		
 
<h2># </h2>	
<ul> 
  <li><a href="indextesoreria.php?sec=pendientes/cargar_orden_pendientes_saf_fp_bd&fecha_ant=<?php echo $anterior;?>&amp;apli=tgpa&fecha_cons=2011&sub_saf=<?php echo $sub_nrosaf;?>&amp;per=A&band=T">Otros Ejercicios</a></li>
</ul>
<h2><?php echo $mostrar -1;?> </h2>	
<ul> 
   <li><a target="_blank" href="consolidada/listado_ordenes_pendientes_fp.php?apli=tgpa&consul=<?php echo $mostrar ;?>&amp;per=A&band=T&saf=<?php echo $nrosaf; ?>">Ordenes Pendientes de Pago</a></li>
</ul>

<h2><?php echo $mostrar;?>  </h2>	
<ul> 
  <li><a target="_blank" href="consolidada/listado_ordenes_pendientes_fp.php?apli=tgpa&consul=<?php echo $mostrar ;?>&amp;per=A&band=T&saf=<?php echo $nrosaf; ?>">Ordenes Pendientes de Pago</a></li>
</ul>

<ul>
    

      <li><a href="indextesoreria.php?sec=saf/index1&apli=s&per=C">Regresar Menu</a></li>
	
	<!-- <li><a href="indextesoreria.php?sec=tesoreria/saf_consulta&apli=tgpc&per=A">Beneficiarios - SAF</a> </li>-->
</ul>
<?php
	}
else
  {
?>
<!--<h2>2011</h2>	
<ul> 
   <li><a href="indextesoreria.php?sec=pendientes/cargar_orden_pendientes_saf_fp_sb&amp;apli=tgpa&sub_saf=<?php// echo $sub_nrosaf;?>&fecha_cons=2011&amp;per=A&band=T">Ordenes Pendientes de Pago</a></li>
</ul>-->

<h2># </h2>	
<ul> 
   <li><a href="indextesoreria.php?sec=pendientes/cargar_orden_pendientes_saf_fp_sb_bd&fecha_ant=<?php echo $anterior;?>&amp;apli=tgpa&fecha_cons=2011&sub_saf=<?php echo $sub_nrosaf;?>&amp;per=A&band=T">Otros Ejercicios</a></li>
</ul>
<h2><?php echo $mostrar -1;?> </h2>	
<ul> 
   <li><a href="indextesoreria.php?sec=pendientes/cargar_orden_pendientes_saf_fp_sb&amp;apli=tgpa&sub_saf=<?php echo $sub_nrosaf;?>&fecha_cons=<?php echo $mostrar -1;?>&amp;per=A&band=T">Ordenes Pendientes de Pago</a></li>
</ul>

<h2><?php echo $mostrar;?> </h2>	
<ul> 
   <li><a href="indextesoreria.php?sec=pendientes/cargar_orden_pendientes_saf_fp_sb&amp;apli=tgpa&sub_saf=<?php echo $sub_nrosaf;?>&fecha_cons=<?php echo $mostrar;?>&amp;per=A&band=T">Ordenes Pendientes de Pago</a></li>
</ul>

<ul>
    

      <li><a href="indextesoreria.php?sec=saf/index1&apli=s&per=C">Regresar Menu</a></li>
	
	<!-- <li><a href="indextesoreria.php?sec=tesoreria/saf_consulta&apli=tgpc&per=A">Beneficiarios - SAF</a> </li>-->
</ul>
<?php
  }
 ?> 
</div>

<div class="clearer"><span></span></div>