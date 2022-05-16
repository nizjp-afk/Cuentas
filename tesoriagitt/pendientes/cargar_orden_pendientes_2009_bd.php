 <?php
  error_reporting ( E_ERROR );
//conexion
	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	$aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
	$bandera = $_GET['band'];
	$fecha_cons=$_GET['fecha_cons'];
	include('incluir_siempre.php');

$dia = date("d-m-Y");
	////verifica fecha
	
	$d_fecha=date('Y-m-d');
	$dia = date("d-m-Y");
	 function restaFechas($dFecIni, $dFecFin)
{
    $dFecIni = str_replace("-","",$dFecIni);
    $dFecIni = str_replace("/","",$dFecIni);
    $dFecFin = str_replace("-","",$dFecFin);
    $dFecFin = str_replace("/","",$dFecFin);

    ereg( "([0-9]{1,2})([0-9]{1,2})([0-9]{2,4})", $dFecIni, $aFecIni);
    ereg( "([0-9]{1,2})([0-9]{1,2})([0-9]{2,4})", $dFecFin, $aFecFin);

    $date1 = mktime(0,0,0,$aFecIni[2], $aFecIni[1], $aFecIni[3]);
    $date2 = mktime(0,0,0,$aFecFin[2], $aFecFin[1], $aFecFin[3]);

    return round(($date2 - $date1) / (60 * 60 * 24));

    
}	
	
		


if ((isset($_POST['busca']) and !empty($_POST['busnom'])) or ( $_POST['busnom']!=''))
			{ $fecha_cons = $_GET['fecha_cons'];
				$fecha_ant = $_GET['fecha_ant'];
		 		
				$nom = $_POST['busnom'];
				$ssql = "SELECT sum(`Saldos`) as saldo,sum(`Imp_orden`) as importe,sum(`Total_Pagado`) as total,count( `Numero_OP` ) as cant 
				FROM op_pendientes where (Saf='$nom' or  Numero_OP='$nom' or cuit='$nom')
				AND (Ejercicio >='$fecha_cons' and Ejercicio <= '$fecha_ant') and estado='N'";
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
		   $fecha_cons = $_GET['fecha_cons'];
				$fecha_ant = $_GET['fecha_ant'];
		  $ssql = "SELECT sum(`Saldos`) as saldo,sum(`Imp_orden`) as
		   importe,sum(`Total_Pagado`) as total,count( `Numero_OP` ) as
		    cant 
						FROM op_pendientes where (Saf='$nom' or  Numero_OP='$nom' or cuit='$nom')
						AND (Ejercicio >='$fecha_cons' and Ejercicio <= '$fecha_ant') and estado='N'";
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
		    $fecha_cons=$_GET['fecha_cons'];
		 $anterior=$_GET['fecha_ant'];
		  $nom='';
		  $ssql = "SELECT sum(`Saldos`) as saldo,sum(`Imp_orden`) as importe,sum(`Total_Pagado`) as total,count( `Numero_OP` ) as cant 
		  FROM op_pendientes where (Ejercicio >='$fecha_cons' and Ejercicio <= '$anterior') and estado='N' ";
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
		{ $fecha_cons = $_GET['fecha_cons'];
				$fecha_ant = $_GET['fecha_ant'];
		 		
				$nom = $_POST['busnom'];
				$_pagi_sql = "SELECT CASE estado
WHEN 'N'
THEN 'P'
WHEN 'B'
THEN 'A'
WHEN 'R'
THEN 'B'
WHEN 'I'
THEN 'I'
END AS estado, op_pendientes . * FROM op_pendientes where (Saf='$nom' or Numero_OP='$nom' or cuit='$nom') AND (Ejercicio >='$fecha_cons' and Ejercicio <= '$fecha_ant') ORDER BY `estado` DESC,FECHA_OP desc,Numero_OP";
					 
		}
	 elseif ($_GET['_pagi_pg'] >=1 and !empty($_GET['nom']) and (!(isset($_POST['busca'])))) 
        {
	     		 $fecha_cons = $_GET['fecha_cons'];
				$fecha_ant = $_GET['fecha_ant'];
		 $nom = $_GET['nom'];	
		 $_pagi_sql = "SELECT CASE estado
WHEN 'N'
THEN 'P'
WHEN 'B'
THEN 'A'
WHEN 'R'
THEN 'B'
WHEN 'I'
THEN 'I'
END AS estado, op_pendientes . * FROM op_pendientes where (Saf='$nom' or Numero_OP='$nom' or cuit='$nom') AND (Ejercicio >='$fecha_cons' and Ejercicio <= '$fecha_ant') ORDER BY `estado` DESC,FECHA_OP desc,Numero_OP";
					
         }
   
	  
	  else
	   {
		 if(($_GET['busnom']!='') or ($_POST['busnom']!=''))
		    { 
			 $fecha_cons = $_GET['fecha_cons'];
				$fecha_ant = $_GET['fecha_ant'];
		 $nom = $_GET['busnom'];
		  $_pagi_sql =  "SELECT CASE estado
WHEN 'N'
THEN 'P'
WHEN 'B'
THEN 'A'
WHEN 'R'
THEN 'B'
WHEN 'I'
THEN 'I'
END AS estado, op_pendientes . * FROM op_pendientes where (Saf='$nom' or Numero_OP='$nom' or cuit='$nom') AND (Ejercicio >='$fecha_cons' and Ejercicio <= '$fecha_ant') ORDER BY `estado` DESC,FECHA_OP desc,Numero_OP";
				
	        }
			
	      else
	       {
		   $fecha_cons = $_GET['fecha_cons'];
				$fecha_ant = $_GET['fecha_ant'];
			
			   
		   $_pagi_sql = "SELECT CASE estado
WHEN 'N'
THEN 'P'
WHEN 'B'
THEN 'A'
WHEN 'R'
THEN 'B'
WHEN 'I'
THEN 'I'
END AS estado, op_pendientes. *
FROM op_pendientes
WHERE (Ejercicio >='$fecha_cons' and Ejercicio <= '$fecha_ant')
ORDER BY `estado` DESC , FECHA_OP DESC , Numero_OP"; 
	       }
	   }
  }
 else
  {
	 	 $fecha_cons=$_GET['fecha_cons'];
		 $anterior=$_GET['fecha_ant'];
	 $_pagi_sql = "SELECT CASE estado
WHEN 'N'
THEN 'P'
WHEN 'B'
THEN 'A'
WHEN 'R'
THEN 'B'
WHEN 'I'
THEN 'I'
END AS estado, op_pendientes. *
FROM op_pendientes
WHERE (Ejercicio >='$fecha_cons' and  Ejercicio  <= '$anterior')
ORDER BY `estado` DESC , FECHA_OP DESC , Numero_OP"; 
  }



	
