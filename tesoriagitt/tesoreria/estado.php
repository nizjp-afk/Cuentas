<?php
error_reporting ( E_ERROR ); 
 $id = $_GET['id'];
 $tipo = $_GET['tipo'];
if ($tipo=='o')
	  			{
 ?>						  
					  <meta http-equiv='refresh' content='0;url= indextesoreria.php?sec=tesoreria/estado_o&id=<?php echo $id; ?>&apli=tgpc&per=H'/>
<?php			 
			}
			
if ($tipo=='f')
		   	{
 ?>						  
					  <meta http-equiv='refresh' content='0;url= indextesoreria.php?sec=tesoreria/estado_f&id=<?php echo $id; ?>&apli=tgpc&per=H'/>
<?php			 
			}
			
if ($tipo=='j')
		    	{
 ?>						  
					  <meta http-equiv='refresh' content='0;url= indextesoreria.php?sec=tesoreria/estado_j&id=<?php echo $id; ?>&apli=tgpc&per=H'/>
<?php			 
			}			
?>			