<?php
error_reporting ( E_ERROR );
  $band=$_GET['band'];
  $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];

  $id_s =$_GET['id_saf'];
  
  include('dgti-mysql-var_dgti-beneficiarios.php');
  include('dgti-intranet-mysql_connect.php');  
  include('dgti-intranet-mysql_select_db.php');


  		

  include('incluir_siempre.php');
?>  
<html>

<body>
<div class="content">

   <FORM name="sampleform" action="indextesoreria.php?sec=retenciones/numero1" method="POST"  >


      <table width="95%" border="0" align="center"  cellpadding="4" cellspacing="0">
	  <tr class="g_sup_centro_002b1">
			<td width="37%"  height="24" >Ingresar Numero  </td>
			<td width="50%"  height="24">&nbsp;</td>
            <td width="5%"  align="right" ><a href='javascript:window.history.back()' class="ciclo-lista-txt"><font size="+1">X</font></a></td>
        </tr>
        <tr>
          <td height="39" colspan="3" align="right">&nbsp;</td>
        </tr>	

        <tr>
          <td></td>
         <td height="48" colspan="2" align="left" ><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Numero :</font>
        <input type="text" name="num" size=20 ></td>
          </tr>
          

        <tr>
          <td></td>
          <td colspan="2" align="center">
            <input type="hidden" name="bandera" value="P">
             <input type="hidden" name="vdir" value="<?php echo $vdir; ?>">
            <input type="submit" name="Submit" value="   Actualizar ">          </td>
        </tr>
  </table>
</form>
<br> 
</div>
<div class="sidenav">


</div>
</body>
</html>
