<?php 
error_reporting ( E_ERROR );

   if(!$_FILES['archivo']['name']=='')
			      {
				    $vimagen = $_FILES['archivo']['name'];
					$img_tmp = $_FILES['archivo']['tmp_name'];
					
					 if(move_uploaded_file($img_tmp,"txt_afip/".$vimagen))
					 
					    {
						 
						 
						  ?>
                 <meta http-equiv='refresh' content='0;url=indextesoreria.php?sec=Exportacion/txtamysql_ss_e' />	
<?php
	                         
						 
						  exit;
						}
				     else
					    {
					     echo "ERROR AL GUARDAR IMAGEN";exit;
						} 
						
				}		
?>


