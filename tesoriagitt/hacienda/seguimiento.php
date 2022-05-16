<?php
    error_reporting ( E_ERROR );
	  $aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
	
    include('incluir_siempre.php'); 
	
    $usuario= $_GET['usr'];
    $saf= $_GET['id'];
    $mes= $_GET['mm'];
    $ejercicio= $_GET['aa'];

	// $expe=$_GET['expe'];

    include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');

////////////////////

/*
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
*/
//


 $ssql =  "SELECT *
									FROM `analisis_f`
									WHERE `mm` ='$mes'
									AND `aa` ='$ejercicio'
									and entidad ='$saf'
									order by total desc
									";

	 if (!($datos = mysqli_query($conexion_mysql,$ssql)))
		{
		  //.....................................................................
		  // informa del error producido
		  $cuerpo1  = "al intentar buscar expediente";
		 
		  //.....................................................................
		}



?>       
<p></p>
        
        
        
      <table align="left" class="textbox" width="900" style="border: #999 1px solid; border-collapse: separate; padding: 7" id="example" >


 
    <tr>
	   <td height="30"  class="fuframe1"  colspan="7" align="center"><font size="+1"> <hr><b>Consulta de Pagos <?php echo 'SAF '.$saf;?></b></font></td><BR>
</tr>

 


         <tr bgcolor="#C4F0F9">    
                
                 <td align="center" ><strong>Fecha </strong></td>
                  <td align="center" ><strong>Tipo </strong></td>
			 <td align="center" ><strong>Ejercicio </strong></td>
                 <td align="center" ><strong>Nro-Esidif </strong></td>
                  <td align="left"  ><strong>Beneficiario </strong></td>
                 <td align="center" ><strong>Observacion </strong></td>
                 
                 <td align="center" ><strong>Importe </strong></td>
                 
  </tr>
          <tr><td colspan="7"><hr></td>
<?php	
		 
 while($datos_r=mysqli_fetch_array($datos))
       {
		
 	  
$fecha_p=$datos_r['fecha_p'];
$tipo_o=$datos_r['tipo_o'];
$ejer_o=$datos_r['ejer_o'];
$nro_o=$datos_r['nro_o'];

$ente=$datos_r['ente'];
$obs_o=$datos_r['obs_o'];
$total=$datos_r['total'];
	 $extra=$datos_r['extra'];
	 $tot=$tot+$total;

	if($extra == 'S')	
	{
		
	
?>	
      <tr bgcolor="#DB7072"  >
        
         <td align="center" > <?php echo $fecha_p ;?></td>
         
          <td align="center" > <?php echo $tipo_o ;?></td>
         <td align="center" > <?php echo $ejer_o ;?></td>
          <td ><?php echo $nro_o;?></td>
         <td ><?php echo $ente;?></td>
		   <td ><?php echo $obs_o;?></td>
         <td align="right"   >&nbsp;<?php echo number_format($total, 2, ',', '.');?></td>
          
             
         
  <?php	
		 } 
	else
	{
		?>
		 <tr >
        
         <td align="center" > <?php echo $fecha_p ;?></td>
         
          <td align="center" > <?php echo $tipo_o ;?></td>
         <td align="center" > <?php echo $ejer_o ;?></td>
          <td ><?php echo $nro_o;?></td>
         <td ><?php echo $ente;?></td>
		   <td ><?php echo $obs_o;?></td>
         <td align="right"   >&nbsp;<?php echo number_format($total, 2, ',', '.');?></td>
          
       </tr> 
		  
		  
		<?php
		
		
	}	
	 
	 ?>
		  </tr>  
       <tr><td colspan="7"><hr></td>
       	
       </tr> 

<?php
	 
	 
 }
			?>
<tr height="20" align="center">
		
	<td height="30"   colspan="7" align="right">Total General $ <?php echo number_format($tot, 2, ',', '.') ;?>
			
</table>
				
