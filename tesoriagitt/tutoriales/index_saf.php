<?php
 error_reporting ( E_ERROR );
  $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];

  include('incluir_siempre.php');
  
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
  	//$fecha_cons=$_GET['consul'];	
	
	$ssql = "SELECT * FROM control_ti_saf where numero='$nrosaf'";
     if (!($r_cf= mysqli_query($conexion_mysql,$ssql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }	
	
	$f_cf=mysqli_fetch_array($r_cf);
	$nro =$f_cf['nro_ti'];
	$nro_max=$nro;
  
  
?>  
<div class="content">
<h1>
  <p>Consulta de Tutoriales</p></h1>
<!-- <div class="descr">Jueves, 22 de Mayo de 2008.</div> -->
<p>

</p>
<p>
</p>
</div>

<div class="sidenav">

<ul>
<!--<li><a href="tutoriales/consulta_op.pdf" target="_blank" style="text-decoration: none">Consulta de Ordenes Pagadas y Pendientes</a></li>
-->
<li><a href="tutoriales/retenciones_saf.pdf" target="_blank" style="text-decoration: none">Constancia de Retenciones</a></li>
    
    
</ul>
</div>

<div class="clearer"><span></span></div>