 <?php
  error_reporting ( E_ERROR );
  
/*  SELECT *, (IMP_FORM-RETENCION-IMPORTE_A_PAGAR) AS pagado, (
IMP_FORM - RETENCION )as Imp_orden,CONCAT(FORMULARIO,'-',SAF,'-',NUMERO) AS orden FROM `orden_pago`
WHERE  ESTADO !='C' AND ESTADO !='I' and `orden `='41-501-3219' order by FORMULARIO,SAF,NUMERO*/
//conexion
	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');

	$aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
	$bandera = $_GET['band'];
	$fecha_cons=$_GET['consul'];
	  include('incluir_siempre.php');
	  
	  
	  
	 

	////verifica fecha
	
	$d_fecha=date('Y-m-d');
	
	$ssql = "SELECT * FROM `control_fecha_fp` ";
     if (!($r_cf= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }	
	
	$f_cf=mysql_fetch_array($r_cf);
	$t_fecha =$f_cf['c_fecha']; 
	
	if ($t_fecha=='0000-00-00')
	   {
		
	   $ssql = "TRUNCATE op_pendiente_tmp_fp ";
        if (!($r_op= mysql_query($ssql, $conexion_mysql)))
          {
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar area";
			 
			  //.....................................................................
			}		
	     $ssql = "UPDATE control_fecha_fp SET c_fecha='$d_fecha',nro_ti='1' where id=1";
				 if (!($r_cf= mysql_query($ssql, $conexion_mysql)))
				{
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar buscar area";
				 
				  //.....................................................................
				}	
	 
	  }
	 else
	  {
		  if (!($t_fecha==$d_fecha))
		   {
			    $ssql = "TRUNCATE op_pendiente_tmp_fp";
					if (!($r_op= mysql_query($ssql, $conexion_mysql)))
					  {
						  //.....................................................................
						  // informa del error producido
						  $cuerpo1  = "al intentar buscar area";
						 
						  //.....................................................................
						}
				 $ssql = "UPDATE control_fecha_fp SET c_fecha='$d_fecha',nro_ti='1' where id=1";
							 if (!($r_cf= mysql_query($ssql, $conexion_mysql)))
							{
							  //.....................................................................
							  // informa del error producido
							  $cuerpo1  = "al intentar buscar area";
							 
							  //.....................................................................
							}	
			}
			
	  }
	  
    include('dgti-mysql-var_dbtgp.php');
    include('dgti-intranet-mysql_connect.php');  
	include('dgti-intranet-mysql_select_db.php');
	
	
	 $ssql = "SELECT *  FROM `escritural` WHERE ESTADO='A' ORDER BY ESCRITURAL";
     if (!($r_saf= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
	

if ((isset($_POST['busca']) and !empty($_POST['busnom'])) or ( $_POST['busnom']!=''))
			{
		 		
				$nom = $_POST['busnom'];
				$ssql = "SELECT SUM( IMPORTE_A_PAGAR ) AS saldo, SUM( IMP_FORM - RETENCION - IMPORTE_A_PAGAR ) AS total, SUM( IMP_FORM - RETENCION ) AS importe, count(NUMERO) AS cant
		  FROM orden_pago_temp,escritural AS e
where (e.ID='$nom' ) 
AND e.ID = orden_pago_temp.id_escritural
AND EJERCICIO='$fecha_cons'
AND orden_pago_temp.ESTADO = 'P'
AND e.ESTADO='A'
";
					 if (!($r_op= mysql_query($ssql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}
			}
	
	  
	elseif (($_GET['busnom']!='' or $_GET['nom']!='') and (!(isset($_POST['busca']))) )
        {
			
		  if ($_GET['_pagi_pg'] >=1)
		    {
		  $nom = $_GET['nom'];	
			}
		else
		  {  
		      $nom = $_GET['busnom'];	
			 	
		  }
		  $ssql = "SELECT SUM( IMPORTE_A_PAGAR ) AS saldo, SUM( IMP_FORM - RETENCION - IMPORTE_A_PAGAR ) AS total, SUM( IMP_FORM - RETENCION ) AS importe, count(NUMERO) AS cant
		  FROM orden_pago_temp,escritural AS e
where (e.ID='$nom' ) 
AND e.ID = orden_pago_temp.id_escritural
AND EJERCICIO='$fecha_cons'
AND orden_pago_temp.ESTADO = 'P'
AND e.ESTADO='A'
";
					 if (!($r_op= mysql_query($ssql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}
         }
	 
	  
	  else
	   {
		   
		  $nom='';
		  
		  $ssql = "SELECT SUM( IMPORTE_A_PAGAR ) AS saldo, SUM( IMP_FORM - RETENCION - IMPORTE_A_PAGAR ) AS total, SUM( IMP_FORM - RETENCION ) AS importe, count(NUMERO) AS cant
		  FROM orden_pago_temp,escritural AS e
where e.ID = orden_pago_temp.id_escritural
AND EJERCICIO='$fecha_cons'
AND orden_pago_temp.ESTADO = 'P'
AND e.ESTADO='A'";
				 if (!($r_op= mysql_query($ssql, $conexion_mysql)))
				{
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar buscar area";
				 
				  //.....................................................................
				}
	     }
		
	  
if (($_GET['busnom']!='') or (isset($_POST['busca'])) or (isset($_GET['_pagi_pg'] )))
  {
if ((isset($_POST['busca']) and !empty($_POST['busnom'])))
		{
		 		
				$nom = $_POST['busnom'];
				$_pagi_sql = "SELECT orden_pago_temp.* , (
IMP_FORM - RETENCION - IMPORTE_A_PAGAR
) AS pagado, (
IMP_FORM - RETENCION )as Imp_orden, e.ESCRITURAL,e.DENOMINACION,e.ID
		  FROM orden_pago_temp,escritural AS e
where (e.ID='$nom' ) 
AND e.ID = orden_pago_temp.id_escritural
AND EJERCICIO='$fecha_cons'
AND orden_pago_temp.ESTADO != 'I'
AND orden_pago_temp.ESTADO != 'C'
order by orden_pago_temp.ESTADO DESC,FECHA_OP desc,FORMULARIO,orden_pago_temp.SAF,NUMERO";
					 
		}
	 elseif ($_GET['_pagi_pg'] >=1 and !empty($_GET['nom']) and (!(isset($_POST['busca'])))) 
        {
	     		
		 $nom = $_GET['nom'];	
		 $_pagi_sql = "SELECT orden_pago_temp.* , (
IMP_FORM - RETENCION - IMPORTE_A_PAGAR
) AS pagado, (
IMP_FORM - RETENCION )as Imp_orden, e.ESCRITURAL,e.DENOMINACION,e.ID
		  FROM orden_pago_temp,escritural AS e
where (e.ID='$nom' ) 
AND e.ID = orden_pago_temp.id_escritural
AND EJERCICIO='$fecha_cons'
AND orden_pago_temp.ESTADO != 'I'
AND orden_pago_temp.ESTADO != 'C'
order by orden_pago_temp.ESTADO DESC,FECHA_OP desc,FORMULARIO,orden_pago_temp.SAF,NUMERO";
					
         }
   
	  
	  else
	   {
		 if(($_GET['busnom']!='') or ($_POST['busnom']!=''))
		    { 
			
		 $nom = $_GET['busnom'];
		 $nom1 = $_GET['busnom1'];
		  $_pagi_sql =  "SELECT orden_pago_temp.* , (
IMP_FORM - RETENCION - IMPORTE_A_PAGAR
) AS pagado, (
IMP_FORM - RETENCION )as Imp_orden,e.ESCRITURAL,e.DENOMINACION,e.ID
		  FROM orden_pago_temp,escritural AS e
where (e.ID='$nom' ) 
AND e.ID = orden_pago_temp.id_escritural
AND EJERCICIO='$fecha_cons'
AND orden_pago_temp.ESTADO != 'I'
AND orden_pago_temp.ESTADO != 'C'
order by orden_pago_temp.ESTADO DESC,FECHA_OP desc,FORMULARIO,orden_pago_temp.SAF,NUMERO";
				
	        }
			
	      else
	       {
			   
		   $_pagi_sql = "SELECT orden_pago_temp.*  , (
IMP_FORM - RETENCION - IMPORTE_A_PAGAR
) AS pagado, (
IMP_FORM - RETENCION
) AS Imp_orden, e.ESCRITURAL,e.DENOMINACION,e.ID
FROM orden_pago_temp, escritural AS e
WHERE EJERCICIO = '$fecha_cons'
AND e.ID = orden_pago_temp.id_escritural
AND orden_pago_temp.ESTADO != 'C'
AND e.ESTADO='A'
order by orden_pago_temp.ESTADO DESC,FECHA_OP desc,FORMULARIO,orden_pago_temp.SAF,NUMERO";
	       }
	   }
  }
 else
  {
	 
	 $_pagi_sql = "SELECT orden_pago_temp.* , (
IMP_FORM - RETENCION - IMPORTE_A_PAGAR
) AS pagado, (
IMP_FORM - RETENCION
) AS Imp_orden, e.ESCRITURAL,e.DENOMINACION,e.ID
FROM orden_pago_temp, escritural AS e
WHERE EJERCICIO = '$fecha_cons'
AND e.ID = orden_pago_temp.id_escritural
AND orden_pago_temp.ESTADO != 'C'
AND e.ESTADO='A'
order by orden_pago_temp.ESTADO DESC,FECHA_OP desc,FORMULARIO,orden_pago_temp.SAF,NUMERO";
  }





 
    
	
if (isset($_POST['busca']))
    { 
	 unset($_GET['_pagi_pg']);
	 $_pagi_actual = 1;
	}   
   
$_pagi_cuantos = 10;
$_pagi_nav_num_enlaces = 8;
$_pagi_nav_estilo="pag";
$_pagi_propagar=array('sec','nom','apli','per','consul');
//definimos qué irá en el enlace a la página anterior
$_pagi_nav_anterior = "<img src='img/izq.png' border=0>";// podría ir un tag <img> o lo que sea
$_pagi_nav_primera = "<img src='img/izqfin.png' border=0>";
$_pagi_nav_ultima = "<img src='img/derfin.png' border=0>";
//definimos qué irá en el enlace a la página siguiente
$_pagi_nav_siguiente = "<img src='img/der.png' border=0>";// podría ir un tag <img> o lo que sea
include("paginator.inc.php");	
	

?>
<div class="content">

<h2>Ordenes Pendientes de Pago Recursos Propios <?php echo $fecha_cons; ?></h2>
<br />
<form action="" method="post">

<table  width="110%"  border="1" align="center" cellpadding="0" cellspacing="0" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
     <tr class="fuframe1">
    	<td height="30" colspan="3" >Nro. de Escritural
          <select name="busnom">
					<option value="" selected >Sin Especificar</option>
<?php     
       
                    while ($f_saf = mysql_fetch_array ($r_saf))
                           {
                      
?>
<OPTION title="<? echo $f_saf['DENOMINACION']; ?>" value="<? echo $f_saf['ID'] ?>"> <? echo $f_saf['ESCRITURAL']?></OPTION>
               
             <?php
			      }
				  ?>
                  </select>
    	 
      		<input name="busca" type="submit" id="busca" value="Buscar" />
            
	  		  
      </td>
         
         
    </tr>
</table>    
</form>


<table width="110%"  border="1" cellpadding="0" cellspacing="0"  >
   <tr class="fuframe1">
       <td><strong>Ejer.</strong></td>
       <td ><strong>SAF</strong></td>
       <td ><strong>Nro. Orden</strong></td>
       <td ></td>
       <td><strong>Saldos Disp</strong></td>
       <td ><strong>Imp. Form</strong></td>
       <td ><strong>Imp. Pagado</strong></td>
       <td ><strong>Beneficiario</strong></td>
       <td ><strong>Concepto</strong></td>
       <td><strong>Fecha</strong></td>
       <td><strong>Estado</strong></td>
      
   </tr>
   <?php
 
      while ($f_orden=mysql_fetch_array($_pagi_result))
	  {
		   $d_cuit=$f_orden['CUIT'];
		   $estado_op=$f_orden['ESTADO'];
		   $orden=$f_orden['NUMERO'];
		   $op_saf=$f_orden['SAF'];
		   $ejer_op=$f_orden['EJERCICIO'];
		   $num=$f_orden['FORMULARIO']; 
		   $IMP1= number_format($f_orden['IMP_FORM'],2);
		   $IMP2=number_format($f_orden['RETENCION'],2);
		   $IMP3=number_format($f_orden['IMPORTE_A_PAGAR'],2);
		   $Imp_orden=number_format($f_orden['Imp_orden'],2);
           $Total_Pagado=$f_orden['pagado'];
			 
			 
			 $orden1=$num.'-'.$op_saf.'-'.$orden;
		   
		      $inhi_v='';
		   $baja='';
		  
		  include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
		  
		  $ssql = "SELECT * FROM beneficiarios_aprobados where cuitl='$d_cuit' ";
					 if (!($r_cb= mysql_query($ssql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}
		   $f_cb=mysql_fetch_array($r_cb);
		   
		   $estado=$f_cb['estado'];
		   $apellido_b=$f_cb['apellido'];
		   $nombre_b=$f_cb['nombre'];
		   $razon_social_b=$f_cb['razon_social'];
		   $inhi=$f_cb['inhi'];
		   
		   if($razon_social_b=='')
		     {
				 $beneficiario=$apellido_b.', '.$nombre_b;
			 }
			else
			 {
				  $beneficiario=$razon_social_b;
			 }
		     
	     	  
	
 
	   if(($estado=='A') and ($inhi=='') and (($estado_op=='P') or ($estado_op=='I')) )
	  
{
	if ($estado_op=='I')
	    
		    {
				$inhi_v='IMPUESTO';
			}
	?>	
 
	    <tr bgcolor="#F3F3F3"  class="fuframe" > 
 <?php 
   }
 else
 {
	 if($estado_op=='A')
	    {	 $inhi_v='B';
?>		
 
	    <tr bgcolor="#FFCB97" class="fuframe" > 
 <?php 
       } 
	 else 
	   {  
	  
	if(($inhi!='') or ($estado=='B') )
	   {	
	   if($inhi!=''){ $inhi_v='INHI';}
	   if($estado=='B'){ $baja='BAJA';}
?>		
 
	    <tr bgcolor="#CCFFFF" class="fuframe" > 
 <?php 
       }
	   if ($estado_op=='B')
	     {
	      if($inhi!=''){ $inhi_v='INHI';}
	      if($estado=='B'){ $baja='BAJA';}
		  if(($inhi=='') and ($estado=='A'))
		    {
				$inhi_v='BLOQ';
			}
	   ?>		
 
	    <tr bgcolor="#CCFFFF" class="fuframe" > 
 <?php 
         }
	   }
	  
 }
?>        <td  height="30" align="center"><?php echo $f_orden['EJERCICIO'];?></td>
           <td  align="center"><?php echo $f_orden['ESCRITURAL'];?></td>
          <td ><?php echo $orden1 ;?></td>
          
          
          
          <td  align="center"><?php if(($estado_op=='A') or ($estado_op=='I')){$nada=0;}else { ?><a target="_parent" href="indextesoreria.php?sec=consolidada/confirmar_pago_fp&apli=h&consul=<?php echo $fecha_cons; ?>&saf=<?php echo $saf; ?>&per=A&id=<?php echo $f_orden['CLAVE']; ?>&nomb=<?php echo $nom; ?>"><img src="img/ok.png" border="0" height="16" width="16"/></a><?php }?></td>
          <td  align="right"><?php echo $IMP3 ;?></td>
          
          <td  align="right">&nbsp;<?php echo $Imp_orden;?></td>
          <td  align="right">&nbsp;<?php echo $Total_Pagado;?></td>
          
            <td  align="left"><?php echo substr($beneficiario,0,30);?></td>
            
            <td  align="left"><?php echo substr($f_orden['CONCEPTO'],0,20);?></td>
     
          <td  align="left">&nbsp;<?php echo $f_orden['FECHA_OP'];?></td>
          <td height="30"  align="center" ><strong>&nbsp;<?php if ($estado=='B') { echo $baja; } else { echo $inhi_v; }?></strong></td>
         
         
          </tr>
          
<?php	   
     
	   
	   }
?>	  
  <TR><TD align="center" colspan="11"><?php //Incluimos la barra de navegaci&oacute;n
              echo"<p>".$_pagi_navegacion."</p>";
              ?></TD></TR>    
 </table> 
 




<?php
$f_orden=mysql_fetch_array($r_op);
?>

  
<table  width="110%"  border="1" align="center" cellpadding="10" cellspacing="3" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
     <tr class="fuframe1">
    
    	<td height="33" colspan="2"><strong>Cantidad de Ordenes Pendientes:</strong></td>
        <td align="right"><?php echo $f_orden['cant']; ?>
    </tr>

  <tr>
    	<td height="33" colspan="3"><strong>Importes Totales</strong></td>
        
    </tr>
    <tr>
      <td height="31" align="right"><strong>Saldos Disp.:</strong> <?php echo number_format($f_orden['saldo'],2); ?> </td>
      <td align="center"><strong> Imp. Form.:</strong> <?php echo number_format($f_orden['importe'],2); ?> </td>
         <td><strong>Imp.Pagado:</strong> <?php echo number_format($f_orden['total'],2); ?> </td>
         </td>
    </tr>
</table>
</div>
<div class="sidenav_op">
<h2></h2>
<ul>
     <li><strong> &nbsp;BAJA: </strong>Baja de Beneficiario</li>
     <li><strong> &nbsp;BLOQ: </strong>O.P Bloqueada</li>
     <li><strong> &nbsp;INHI: </strong>Situacion Cta</li>
</ul>
</div>
<div class="sidenav_m">
<h2></h2>
<ul>
     
     <li><strong> &nbsp;&nbsp; </strong>Baja de Orden de Pago</li>
 </ul>
 </div>    
<div class="sidenav_p">     

<h2></h2>
<ul>
    
	<li><a href="indextesoreria.php?sec=consolidada/desconfirmar_orden_consolidada_fp&consul=<?php echo $fecha_cons; ?>&saf=<?php echo $nrosaf; ?>&apli=h&per=A">Desconfirmar Ordenes Solicitadas</a></li>
    <li><a href="indextesoreria.php?sec=consolidada/modificar_orden_consolidada_fp&consul=<?php echo $fecha_cons; ?>&saf=<?php echo $nrosaf; ?>&apli=h&per=A">Modificacion Ordenes Solicitadas</a></li>
    <li><a href="indextesoreria.php?sec=consolidada/ver_cumplase_fp&consul=<?php echo $fecha_cons; ?>&saf=<?php echo $nrosaf; ?>&apli=h&per=A">Imprimir Ordenes Solicitadas</a></li>
      <li><a href="indextesoreria.php?sec=hacienda/index1&apli=h&per=A">Regresar Menu</a></li>
	
	<!-- <li><a href="indextesoreria.php?sec=tesoreria/saf_consulta&apli=tgpc&per=A">Beneficiarios - SAF</a> </li>-->
</ul>
</div>
<!--<div class="sidenav">
</div> -->
<div class="clearer"><span></span></div>