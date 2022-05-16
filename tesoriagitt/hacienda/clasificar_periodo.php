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

<h2>CLASIFICAR </h2>


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
			 $saf_c = $_POST['saf'];
				 
							  
			$nombre_mes=ltrim($mes, '0');
if ($saf_c=='N')

{
	
	$ssql =  "SELECT * FROM `analisis_f`
									WHERE `mm` ='$mes'
									AND `aa` ='$ejercicio' 
									
									order by fecha_p desc
									";
	
}
 else
 {
	 
	 $ssql =  "SELECT * FROM `analisis_f`
									WHERE `mm` ='$mes'
									AND `aa` ='$ejercicio' 
									and entidad='$saf_c'
									
									order by fecha_p desc
									";
 }

	 if (!($datos = mysqli_query($conexion_mysql,$ssql)))
		{
		  //.....................................................................
		  // informa del error producido
		  $cuerpo1  = "al intentar buscar expediente";
		 
		  //.....................................................................
		}



?>       
<p></p>
        
      <form name="" action="indextesoreria.php?sec=hacienda/clasificador&apli=h&per=O" method="post"> 
		  
		   <input type="hidden" name="fecha_mes" value="<?php echo  $mes; ?>" />
		   <input type="hidden" name="fecha_e" value="<?php echo  $ejercicio; ?>" />
		   <input type="hidden" name="saf" value="<?php echo  $saf_c; ?>" />
        
      <table width="950"  align="left" border="1" cellpadding="0" cellspacing="0" bgcolor="#DBE3E6" bordercolor="#000000"  >


 
    <tr bgcolor="#F3F3F3"    class="letra"> 
	   <td height="30"  class="fuframe1"  colspan="10" align="center"><font size="+1"> <hr><b>CLASIFICAR EXCEDENTES <?php echo $meses{$nombre_mes-1}.', '.$ejercicio; ?></b></font></td><BR>
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
			  <td width="20"  ><strong></strong></td>
			  <td align="center" width="20"><strong>FF </strong></td>
                 
  </tr>
          <tr><td colspan="10"><hr></td>
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
	 $ff=$datos_r['ff'];
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
	<?php
	 if($extra =='N')
	 {
		 ?>
			 <td align="right" ><input type="checkbox" name="C<?php echo $datos_r['id'];?>" value='S' /></td>
		<?php	 
	 }

	 else
	 {
		 ?>
			<td align="right" width="15px" ><input type="checkbox" checked   name="C<?php echo $datos_r['id'];?>" value="S" /></td> 
		<?php	 
	 }
		 ?>
          
      	  <td ><?php echo $ff;?></td>
		  </tr>  
       <tr><td colspan="10"><hr></td>
       	
       </tr>       
         
  <?php	
		 } 
				}

	?>
<tr>        
              
      <td align="center" colspan="10"><INPUT type="image" title="Confirmar Devolucion" src="img/grabar.png"   /></td>      
     
     
     </tr> 
			
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
				
