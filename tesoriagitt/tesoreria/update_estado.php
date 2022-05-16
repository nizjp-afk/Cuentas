<?php 
error_reporting ( E_ERROR ); 
 $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];

  include('incluir_siempre.php');
   include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');    
	 
//variables recibidas
   $id_bene=$_POST['id_bene'];
   $inhi=$_POST['inhi'];
   $bene_cesion=$_POST['bene_cesion'];
   $motivo=$_POST['motivo'];
     $cuitl=$_POST['cuit'];
 
  if($inhi=='Inhibido')
   {
	$ssql = "UPDATE beneficiarios_aprobados SET inhi='$inhi',motivo='$motivo',estado='B' WHERE id_beneficiario='$id_bene'";
				 if (!($r_beneficiarios = mysql_query($ssql,$conexion_mysql)))
				 {
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar dar de alta un beneficiario";
					  echo $cuerpo1;
						   exit;
					  //.....................................................................
				 }
				 
   }
   
				 $accion='Modificacion de Cta'.' '.$inhi.' '.$motivo;
                 $tabla='beneficiarios_aprobados';
                 include('agrego_movi.php'); 
   
   
				 
?>	
<div class="content">
	<center><h1>Guardando</h1></center>
	
	<center><img src="../img/loader_guardando.gif" width="100" height="100" />
	<p>Sus Datos Fueron Grabado con Exito.</p></center>


<!-- ======================================================================= -->

<code>Haga click <a href='indextesoreria.php?sec=tesoreria/beneficiarios_consulta_inhi&apli=tgpc&per=H'>aqu&iacute;</a> para regresar.</code>

</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>