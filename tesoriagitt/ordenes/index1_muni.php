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
<h1><p>Consulta de Ordenes Pagadas</p><p> y Pendientes de Pagos</p></h1>
<!-- <div class="descr">Jueves, 22 de Mayo de 2008.</div> -->
<p>

</p>
<p>
</p>
</div>

<div class="sidenav">

<ul>
    <li><a href="indextesoreria.php?sec=contaduria/contra&apli=orden&per=C" >Cambiar Contrase&ntilde;a</a></li>
     <li><a href="indextesoreria.php?sec=ordenes/periodo_m&apli=orden&per=C">Ordenes Pagadas </a> </li>
	      
    <li><a target="_blank" href="pendientes/listado_ordenes_pendientes_benef_mun.php?apli=orden&per=C&cuit=<?php echo $usuario;?> ">Ordenes Pendientes de Pago </a> </li>
 
</ul>
</div>

<div class="clearer"><span></span></div>