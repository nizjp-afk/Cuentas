<?php
error_reporting ( E_ERROR ); 
/////////////////CONEXION DB///////////////////
   include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
//////////////////////////////////////////////////

   
    // establece las variables que se usarán en el mail en caso de error
      $usu   = $_POST['usuarios'];
	  $apl    = $_POST['apli'];
	  $tipo    = $_POST['tipo'];
	  
      $ssql   = "SELECT * FROM aplicaciones WHERE cod = '$apl'";
      if (!($r_apli = mysql_query($ssql, $conexion_mysql)))
      {
        //.....................................................................
        // informa del error producido
        echo "ERROR EN LECTURA DE LA TABLA APLICACIONES";exit;
        //.....................................................................
      }
      $f_apli = mysql_fetch_array($r_apli);
	  $per    = $f_apli['permisosgral'];
	
      $ssql   = "INSERT INTO permisos (
                                             usuarios_userid,
                                             aplicaciones_cod,
											 permisospart)";

      $ssql.= "VALUES (                      '$usu',
                                             '$apl',
											 '$tipo')";
      if (!($r_per= mysql_query($ssql, $conexion_mysql)))
      {
        //.....................................................................
        // informa del error producido
         echo "ERROR EN INSERTAR PERMISOS";
		 exit;
        //.....................................................................
      }
/*
/////////////INCLUYE LA FUNCION QUE AGREGA MOVIMIENTO DE DATOS//////////
include('agrego_movi.php');                                        //
$accion='AGREGA UN REGISTRO DE PERMISO A USUARIO';                    //
$tabla='PERMISOS';                                                    //
agrego_movi($usuario,$accion,$tabla);                                 //
////////////////////////////////////////////////////////////////////////
*/

$cuitl=$usu;
	$accion='AGREGA UN REGISTRO DE PERMISO A USUARIO'; 
		  $tabla='PERMISOS';
		  include('agrego_movi.php');
?>
  <meta http-equiv='refresh' content='3;url=indextesoreria.php?sec=contaduria/permisos_alta1'> 

	<table width="60%" border="0" align="left">
     <tr>
     <td align="center">
	 <p class="Estilo2 style1 Estilo1"><img src="img/loader_guardando.gif" width="100" height="100" /></p>
      <p class="Estilo2 style1">
	  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Espere unos segundos el Sistema se Redirigir&aacute; automaticamente
	  <br><br>
      Gracias
	  </font>
	  </p>
	  </td>
     </tr>
   </table>