if (isset($_POST['busca']))
    { 
	 unset($_GET['_pagi_pg']);
	 $_pagi_actual = 1;
	}   
   
$_pagi_cuantos = 10;
$_pagi_nav_num_enlaces = 8;
$_pagi_nav_estilo="pag";
$_pagi_propagar=array('sec','nom','apli','per','fecha_cons','fecha_ant');
//definimos qué irá en el enlace a la página anterior
$_pagi_nav_anterior = "<img src='img/izq.png' border=0>";// podría ir un tag <img> o lo que sea
$_pagi_nav_primera = "<img src='img/izqfin.png' border=0>";
$_pagi_nav_ultima = "<img src='img/derfin.png' border=0>";
//definimos qué irá en el enlace a la página siguiente
$_pagi_nav_siguiente = "<img src='img/der.png' border=0>";// podría ir un tag <img> o lo que sea
include("paginator.inc.php");	

?>
<div class="content">

<h2>Ordenes Pendientes de Pago Recursos del Tesoro Ejercicios Vencidos</h2>
<br />
<form action="" method="post">

<table  width="110%"  border="1" align="center" cellpadding="0" cellspacing="0" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
     <tr class="fuframe1">
    	<td height="30" colspan="3" >Nro. de Orden
    	  <input  name="busnom" type="text" id="busnom" size="30" maxlength="50" />
      		<input name="busca" type="submit" id="busca" value="Buscar" />
            
	  		  
      </td>
         <td height="30" colspan="2" ><a title="Listado de Ordenes Pendientes" href="tesoreria/listado_pendientes_ft_cons_bd.php?fecha_cons=<?php echo $fecha_cons; ?>&saf=<?php echo $nom; ?>" target="_blank"  ><img src="img/print_odp.jpg" width="35" align="" height="24" border="0"/></a>   
		</td>     
         
    </tr>
</table>    
</form>


