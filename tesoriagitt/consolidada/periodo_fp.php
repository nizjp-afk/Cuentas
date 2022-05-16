<?php
  error_reporting ( E_ERROR );
  $vdir=$_GET['valor'];
  $valor=$_GET['dato'];
  $dato=$_GET['saf'];
  $sub_dato=$_GET['sub_saf'];
  $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];
  
  if (!($sub_dato=='N'))
      {
     $cuenta_saf=$dato.'-'.'Escritural'.'-'.$sub_dato;
   }
   else
   {
     $cuenta_saf=$sub_dato;
   }
  if($valor=='O')
    {
        $accion='Consulta Ordenes Pagadas Fondos Propios';
	 	$tabla='orden_pago_fp';
	 	include('agrego_movi.php'); 

	}
	
 if($valor=='S')
    {
        $accion='Consulta Escritural';
	 	$tabla='escritural';
	 	include('agrego_movi.php'); 

	}
	
if($valor=='SD')
    {
        $accion='Consulta Escritural';
	 	$tabla='escritural';
	 	include('agrego_movi.php'); 

	}	
  		
		
if($valor=='E')
    {
        $accion='Consulta Escritural';
	 	$tabla='escritural';
	 	include('agrego_movi.php'); 

	}			
  if($valor=='R')
    {
        $accion='Consulta Consolidado';
	 	$tabla='escritural';
	 	include('agrego_movi.php'); 
	}
	
 if($valor=='RE')
    {
        $accion='Consulta Cuenta Recaudadora';
	 	$tabla='escritural';
	 	include('agrego_movi.php'); 
	}	
	
	if($valor=='RS')
    {
        $accion='Consulta Cuenta Recaudadora';
	 	$tabla='escritural';
	 	include('agrego_movi.php'); 
	}	
    
     include('dgti-mysql-var_dbtgp.php');
	 include('dgti-intranet-mysql_connect.php');  
	 include('dgti-intranet-mysql_select_db.php');
	 
