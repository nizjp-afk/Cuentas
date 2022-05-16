<?php
error_reporting ( E_ERROR ); 
$id = $_GET['id'];
$m = $_GET['m'];
echo $espec = $_GET['espec'];
?>


<form name="form1" method="post" action="indextesoreria.php?sec=contaduria/bajapersona1&id=<?php echo $id; ?>">

<table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
 <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="50" rowspan="3" background="../img/ate_e.png">&nbsp;</td>
    <td width="247">&nbsp;</td>
  </tr>
  <tr>
    <td><span class="txt_dat_hora">DESEA ELIMINAR ESTOS DATOS?</span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="Submit" name="baja" value="ELIMINAR" ></td>
  </tr>
</table>

</form>
