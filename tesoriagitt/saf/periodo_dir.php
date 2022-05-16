<?php
error_reporting ( E_ERROR );
  $vdir=$_GET['valor'];
  $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];

  $id_s =$_GET['id_saf'];
  $dato =$_GET['dato'];
  
  include('dgti-mysql-var_dgti-beneficiarios.php');
  include('dgti-intranet-mysql_connect.php');  
  include('dgti-intranet-mysql_select_db.php');

 if($valor=='P')
    {
        $accion='Consulta Ordenes Pagadas Fondos Propios';
	 	$tabla='orden_pago_fp';
	 	include('agrego_movi.php'); 

	}
	
 if($valor=='E')
    {
        $accion='Consulta Escritural';
	 	$tabla='escritural';
	 	include('agrego_movi.php'); 

	}
	
if($valor=='D')
    {
        $accion='Consulta Ordenes Pendientes Fondos Propios';
	 	$tabla='orden_pago dbtgp';
	 	include('agrego_movi.php'); 

	}	
  		
 if ($dato=='P')
   {  	
  $ssql = "SELECT *  FROM `saf_escritural` where origen='$id_s' AND ESTADO='A' ORDER BY `ESCRITURAL` ASC";
     if (!($r_saf= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
     }
   }
  else
   {  	
  $ssql = "SELECT *  FROM `saf_escritural` where origen='$id_s' and grupo='1' ORDER BY `ESCRITURAL` ASC";
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

   if($dato=="T")
     {
?>		 
   <FORM name="sampleform" action="ordenes/listado_ordenes_ft_o.php?apli=orden&per=C" method="POST" target="_blank" >
   
 <?php
	 }
if($dato=="TE")
     {
?>		 
   <FORM name="sampleform" action="saf/listado_ordenes_fte.php?apli=orden&per=C" method="POST" target="_blank" >
   
 <?php
	 }	 


if($dato=="PE")
     {
?>		 
   <FORM name="sampleform" action="saf/listado_ordenes_ftp.php?apli=orden&per=C" method="POST" target="_blank" >
   
 <?php
	 }	 


if($dato=="P")
     {
?>
  <FORM name="sampleform" action="consolidada/listado_ordenes_fp_o.php?apli=orden&per=C" method="POST" target="_blank" >

  
  <?php
	 }
if($dato=="E")
    {
?>			
<FORM name="sampleform" action="consolidada/escritural_rango_dir.php?apli=s&per=E" method="POST" target="_blank" >
<?php
	}	
if($dato=="G")
     {
?>
  <FORM name="sampleform" action="indextesoreria.php?sec=saf/carga_orden_pagadas_dir_fp&apli=orden&per=C" method="POST" >
  
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
          <td height="45" colspan="2" align="left" > 
          <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">SAF: </font>
         <select name="saf">
					<option value="N" selected >Sin Especificar</option>
<?php     
       
                    while ($f_saf = mysql_fetch_array ($r_saf))
                           {
                      
?>
<OPTION <?php if ($dato =='E'){?> value="<? echo $f_saf['ESCRITURAL'] ?>" <?php } else {?>value="<? echo $f_saf['ID'] ?>" <?php } ?> > <?php if($dato=='T'){?> <? echo $f_saf['SAF'].' '.$f_saf['DENOMINACION'];?> <?php } else { ?> <? echo $f_saf['SAF'].' '.$f_saf['ESCRITURAL'].' '.$f_saf['DENOMINACION'];?><?php } ?></OPTION>
               
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
              <input type="hidden" name="origen" value="<?php echo $id_s; ?>">
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
