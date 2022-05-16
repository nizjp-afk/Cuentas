<?php
error_reporting ( E_ERROR ); 
  $id=$_GET['id'];
  $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];

  include('incluir_siempre.php');
?>  
<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
	if (form.conv.value == "N")
	{ alert("Por favor Seleccione un Convenio"); form.conv.focus(); return; }
	
	if (form.diad.value == "0")
	{ alert("Por favor ingrese bien la Fecha"); form.diad.focus(); return; }
	
	if (form.mesd.value == "0")
	{ alert("Por favor ingrese bien la Fecha"); form.mesd.focus(); return; }
	
	if (form.anod.value == "0")
	{ alert("Por favor ingrese bien la Fecha"); form.anod.focus(); return; }
	
	if (form.diah.value == "0")
	{ alert("Por favor ingrese bien la Fecha"); form.diah.focus(); return; }
	
	if (form.mesh.value == "0")
	{ alert("Por favor ingrese bien la Fecha"); form.mesh.focus(); return; }
	
	if (form.anoh.value == "0")
	{ alert("Por favor ingrese bien la Fecha"); form.anoh.focus(); return; }
	
	
	form.submit();
}
</script>
</head>
<body>
<div class="content">
<?php 
  if ($vdir=='D')
    {
?>
   <FORM name="sampleform" action="indextesoreria.php?sec=retenciones_saf/ver_retenciones&apli=<?php echo $aplicacion;?>&per=<?php echo $permisosnecesarios;?>" method="POST" >
<?php
	}
 else
    {
?>
	
<FORM name="sampleform" action="indextesoreria.php?sec=retenciones_saf/ver_retenciones&apli=<?php echo $aplicacion;?>&per=<?php echo $permisosnecesarios;?>" method="POST" >
<?php
	}
?>	
      <table width="87%" border="0" align="center"  cellpadding="4" cellspacing="0">
	  <tr class="g_sup_centro_002b1">
			<td width="28%"  height="24" >Seleccione el Periodo  </td>
			<td width="68%"  height="24">&nbsp;</td>
            <td width="4%"  align="right" ><a href='javascript:window.history.back()' class="ciclo-lista-txt"><font size="+1">X</font></a></td>
        </tr>
        <tr>
          <td height="39" colspan="3" align="right">&nbsp;</td>
        </tr>	

        <tr>
          <td></td>
           <td height="48" colspan="2" align="left" ><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Desde :</font>
        <input type="text" name="firstinput" size=20 readonly> <small><a href="javascript:showCal('Calendar1')"><img src="img/calendar.png" width="22" height="22" border="0" align="absbottom" /></a></small>
          </td>
          </tr>
          <tr>
           <td></td>
          <td height="45" colspan="2" align="left" > 
          <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Hasta : </font>
          <input type="text" name="secondinput" size=20 readonly> <small><a href="javascript:showCal('Calendar2')"><img src="img/calendar.png" width="22" height="22" border="0" align="absbottom" /></a></small></td>
        </tr>	




        <tr>
          <td></td>
          <td colspan="2" align="center">
            <input type="hidden" name="bandera" value="P">
             <input type="hidden" name="id" value="<?php echo $id; ?>">
             
            <input type="submit" name="Submit" value="   Ver   "  onClick="Validar(this.form)">          </td>
        </tr>
  </table>
</form>
<br> 
</div>

</body>
</html>
