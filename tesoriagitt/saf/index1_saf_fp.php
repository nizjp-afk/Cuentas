<?php
  error_reporting ( E_ERROR ); 

  $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];

   $accion='Consulta Ordenes Pendientes';
   $tabla='op_pendiente';
   include('agrego_movi.php'); 
   include('incluir_siempre.php');
  
   include('dgti-mysql-var_dgti-beneficiarios.php');
   include('dgti-intranet-mysql_connect.php');  
   include('dgti-intranet-mysql_select_db.php');


   	
  $ssql = "SELECT *  FROM `nro_saf` where saf_id='$saf_dir' order by numero";
     if (!($r_saf= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
   }
  
?>  
<div class="content">
<h1>Ordenes de Pago Pendientes -Recursos Propios-</h1>
<!-- <div class="descr">Jueves, 22 de Mayo de 2008.</div> -->
<p>&nbsp;</p>
</div>

<div class="sidenav">

<ul>
    

      <li><a href="indextesoreria.php?sec=saf/index1&apli=s&per=C">Regresar Menu</a></li>
	
	<!-- <li><a href="indextesoreria.php?sec=tesoreria/saf_consulta&apli=tgpc&per=A">Beneficiarios - SAF</a> </li>-->
</ul>




	<?php include('menu_acordeon_saf_1_fp.php'); ?>

</div>
<div class="clearer"><span></span></div>