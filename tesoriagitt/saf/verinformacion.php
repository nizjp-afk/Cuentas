<?php
error_reporting ( E_ERROR ); 
 $id = $_GET['id'];
 $tipo = $_GET['tipo'];
if ($tipo=='o')
	  			{
 ?>						  
					  <meta http-equiv='refresh' content='0;url= indextesoreria.php?sec=saf/verinformacion_o&id=<?php echo $id; ?>'/>
<?php			 
			}
			
if ($tipo=='f')
		   	{
 ?>						  
					  <meta http-equiv='refresh' content='0;url= indextesoreria.php?sec=saf/verinformacion_f&id=<?php echo $id; ?>'/>
<?php			 
			}
			
if ($tipo=='j')
		    	{
 ?>						  
					  <meta http-equiv='refresh' content='0;url= indextesoreria.php?sec=saf/verinformacion_j&id=<?php echo $id; ?>'/>
<?php			 
			}			
?>			