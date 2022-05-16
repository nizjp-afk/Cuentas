<?php
  session_name('valido');
  session_start();
  if (!isset($_SESSION['vps_regresar']))
    {
      $regresar = "/hospital_clinicas";
    }
  else
    {
      $regresar = $_SESSION['vps_regresar'];
    }
  unset($_SESSION['vps_regresar']);
?>


<table width="450" border="0" align="center" cellpadding="5" cellspacing="1">
    <tr>
      
    <td height="173" align="center" ><blockquote>
   
    </blockquote>      <p class="Estilo1"><img src="img/atencion.png" width="128" height="128"></p>
    <p ><font color="#FF0000" size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong>&iexcl;&iexcl; ATENCION !!</strong><br>
          Ud. 
            no posee autorizaci&oacute;n para<br>
            hacer uso de esta opci&oacute;n...</font></p>
    <p><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
        Solic&iacute;tela al personal <br>
      <strong>Responsable del Sistema </strong></font></p>
      <p><font color="#FF0000" size="1" face="Verdana, Arial, Helvetica, sans-serif"><?php echo '<a style="color:#FF0000 href="'.$regresar.'">' ?>Elija 
        esta opci&oacute;n<?php echo "</a>" ?> si la pantalla no cambia autom&aacute;ticamente<br>
        <br>
      </font></p>
      </td>
    </tr>
  </table>
