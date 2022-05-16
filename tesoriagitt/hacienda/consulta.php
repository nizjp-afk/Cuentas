<?php
    error_reporting ( E_ERROR );
	$aplicacion = $_GET['apli'];
     $permisosnecesarios = $_GET['per'];
include('incluir_siempre.php');

 include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
	
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
	
   $ssql = "SELECT * FROM `nro_saf` order by numero  ";
     if (!($r_saf= mysqli_query($conexion_mysql,$ssql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
	
	////verifica fecha
	
	$d_fecha=date('Y-m-d');
	




 
 
 
 ?>
<link rel="stylesheet" href="thickbox/thickbox.css" type="text/css" />
<script type="text/javascript" src="thickbox/jquery.js"></script>
<script type="text/javascript" src="thickbox/thickbox.js"></script>



<div class="content">

<h2>CONSULTA Y DESCARGA </h2>


<br /> 
<form action="" method="post">

<table width="900"  border="1" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
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
					SAF <select name="saf">
					<option value="N" selected >Sin Especificar</option>
<?php     
       
                    while ($f_saf = mysqli_fetch_array ($r_saf))
                           {
                      
?>
<OPTION value="<?php echo $f_saf['numero'] ?>"> <?php echo $f_saf['numero'].' - '.$f_saf['nombre']?></OPTION>
               
             <?php
			      }
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
				
				
				
				 $ejercicio = $_POST['ejercicio'];
				 $mes = $_POST['mm'];
				 
							  
			$nombre_mes=ltrim($mes, '0');

if ( $_POST['saf']=='N')
{
					
 $ssql =  "SELECT * FROM `analisis_f`
									WHERE `mm` ='$mes'
									AND `aa` ='$ejercicio' 
									
									order by total desc
									";

	 if (!($datos = mysqli_query($conexion_mysql,$ssql)))
		{
		  //.....................................................................
		  // informa del error producido
		  $cuerpo1  = "al intentar buscar expediente";
		 
		  //.....................................................................
		}

					
					$fecha_ac = "SELECT MAX( `fecha_p` ) as fecha_ac FROM `analisis_f`
              WHERE `mm` ='$mes'
              AND `aa` ='$ejercicio' ";
							  
				 
   
				 if (!($fecha_ac_res= mysqli_query($conexion_mysql,$fecha_ac)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}	
}
					else
					{

						$saf=$_POST['saf'];
						
						$ssql =  "SELECT * FROM `analisis_f`
									WHERE `mm` ='$mes'
									AND `aa` ='$ejercicio' and entidad='$saf'
									
									order by total desc
									";

	 if (!($datos = mysqli_query($conexion_mysql,$ssql)))
		{
		  //.....................................................................
		  // informa del error producido
		  $cuerpo1  = "al intentar buscar expediente";
		 
		  //.....................................................................
		}

					
					$fecha_ac = "SELECT MAX( `fecha_p` ) as fecha_ac FROM `analisis_f`
              WHERE `mm` ='$mes'
              AND `aa` ='$ejercicio' and entidad='$saf' ";
							  
				 
   
				 if (!($fecha_ac_res= mysqli_query($conexion_mysql,$fecha_ac)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}	
						
						
					}
	
	
 $f_ultact = mysqli_fetch_array ($fecha_ac_res);
 
  

$fecha_ua = date("d-m-Y", strtotime($f_ultact['fecha_ac']));


?>       
<p></p>
        
      <form name="" action="indextesoreria.php?sec=hacienda/clasificador&apli=h&per=O" method="post"> 
		  
		   <input type="hidden" name="fecha_mes" value="<?php echo  $mes; ?>" />
		   <input type="hidden" name="fecha_e" value="<?php echo  $ejercicio; ?>" />
        
      <table width="900"  align="left" border="1" cellpadding="0" cellspacing="0" bgcolor="#DBE3E6" bordercolor="#000000"  >
		  <tr bgcolor="#dadada"  >
<td colspan="8" align="right" >
		
        <em><a target="_blank"  title="Seguimiento Pagado" href="hacienda/excel.php?apli=h&per=C&id=<?php echo $saf;?>&mm=<?php echo $mes;?>&aa=<?php echo $ejercicio;?>"> <img src="img/xls.jpg"  width="50" height="50"  border="0" /></a>  </em>
		  <em><a target="_blank" title="Seguimiento Pagado" href="hacienda/analisis_periodo_pdf_s.php?apli=h&per=C&id=<?php echo $saf;?>&mm=<?php echo $mes;?>&aa=<?php echo $ejercicio;?>"> <img src="img/pdf_n.jpg" width="50" height="50"  border="0" /></a>  </em> 
     
		</td>
		  </tr>
<tr bgcolor="#dadada"  >
     <td colspan="8" align="right"><strong>ULTIMA ACTUALIZACION &nbsp;<?php echo $fecha_ua; ?></strong></td>
  </tr>
 
    <tr bgcolor="#F3F3F3"    class="letra"> 
	   <td height="30"  class="fuframe1"  colspan="9" align="center"><font size="+1"> <hr><b>ORDENES PAGADA EN  <?php echo $meses{$nombre_mes-1}.', '.$ejercicio; ?></b></font></td><BR>
</tr>

 


         <tr align="center" class="letra">  
                
                 <td align="center" ><strong>Dia </strong></td>
			 <td align="center" ><strong>Saf </strong></td>
                  <td align="center" ><strong>Tipo </strong></td>
			 <td align="center" ><strong>Ejercicio </strong></td>
                 <td align="center" ><strong>Nro-Esidif </strong></td>
                  <td align="left"  ><strong>Beneficiario </strong></td>
                 <td align="center" ><strong>Observacion </strong></td>
                 
                 <td align="center" ><strong>Importe </strong></td>
			 
                 
  </tr>
          <tr><td colspan="9"><hr></td>
<?php	
		 
 while($datos_r=mysqli_fetch_array($datos))
       {
		
 	  
//$fecha_p=$datos_r['fecha_p'];
$tipo_o=$datos_r['tipo_o'];
$ejer_o=$datos_r['ejer_o'];
$nro_o=$datos_r['nro_o'];
	 $entidad=$datos_r['entidad'];

	 $fecha_p = date("d", strtotime($datos_r['fecha_p']));
	 
$ente=$datos_r['ente'];
$obs_o=$datos_r['obs_o'];
$total=$datos_r['total'];
	 $extra=$datos_r['extra'];
	 $tot=$tot+$total;

		 
?>	
         <tr bgcolor="#F3F3F3"    class="letra"> 
        
         <td align="left" > <?php echo $fecha_p ;?></td>
		   <td align="right"  > <?php echo $entidad ;?></td>
         
          <td align="center" > <?php echo $tipo_o ;?></td>
         <td align="center" > <?php echo $ejer_o ;?></td>
          <td ><?php echo $nro_o;?></td>
         <td ><?php echo $ente;?></td>
		   <td ><?php echo $obs_o;?></td>
         <td align="right"   >&nbsp;<?php echo number_format($total, 2, ',', '.');?></td>
	
          
       </tr>  
       <tr><td colspan="9"><hr></td>
       	
       </tr>       
         
  <?php	
		 } 
				}

	?>

			
</table>
		 <?php
	
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
				
