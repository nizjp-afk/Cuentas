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
 if($band=='S')
  {
?>	  
   <FORM name="sampleform" action="retenciones/txtsicore_nro_backup.php" method="POST" target="_blank" >
<?php
  }
 elseif($band=='SS')
   {
?>	  
   <FORM name="sampleform" action="retenciones/txtsijp_web.php" method="POST" target="_blank" >
<?php
   }
   elseif($band=='SE')
   {
?>	  
   <FORM name="sampleform" action="retenciones/txtsijp_exe.php" method="POST" target="_blank" >
<?php
   }
    elseif($band=='SG')
   {
?>	  
   <FORM name="sampleform" action="retenciones/txtsijp.php" method="POST" target="_blank" >
<?php
   }
 elseif($band=='CS')
   {
?>	  
   <FORM name="sampleform" action="indextesoreria.php?sec=retenciones/beneficiarios_consulta_aprobado&apli=cr&per=C" method="POST"  >
<?php
  }
  elseif($band=='CBS')
   {
?>	  
   <FORM name="sampleform" action="indextesoreria.php?sec=retenciones/beneficiarios_consulta_constancia_ss&apli=orden&per=C" method="POST"  >
<?php
  }
  elseif($band=='CIT')
   {
?>	  
   <FORM name="sampleform" action="indextesoreria.php?sec=retenciones/beneficiarios_consulta_constancia_it&apli=cr&per=C" method="POST"  >
<?php
  }
  elseif($band=='CIP')
   {
?>	  
   <FORM name="sampleform" action="indextesoreria.php?sec=retenciones/beneficiarios_consulta_constancia_ip&apli=cr&per=C" method="POST"  >
<?php
  }
  elseif($band=='SP')
  {
?>	  
   <FORM name="sampleform" action="retenciones/txtsicore_fp.php" method="POST" target="_blank" >
<?php
  }
 elseif($band=='SSP')
   {
?>	  
   <FORM name="sampleform" action="retenciones/txtsijp_fp.php" method="POST" target="_blank" >
<?php
   }
 elseif($band=='CSP')
   {
?>	  
   <FORM name="sampleform" action="indextesoreria.php?sec=retenciones/beneficiarios_consulta_aprobado_fp&apli=cr&per=C" method="POST"  >
<?php
  }
   elseif($band=='CGT')
   {
?>	  
   <FORM name="sampleform" action="indextesoreria.php?sec=retenciones/beneficiarios_consulta_aprobado_gt&apli=cr&per=C" method="POST"  >
<?php
   }
 elseif($band=='CGP')
   {
?>	  
   <FORM name="sampleform" action="indextesoreria.php?sec=retenciones/beneficiarios_consulta_aprobado_gp&apli=cr&per=C" method="POST"  >
<?php
  }
   elseif($band=='IBT')
   {
?>	  
    <FORM name="sampleform" action="retenciones/txtingbru_ft.php" method="POST" target="_blank" >
<?php
   }
 elseif($band=='IBP')
   {
?>	  
    <FORM name="sampleform" action="retenciones/txtingbru.php" method="POST" target="_blank" >
<?php
   }
   elseif($band=='IBC')
   {
?>	  
    <FORM name="sampleform" action="retenciones/txtib.php" method="POST" target="_blank" >
<?php
   }
 
 ?> 

      <table width="95%" border="0" align="center"  cellpadding="4" cellspacing="0">
	  <tr class="g_sup_centro_002b1">
			<td width="37%"  height="24" >Seleccione el Periodo  </td>
			<td width="50%"  height="24">&nbsp;</td>
            <td width="5%"  align="right" ><a href='javascript:window.history.back()' class="ciclo-lista-txt"><font size="+1">X</font></a></td>
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
             <input type="hidden" name="vdir" value="<?php echo $vdir; ?>">
            <input type="submit" name="Submit" value="   Ver   "  onClick="Validar(this.form)">          </td>
        </tr>
  </table>
</form>
<br> 
</div>
<div class="sidenav">


</div>
</body>
</html>
