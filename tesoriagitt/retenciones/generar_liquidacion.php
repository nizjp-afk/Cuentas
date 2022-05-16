 <?php
error_reporting (E_ERROR); 
$aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
	 include('incluir_siempre.php');

//conexion
	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	
  if(($_POST['regimen']!='N') and ($_POST['seguridad']!='N') and ($_POST['ingreso']!='N')
	 and($_POST['ganancia']!='N') )
    {
 // echo '<br>';
      
   
   $idbene = $_POST['id_b'];
   $id = $_POST['id_o'];
  // $orden = $_POST['orden'];
   $ing_bruto = $_POST['ingreso_bruto_b'];
   $band = $_POST['band'];
  //variable para determinar si esta inscripto o no
   $id_ganancia=$_POST['ganancia_b'];
    $fecha_t=$_POST['fecha_t'];
   
   $ssql = "SELECT * FROM alicuota order by nombre ";
     if (!($r_alicuota= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de iva";
      echo $cuerpo1;
      //.....................................................................
    }   
	
	 $ssql = "SELECT * FROM anexoss";
				 if (!($r_ss= mysql_query($ssql, $conexion_mysql)))
				{
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar buscar tipo de iva";
				  echo $cuerpo1;
				  //.....................................................................
				}   

 
  
if ($band=='M')
  {
   $regimen = $_POST['regimen'];
 // echo '<br>';
   $seguridad = $_POST['seguridad'];
   $ganancia = $_POST['ganancia'];
   $ingreso = $_POST['ingreso'];
   $iva_situacion = $_POST['iva_situacion'];
  
  $ssql = "UPDATE beneficiarios_aprobados SET 
           ganancia='$ganancia',
		   regimen='$regimen',
		   seguridad='$seguridad',
		   ingreso='$ingreso',
		   iva_situacion='$iva_situacion',
		   sipaf_m='M'
		   WHERE id_beneficiario='$idbene'";
				 if (!($r_beneficiarios = mysql_query($ssql,$conexion_mysql)))
				 {
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar dar de alta un beneficiario";
					  echo $cuerpo1;
						   exit;
					  //.....................................................................
				 }
				 
				 $accion='Cambio Situacion Beneficiario id'.': '.$idbene;
		  $tabla='beneficiarios_aprovados';
		  include('agrego_movi.php');  	 
				 
}				 
		$ssql = "SELECT * FROM `beneficiarios_aprobados` WHERE id_beneficiario='$idbene'";
     if (!($r_beneficiario= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }    
	 $f_beneficiario= mysql_fetch_array ($r_beneficiario);
	 $fecha_aprobacion = $f_beneficiario['fecha_aprobacion']; 
	 $id_ganancia = $f_beneficiario['ganancia']; 
	 $ing_bruto = $f_beneficiario['ingreso']; 
	 $seguridad = $f_beneficiario['seguridad']; 
     $iva_situacion = $f_beneficiario['iva_situacion'];	  
	 $ganancia = $f_beneficiario['ganancia'];	  
		//  $alicuota = $f_beneficiario['alicuota'];	  
	 $ingreso = $f_beneficiario['ingreso'];
     $regimen = $f_beneficiario['regimen'];
	 $seguridad = $f_beneficiario['seguridad'];  
    
		
   if ($id_ganancia=='1')
	   {
		   	$ssql = "SELECT id_rg,codigo,inscripto,nosujeto,observacion FROM anexorg830   ";
				 if (!($r_rg= mysql_query($ssql, $conexion_mysql)))
				{
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar buscar tipo de iva";
				  echo $cuerpo1;
				  //.....................................................................
				}   
	   }
	 else
	    {
		   	$ssql = "SELECT id_rg,codigo,noinscripto,nosujeto,observacion FROM anexorg830   ";
				 if (!($r_rg= mysql_query($ssql, $conexion_mysql)))
				{
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar buscar tipo de iva";
				  echo $cuerpo1;
				  //.....................................................................
				}   
	   }
	 $ssql = "SELECT  * FROM regimen where id_regimen='$regimen'   ";
				 if (!($r_ib= mysql_query($ssql, $conexion_mysql)))
				{
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar buscar tipo de iva";
				  echo $cuerpo1;
				  //.....................................................................
				} 	
				
	 $f_ib= mysql_fetch_array ($r_ib);
	 $alicuotaib = $f_ib['alicuota']; 
     $nosujetoib = $f_ib['base'];   
	
 
 
	   
 
 $ssql = "SELECT  `beneficiarios_aprobados`.`cuitl` , `beneficiarios_aprobados`.`apellido` ,
	         `beneficiarios_aprobados`.`nombre` , `beneficiarios_aprobados`.`razon_social` ,
			 `ganancias`.`nombre` AS gan, `ingreso_bruto`.`nombre` AS inbru, 
			 `iva`.`nombre` AS siva, `regimen`.`nombre` AS reg, 
			 `seguridad_social`.`nombre` AS seguridad
			FROM `seguridad_social` , `beneficiarios_aprobados` , `ganancias` , `ingreso_bruto` ,
			`iva` , `regimen`
			WHERE 
			  (
			    (`beneficiarios_aprobados`.`id_beneficiario` ='$idbene')
				AND (`ganancias`.`id_ganancia` = ganancia)
				AND (`ingreso_bruto`.`id_ingreso` = ingreso)
				AND (`iva`.`id_iva` = iva_situacion)
				AND (`regimen`.`id_regimen` = regimen)
				AND (`seguridad_social`.`id_seguridad` = seguridad)
			)";
     if (!($r_situacion= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }    
	$f_situacion= mysql_fetch_array ($r_situacion);

	 /*echo '<br>';
	echo $idbene = $f_beneficiario['id_beneficiario'];
     echo '<br>';
	 // $orden = $f_beneficiario['orden'];
     echo '<br>';
	 echo $regimen = $f_beneficiario['regimen'];
     echo '<br>';
	 echo $seguridad = $f_beneficiario['seguridad'];
     echo '<br>';
	 echo $ganancia = $f_beneficiario['ganancia'];
     echo '<br>';
	 echo $ingreso = $f_beneficiario['ingreso'];
     echo '<br>';
	 echo $iva_situacion = $f_beneficiario['iva_situacion'];

exit;*/

     
			  
			  
			  $ssql = "SELECT * FROM op_pendientes 
			            where id='$id'";
			 if (!($r_ord= mysql_query($ssql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar tipo de iva";
					  echo $cuerpo1;
					  //.....................................................................
					}  
	
	       $f_orden =  mysql_fetch_array($r_ord);
			
			 $cant = mysql_num_rows($r_ord);
			 
			 if ($cant > 0)
			   {
			
			  $orden=$f_orden['Numero_OP'];
			  $op_saf=$f_orden['Saf'];
			  $total=$f_orden['total_orden'];
			  $fecha=$f_orden['Fecha_OP'];	
			  $ejer_op=$f_orden['Ejercicio'];      
			   }
			   
			$sql="SELECT * FROM historial_orden
			            where numero_op='$orden'
						and ejercicio='$ejer_op'
						and saf='$op_saf' ";

       if (!($r_obser = mysql_query($sql, $conexion_mysql)))
         {
            //.....................................................................
            // INFORMA  DE ERROR PRODUCIDO//
            $cuerpo1  = "al intentar insertar examen fisico";
            $cuerpo2  = "Base de datos                 = ".$mysql_basededatos.$emaillinea;
            $cuerpo2 .= "Sentencia sql                 = ".$ssql.$emaillinea;
           echo $cuerpo1;
            exit;
            //.....................................................................
         }  
		$f_obser = mysql_fetch_array($r_obser); 
		$obser = nl2br($f_obser['observacion']);

			 
			  
   //$concepto_partida=$inciso.'-'.$principal.'-'.$parcial.'-'.'0';
	
   



?>
 

<html>
<script language="javascript1.2" type="text/javascript">

function mostrar()
    {
     var idrg = document.sampleform.rg.value;
	 document.sampleform.rgh.value = idrg;
	 var cneto= document.sampleform.neto.value;
	 var ganancia= document.sampleform.ganancia.value;
	 valor=buscarm(idrg);
	 valor1=buscarb(idrg);
	// if(idrg==12)
	 //{
		//    document.sampleform.retencion.disabled=false;
	 //}
	 if (valor== null)
	   {
		   valor=""; 
	   }
	  if (valor1== null)
	   {
		   valor1=""; 
	   }  
	 document.sampleform.minimorg.value = valor1;
	 if (ganancia==1)
	    {
	     if (cneto > valor1)
	       {
			 document.sampleform.alicuotarg.value =redondear(valor,2);
			 base=cneto - valor1;
			 document.sampleform.baserg.value= base;
			 retencionrg=(base *(1 + valor / 100))-base;
			if(retencionrg >= 20)
		   {
		   document.sampleform.retencion.value=  redondear(retencionrg,2);
		   }
		  else
		   {
			document.sampleform.retencion.value ="0.00";
		    document.sampleform.obser_ganancia.value =redondear(retencionrg,2)+" - Importe menor a $20.00";
		   }
			
	 
		   }
	     else
	       {
			document.sampleform.alicuotarg.value =redondear(valor,2);
			document.sampleform.baserg.value= 0;
			retencionrg=0
			document.sampleform.retencion.value=  redondear(retencionrg,2);   
		   
	       }
	   }
	 else
	  {
	     
			 document.sampleform.alicuotarg.value =redondear(valor,2);
			 var alicuota= document.sampleform.alicuotarg.value;
			 base=cneto ;
			 document.sampleform.baserg.value= base;
			 retencionrg=cneto * (valor / 100);
			
			 document.sampleform.retencion.value=  redondear(retencionrg,2);
	 
		  
	  
	  }
	   	   
		
	}


 function buscarm(idrg)
    {
  if (idrg != null)
	       {
<?php				   
     mysql_data_seek($r_rg,0);
	   while ($f_rg = mysql_fetch_array ($r_rg))
	      {
		   $idrgbase=$f_rg['id_rg'];
?>		   
		   idrgbase=<?php echo $idrgbase; ?>;
		   
		   if (idrgbase == idrg) 
		     {
<?php 
           $valor= $f_rg[2];
		   
?>		   
		  
		     return <?php echo $valor; ?>;
			}
<?php    
        
		} 
?>		
	  }
	  
	}
	
 function buscarb(idrg)
    {
  if (idrg != null)
	       {
<?php				   
     mysql_data_seek($r_rg,0);
	   while ($f_rg = mysql_fetch_array ($r_rg))
	      {
		   $idrgbase=$f_rg['id_rg'];
?>		   
		   idrgbase=<?php echo $idrgbase; ?>;
		   
		   if (idrgbase == idrg) 
		     {
<?php 
           $valor1= $f_rg[3];
		   
?>		   
		  
		     return <?php echo $valor1; ?>;
			}
<?php    
        
		} 
?>		
	  }
	  
 }
<!--funcion para calcular el neto teniendo el valor del monto totoal de la orden y el iva -->
function calcularneto()
    {
			
     document.sampleform.rg.disabled=false;		
     document.sampleform.minimorg.value = "";
	 document.sampleform.alicuotarg.value = "";
	 document.sampleform.baserg.value= "";
     document.sampleform.retencion.value= "";
	 document.sampleform.rg.selectedIndex = 0;
	 document.sampleform.ss.selectedIndex = 0;
	 document.sampleform.alicuotass.value = "";
	 document.sampleform.basess.value= "";
     document.sampleform.retencionss.value= "";
     var valoriva = document.sampleform.iva.value;
	 var valormonto = document.sampleform.monto.value;
	 if(valoriva==9.99)
	   { 
	     var totalneto =document.sampleform.neto.value;
	   }
	  else
	   {
		   var totalneto =valormonto / (1 + valoriva / 100); 
	   }
	 document.sampleform.neto.value = redondear(totalneto,2);
	 document.sampleform.imponibless.value = redondear(totalneto,2);
	 document.sampleform.imponibleib.value = redondear(totalneto,2);
	 var alicib = document.sampleform.alicuotaib.value;
	 var bib = document.sampleform.imponibleib.value;
	 var baseib = document.sampleform.baseib.value;
	 var cneto= document.sampleform.neto.value; 
	 var retencionib =cneto*alicib/100;
	   
		    document.sampleform.retencionib.value =redondear(retencionib,2);
	
	 
	 
	}
	
	function calcularnetoss()
    {
		
	  var valoriva = document.sampleform.iva.value;
	  var vneto = document.sampleform.neto.value;
	  document.sampleform.rg.disabled=false;		
	  document.sampleform.minimorg.value = "";
	  document.sampleform.alicuotarg.value = "";
	  document.sampleform.baserg.value= "";
	  document.sampleform.retencion.value= "";
	  document.sampleform.rg.selectedIndex = 0;
	  var valormonto = document.sampleform.monto.value;
			
			 if(valoriva==9.99)
	            {
		          var totalneto =document.sampleform.neto.value;
	            }
	         else
	           {
		          var totalneto =valormonto / (1 + valoriva / 100); 
	           }
	  document.sampleform.neto.value = redondear(totalneto,2);	 
	  document.sampleform.imponibleib.value = redondear(totalneto,2);
	  var alicib = document.sampleform.alicuotaib.value;
	  var bib = document.sampleform.imponibleib.value;
	  var baseib = document.sampleform.baseib.value;
	  var cneto= document.sampleform.neto.value; 
	  var retencionib =cneto*alicib/100;
	 
		    document.sampleform.retencionib.value =redondear(retencionib,2);
	    
	
			  	 
		
	  }
	  
	  
	function calcular_bi() 
    {
	
	  var alicib = document.sampleform.alicuotaib.value;
	  var baseib = document.sampleform.baseib.value;
	  var cneto= document.sampleform.imponibleib.value;
	  var retencionib =cneto*alicib/100;
	  
		    document.sampleform.retencionib.value =redondear(retencionib,2);
	  
	   
	
			  	 
		
	  }	  
	  
	
function redondear(cantidad, decimales)
    {
	var cantidad = parseFloat(cantidad);
	var decimales = parseFloat(decimales);
	
	decimales = (!decimales ? 2 : decimales);
	return Math.round(cantidad * Math.pow(10, decimales)) / Math.pow(10, decimales);
	} 
	
function mostrarss()
    {
	 document.sampleform.obser_retencionss.value="";	
     var idss = document.sampleform.ss.value;
	 var cneto= document.sampleform.neto.value;
	 valora=buscarss(idss);
	 valorr=buscarr(idss);
	 if (valora== null)
	   {
		   valora=""; 
	   }
	  if (valorr== null)
	   {
		   valorr=""; 
	   }  
	 document.sampleform.alicuotass.value = valora;
	  if (cneto > valorr)
	    {
		 document.sampleform.basess.value =redondear(valorr,2);
		 var bi = document.sampleform.imponibless.value;
		 var retencionss =bi*valora/100;
		 if(retencionss >= 40)
		   {
		    document.sampleform.retencionss.value =redondear(retencionss,2);
		   }
		  else
		   {
			document.sampleform.retencionss.value ="0.00";
		    document.sampleform.obser_retencionss.value =redondear(retencionss,2)+" - Importe menor a $40.00";
		   }
		   
	   }
	 else
	   {
		document.sampleform.basess.value =redondear(valorr,2);
		document.sampleform.retencionss.value =0;   
	   }
	}

 function buscarss(idss)
    {
  if (idss != null)
	       {
<?php				   
     mysql_data_seek($r_ss,0);
	   while ($f_ss = mysql_fetch_array ($r_ss))
	      {
		   $idssbase=$f_ss['id_ss'];
?>		   
		   idssbase=<?php echo $idssbase; ?>;
		   
		   if (idssbase == idss) 
		     {
<?php 
           $valora= $f_ss['retencion'];
		   
?>		   
		  
		     return <?php echo $valora; ?>;
			}
<?php    
        
		} 
?>		
	  }

		  
}
function buscarr(idss)
    {
  if (idss != null)
	       {
<?php				   
     mysql_data_seek($r_ss,0);
	   while ($f_ss = mysql_fetch_array ($r_ss))
	      {
		   $idssbase=$f_ss['id_ss'];
?>		   
		   idssbase=<?php echo $idssbase; ?>;
		   
		   if (idssbase == idss) 
		     {
<?php 
           $valorr= $f_ss['nosujeto'];
		   
?>		   
		  
		     return <?php echo $valorr; ?>;
			}
<?php    
        
		} 
?>		
	  }
	  
}
</script>
<div class="content">
<form action="indextesoreria.php?sec=retenciones/guardar_afip&apli=cr&per=R" method="post" name="sampleform">	
<input type="hidden" name="ganancia" value="<?php echo $ganancia; ?>">
<input type="hidden" name="seguridad" value="<?php echo $seguridad; ?>">
<input type="hidden" name="fecha_t" value="<?php echo $fecha_t; ?>" >


<input type="hidden" name="saf" value="<?php echo $op_saf; ?>" >
<input type="hidden" name="orden" value="<?php echo $orden; ?>" >
<input type="hidden" name="ejercicio" value="<?php echo $ejer_op; ?>" >
<input type="hidden" name="obser_1" value="<?php echo $obser; ?>" >
<input type="hidden" name="cuit" value="<?php  echo $f_beneficiario['cuitl']; ?>" >
<input type="hidden" name="rgh" value="">


<table border="0" align="center" >
 <tr height=10px>
    <td colspan="2">&nbsp; </td>
  </tr>
  <tr>
		<td height="49" colspan="2"><h2 align="center">MODULO DE IMPUESTOS Y RETENCIONES</h2></td>
	</tr>
   <tr height=10px>
    <td colspan="2"><hr /></td>
  </tr>
   <TR>	  
      <td colspan="2" class="subtitle"><div align="center"><strong>
        <?php if ($f_situacion['razon_social']=='')
	               {
				    echo $f_situacion['apellido']; echo $f_situacion['nombre']; 
								
					}
				else 
				   {
				    echo $f_situacion['razon_social']; }?>
        --- Nro. CUIL | CUIT:<?php  echo $f_beneficiario['cuitl']; ?></strong></div></td>
	  </TR>
   <tr height=10px>
    <td colspan="2"><hr /></td>
  </tr>
   <tr>
			<td width="146" class="subtitle">Situacion frente I.V.A.</td>
			<td width="387"><?php echo $f_situacion['siva']; ?>	</td>
	</tr>
	 <tr height=10px>
    <td colspan="2"><hr /></td>
  </tr>
		<tr>
			<td class="subtitle">Ganancia</td>
		  <td><?php echo $f_situacion['gan']; ?></td>
		</tr>
	 <tr height=10px>
    <td colspan="2"><hr /></td>
  </tr>	
		<tr>
			<td class="subtitle">Ingreso Bruto</td>
			<td><?php echo $f_situacion['inbru']; ?>  	</td>
		</tr>
		
		 <tr height=10px>
    <td colspan="2"><hr /></td>
  </tr>		

		<tr>
			<td class="subtitle">Regimen de Convenio  </td>
			<td><?php echo $f_situacion['reg']; ?></td>
		</tr>
		 <tr height=10px>
    <td colspan="2"><hr /></td>
  </tr>
		<tr>
			<td class="subtitle">Seguridad Social</td>
			<td><?php echo $f_situacion['seguridad']; ?>   	  	</td>
		</tr>
		
		
		 <tr height=10px>
    <td colspan="2"><hr /></td>
		<tr>
			<td class="subtitle">Orden de Pago</td>
			<td><?php echo $orden; ?>   	  	</td>
		</tr>
		
 </tr>
 
	 <tr height=10px>
    <td colspan="2"><hr /></td>
  </tr>
 	
		<tr>
			<td class="subtitle">Fecha Orden</td>
			<td><input type="text" name="firstinput" size=20 readonly> <small><a href="javascript:showCal('Calendar1')"><img src="img/calendar.png" width="22" height="22" border="0" align="absbottom" /></a></small> 	  	</td>
		</tr>
		
 </tr>
 
	 <tr height=10px>
    <td colspan="2"><hr /></td>
  </tr> 
	
</table>
 
<table height="113" border="0" align="center" cellpadding="0">
	<tr>
		<td height="46" ><H4>GANANCIA</H4></td>
		<td width="348">&nbsp;</td>
	</tr>
	
    <tr height=10px>
		<td height="10" colspan="2"></td>
	</tr>
		<tr bgcolor="#EAEAEA">
			<td height="25" colspan="2"><h4>1) Concepto OP </h4></td>
		</tr>
        
        <tr height=20px>
                    <td colspan="2"><hr></td>
      </tr>
</table>        
<table border="0" cellpadding="0" align="center">
  
  
  <tr>
        <td  > Monto Orden de Pago: 
        </td>
        <td><input type="text" name="monto" value="<?php echo $total; ?>" readonly></td> 
  </tr> 
   <tr>
        <td  > IVA: 
        </td>
        <td><select name="iva"  <?php if ($seguridad==2) { ?> onChange="calcularnetoss()" <?php }else {?> onChange="calcularneto()" <?php } ?> >
					<option value="N" selected >Sin Especificar</option>
<?php     
       
                    while ($f_alicuota = mysql_fetch_array ($r_alicuota))
                           {
?>
                       <option value="<?php echo $f_alicuota['nombre'] ?>" >
					   <?php echo $f_alicuota['nombre'];
					       }
						?>   
		    </option>
                       </select>    
		 	 
</td> 
  </tr> 

  
  
  <tr>
        <td  > Neto: 
        </td>
        <td><input type="text" name="neto"  value=""   />
        </td> 
  </tr> 
  <?php
    if($ganancia==4)
	  {
?>
        <tr>
        <td height="42"  > Monotributista: 
        </td>
        <td><input type="radio"  name="mono"  value="S" />Servicio&nbsp;&nbsp;&nbsp;      <input type="radio"  name="mono"  value="V" />Venta Cosas Muebles
        </td> 
  </tr> 

<?php
	  }
?>	  
  <tr>
        <td height="31"  > Regimen: 
        </td>
<td><select name="rg" onChange="mostrar()" disabled  >
					<option value="N" selected >Sin Especificar</option>
<?php     
                    mysql_data_seek($r_rg,0); 
                    while ($f_rg = mysql_fetch_array ($r_rg))
                           {
?>
                       <option title="<?php echo $f_rg['observacion']; ?>" value="<?php echo $f_rg['id_rg'] ?>" >
					   <?php echo $f_rg['codigo'];
					       }
						?>   
		    </option>
                       </select>    
		 	 
</td> 
  </tr> 
      <tr>
        <td  > Minimo No Sujeto Ret : 
        </td>
        <td><input type="text" name="minimorg"  readonly/></td> 
  </tr> 
  
  <tr>
        <td  > Base Imponible : 
        </td>
        <td><input type="text" name="baserg" readonly/></td> 
  </tr> 
  
  <tr>
        <td  > Alicuota : 
        </td>
        <td><input type="text" name="alicuotarg" size="2" disabled />%</td> 
  </tr>
  <tr>
        <td  > Retencion Concepto : 
        </td>
        <td><input type="text" name="retencion"  /></td> 
  </tr>
   <tr>
        <td  >Observacion : 
        </td>
        <td><input type="text" name="obser_ganancia" size="30" readonly/></td> 
  </tr>
</table>  
<?php
      if ($seguridad==1)
	     {
?>	
  <table height="130" border="0" align="center" cellpadding="0">
	
	<tr height=10px>
		<td colspan="2"><hr></td>
	</tr>
		 
	<tr>
		<td width="180" height="60"><H4>SEGURIDAD SOCIAL</H4></td>
		<td width="311">&nbsp;</td>
	</tr>
	<tr height=10px>
		<td height="14" colspan="2"><hr></td>
	</tr>
    <tr height=10px>
		<td height="10" colspan="2"></td>
	</tr>
</table>             
	 
<table border="0" cellpadding="0" align="center">
  
   
  <tr>
        <td  > Base Imponible : 
        </td>
        <td><input type="text" name="imponibless" /></td> 
  </tr>
  
 
  <tr>
        <td  > Regimen: 
        </td>
        <td><select name="ss" onChange="mostrarss()" >
					<option value="N" selected >Sin Especificar</option>
<?php     
                    mysql_data_seek($r_ss,0); 
                    while ($f_ss = mysql_fetch_array ($r_ss))
                           {
?>
                       <option value="<?php echo $f_ss['id_ss'] ?>" >
					   <?php echo $f_ss['codigo'].' '.$f_ss['descripcion'];
					       }
						?>   
		    </option>
                       </select>    
		 	 
</td> 
  </tr> 
  
   <tr>
        <td  > Importe no Sujeto a Retencion : 
        </td>
        <td><input type="text" name="basess" readonly/></td> 
  </tr>   
    
  <tr>
        <td  > Alicuota : 
        </td>
        <td><input type="text" name="alicuotass" size="2" readonly/>%</td> 
  </tr>
  
  
  <tr>
        <td  > Retencion Concepto : 
        </td>
        <td><input type="text" name="retencionss" readonly/></td> 
  </tr>
  
   <tr>
        <td  >Observacion : 
        </td>
        <td><input type="text" name="obser_retencionss" size="30" readonly/></td> 
  </tr>
  
  </table>
	<?php
		 }
?>
<br>	 

<?php
   if(!($ing_bruto ==4))
     {
?>
  <table height="130" border="0" align="center" cellpadding="0">
	
	<tr height=10px>
		<td colspan="2"><hr></td>
	</tr>
	<tr>
		<td width="180" height="60"><H4>INGRESOS BRUTOS</H4></td>
		<td width="311">&nbsp;</td>
	</tr>
	<tr height=10px>
		<td height="14" colspan="2"><hr></td>
	</tr>
    <tr height=10px>
		<td height="10" colspan="2"></td>
	</tr>
		

</table>             
<table border="0" cellpadding="0" align="center"> 
      
   <tr>
        <td  > Base Imponible : 
        </td>
        <td><input type="text" name="imponibleib" onBlur="calcular_bi()"></td> 
  </tr>  
  <tr>
        <td  > Alicuota : 
        </td>
        <td><input type="text" name="alicuotaib" value="<?php echo $alicuotaib; ?>" size="2" readonly/> %</td> 
  </tr>
  <tr>
        <td  > Importe no Sujeto a Retencion  : 
        </td>
        <td><input type="text" name="nosujetob" value="<?php echo $nosujetoib; ?>" readonly/>
        <input type="hidden" name="baseib" value="<?php echo $nosujetoib; ?>" ></td> 
  </tr>
  <tr>
        <td  > Retencion Concepto : 
        </td>
        <td><input type="text" name="retencionib" readonly/></td> 
  </tr>
 
</table>
<br>
<?php 
	 }
?>	

  <table height="60" border="0" align="center" cellpadding="0">
	
	<tr height=10px>
		<td colspan="2"><hr></td>
	</tr>
	<tr>
		<td width="180" height="60"><H4>Observacion</H4></td>
		<td width="311">&nbsp;</td>
	</tr>
	<tr height=10px>
		<td height="14" colspan="2"><hr></td>
	</tr>
    <tr height=10px>
		<td height="10" colspan="2"></td>
	</tr>
		

</table>             
<table border="0" cellpadding="0" align="center">
<tr>
  <td>Estado</td>
  <td><select name="estado" >
       <option value="N" selected >Normal</option>
       <option value="R">Bloqueada</option>
       <option value="B">Baja</option> 
      </select> 

</tr>
<tr>
    <td>
     Detalle:</td>
     <td>   <textarea name="observ" cols="50" rows="3"></textarea>    </td>
</tr>
  <tr>
        <td align="center" colspan="2"><button type="submit" name="modificar"><img src="img/confirmar.png"></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       
        </td>
     </tr>
</table>    
</form>

</div>

<div class="sidenav">
<h2></h2>
<ul>
 
      <li><a href="indextesoreria.php?sec=retenciones/carga_orden&apli=cr&per=R">Regresar Menu</a></li>
	
	<!-- <li><a href="indextesoreria.php?sec=tesoreria/saf_consulta&apli=tgpc&per=A">Beneficiarios - SAF</a> </li>-->
</ul>
</div>

<div class="clearer"><span></span></div>
<?php
}
	
else
{
	 header('location: ../indextesoreria.php?sec=retencion/error');
}
?>  
</html>