 <?php
  error_reporting ( E_ERROR );
//conexion
	 include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
	
	$aplicacion = $_GET['apli'];
     $permisosnecesarios = $_GET['per'];
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

    return round(intval($date2 - $date1) / (60 * 60 * 24));

    
}	
	
  
	
	////verifica fecha
	
	$d_fecha=date('Y-m-d');
	




 
 
 
 ?>
<link rel="stylesheet" href="thickbox/thickbox.css" type="text/css" />
<script type="text/javascript" src="thickbox/jquery.js"></script>
<script type="text/javascript" src="thickbox/thickbox.js"></script>



<div class="content">

<h2>Analisis </h2>


<br /> 
<form action="" method="post">

<table width="100%"  border="1" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
<tr>
    	<td height="30"  class="fuframe1" >
                <strong>Ejercicio</strong><!--<select name="ejercicio">
                    <option value="2016">2016</option>
                    <option value="2015">2015</option>
                    
                </select>-->
                 <select name="ejercicio"  >
                      <option  value="---">A&ntilde;o</option>
                      <?php
                        $fechaactual=strtotime('now');
                        $anioactual=substr(date('d/m/Y',$fechaactual),6,4);
						
						$j=$anioactual;
						
                       // $anioactual=$anioactual-1;
						for ($i=2019;$i<$j;$i++)
                        {
                        echo "<option value='$anioactual'";
                       
                        echo ">".$anioactual."</option>";
                        $anioactual=$anioactual-1;
                        }
?>
					 
					 </select>
					 <!--<select name="mm"  >
                      <option  value="0">MES</option>
              <?php
                              /*   $meses= array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto',
                                        'Septiembre','Octubre','Noviembre','Diciembre');
                                $meshtml="";
                                for ($i=1;$i<13;$i++)
                                {
                                $meshtml= $i; if ($i<10) {$meshtml= "0".$i;}
                                echo "<option value='$meshtml'";
                                echo ">".$meses{$i-1}."</option>";
                                } */?>
                        
						
?>
                     </select>-->
					 
				
            
      		<input name="busca" type="submit" class="tabla_jugando" id="busca" value="Buscar" />
            <input type="hidden" name="fecha_cons" value="<?php echo  $fecha_cons; ?>" />
            <input type="hidden" name="band" value="<?php echo $bandera;?>" /> 
             <input type="hidden" name="nom" value="<?php echo $nom; ?>" /> 
            
	  		  
          
         
         
    </tr>
</table>    
</form>
<?php
	
