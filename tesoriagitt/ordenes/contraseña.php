<?php
error_reporting ( E_ERROR ); 
     $aplicacion = $_GET['apli'];
     $permisosnecesarios = $_GET['per'];
//   include('incluir_siempre.php');

/////////////////CONEXION DB//////////////////
    include('conexion_compras.php');
    include('mysql_connect.php');  
    include('mysql_select_db.php');
//////////////////////////////////////////////

       $ssql = "SELECT * FROM areas ";
     if (!($r_area= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
        

?>

<form action="index1.php?sec=configuracion/contraseña1&apli=areas&per=C" method="post" >	
<table border="0" cellpadding="0" align="center" >
	<tr>
		<td height="49" colspan="2"><h1>Cambiar Contrase&ntilde;a </h1></td>
	</tr>
	<tr height=10px>
		<td colspan="2"><hr></td>
	</tr>
        <tr>
        <tr>
          <td height="32" align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">D.N.I N&uacute;mero : </font></td>
          <td colspan="2"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <input name="docnro" type="text" size="8" maxlength="8">
          </font></td>
        </tr>
       
      
      
         
        <tr>
          <td height="30" align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Contrase&ntilde;a : </font></td>
          <td colspan="2"><input name="encriptado" type="password" size="31" maxlength="32"></td>
        </tr>
        <tr>
          <td height="33" align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Repita contrase&ntilde;a  : </font></td>
          <td colspan="2"><input name="encriptado1" type="password" id="encriptado1" size="31" maxlength="32"></td>
        </tr>				
       
        

        <tr>
          <td colspan="3" align="center"><input type="image"  src="img/update.png"   name="aceptar" value="Agregar" /></td>
        </tr>
  </table>
</form>

