<?php
 $mostrar=date('Y');
  $anterior=date('Y')-2;
//echo $permisos;
 // echo $nrosaf;
?>

<div class="glossymenu">
<a class="menuitem submenuheader" href="#">Consultas</a>
	
    <div class="submenu">
   
			
		<ul>
           
			<li><a href="indextesoreria.php?sec=hacienda/analisis_periodo&apli=h&per=C">Analisis de Gasto </a></li>
				<li><a href="indextesoreria.php?sec=hacienda/analisis_recurso&apli=h&per=C">Analisis de Recurso </a></li>
			<li><a href="indextesoreria.php?sec=hacienda/analisis_gr&apli=h&per=C">Analisis de Gasto - Recurso </a></li>
			<li><a href="indextesoreria.php?sec=hacienda/clasificar_periodo&apli=h&per=O">Clasificacion </a></li>
			<li><a href="indextesoreria.php?sec=hacienda/consulta&apli=h&per=C">Consulta y Descarga  </a></li>
			  <li><a href="indextesoreria.php?sec=retenciones/consulta_orden_b&apli=h&per=C&valor=D">Consulta de Ordenes Bloqueadas</a></li>
			
           
            
          
		</ul>
	</div>
	<?php
			
			if($permisos=='CAO')
			{
           ?>
<a class="menuitem submenuheader" href="#">Actualizar Datos</a>
	<div class="submenu">       
			<ul>
            <li><a href="indextesoreria.php?sec=hacienda/exportacion&apli=h&per=X&band=CSP">1 - Importar </a></li>
            
			<li><a href="indextesoreria.php?sec=hacienda/pagado_financiero&apli=h&per=X">2- Pocesar Pagos</a></li>
				<li><a href="indextesoreria.php?sec=hacienda/exp_recurso&apli=h&per=X">2- Pocesar Recursos</a></li>
				
			<li><a href="indextesoreria.php?sec=hacienda/limite&apli=h&per=X">2- Limites</a></li>	
            
       </ul>
     </div>  
	
   <?php
			}
	?>
    
    
</div>