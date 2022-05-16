<?php 
error_reporting ( E_ERROR );
  $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];
   include('incluir_siempre.php');
   
   if(!$_FILES['archivo']['name']=='')
			      {
				    $vimagen = $_FILES['archivo']['name'];
					$img_tmp = $_FILES['archivo']['tmp_name'];
					
					 if(move_uploaded_file($img_tmp,"cuentas/".$vimagen))
					 
					    {
						 
						
						  ?>
                <meta http-equiv='refresh' content='0;url=indextesoreria.php?sec=tesoreria/txtamysql_ctas&apli=tgpa&per=I&arc=<?php echo $vimagen; ?>' />	
<?php
	                         
						 
						  exit;
						}
				     else
					    {
					     echo "ERROR AL GUARDAR IMAGEN";exit;
						} 
						
				}		
?>


