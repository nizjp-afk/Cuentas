 <?php
  //error_reporting ( E_ERROR );
//conexion
	 include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
	
	$accion='Consulta de Ordenes Bloqueadas';
		  $tabla='Ordenes_bo';
		  include('agrego_movi.php'); 
	
	$aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
	
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

    return round(intval($date2 - $date1) / (60 * 60 * 24));

    
}	
	
	
	
	////verifica fecha
	
	$d_fecha=date('Y-m-d');
	




 
 
 
 ?>
 
<div class="content">

<h2>Consulta de Ordenes Bloqueadas  </h2>


<br /> 
<form action="" method="post">


<?php
	

		 		//echo 'paso1';echo "<br>";
				
				
				
							  
						
					
					
			  $_pagi_sql = "SELECT `op_bloqueadas`.`cuit_beneficiario`, `tipo_op_bloqueadas`.`cod_descripcion`, `tipo_op_bloqueadas`.`descripcion`, `beneficiarios_aprobados`.`apellido`, `beneficiarios_aprobados`.`nombre`, `beneficiarios_aprobados`.`razon_social`, `op_bloqueadas`.`clave`, `op_bloqueadas`.`ejercicio`, `op_bloqueadas`.`saf`, `op_bloqueadas`.`nro_esidif`, `op_bloqueadas`.`observaciones`,`op_bloqueadas`.`fecha`
FROM beneficiarios_aprobados, op_bloqueadas, tipo_op_bloqueadas
WHERE ((`beneficiarios_aprobados`.`cuitl` =op_bloqueadas.cuit_beneficiario) AND (`op_bloqueadas`.`id_tipo_op_bloqueada` =tipo_op_bloqueadas.id)
 and op_bloqueadas.saf='$nrosaf')
 and op_bloqueadas.estado='B'
 order by  `op_bloqueadas`.`ejercicio`,`op_bloqueadas`.`nro_esidif`  ";
	

							  
				 if (!($_pagi_result= mysql_query($_pagi_sql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}		
		$cant = mysql_num_rows($_pagi_result);
					  
			
 
			  


?>
<table width="130%"  border="1" align="CENTER" cellpadding="3" cellspacing="1" bgcolor="#DBE3E6" bordercolor="##c5cccf" >
 <tr bgcolor="#dadada"  >
     <td colspan="10" align="center"><font size="+1"><strong>Ordenes Bloqueadas</strong></font></td>
  </tr>
  <tr bgcolor="#dadada">
     <td><strong> Fecha</strong> </td>
     <td><strong>Ejer</strong></td>
     <td><strong>Saf</strong></td>
     <td ><strong>Nr.Orden</strong></td>
     <td ><strong>Beneficiarios</strong></td>
     <td><strong>Concepto Bloqueo</strong></td>
     <td ><strong>Observacion</strong></td>
          
   </tr>
<br>
<?php
	   if ($cant>0)
	     {
			 //echo 'paso2';echo "<br>";
?>			 

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
		   $ejerciciob=$f_orden['ejercicio'];
		   $safb=$f_orden['saf'];
		   $nro_esidif=$f_orden['nro_esidif'];
		   $observaciones=$f_orden['observaciones'];
		   // $fecha=$f_orden['fecha'];
		 		 
		 
		 $f_g=explode("-", $f_orden['fecha']); 
           $fecha=$f_g[2].'-'.$f_g[1].'-'.$f_g[0]; 
	
		 
		  $ssql = "SELECT * FROM historial_orden
			            where numero_op='$nom_op' 
						and ejercicio='$ejercicio'
						and saf='$saf'
						";
			 if (!($r_hist= mysql_query($ssql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar tipo de iva";
					  echo $cuerpo1;
					  //.....................................................................
					}  
	
	        $f_hist =  mysql_fetch_array($r_hist);
			$obser = nl2br($f_hist['observacion']);
		 
		  ?>
	<tr bgcolor="#F3F3F3">
     <td  align="center" style="font-size:11px" ><?php echo $fecha;?></td>
    <td  height="30" align="center" style="font-size:11px"><?php echo $ejerciciob;?></td>
           <td  align="center" style="font-size:11px"><?php echo $safb;?></td>
          <td  align="center" style="font-size:11px"><?php echo 'PRE'.'-'.$nro_esidif;?></td>
         
          <td align="left" style="font-size:11px" ><?php echo $bene;?></td>
          
          <td  align="left" style="font-size:10px" >&nbsp;<?php echo $cod_descripcion.' '.$descripcion;?></td>
          <td  align="left" style="font-size:10px">&nbsp;<?php echo $observaciones;?></td>
          
          



<?php
	}
	
?>
<tr>
		<td align="center" colspan="8">
	
		</td>
	</tr>	
        
</table>
<?php
		 }
			
?>	   

    <br />
<br />
<br />
<br />
<br />
<br />

</div>
<!--<div class="sidenav_m">
<h2></h2>
<ul>
      <li><strong> BLOR: </strong>Bloqueada/Retenciones</li>
    
 </ul>
 </div>-->
<div class="sidenav_p">
<h2></h2>
<ul>
 
      <li><a href="indextesoreria.php?sec=saf/index1&apli=s&per=E">Regresar Menu</a></li>
	
	<!-- <li><a href="indextesoreria.php?sec=tesoreria/saf_consulta&apli=tgpc&per=A">Beneficiarios - SAF</a> </li>-->
</ul>
</div>
<div class="clearer"><span></span></div>
<!--<div class="sidenav">
</div> -->
<div class="clearer"><span></span></div>