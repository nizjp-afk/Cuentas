 <?php
  error_reporting ( E_ERROR );
//conexion
	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	$aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
	$fecha_cons=$_GET['consul'];
	
	$ssql = "SELECT * FROM control_ti_saf where numero='$nrosaf'";
     if (!($r_cf= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }	
	
	$f_cf=mysql_fetch_array($r_cf);
	$nro =$f_cf['nro_ti'];
	
	if (isset($_POST['busca']) and !empty($_POST['busnom']))
			{
		 		
				$nom = $_POST['busnom'];
				$ssql = "SELECT sum(`Saldos`) as saldo,sum(`Imp_orden`) as importe,sum(`Total_Pagado`) as total,count( `Numero_OP` ) as cant 
				FROM op_pendiente_tmp_saf 
				where Saf='$nrosaf' 
				and nro_ti='$nro' 
				And Numero_OP='$nom'";
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
		  $ssql = "SELECT sum(`Saldos`) as saldo,sum(`Imp_orden`) as importe,sum(`Total_Pagado`) as total,count( `Numero_OP` ) as cant 
		  FROM op_pendiente_tmp_saf where Saf='$nrosaf' and nro_ti='$nro' ";
				 if (!($r_op= mysql_query($ssql, $conexion_mysql)))
				{
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar buscar area";
				 
				  //.....................................................................
				}
	  }
		
if (isset($_POST['busca']) and !empty($_POST['busnom']))
  {
   $nom = $_POST['busnom'];	  
   $_pagi_sql = "SELECT * FROM op_pendiente_tmp_saf where nro_ti='$nro' and Saf='$nrosaf' And Numero_OP='$nom' ";
  }
 else
  {
	  $_pagi_sql = "SELECT * FROM op_pendiente_tmp_saf where nro_ti='$nro' and Saf='$nrosaf' ";
  }
	
if (isset($_POST['busca']))
    { 
	 unset($_GET['_pagi_pg']);
	 $_pagi_actual = 1;
	}   
   
$_pagi_cuantos = 10;
$_pagi_nav_num_enlaces = 8;
$_pagi_nav_estilo="pag";
$_pagi_propagar=array('sec','nom','apli','per',);
//definimos qué irá en el enlace a la página anterior
$_pagi_nav_anterior = "<img src='img/izq.png' border=0>";// podría ir un tag <img> o lo que sea
$_pagi_nav_primera = "<img src='img/izqfin.png' border=0>";
$_pagi_nav_ultima = "<img src='img/derfin.png' border=0>";
//definimos qué irá en el enlace a la página siguiente
$_pagi_nav_siguiente = "<img src='img/der.png' border=0>";// podría ir un tag <img> o lo que sea
include("paginator.inc.php");


?>
<div class="content">
<h2>Desconfirmar Ordenes Solicitadas  <?php echo $fecha_cons; ?></h2>


<br /> 
<form action="" method="post">


<table  width="103%"  border="1" align="center" cellpadding="0" cellspacing="0" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
     <tr class="fuframe1">
    	<td height="30" colspan="3" >Nro. de Orden
    	  <input  name="busnom" type="text" id="busnom" size="30" maxlength="50" />
      		<input name="busca" type="submit" id="busca" value="Buscar" />
            
	  		  
      </td>
         
         
    </tr>
</table>    
</form>

<div id="aprobar">   
<table width="100%"  border="1" cellpadding="0" cellspacing="0"  >
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
      
   </tr>
   <?php
 
      while ($f_orden=mysql_fetch_array($_pagi_result))
	  {
		   $d_cuit=$f_orden['cuit'];
		  
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
		   
		   if($razon_social_b=='')
		     {
				 $beneficiario=$apellido_b.', '.$nombre_b;
			 }
			else
			 {
				  $beneficiario=$razon_social_b;
			 }
		     
	     	  
	
 
	   if($estado=='A')
{
	?>	
 
	    <tr bgcolor="#F3F3F3"  class="fuframe" > 
 <?php 
   }
 else
 {
?>	
 
	    <tr bgcolor="#8BC5C5" class="fuframe" > 
 <?php 
   }
?>             <td  height="28" align="center"><?php echo $f_orden['Ejercicio'];?></td>
           <td  align="center"><?php echo $f_orden['Saf'];?></td>
          <td  align="center"><?php echo $f_orden['Numero_OP'];?></td>
          <td align="center"><a target="_parent" href="indextesoreria.php?sec=consolidada/desconfirmar_pago&apli=h&per=A&id=<?php echo $f_orden['id']; ?>&consul=<?php echo $fecha_cons; ?>"><img src="img/ok.png" border="0" height="16" width="16"/></a></td>
          <td  align="right"><?php echo $f_orden['Saldos'];?></td>
          
          <td  align="right">&nbsp;<?php echo $f_orden['Imp_orden'];?></td>
          <td  align="right">&nbsp;<?php echo $f_orden['Total_Pagado'];?></td>
                      <td  align="left"><?php echo substr($beneficiario,0,30);?></td>

          <td  align="left"><?php echo substr($f_orden['Concepto'],0,20);?></td>
     
          <td  align="left">&nbsp;<?php echo $f_orden['Fecha_OP'];?></td>
         
          </tr>
          
<?php	   
     
	   
	   }
?>	  
  <TR><TD align="center" colspan="9"><?php //Incluimos la barra de navegaci&oacute;n
              echo"<p>".$_pagi_navegacion."</p>";
              ?></TD></TR>    
 </table> 
 </div>    

<?php
$f_orden=mysql_fetch_array($r_op);
?>
<table width="100%"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
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
<div class="sidenav">
<h2></h2>
<ul>
    
	
    <li><a href="indextesoreria.php?sec=consolidada/modificar_orden_consolidada&consul=<?php echo $fecha_cons; ?>&apli=s&per=A">Modificar Ordenes Autorizadas</a></li>
     <li><a href="indextesoreria.php?sec=consolidada/cargar_orden_consolidada&consul=<?php echo $fecha_cons; ?>&apli=s&per=A">Confirmar Ordenes Pendientes</a></li>
     <li><a href="indextesoreria.php?sec=consolidada/ver_cumplase&consul=<?php echo $fecha_cons; ?>&apli=s&per=A">Imprimir Ordenes Autorizadas</a></li>
     <li><a href="indextesoreria.php?sec=saf/index1&consul&apli=s&per=A">Regresar Menu</a></li>
    
	
	<!-- <li><a href="indextesoreria.php?sec=tesoreria/saf_consulta&apli=tgpc&per=A">Beneficiarios - SAF</a> </li>-->
</ul>
</div>
<!--<div class="sidenav">
</div> -->
<div class="clearer"><span></span></div>