<?php
error_reporting ( E_ERROR );
  $dato=$_GET['dato'];
  $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];

  $id_s =$_GET['id_saf'];
  
 
	
	

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
  if($dato=='I')
  {
   ?>

 <FORM name="form" action="clasificador/informe_sueldos.php?&apli=tgpa&per=T" method="POST" target="_blank" >
      <table width="87%" border="0" align="center"  cellpadding="4" cellspacing="0">
	  <tr class="g_sup_centro_002b1">
			<td width="28%"  height="24" >Seleccionar Periodo</td>
			<td width="87%"  height="24">&nbsp;</td>
            <td width="54%"  align="right" ><a href='javascript:window.history.back()' class="ciclo-lista-txt"><font size="+1">X</font></a></td>
        </tr>
        <tr>
          <td height="39" align="right">&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>	

    <tr>
          <td height="39" align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Periodo Desde :</font></td>
          <td colspan="2"> <select name="mes" id="mes" class="style11">
        <option  value="---">MES</option>
        <?php
                                 $meses= array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto',
                                        'Septiembre','Octubre','Noviembre','Diciembre');
                                $meshtml="";
                                for ($i=1;$i<13;$i++)
                                {
                                $meshtml= $i; if ($i<10) {$meshtml= "0".$i;}
                                echo "<option value='$meshtml'";
								if($meshtml==($mes-1)){echo "selected";}
								 
                                echo ">".$meses{$i-1}."</option>";
                                } ?>
      </select>
      <select name="anio" id="anio"  class="style11" >
      
        <?php
                        $fechaactual=strtotime('now');
                        $anioactual=substr(date('d/m/Y',$fechaactual),6,4);
                        for ($i=1;$i<3;$i++)
                        {
                        echo "<option value='$anioactual' ";
						if($anioactual==$aa){echo "selected";}
                        echo ">".$anioactual."</option>";
                        $anioactual=$anioactual-1;
                        }
 
                        ?>
      </select>
          
        </tr>

		   


        <tr>
          <td colspan="3" align="center">
            
            <input type="submit" name="Submit" value="   Ver   "  onClick="Validar(this.form)">          </td>
        </tr>
  </table>
</form>
<?php  
  }
 elseif($dato=='D')
  {
   ?>

 <FORM name="form" action="clasificador/informe_detallado_sueldos.php?&apli=tgpa&per=T" method="POST" target="_blank" >
      <table width="87%" border="0" align="center"  cellpadding="4" cellspacing="0">
	  <tr class="g_sup_centro_002b1">
			<td width="28%"  height="24" >Seleccionar Periodo</td>
			<td width="87%"  height="24">&nbsp;</td>
            <td width="54%"  align="right" ><a href='javascript:window.history.back()' class="ciclo-lista-txt"><font size="+1">X</font></a></td>
        </tr>
        <tr>
          <td height="39" align="right">&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>	

    <tr>
          <td height="39" align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Periodo Desde :</font></td>
          <td colspan="2"> <select name="mes" id="mes" class="style11">
        <option  value="---">MES</option>
        <?php
                                 $meses= array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto',
                                        'Septiembre','Octubre','Noviembre','Diciembre');
                                $meshtml="";
                                for ($i=1;$i<13;$i++)
                                {
                                $meshtml= $i; if ($i<10) {$meshtml= "0".$i;}
                                echo "<option value='$meshtml'";
								if($meshtml==($mes-1)){echo "selected";}
								 
                                echo ">".$meses{$i-1}."</option>";
                                } ?>
      </select>
      <select name="anio" id="anio"  class="style11" >
      
        <?php
                        $fechaactual=strtotime('now');
                        $anioactual=substr(date('d/m/Y',$fechaactual),6,4);
                        for ($i=1;$i<3;$i++)
                        {
                        echo "<option value='$anioactual' ";
						if($anioactual==$aa){echo "selected";}
                        echo ">".$anioactual."</option>";
                        $anioactual=$anioactual-1;
                        }
 
                        ?>
      </select>
          
        </tr>

		   


        <tr>
          <td colspan="3" align="center">
            
            <input type="submit" name="Submit" value="   Ver   "  onClick="Validar(this.form)">          </td>
        </tr>
  </table>
</form>
<?php  
  } 
  elseif($dato=='M')
   {
?>	    
  <FORM name="sampleform" action="indextesoreria.php?sec=clasificador/carga_orden_pagadas_muni&apli=tgpa&per=T" method="POST"  >
  

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
  <?php  
  } 
  else
  {
?>	    
  <FORM name="sampleform" action="indextesoreria.php?sec=clasificador/carga_orden_pagadas_dir&apli=tgpa&per=T" method="POST"  >
  

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
<?php
  }
  ?>
<br> 
</div>
<div class="sidenav">


</div>
</body>
</html>
