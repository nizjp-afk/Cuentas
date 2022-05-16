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
	 include('incluir_siempre.php');
	////verifica fecha
	
	$d_fecha=date('Y-m-d');
	
	
if (isset($_POST['busca']) and !empty($_POST['busnom']))
			{
		 		
				$nom = $_POST['busnom'];
				$fecha_cons = $_POST['fecha_cons'];
				
				$ssql = "SELECT sum(`Saldos`) as saldo,sum(`Imp_orden`) 
				as importe,sum(`Total_Pagado`) as total,count( `Numero_OP` ) as cant 
				FROM op_pendientes_fp where Ejercicio='$fecha_cons' 
				and Saf='$nrosaf' and Numero_OP='$nom'";
					 if (!($r_op= mysql_query($ssql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}
					
			 $_pagi_sql = "SELECT * FROM op_pendientes_fp where Ejercicio='$fecha_cons'
		           and Saf='$nrosaf' and Numero_OP='$nom'";
					
					
					
			   }
			elseif ($_GET['_pagi_pg'] >1 and !empty($_GET['nom'])) 
		      
			  {	
			  echo 'paso1';
			    $nom = $_GET['busnom'];
				$fecha_cons = $_GET['fecha_cons'];
				$nrosaf = $_GET['nrosaf'];
				
				$ssql = "SELECT sum(`Saldos`) as saldo,sum(`Imp_orden`) as importe,sum(`Total_Pagado`) as total,count( `Numero_OP` ) as cant 
				FROM op_pendientes_fp where Ejercicio='$fecha_cons' 
				and Saf='$nrosaf' and Numero_OP='$nom'";
					 if (!($r_op= mysql_query($ssql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}
					
			 $_pagi_sql = "SELECT * FROM op_pendientes_fp where Ejercicio='$fecha_cons'
		           and Saf='$nrosaf' and Numero_OP='$nom'";
			  }
			  
			  
	else
	  {
		 
		 $fecha_cons=$_GET['fecha_cons'];
		 
		    $_pagi_sql = "SELECT * FROM op_pendientes_fp where Ejercicio='$fecha_cons' and Saf='$nrosaf' ";
			
		  
		  
		 
		  $ssql = "SELECT sum(`Saldos`) as saldo,sum(`Imp_orden`) as importe,sum(`Total_Pagado`) as total,count( `Numero_OP` ) as cant 
		  FROM op_pendientes_fp where Ejercicio='$fecha_cons' and Saf='$nrosaf' ";
				 if (!($r_op= mysql_query($ssql, $conexion_mysql)))
				{
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar buscar area";
				 
				  //.....................................................................
				}
	  }
		
$_pagi_cuantos = 10;
$_pagi_nav_num_enlaces = 15;
$_pagi_nav_estilo="pag";
$_pagi_propagar=array('sec','nom','fecha_cons','nrosaf','apli','per');
//definimos qué irá en el enlace a la página anterior
$_pagi_nav_anterior = "<img src='img/izq.png' border=0>";// podría ir un tag <img> o lo que sea
$_pagi_nav_primera = "<img src='img/izqfin.png' border=0>";
$_pagi_nav_ultima = "<img src='img/derfin.png' border=0>";
//definimos qué irá en el enlace a la página siguiente
$_pagi_nav_siguiente = "<img src='img/der.png' border=0>";// podría ir un tag <img> o lo que sea
include("paginator.inc.php");  


?>
<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
<div class="content">

<h2>Ordenes Pendientes de Pago -Fondo Propio- <?php echo $fecha_cons; ?></h2>


<br /> 
<form action="" method="post">

<table width="100%"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
<tr>
    	<td height="30" colspan="3" >Orden de Pago Nro.:<input  name="busnom" type="text" id="busnom" size="30" maxlength="50" />
      		<input name="busca" type="submit" class="tabla_jugando" id="busca" value="Buscar" />
            <input type="hidden" name="fecha_cons" value="<?php echo  $fecha_cons; ?>" />
	  		  
        </td>
         </td>
         <td height="30" colspan="2" ><a title="Listado de Orden de Pago Pendientes -Fondo Propio-" href="pendientes/listado_ordenes_pendientes.php?consul=<?php echo $fecha_cons; ?>&saf=<?php echo $nrosaf; ?>" target="_blank"  ><img src="img/print_odp.jpg" width="35" align="" height="24" border="0"/></a>   
		</td>  
         
    </tr>
</table>    
</form>
<table width="100%"  border="1" align="left" cellpadding="0" cellspacing="0" bgcolor="#DBE3E6" bordercolor="#EAEAEA">
   <tr class="fuframe" >
   <td width="18"><strong>SAF</td>
       <td width="25"><strong>Nr.Orden</td>
       <td width="65" align="center"><strong>Beneficiarios</td>
       <td width="65" align="center"><strong>Concepto</td>
       <td width="43"><strong>Imp. Pagado</td>
       <td width="43"><strong>Imp. Form</td>
       <td width="43"><strong>Saldos Disp</td>
          
   </tr>

 
 <?php
 
      while ($f_ordenp=mysql_fetch_array($_pagi_result))
	  {
?>	
  
	    <tr bgcolor="#F3F3F3"  class="fuframe1" > 
           
           <td width="31" align="center"><?php echo $f_ordenp['Saf'];?></td>
          <td width="66" align="center"><?php echo $f_ordenp['Numero_OP'];?></td>
          <td width="136" align="left"><?php echo substr($f_ordenp['Beneficiario'],0,20);?></font></td>
         <td width="136" align="left"><?php echo substr($f_ordenp['Concepto'],0,25);?></font></td>
         
          <td width="85" align="right">&nbsp;<?php echo $f_ordenp['Total_Pagado'];?></td>
           <td width="77" align="right">&nbsp;<?php echo $f_ordenp['Imp_orden'];?></td>
          <td width="77" align="right"><?php echo $f_ordenp['Saldos'];?></td>
          
         
         
          
          
<?php	   
     
	   
	   }
?>	   

<tr>
		<td align="center" colspan="8">
	
		</td>
	</tr>	
<tr>
		<td align="center" colspan="8">
	<?php //Incluimos la barra de navegacion
        echo $_pagi_navegacion;
        ?>
		</td>
	</tr>	          
</table>



<?php
$f_orden=mysql_fetch_array($r_op);
?>
<table width="100%"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBE3E6" bordercolor="#EAEAEA" class="fuframe" >
   <tr>
    	<td width="47%" height="33"  ><strong>Cantidad de Ordenes Pendientes:</strong></td>
        <td width="50%" align="right"><?php echo $f_orden['cant']; ?></td>
    </tr>

  <tr>
    	<td height="33" colspan="2"><strong>Importes Totales</strong></td>
        
    </tr>
     <tr>
      <td height="31" align="right"><strong>Saldos Disp.:</strong></td><td align="right"> <?php echo number_format($f_orden['saldo'],2); ?> </td></tr>
     <tr> 
  <td height="29" align="right"><strong> Imp. Form.:</strong></td><td align="right"> <?php echo number_format($f_orden['importe'],2); ?> </td></tr>
      <tr>
        <td height="39" align="right"><strong>Imp.Pagado:</strong></td><td align="right"> <?php echo number_format($f_orden['total'],2); ?> </td>
         <td width="3%"></td>
    </tr>
</table>    
</div>
<div class="sidenav">
<h2></h2>
<ul>
    

      <li><a href="indextesoreria.php?sec=pendientes/index1_saf&apli=s&per=A">Regresar Menu</a></li>
	
	<!-- <li><a href="indextesoreria.php?sec=tesoreria/saf_consulta&apli=tgpc&per=A">Beneficiarios - SAF</a> </li>-->
</ul>
</div>
<!--<div class="sidenav">
</div> -->
<div class="clearer"><span></span></div>