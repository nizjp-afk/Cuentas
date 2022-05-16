<?php
error_reporting ( E_ERROR );
  $vdir=$_GET['valor'];
  $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];

  $id_s =$_GET['id_saf'];
  
  $band=$_GET['ban'];
   
   include('dgti-mysql-var_dbtgp.php');
	 include('dgti-intranet-mysql_connect.php');  
	 include('dgti-intranet-mysql_select_db.php');
	 
if($band=='E') 
  {
	  $ssql = "SELECT * from escritural ORDER BY `ESCRITURAL` ASC";
     if (!($r_saf= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
  }
 if ($band=='ES')
   {	 
	 
$ssql = "SELECT * from escritural where ESTADO='A' and SAF='$nrosaf' ORDER BY `ESCRITURAL` ASC";
     if (!($r_saf= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }

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
<?php
if($band=='C')
  {
  ?>
   <FORM name="sampleform" action="contaduria/excelmodicta.php" method="POST" target="_blank" >
<?php
}
if($band=='E')
  {
  ?>
   <FORM name="sampleform" action="contaduria/excelescritural.php" method="POST" target="_blank" >
<?php
}
if($band=='ES')
  {
  ?>
   <FORM name="sampleform" action="saf/excelescritural.php" method="POST" target="_blank" >
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
  <?php if(($band=='E') or ($band=='ES'))
   {
   ?>
 <tr>
           <td>&nbsp;</td>
          <td height="45" colspan="2" align="left" > 
          <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">ESCRITURAL: </font>
        <select name="saf" onChange="slctryole(this,this.form.cuenta)">
					<option value="N" selected >Sin Especificar</option>
<?php     
       
                    while ($f_saf = mysql_fetch_array ($r_saf))
                           {
							   $esc_s=explode('-',$f_saf['ESCRITURAL']);
	                           $escritural= $esc_s[1].''.$esc_s[0].''.$esc_s[2];
							   
                      
?>
<OPTION  value="<? echo $f_saf['ESCRITURAL']; ?>"> <? echo $f_saf['ESCRITURAL'].' '.$f_saf['DENOMINACION'];?></font></OPTION>
               
             <?php
			      }
				  ?>
                </select>  
         </td>
        </tr>
 <?php
 }?>

        <tr>
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
