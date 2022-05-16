<?php
error_reporting ( E_ERROR ); 
  $id=$_GET['id'];
  $tipo=$_GET['tipo'];
  $id_saf=$_GET['id_saf'];
   $apli= $_GET['apli'];
  $per = $_GET['per'];


  if ($tipo=='f')
    {
?>						  
    <meta http-equiv='refresh' content='0;url=
	indextesoreria.php?sec=federal/formulariomodi_f&apli=<?php echo $apli; ?>&per=<?php echo $per; ?>&id=<?php echo $id; ?>	'/>	               
<?php	
   
    }
 if ($tipo=='j')
   {
?>						  
    <meta http-equiv='refresh' content='0;url=
	indextesoreria.php?sec=federal/formulariomodi_j&apli=<?php echo $apli; ?>&per=<?php echo $per; ?>&id=<?php echo $id; ?>	' />	               
<?php
    }
 

