<?php
 error_reporting ( E_ERROR );
  $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];

  include('incluir_siempre.php');
  
   $d_fecha=date('Y-m-d');
   
    $mostrar=date('Y');
   
     include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
  	//$fecha_cons=$_GET['consul'];	
	
	$ssql = "SELECT * FROM `control_fecha`";
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
	
	$ssql = "SELECT * FROM control_fecha_fp ";
     if (!($r_cf= mysqli_query($conexion_mysql,$ssql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }	
	
	$f_cf=mysqli_fetch_array($r_cf);
	$nro_fp =$f_cf['nro_ti'];
	$nro_max_fp=$nro_fp;
  
   $ssql = "SELECT * FROM control_ti_saf where c_fecha='$d_fecha' and nro_ti > 1";
     if (!($r_cft= mysqli_query($conexion_mysql,$ssql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }	
	
	$cant = mysqli_num_rows($r_cft);
?>  
<div class="content">
<h1>Secretaria de Hacienda</h1>
<!-- <div class="descr">Jueves, 22 de Mayo de 2008.</div> -->
<p> 
</p>
</div>

<div class="sidenav">

	<?php include('menu_acordeon_hacienda.php'); ?>

</div>

<div class="clearer"><span></span></div>