<?php 
error_reporting ( E_ERROR );

   if(!$_FILES['archivo']['name']=='')
			      {
				   echo $vimagen = $_FILES['archivo']['name'];
					echo $img_tmp = $_FILES['archivo']['tmp_name'];
					
					 if(move_uploaded_file($img_tmp,$vimagen))
					 
					    {
						 
						 
						 echo "Exportacion exitosa";exit;
						}
				     else
					    {
					     echo "ERROR AL GUARDAR IMAGEN";exit;
						} 
						
				}	
				
				
					
?>


