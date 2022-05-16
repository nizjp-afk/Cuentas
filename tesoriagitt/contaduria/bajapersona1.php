<?php
error_reporting ( E_ERROR ); 
 ///////////CONEXION DB/////////////////////////////
  include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
///////////////////////////////////////////////////
?>
<div class="content">	

<?php	   
    // establece las variables que se usarán en el mail en caso de error
     echo $id = $_POST['hid'];
     
     $ssql   = "DELETE FROM personas WHERE id_personas='$id'";

      if (!($r_personas = mysql_query($ssql, $conexion_mysql)))
      {
        //.....................................................................
        // informa del error producido
	             echo "ERROR EN BORRAR PERSONA";exit;
        //.....................................................................
      }

/////////////INCLUYE LA FUNCION QUE AGREGA MOVIMIENTO DE DATOS//////////
//include('../agrego_movi.php');                                        //
//$accion='BORRAR UN REGISTRO DE PERSONA PARA UN USUARIO';              ////
//$tabla='PERSONAS';                                                    //
//agrego_movi($usuario,$accion,$tabla);                                 //
////////////////////////////////////////////////////////////////////////
	  
    
?>
 	
	<center><h1>Guardando</h1></center>
	
	<center><img src="../img/loader_guardando.gif" width="100" height="100" />
	<p>Fue Eliminado con exito los datos.</p></center>
<code>Haga click <a href='indextesoreria.php'>aqu&iacute;</a> para regresar.</code>
		  
</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>
	      