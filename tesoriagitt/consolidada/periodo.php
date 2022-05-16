<?php
 error_reporting ( E_ERROR );
  $vdir=$_GET['valor'];
  $dato=$_GET['dato'];
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

	
<FORM name="form" action="indextesoreria.php?sec=consolidada/carga_orden_pagadas&apli=orden&per=C" method="POST" >
<input type="hidden" name="dato" value="<?php echo $dato;?>">
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
            <select name="diad" id="diad" class="style11">
            <option  value="0" >D&Iacute;A</option>
            <?php
                
              
                                $diahtml="";
                                for ($i=1; $i<32; $i++)
                                {
                                        $diahtml= $i; if ($i<10) {$diahtml= "0".$i;}
                                        echo "<option value='$diahtml'";
                                        echo ">".$diahtml."</option>";
                                } ?>
          </select>
            <select name="mesd" id="mesd" class="style11">
              <option  value="0">MES</option>
              <?php
                                 $meses= array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto',
                                        'Septiembre','Octubre','Noviembre','Diciembre');
                                $meshtml="";
                                for ($i=1;$i<13;$i++)
                                {
                                $meshtml= $i; if ($i<10) {$meshtml= "0".$i;}
                                echo "<option value='$meshtml'";
                                echo ">".$meses{$i-1}."</option>";
                                } ?>
            </select>
            <select name="anod" id="anod"  class="style11" onChange="calcular_fecha()">
              <option  value="0">A&Ntilde;O</option>
              <?php
                        $fechaactual=strtotime('now');
                        $anioactual=substr(date('d/m/Y',$fechaactual),6,4);
                        for ($i=1;$i<4;$i++)
                        {
                        echo "<option value='$anioactual'";
                        echo ">".$anioactual."</option>";
                        $anioactual=$anioactual-1;
                        }
 
                        ?>
            </select>
          </td>
          </tr>
           <td></td>
          <td height="45" colspan="2" align="left" > 
          <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Hasta: </font>
          <select name="diah" id="diah" class="style11">
            <option  value="N" >D&Iacute;A</option>
            <?php
                
              
                                $diahtml="";
                                for ($i=1; $i<32; $i++)
                                {
                                        $diahtml= $i; if ($i<10) {$diahtml= "0".$i;}
                                        echo "<option value='$diahtml'";
                                        echo ">".$diahtml."</option>";
                                } ?>
          </select>
          <select name="mesh" id="select2" class="style11">
            <option  value="0">MES</option>
            <?php
                                 $meses= array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto',
                                        'Septiembre','Octubre','Noviembre','Diciembre');
                                $meshtml="";
                                for ($i=1;$i<13;$i++)
                                {
                                $meshtml= $i; if ($i<10) {$meshtml= "0".$i;}
                                echo "<option value='$meshtml'";
                                echo ">".$meses{$i-1}."</option>";
                                } ?>
          </select>
          <select name="anoh" id="select3"  class="style11" onChange="calcular_fecha()">
            <option  value="0">A&Ntilde;O</option>
            <?php
                        $fechaactual=strtotime('now');
                        $anioactual=substr(date('d/m/Y',$fechaactual),6,4);
                        for ($i=1;$i<4;$i++)
                        {
                        echo "<option value='$anioactual'";
                        echo ">".$anioactual."</option>";
                        $anioactual=$anioactual-1;
                        }
 
                        ?>
          </select></td>
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

<ul>
	
    <li><a href="indextesoreria.php?sec=contaduria/contra&apli=orden&per=C" >Cambiar Contraseña</a></li>
   
</ul>

</div>
</body>
</html>
