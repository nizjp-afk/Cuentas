<?php
  error_reporting ( E_ERROR );
  $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];

  include('incluir_siempre.php');
  
  
?>  
<div class="content">
    <h1>Empresas Estatales</h1>

<!-- <div class="descr">Jueves, 22 de Mayo de 2008.</div> -->
<p>

</p>
<p>
</p>
</div>

<div class="sidenav">


<h2>Consultas</h2>	
<ul>   
   	<li><a href="indextesoreria.php?sec=sapem/beneficiarios_consulta_aprobado&apli=orden&per=T">Beneficiarios </a></li>
   
    <li><a href="indextesoreria.php?sec=sapem/consulta_orden&apli=orden&per=P">Consulta de Orden de Pago</a></li>
    
 		 
     <li><a href="indextesoreria.php?sec=sapem/periodo&apli=orden&per=T&tipo=P">Ordenes Pagadas . PDF</a> </li>
     
     <li><a href="indextesoreria.php?sec=sapem/periodo&apli=orden&per=T&tipo=E">Ordenes Pagadas .EXCEL </a> </li>
     
     <li><a href="indextesoreria.php?sec=sapem/periodo&apli=orden&per=T&tipo=G">Informe Gral .EXCEL </a> </li>
    
 
</ul>




</div>

<div class="clearer"><span></span></div>