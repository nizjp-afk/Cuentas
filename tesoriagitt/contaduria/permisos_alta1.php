<?php
error_reporting ( E_ERROR ); 
/////////////////CONEXION DB///////////////////
   include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
       
//////////////////////////////////////////////////

   
    // establece las variables que se usarán en el mail en caso de error
      $ssql   = "SELECT * FROM usuarios,personas WHERE `personas_docnro`=docnro ORDER BY `userid`";
      if (!($r_usu = mysql_query($ssql, $conexion_mysql)))
      {
        //.....................................................................
        // informa del error producido
        echo "ERROR EN LECTURA DE LA TABLA USUARIOS";exit;
        //.....................................................................
      }

      $ssql   = "SELECT * FROM aplicaciones ORDER BY id_apli";
      if (!($r_apli = mysql_query($ssql, $conexion_mysql)))
      {
        //.....................................................................
        // informa del error producido
        echo "ERROR EN LECTURA DE LA TABLA APLICACIONES";exit;
        //.....................................................................
      }


?>
<div class="content">

 <form name="form1" method="post" action="indextesoreria.php?sec=contaduria/permisos_alta2&ap=admin&per=ABCM">
     <table border="0" cellpadding="0" align="center">
	  	 <tr>
		     <td height="49" colspan="2" align="center"><h1>Permisos</h1></td>
   	    </tr>
	<tr height=10px>
		<td colspan="2" align="center"><hr></td>
	</tr>
        <tr>
		<td width="199" height="35" align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Usuario : </font></td>
          <td colspan="2">
		   <select name="usuarios" id="usuarios">
<?php 
           while ($f_usu = mysql_fetch_array($r_usu))
		      {
			     echo "<option value=".$f_usu['userid'];
				 echo ">".$f_usu['userid'].' - '.$f_usu['apellido'].', '.$f_usu['nombre']."</option>";
			  }
?>           
	      </select></td>
        </tr>
        <tr>
          <td align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Aplicacion : </font></td>
          <td colspan="2">
		  <select name="apli" id="apli">
<?php 
           while ($f_apli = mysql_fetch_array($r_apli))
		      {
			     echo "<option value=".$f_apli['cod'];
				 echo ">".$f_apli['descrip']."</option>";
			  }
?> 
          </select></td>
        </tr>
		<tr>
		  <td align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Permisos: </font></td>
		  <td>
		     <select name="tipo" >
			   <option value="A">Alta</option>
			   <option value="B">Baja</option>
			   <option value="M">Modificacion</option>
			    <option value="G">Modificacion General de Beneficiarios</option>
               <option value="R">Control de Retencion</option>
                 <option value="D">Descarga a Sicore/SIJP</option>
                  <option value="RDC">General Retenciones</option>
                 <option value="C">Consulta</option>
			   <option value="ABCMG">General</option>
                <option value="EC">Saf</option>
   
			 </select>  
			 </td>   
		</tr>
        <tr>
          <td colspan="3" align="center"> <input type="image" src="img/grabar.png" class="tabla_jugando"  name="aceptar" value="Agregar" />            </td>
        </tr>
   </table>
</form> 
    
 </div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>