if (isset($_POST['busca']) )
			{
				
				if  (!empty($_POST['ejercicio']) )
                      {
		 		//echo 'paso1';echo "<br>";
				
				
				
				 $ejercicio = $_POST['ejercicio'];
				// $mes = $_POST['mm'];
				 
							  
							
					
							  $_pagi_sql = "SELECT *
FROM `cuentas_recaudacion`
ORDER BY `titular` , `ffin` ";
							  
				
  
   
				 if (!($_pagi_result= mysqli_query($conexion_mysql,$_pagi_sql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}		
		 $cant = mysqli_num_rows($_pagi_result);
					  
		
  $nombre_mes=ltrim($mes, '0');
					
					
					$fecha_ac = "SELECT MAX( `fecha` ) as fecha_ac FROM `cuenta_ingreso`
              WHERE `aa` ='$ejercicio' ";
							  
				 
   
				 if (!($fecha_ac_res= mysqli_query($conexion_mysql,$fecha_ac)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}		
 $f_ultact = mysqli_fetch_array ($fecha_ac_res);
					
					
					
					
					
 
  

$fecha_ua = date("d-m-Y", strtotime($f_ultact['fecha_ac']));
                                
			  
if ($cant>0)
	     {

?>			 

<br />
<br />
<br />
<table width="130%"  border="1" align="CENTER" cellpadding="3" cellspacing="2" bgcolor="#DBE3E6" bordercolor="##c5cccf" >
	<tr bgcolor="#FFFFFF">
	  <td colspan="7"  >
		
        <em>Analisis de Recurso /Acumulado<a target="_blank"  title="Informe Detallado de Recurso" href="hacienda/analisis_detalle_recurso_pdf.php?apli=h&per=C&aa=<?php echo $ejercicio;?>"> <img src="img/pdf1.jpg"   width="30" height="30"  border="0" /></a>  </em> &nbsp;&nbsp;&nbsp;&nbsp;
		 
     
		</td>
	</tr>
	  
	<tr bgcolor="#dadada"  >
     <td colspan="7" align="right"><strong>ULTIMA ACTUALIZACION &nbsp;<?php echo $fecha_ua; ?></strong></td>
  </tr>
 <tr bgcolor="#dadada"  >
     <td colspan="7" align="center"><font size="+1"><strong>INGRESO &nbsp;<?php echo $meses{$nombre_mes-1}.', '.$ejercicio; ?></strong></font></td>
  </tr>
  <tr bgcolor="#dadada" align="center">
     <td><strong>Saf</strong></td>
     <td ><strong>Cuenta</strong></td>
     
     <td ><strong>FFin</strong></td>
	  <td ><strong>Denominacion</strong></td>
	   <td ><strong>Total</strong></td>
	    <td ><strong>&nbsp;</strong></td>
	 
          
   </tr>
<?php


	   
			 //echo 'paso2';echo "<br>";

			  while ($f_limit=mysqli_fetch_array($_pagi_result))
	            {
                  
				  $saf=$f_limit['titular'];
				  $cuenta= $f_limit['banco'].'-'.$f_limit['sucursal'].'-'.$f_limit['cuenta'];
				  
				   $b= $f_limit['banco'];
				   $s= $f_limit['sucursal'];
				   $c= $f_limit['cuenta'];
				  
				   $ffin=$f_limit['ffin'];
				  $denominacion=$f_limit['denominacion'];
				  
				  
				  
				 				
				  
				   $saf_ac = "SELECT sum(monto) as acumulado
									FROM `cuenta_ingreso`
									WHERE `cuenta` ='$c'
									and `sucursal` ='$s'
									and `banco` ='$b'
									";
							  
				
  
   
				 if (!($f_saf_ac= mysqli_query($conexion_mysql,$saf_ac)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}	
				  
				  $f_safac=mysqli_fetch_array($f_saf_ac);
					  $tota_ac_saf=$f_safac['acumulado'];
				  
				  
				  $total_a=$total_a+$tota_ac_saf;
				 
	if($tota_ac_saf >0)
	{
		?>
	
		        
		  
	<tr bgcolor="#F3F3F3">
     
           <td  align="center" > <?php echo $saf;?></td>
          
          <td align="left"  ><?php echo $cuenta;?></td>
		
		  <td align="center"  ><?php echo $ffin;?></td> 
		 <td align="left"  ><?php echo $denominacion;?></td>
          
		<td  align="right" >&nbsp;<?php echo number_format($tota_ac_saf, 2, ',', '.')?></td>
        <td align="center" ><em><a title="Seguimiento Ingresado" href="hacienda/seguimiento_ingreso.php?apli=h&per=C&id=<?php echo $saf;?>&mm=<?php echo $mes;?>&aa=<?php echo $ejercicio;?>&height=700&width=900&modal=true" class="thickbox"> <img src="img/lupa.jpg" width="25" height="25"  border="0" /></a>  </em></td> 
		

</tr>
	

<?php
	}
	
	}
$vart=$total_a*100;
				  $pora=$vart/$total_g;
				  $vp = number_format($pora, 2, '.', '');
	
	?>
	
    <tr >
		<td colspan="3">TOTAL</td>
		
				<td align="right"  > $ <?php echo number_format($total_a, 2, ',', '.') ;?>
				
	
		</td>
	</tr>	
        
	<tr bgcolor="#FFFFFF">
	  <td colspan="7" align="right" >
		
    
        <em>Analisis de Recurso /Acumulado<a target="_blank"  title="Informe Detallado de Recurso" href="hacienda/analisis_detalle_recurso_pdf.php?apli=h&per=C&aa=<?php echo $ejercicio;?>"> <img src="img/pdf1.jpg"   width="30" height="30"  border="0" /></a>  </em> &nbsp;&nbsp;&nbsp;&nbsp;
		 
     
		</td>
	</tr>
</table>
<?php
 
			}
					
				}
}
	?>	   

   

</div>

<div class="sidenav_p">
<h2></h2>
<ul>
 
      <li><a href="indextesoreria.php?sec=hacienda/index1&apli=h&per=C">Regresar Menu</a></li>
	
	<!-- <li><a href="indextesoreria.php?sec=tesoreria/saf_consulta&apli=tgpc&per=A">Beneficiarios - SAF</a> </li>-->
</ul>
</div>
<div class="clearer"><span></span></div>
<!--<div class="sidenav">
</div> -->
<div class="clearer"><span></span></div>