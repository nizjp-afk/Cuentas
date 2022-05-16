 <?php
  error_reporting ( E_ERROR );
//conexion
	 include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
	
	$aplicacion = $_GET['apli'];
   echo  $permisosnecesarios = $_GET['per'];
	
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
					 <select name="mm"  >
                      <option  value="0">MES</option>
              <?php
                                 $meses= array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto',
                                        'Septiembre','Octubre','Noviembre','Diciembre');
                                $meshtml="";
                                for ($i=1;$i<13;$i++)
                                {
                                $meshtml= $i; if ($i<10) {$meshtml= "0".$i;}
                                echo "<option value='$meshtml'";
                                echo ">".$meses{$i-1}."</option>";
                                } ?>
                        
						
?>
                     </select>
					 
				
            
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
				
				if  (!empty($_POST['ejercicio']) and !empty($_POST['mm']))
                      {
		 		//echo 'paso1';echo "<br>";
				
				
				
				echo $ejercicio = $_POST['ejercicio'];
				echo $mes = $_POST['mm'];
				 
							  
							
					
							  $_pagi_sql = "SELECT *
									FROM `limites_f`
									WHERE `mm` ='$mes'
									AND `aa` ='$ejercicio'";
							  
				
  
   
				 if (!($_pagi_result= mysql_query($_pagi_sql, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}		
		 $cant = mysql_num_rows($_pagi_result);
					  
		
  $nombre_mes=ltrim($mes, '0');
                                
			  
if ($cant>0)
	     {

?>			 

<br />
<br />
<br />
<table width="130%"  border="1" align="CENTER" cellpadding="3" cellspacing="1" bgcolor="#DBE3E6" bordercolor="##c5cccf" >
 <tr bgcolor="#dadada"  >
     <td colspan="7" align="center"><font size="+1"><strong>Analisis &nbsp;<?php echo $meses{$nombre_mes-1}.', '.$ejercicio; ?></strong></font></td>
  </tr>
  <tr bgcolor="#dadada" align="center">
     <td><strong>Saf</strong></td>
     <td ><strong>Limite</strong></td>
     
     <td ><strong>Acumulado</strong></td>
	  <td ><strong>Variacion</strong></td>
	   <td ><strong>Diferencia</strong></td>
	  <td ><strong></strong></td>
          
   </tr>
<?php


	   
			 //echo 'paso2';echo "<br>";

			  while ($f_limit=mysql_fetch_array($_pagi_result))
	            {
                  
				  $saf=$f_limit['entidad'];
				  $total_l=$f_limit['total'];
				  $total_g=$total_g+$total_l;
				  
				 				
				  
				   $saf_ac = "SELECT sum(total) as acumulado
									FROM `analisis_f`
									WHERE `mm` ='$mes'
									AND `aa` ='$ejercicio'
									and entidad ='$saf'
									";
							  
				
  
   
				 if (!($f_saf_ac= mysql_query($saf_ac, $conexion_mysql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}	
				  
				  $f_safac=mysql_fetch_array($f_saf_ac);
					  $tota_ac_saf=$f_safac['acumulado'];
				   $dif=$total_l-$tota_ac_saf;
				  
				  $total_a=$total_a+$tota_ac_saf;
				  $total_d=$total_d+$dif;
				  
		          $var=$tota_ac_saf*100;
				  $por=$var/$total_l;
				  $english_format_number = number_format($por, 2, '.', '');
		  ?>
	<tr bgcolor="#F3F3F3">
     
           <td  align="center" > <?php echo $saf;?></td>
          
          <td align="right"   >&nbsp;<?php echo number_format($total_l, 2, ',', '.');?></td>
		<td  align="right" >&nbsp;<?php echo number_format($tota_ac_saf, 2, ',', '.')?></td>
		<?php 
			  if($english_format_number>100)
			  {
				  ?>
		<td bgcolor="#FD5D60"   align="center" >&nbsp;<?php echo $english_format_number;?></td>
		
		
		<?php
			  }
else
{
	?>
		<td  align="center" >&nbsp;<?php echo $english_format_number;?></td>
		
	
		
		<?php
}
				  
 ?>         
		<td  align="right" >&nbsp;<?php echo number_format($dif, 2, ',', '.')?></td>
        <td align="center" ><em><a title="Seguimiento Pagado" href="hacienda/seguimiento.php?apli=h&per=C&id=<?php echo $saf;?>&mm=<?php echo $mes;?>&aa=<?php echo $ejercicio;?>&height=700&width=900&modal=true" class="thickbox"> <img src="img/lupa.jpg" width="25" height="25"  border="0" /></a>  </em></td> 
		

</tr>

<?php
	}
	?>
    <tr>
		<td align="center" colspan="2">Total General $ <?php echo $total_g ;?>
			<td align="center" > $ <?php echo $total_a ;?>
				<td align="center" > $ <?php echo $total_d ;?>
				
	
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