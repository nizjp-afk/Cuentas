<?php 
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	 
	 $ssql = "SELECT *
FROM `beneficiarios_aprobados`
WHERE `actividad_p` = '910015'";
     if (!($r_beneficiario= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar beneficiario";
      echo $cuerpo1;
      //.....................................................................
    }
	
	/*$ssql = "SELECT * FROM `beneficiarios` where `alta`='' and persona_tipo='o'  order by id_beneficiario";
     if (!($r_beneficiario= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar beneficiario";
      echo $cuerpo1;
      //.....................................................................
    } */     
	while($f_beneficiario= mysql_fetch_array ($r_beneficiario))
	    {

//datos personales
	
  $cuitl = $f_beneficiario['cuitl'];
  $actividad_p=$f_beneficiario['actividad_p'];
  $fecha_p=$f_beneficiario['fecha_p'];
  
  $ssql = "UPDATE beneficiarios_historial SET
                  actividad_p='$actividad_p',
				  fecha_p='$fecha_p'
				 
				  where cuitl='$cuitl' ";
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
?>
	<div class="content">
	<center><h1>Guardando</h1></center>
	
	<center><img src="../img/loader_guardando.gif" width="100" height="100" />
	<p>Sus Datos Fueron Grabado con Exito.</p></center>
<code>Si desea Imprimir, <b>Por favor</b></code>
<code>Haga click <a href='beneficiario/formulario_j.php?cuitl=
	<?php echo $cuitl;?>'>aqu&iacute;</a> </code>
<code>Haga click <a href='index.php'>aqu&iacute;</a> para regresar.</code>



<!-- ======================================================================= -->

</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>