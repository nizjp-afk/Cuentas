<?php
error_reporting ( E_ERROR );
  $vdir=$_GET['valor'];
  $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];

  $id_s =$_GET['id_saf'];
  
  include('dgti-mysql-var_dgti-beneficiarios.php');
  include('dgti-intranet-mysql_connect.php');  
  include('dgti-intranet-mysql_select_db.php');


  	 $ssql = "SELECT *  FROM `nro_saf` order by numero";
     if (!($r_saf= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
	
	

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

   <FORM name="sampleform" action="hacienda/listado_pendientes_ft_cons.php?apli=<?php echo $aplicacion;?>&per=<?php echo $permisosnecesarios;?> " method="POST" target="_blank" >

      <table width="95%" border="0" align="center"  cellpadding="4" cellspacing="0">
	  <tr class="g_sup_centro_002b1">
			<td width="37%"  height="24" >Seleccionar</td>
			<td width="50%"  height="24">&nbsp;</td>
            <td width="5%"  align="right" ><a href='javascript:window.history.back()' class="ciclo-lista-txt"><font size="+1">X</font></a></td>
        </tr>
        <tr>
          <td height="39" colspan="3" align="right">&nbsp;</td>
        </tr>	
   <tr>
           <td></td>
          <td height="45" colspan="2" align="left" > 
          <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">SAF: </font>
         <select name="saf">
					<option value="N" selected >Sin Especificar</option>
<?php     
       
                    while ($f_saf = mysql_fetch_array ($r_saf))
                           {
                      
?>
<OPTION value="<? echo $f_saf['saf_id'] ?>"> <? echo $f_saf['numero'].' - '.$f_saf['nombre']?></OPTION>
               
             <?php
			      }
				  ?>
                  </select>
         </td>
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