<table width="110%"  border="1" cellpadding="0" cellspacing="0"  >
   <tr class="fuframe1">
       <td width="18"><strong>SAF</strong></td>
	    <td width="12"><strong>Ejercico</strong></td>
		 <td width="25"><strong>Fecha&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></td>
       <td width="25"><strong>Nr.Orden</strong></td>
       <td width="65" align="center"><strong>Beneficiarios</td>
       <td width="65" align="center"><strong>Concepto</td>
       <td width="43"><strong>Imp. Pagado</td>
       <td width="43"><strong>Imp. Form</td>
       <td width="43"><strong>Saldos Disp</td>
       <td><strong>Estado</strong></td>
      
   </tr>
   <?php
 
      while ($f_ordenp=mysql_fetch_array($_pagi_result))
	  {
		   $d_cuit=$f_ordenp['cuit'];
		   $estado_op=$f_ordenp[0];
		   $inhi_v='';
		   $baja='';
		  
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
		     
	     	  
		      $f_g=explode("-", $f_ordenp['Fecha_OP']); 
           $fecha_ing=$f_g[2].'-'.$f_g[1].'-'.$f_g[0]; 
		   
		   $resultado_resta = restaFechas($fecha_ing,$dia);
	
 
		if(($estado=='A') and ($inhi=='') and (($estado_op=='P') or ($estado_op=='I')) and ($resultado_resta < 365) )
	  
	  
{
	if ($estado_op=='I')
	    
		    {
				$inhi_v='IMP';
			}
	?>	
 
	    <tr bgcolor="#F3F3F3"  class="fuframe" > 
 <?php 
   }
 else
 {
 if($resultado_resta < 365)
   {
   	 if($estado_op=='A')
	    {	 $baja='BAJR';
?>		
 
	    <tr bgcolor="#FFCB97" class="fuframe" > 
 <?php 
       } 
	 else 
	   {  
	  
	if(($inhi!='') or ($estado=='B') )
	   {	
	   if($inhi!=''){ $inhi_v='BENC';}
	   if($estado=='B'){ $baja='BENB';}
?>		
 
	    <tr bgcolor="#CCFFFF" class="fuframe" > 
 <?php 
       }
	  if ($estado_op=='B')
	     {
	      if($inhi!=''){ $inhi_v='BENC';}
	      if($estado=='B'){ $baja='BENB';}
		  if(($inhi=='') and ($estado=='A'))
		    {
				$inhi_v='BLOR';
			}
	   ?>		
 
	      <tr bgcolor="#FFCB97" class="fuframe" > 
 <?php 
         }
		
	  }
	  }
	else
	 {
	  $baja='BAJD';
	 ?>		
		
 
	    <tr bgcolor="#FFFF99" class="fuframe" > 
		
		
 <?php 
       } 
}

?>        <td  align="center"><?php echo $f_ordenp['Saf'];?></td>
          <td  align="center"><?php echo $f_ordenp['Ejercicio'];?></td>
 <td  align="center"><?php echo $f_ordenp['Fecha_OP'];?></td>
          <td width="66" align="center"><?php echo $f_ordenp['Numero_OP'];?></td>
          <td width="136" align="left"><?php echo substr($beneficiario,0,20);?></font></td>
           <td width="136" align="left"><?php echo substr($f_ordenp['Concepto'],0,25);?></font></td>
         
          <td width="85" align="right">&nbsp;<?php echo $f_ordenp['Total_Pagado'];?></td>
           <td width="77" align="right">&nbsp;<?php echo $f_ordenp['Imp_orden'];?></td>
          <td width="77" align="right"><?php echo $f_ordenp['Saldos'];?></td>     
          
           <td height="30"  align="center" ><strong>&nbsp;<?php if($resultado_resta > 365){echo $baja;} 
		                                                            else
																	{ 
		                                                          if($baja!='') { echo $baja; } 
		                                                        elseif ($inhi_v !='')echo $inhi_v; }
																 ?></strong></td>
         
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
      <td height="31" align="right"><strong>Saldos Disp.:</strong> <?php echo $f_orden['saldo']; ?> </td>
      <td align="center"><strong> Imp. Form.:</strong> <?php echo $f_orden['importe']; ?> </td>
         <td><strong>Imp.Pagado:</strong> <?php echo $f_orden['total']; ?> </td>
         </td>
    </tr>
</table>
</div>
<div class="sidenav_op">
<h2></h2>
<ul>
     <li><strong> &nbsp;BENB: </strong>Beneficiario Inhabilitado</li>
    
     <li><strong> &nbsp;BENC: </strong>Cuenta Cerrada</li>
</ul>
</div>
<div class="sidenav_m">
<h2></h2>
<ul>
      <li><strong> &nbsp;BLOR: </strong>Bloqueada/Retenciones</li>
     <li><strong> &nbsp;BAJR: </strong>Baja/Retenciones</li>
 </ul>
 </div>    
 <div class="sidenav_p">
<h2></h2>
<ul>
      <li><strong> &nbsp;IMP: </strong>Control de Impuesto.</li>
     
 </ul>
 </div>    
 <div class="sidenav_e">
<h2></h2>
<ul>
      <li><strong> &nbsp;BAJD:  </strong>Segun Decreto N&deg; 1804/10 ... Supera los 365 dias</li>
   
 </ul>
 </div>  
 

 <div class="sidenav_p">     

<h2></h2>

      <li><a href="indextesoreria.php?sec=pendientes/index1&apli=h&per=A">Regresar Menu</a></li>
	
	<!-- <li><a href="indextesoreria.php?sec=tesoreria/saf_consulta&apli=tgpc&per=A">Beneficiarios - SAF</a> </li>-->
</ul>
</div>

 
<!--<div class="sidenav">
</div> -->
<div class="clearer"><span></span></div>