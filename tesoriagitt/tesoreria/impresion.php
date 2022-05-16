<?php
error_reporting ( E_ERROR ); 
 $id = $_GET['id'];
 $tipo = $_GET['tipo'];
  $cuitl = $_GET['cuitl'];
if ($tipo=='o')
	  			{
 ?>						  
					  <meta http-equiv='refresh' content='0;url= formulario_o.php?id=<?php echo $id; ?>&cuitl=<?php echo $cuitl; ?>'/>
<?php			 
			}
			
if($cuitl=='')
  {
if ($tipo=='f')
		   	{
 ?>						  
					  <meta http-equiv='refresh' content='0;url=formulario_fi.php?id=<?php echo $id; ?>&cuitl=<?php echo $cuitl; ?>'/>
<?php			 
			}
			
if ($tipo=='j')
		    	{
 ?>						  
					  <meta http-equiv='refresh' content='0;url=formulario_ji.php?id=<?php echo $id; ?>&cuitl=<?php echo $cuitl; ?>'/>
<?php			 
			}		
	}
else
  {
   if ($tipo=='f')
		   	{
 ?>						  
					  <meta http-equiv='refresh' content='0;url=../beneficiario/formulario_f.php?id=<?php echo $id; ?>&cuitl=<?php echo $cuitl; ?>'/>
<?php			 
			}
			
if ($tipo=='j')
		    	{
 ?>						  
					  <meta http-equiv='refresh' content='0;url=../beneficiario/formulario_j.php?id=<?php echo $id; ?>&cuitl=<?php echo $cuitl; ?>'/>
<?php			 
			}						
	}		
?>			