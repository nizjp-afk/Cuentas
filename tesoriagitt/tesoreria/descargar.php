<?php
error_reporting ( E_ERROR );

 $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];
 //include('../incluir_siempre.php');

//estable la conexion  

    include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
 
 $id=trim($_GET['id']);
 $cuit=$_GET['cuit'];
// $nombre_r=$_GET['nombre'];



$_pagi_sql = "SELECT cuitl,apellido,nombre,nombre_f,razon_social
		            
					  FROM beneficiarios_aprobados  where id_beneficiario='$id'";



if (!($result_b = mysql_query($_pagi_sql,$conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar articulo";
     
      //.....................................................................
    }


$f_persona=mysql_fetch_array($result_b);

if($f_persona['razon_social']=='')
			     {
					 if($f_persona['nombre_f']=='')
					   {
						   $nombre_b= $f_persona['apellido'].", ".$f_persona['nombre'];
					   }
					 else 
					   {
						   $nombre_b= $f_persona['apellido'].", ".$f_persona['nombre']."       ' ".$f_persona['nombre_f']." '";
					   }
				 }
			   else
			     {	  
		          echo $nombre_b=$f_persona['razon_social'];
				 }




 $ssql =  "SELECT * FROM pdf_beneficiario WHERE beneficiario_id ='$id'";
 if (!($result_a = mysql_query($ssql,$conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar articulo";
     
      //.....................................................................
    }	


 $sql = "SELECT COUNT(*) total FROM pdf_beneficiario WHERE beneficiario_id ='$id'";
$result = mysql_query($sql,$conexion_mysql);
 $fila = mysql_fetch_assoc($result);
//echo 'Número  total de registros: ' . $fila['total'];
 	
 //echo $cant_a= mysql_num_rows($result_a);
 

if($fila['total'] > 0 )
	 {
	
	

?>

<style type="text/css">
<!--
.Estilo1 {
	font-size: 12px;
	font-weight: bold;
}
.Estilo2 {
	font-size: 10px;
	
}
-->
</style>
<body>
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
<input type="hidden" name="residentes" value="<?php echo $residentes;?>"> 

<table width="700" align="center" cellpadding="4" cellspacing="0" class="tabla_jugando">
<tr><td ></td></TR>   
   

<tr>
    <td   align="left" colspan="2" >
    <div align="left" ><span class="subtitulo"><font color="#DB921B"   size='3' face='Verdana, Arial, Helvetica, sans-serif'>Beneficiario: <?php echo 'CUIT :'.$cuit.' - '.$nombre_b;?> </font>
      
          
    </span></div></td>
  </tr>
	<tr>
    <td   align="left" colspan="2" >
    <div align="left" ><span class="subtitulo"><font color="#DB921B"   size='3' face='Verdana, Arial, Helvetica, sans-serif'>Documentacion Presentada</font>
      
          
    </span></div></td>
  </tr>
	<?php
	
	while($fila_a=mysql_fetch_array($result_a))
			{


				 $carpeta="documentos";
				 $contenido =$fila_a['nombre_pdf'];
		   $archivo=$carpeta.'/'.$contenido;
		
		$ext = pathinfo($contenido, PATHINFO_EXTENSION);
		
		?>
	  
		  <tr>
    <td   align="left" >
		</td>
      <?php
		if($ext=='pdf')
		{
			  ?>
			  
      <td> <em><a target="_blank" title="Descargar Archivo" href="<?php echo $archivo; ?>"> <img src="img/pdf1.jpg"   width="40" height="40" border="0" title="" /> </a>  </em>
    <?php echo $contenido;?></td>
			  
			  <?php
		}

		elseif($ext=='xls' or $ext=='xlsx' or $ext=='csv')
		{
			
			?>
			  
      <td> <em><a target="_blank" title="Descargar Archivo" href="<?php echo $archivo; ?>"> <img src="img/xls.jpg"    width="40" height="40" border="0" title="" /> </a>  </em>
    <?php echo $contenido;?></td>
			  
			  <?php
			
		}
     elseif($ext=='doc' or $ext=='docx'or $ext=='txt')
		{
			  ?>
			  
      <td> <em><a target="_blank" title="Descargar Archivo" href="<?php echo $archivo; ?>"> <img src="img/word.jpg"   width="40" height="40" border="0" title="" /> </a>  </em>
    <?php echo $contenido;?></td>
			  
			  <?php
		}
			  
		elseif($ext=='jpg')
		{
			  ?>
			  
      <td> <em><a target="_blank" title="Descargar Archivo" href="<?php echo $archivo; ?>"> <img src="img/dib.png"   width="40" height="40" border="0" title="" /> </a>  </em>
    <?php echo $contenido;?></td>
			  
			  <?php
		}
			
		elseif($ext=='png')
		{
			  ?>
			  
      <td> <em><a target="_blank" title="Descargar Archivo" href="<?php echo $archivo; ?>"> <img src="img/dib1.png"   width="40" height="40" border="0" title="" /> </a>  </em>
    <?php echo $contenido;?></td>
			  
			  <?php
		}
			 	  
			  
			  else
		{
			  ?>
			  
      <td> <em><a target="_blank" title="Descargar Archivo" href="<?php echo $archivo; ?>"> <img src="img/ni.png"   width="40" height="40" border="0" title="" /> </a>  </em>
    <?php echo $contenido;?></td>
			  
			  <?php
		}
			  
			  ?>
  </tr>
<?php
			 }
		
  ?>

   
  </table>
</form>

<?php
}
		else
		{
	?>		
		<meta http-equiv='refresh' content='3;url=javascript:window.history.back()'>
	  <table width='80%'   border='0' align='center'>
             <tr>
             <td></td>
             </tr>
             <tr>
             <td height='293' valign='top' class='bg-tp-3a'>
             <br>
	         <p align='center'><b><font color='#CC0000' size='5' face='Verdana, Arial, Helvetica, sans-serif'>No Existe Documentacion Presentada  <?php echo $expediente; ?><BR /></font></b><img src="img/messagebox_critical.png" width="128" height="128" /></p>
	         <div align='center'><font size='2' face='Verdana, Arial, Helvetica, sans-serif' align='center'><strong>
             <br>
			 
             </strong></font></div>
	   
             </table>
	  <?php
      exit;  
			
		
		}
 
?>

</body>
