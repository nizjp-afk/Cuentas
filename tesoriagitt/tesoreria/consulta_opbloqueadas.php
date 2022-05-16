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
	$fecha_cons=$_GET['consul'];
	  include('incluir_siempre.php');


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

 $ss = "SELECT `op_bloqueadas`.`cuit_beneficiario`, `tipo_op_bloqueadas`.`cod_descripcion`, `tipo_op_bloqueadas`.`descripcion`, `beneficiarios_aprobados`.`apellido`, `beneficiarios_aprobados`.`nombre`, `beneficiarios_aprobados`.`razon_social`, `op_bloqueadas`.`clave`, `op_bloqueadas`.`ejercicio`, `op_bloqueadas`.`saf`, `op_bloqueadas`.`nro_esidif`, `op_bloqueadas`.`observaciones`
FROM beneficiarios_aprobados, op_bloqueadas, tipo_op_bloqueadas
WHERE ((`beneficiarios_aprobados`.`cuitl` =op_bloqueadas.cuit_beneficiario) AND (`op_bloqueadas`.`id_tipo_op_bloqueada` =tipo_op_bloqueadas.id))";
     if (!($_pagi_result = mysql_query($ss, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo de op bloqueadas";
      echo $cuerpo1;
	  exit;      
      //.....................................................................
    }    
/*	
if (isset($_POST['busca']))
    { 
	 unset($_GET['_pagi_pg']);
	 $_pagi_actual = 1;
	}   
   
$_pagi_cuantos = 25;
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
	*/

?>
<style>

</style>
<div class="content">

<h2>Ordenes Bloqueadas </h2>
<br />
<form action="" method="post">

<table  width="110%"  border="1" align="center" cellpadding="0" cellspacing="0" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
     <tr class="fuframe1">
    	<td height="30" colspan="3" >Nro. de Orden
    	  <input  name="busnom" type="text" id="busnom" size="30" maxlength="50" />
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
      
       
       <td ><strong>Beneficiario</strong></td>
            
       <td><strong>Concepto Bloqueo</strong></td>
       <td ><strong>Observacion</strong></td>
       <td ></td>
   </tr>
   <?php
 
      while ($f_orden=mysql_fetch_array($_pagi_result))
	  {
		  
		  if ($f_orden['razon_social']=='')
	                                   {
										$bene=$f_orden['apellido'].', '.$f_orden['nombre']; 
													
										}
									else 
									   {
										$bene= $f_orden['razon_social']; }
		  // $apellido_b=$f_orden['apellido'];
		   //$nombre_b=$f_orden['nombre'];
		//   $razon_social=$f_orden['razon_social'];
		   $cuit_beneficiario=$f_orden['cuit_beneficiario'];
		   $cod_descripcion=$f_orden['cod_descripcion'];
		   $descripcion=$f_orden['descripcion'];
		   $clave=$f_orden['clave'];
		   $ejercicio=$f_orden['ejercicio'];
		   $saf=$f_orden['saf'];
		   $nro_esidif=$f_orden['nro_esidif'];
		   $observaciones=$f_orden['observaciones'];
			   
				 

		   ?>
<tr style="font-size:9px">
    <td  height="30" align="center"><?php echo $ejercicio;?></td>
           <td  align="center"><?php echo $saf;?></td>
          <td  align="center"><?php echo 'PRE'.'-'.$nro_esidif;?></td>
         
          <td align="left"  ><?php echo $bene;?></td>
          
          <td  align="left" style="font-size:9px" >&nbsp;<?php echo $cod_descripcion.' '.$descripcion;?></td>
          <td  align="left" style="font-size:9px">&nbsp;<?php echo $observaciones;?></td>
          
          
     
         
          <td  align="center"><a target="_parent" href="indextesoreria.php?sec=retenciones/confirmar_op&apli=cr&consul=<?php echo $fecha_cons; ?>&saf=<?php echo $saf; ?>&per=R&id=<?php echo $f_orden['id']; ?>&nomb=<?php echo $nom; ?>"><img src="img/ok.png" border="0" height="16" width="16"/></a></td>
         
         
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

</div>
<div class="sidenav_ba">
<h2></h2>

</div>
<div class="sidenav_m">
<h2></h2>

 </div>    
 <div class="sidenav_p">
<h2></h2>

 </div>    
 <div class="sidenav_e">
<h2></h2>

 </div>  <div class="sidenav_p">     
  <ul>
	
      <li><a href="indextesoreria.php?sec=retencion/index1&apli=h&per=A">Regresar Menu</a></li>
	
	<!-- <li><a href="indextesoreria.php?sec=tesoreria/saf_consulta&apli=tgpc&per=A">Beneficiarios - SAF</a> </li>-->
</ul>
</div>
<!--<div class="sidenav">
</div> -->
<div class="clearer"><span></span></div>