$ssql = "SELECT * from escritural   ORDER BY `saf` ASC";
     if (!($r_saf= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }


    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
	 
$ssql = "SELECT *
FROM `escritural` , cuentas_corrientes
WHERE `cod_proceso` =2
AND cuenta = num_cuenta
GROUP BY `num_cuenta` , `esc_cuenta`
ORDER BY `esc_cuenta` ASC , `num_cuenta` ";
     if (!($f_cuenta= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
 if (!($sub_dato=='N'))
  {

$ssql = "SELECT * FROM `escritural` , cuentas_corrientes  WHERE `cod_proceso` =2  AND cuenta =num_cuenta  And esc_cuenta ='$cuenta_saf'  GROUP BY `num_cuenta` , `esc_cuenta`   ORDER BY `num_cuenta` ASC ";
   
   
  }
 else
 {
	$ssql = "SELECT * FROM `escritural` , cuentas_corrientes  WHERE `cod_proceso` =2  AND cuenta =num_cuenta  And saf ='$dato'  GROUP BY `num_cuenta` , `esc_cuenta`   ORDER BY `num_cuenta` ASC "; 
 }
     if (!($r_cuenta_saf= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }




  include('incluir_siempre.php');
?>  

<script language='javascript' type='text/javascript'>

function slctr(texto,valor)
{
this.texto = texto
this.valor = valor
}
</script>

<?php
      // Generando localidades deacuerdo a la provincia seleccionada  
 $r_cuenta=mysql_fetch_array($f_cuenta);
	echo "<script language='javascript' type='text/javascript'>".chr(13).chr(10);
	$esc=explode('-',$r_cuenta['esc_cuenta']);
	$varaux= $esc[1].''.$esc[0].''.$esc[2];
	$esc_c=$esc[1].''.$esc[0].''.$esc[2];
	$cont=0;
	echo "var ". $esc_c."=new Array()".chr(13).chr(10);
	echo  $esc_c."[$cont] = new slctr('Seleccione Cuenta','N')".chr(13).chr(10);
	$cont++;
	$cuenta_den=trim($r_cuenta['num_cuenta']).' - '.trim($r_cuenta['denominacion']);
	echo  $esc_c."[$cont] = new slctr('".$cuenta_den."','".$r_cuenta['num_cuenta']."')";
	
	echo chr(13).chr(10);
	$cont++;
	while ($r_cuenta=mysql_fetch_array($f_cuenta))
  	{
		$esc=explode('-',$r_cuenta['esc_cuenta']);
		$esc_c_a=$esc[1].''.$esc[0].''.$esc[2];
		if ( $esc_c_a==$varaux)
		{
			$vcod= $esc[1].''.$esc[0].''.$esc[2];
			$cuenta_den=trim($r_cuenta['num_cuenta']).' - '.trim($r_cuenta['denominacion']);
			echo  $esc_c_a."[$cont] = new slctr('".$cuenta_den."','".$r_cuenta['num_cuenta']."')";
			echo chr(13).chr(10);
			$cont++;
		}
		else
		{
			$varaux= $esc[1].''.$esc[0].''.$esc[2];
			echo "var ". $esc_c_a."=new Array()".chr(13).chr(10);
			$cont=0;
			echo  $esc_c_a."[$cont] = new slctr('Seleccione Cuenta','N')".chr(13).chr(10);
			$cont++;
			$cuenta_den=trim($r_cuenta['num_cuenta']).' - '.trim($r_cuenta['denominacion']);
			echo  $esc_c_a."[$cont] = new slctr('".$cuenta_den."','".$r_cuenta['num_cuenta']."')";
			echo chr(13).chr(10);
			$cont++;
		}
	}
	echo "</script>";
	
?>

<script language='javascript' type='text/javascript'>
function slctryole(cual,donde)
{
if(cual.selectedIndex != 0)
{
donde.length=0
cual = eval(cual.value)
for(m=0;m<cual.length;m++)
{
var nuevaOpcion = new Option(cual[m].texto);
donde.options[m] = nuevaOpcion;
if(cual[m].valor != null)
{
donde.options[m].value = cual[m].valor
}
else{
donde.options[m].value = cual[m].texto
}
}
}
}

</script>


<div class="content">

<?php
   if($valor=='H')
    {
?>			
<FORM name="sampleform" action="consolidada/listado_ordenes_tgp_fp.php?apli=h&per=A" method="POST" target="_blank" >
<?php
	}

  if($valor=='t')
    {
?>			
<FORM name="sampleform" action="consolidada/listado_ordenes_tgp_fp.php?apli=tgpa&per=O" method="POST" target="_blank" >
<?php
	}

   if($valor=='E')
    {
?>			
<FORM  name="sampleform" action="consolidada/escritural_rango_tgp.php?apli=tgpa&per=O" method="POST" target="_blank" >
<?php
	}	

 if($valor=='S')
    {
?>			
<FORM name="sampleform" action="consolidada/escritural_rango.php?apli=s&per=E" method="POST" target="_blank" >
<?php
	}	    
if($valor=='O')
   {
?>	   	
<FORM name="sampleform" action="consolidada/listado_ordenes_fp.php?apli=orden&per=C" method="POST" target="_blank" >
<?php	
    }
if($valor=='R')
    {
?>			
<FORM name="sampleform" action="consolidada/resumen_rango_tgp.php?apli=tgpa&per=O" method="POST" target="_blank" >
<?php
	}	
if($valor=='SD')
    {
?>			
<FORM name="sampleform" action="consolidada/escritural_rango_d.php?apli=s&per=E" method="POST" target="_blank" >
<?php
	}	

if($valor=='ER')
    {
?>			
<FORM  name="sampleform" action="consolidada/escritural_recaudadora.php?apli=tgpa&per=O" method="POST" target="_blank" >
<?php
	}
		

if($valor=='RS')
    {
?>			
<FORM  name="sampleform" action="consolidada/escritural_recaudadora_saf.php?apli=tgpa&per=O" method="POST" target="_blank" >
<?php
	}
?>		
<input type="hidden" name="saf" value="<?php echo $dato;?>">
<input type="hidden" name="sub_saf" value="<?php echo $sub_dato;?>">


      <table width="103%" border="0" align="center"  cellpadding="4" cellspacing="0">
	  <tr class="g_sup_centro_002b1">
			<td width="22%"  height="24" ><?php 
if($valor!='GP')
{
	echo 'Seleccione el Periodo'; } else{ echo 'Seleccionar';}?>   </td>
			<td width="70%"  height="24">&nbsp;</td>
            <td width="8%"  align="right" ><a href='javascript:window.history.back()' class="ciclo-lista-txt"><font size="+1">X</font></a></td>
        </tr>
        <tr>
          <td height="39" colspan="3" align="right">&nbsp;</td>
        </tr>	
<?php 
if($valor!='GP')
{
	?>
        <tr>
          <td></td>
          <td height="48" colspan="2" align="left" ><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Desde :</font>
        <input type="text" name="firstinput" size=20 readonly="readonly"> <small><a href="javascript:showCal('Calendar1')"><img src="img/calendar.png" width="22" height="22" border="0" align="absbottom" /></a></small>
          </td>
          </tr>
          <tr>
           <td></td>
          <td height="45" colspan="2" align="left" > 
          <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Hasta : </font>
          <input type="text" name="secondinput" size=20 readonly="readonly"> <small><a href="javascript:showCal('Calendar2')"><img src="img/calendar.png" width="22" height="22" border="0" align="absbottom" /></a></small></td>
        </tr>	
<?php 
}
    if($valor=='E' or $valor=='ER' or $valor=='GP')
	  {
?>		  
   <tr>
           <td>&nbsp;</td>
          <td height="45" colspan="2" align="left" > 
          <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">ESCRITURAL: </font>
        <select name="saf" onchange="slctryole(this,this.form.cuenta)">
					<option value="N" selected >Sin Especificar</option>
<?php     
       
                    while ($f_saf = mysql_fetch_array ($r_saf))
                           {
							   $bandera=$f_saf['bandera'];
							   if($bandera=='N')
							   {
							   $esc_s=explode('-',$f_saf['ESCRITURAL']);
	                           $escritural= $esc_s[0].'-'.$esc_s[1].'-'.$esc_s[2];
							   
                      
?>
<OPTION  value="<?php echo $escritural; ?>"> <?php echo $f_saf['SAF'].'-'.$esc_s[2].'- '.$f_saf['DENOMINACION'];?></OPTION>
               
             <?php
							   }
							   else
							   {
							   $esc_s=explode('-',$f_saf['ESCRITURAL']);
	                           $escritural= $esc_s[1].''.$esc_s[0].''.$esc_s[2];
							   
                      
?>
<OPTION  value="<?php echo $escritural; ?>"> <?php echo $f_saf['ESCRITURAL'].' '.$f_saf['DENOMINACION'];?></OPTION>
               
             <?php
							   }
				  
				  }
				  ?>
                </select>  
         </td>
        </tr>
<?php
	  }
	?>  
<?php 

    if($valor=='ER')
	  {
?>
<tr>
           <td></td>
          <td height="45" colspan="2" align="left" > 
          <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Cuentas: </font>
 	  
   
         <select name="cuenta" id="cuenta">
					
<option value="N" selected >Sin Especificar</option>
                  </select>
  <?php
	
	  }
	  
	?>  
         </td>
        </tr>
        
        
    <?php 

    if($valor=='RS')
	  {
?>		  
   <tr>
           <td>&nbsp;</td>
          <td height="45" colspan="2" align="left" > 
          <font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Cuentas: </font>
        <select name="cuenta" >
					<option value="N" selected >Sin Especificar</option>
<?php     
       
                    while ($f_cuenta_saf = mysql_fetch_array ($r_cuenta_saf))
                           {
							  					   
                      	$cuenta_den=trim($f_cuenta_saf['num_cuenta']);
?>
<OPTION  value="<?php echo $cuenta_den; ?>"> <?php echo trim($f_cuenta_saf['num_cuenta']).' - '.trim($f_cuenta_saf['denominacion']);?></OPTION>
               
             <?php
			      }
				  ?>
                </select>  
         </td>
        </tr>
<?php
	  }
	?>  
    
        
        <tr>
          <td></td>
          <td colspan="2" align="center">
            <input type="hidden" name="bandera" value="P">
            <input type="hidden" name="vdir" value="<?php echo $vdir; ?>">
             <input type="hidden" name="saf_esc" value="<?php echo $cuenta_saf; ?>">
             
            <input type="hidden" name="s_o" value="<?php echo $dato; ?>" />
            <input type="submit" name="Submit" value="   Ver   "  onClick="Validar(this.form)">          </td>
        </tr>
        
        
        
        
        
  </table>
</form>
<br> 
</div>
<div class="sidenav">



</div>

