<?php 
error_reporting ( E_ERROR );
echo $ban= $_POST['bandera'];

   if(!$_FILES['archivo']['name']=='')
			      {
				    $vimagen = $_FILES['archivo']['name'];
					$img_tmp = $_FILES['archivo']['tmp_name'];
					
					 if(move_uploaded_file($img_tmp,"txt_afip/".$vimagen))
					 
					    {
						 
						 if($ban=='CIB')
						   {
							   ?>
                 <meta http-equiv='refresh' content='0;url=indextesoreria.php?sec=retenciones/txtamysqlib' />	
<?php
	                         
						 
						  exit;
		
						   }
						  else 
						  { 
						  ?>
                 <meta http-equiv='refresh' content='0;url=indextesoreria.php?sec=retenciones/txtamysql' />	
<?php
	                         
						 
						  exit;
						  }
						}
				     else
					    {
					     echo "ERROR AL GUARDAR IMAGEN";exit;
						} 
						
				}		
?>


