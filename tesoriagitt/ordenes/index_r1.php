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
     if (!($r_cf= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }	
	
	$f_cf=mysql_fetch_array($r_cf);
	$nro =$f_cf['nro_ti'];
	$nro_max=$nro;
  
  
?>  
<div class="content">
<h1>
  <p>Consulta de Constancia de Retenciones</p></h1>
<!-- <div class="descr">Jueves, 22 de Mayo de 2008.</div> -->
<p>

</p>
<p>
</p>
</div>

<div class="sidenav">

<ul>
<?php
  if($nrosaf=='N' or $nrosaf=='F' or $nrosaf=='D' )
     {

?>		
    <li><a href="indextesoreria.php?sec=contaduria/contra&apli=orden&per=C" >Cambiar Contrase&ntilde;a</a></li>
     
   <?php
	 }
	 ?>
<li><a href="indextesoreria.php?sec=retenciones/beneficiarios_consulta_constancia_g&apli=orden&per=C&band=CBG">Constancia de Retencion Ganancia</a></li>
    
    <li><a href="indextesoreria.php?sec=retenciones/beneficiarios_consulta_constancia_ss&apli=orden&per=C&band=CBS">Constancias de Retencion Contribucion Patronales</a></li>
    <li><a href="indextesoreria.php?sec=retenciones/beneficiarios_consulta_constancia_i&apli=orden&per=C&band=CBS">Constancia de Retencion Ingresos Brutos</a></li>
</ul>
</div>

<div class="clearer"><span></span></div>