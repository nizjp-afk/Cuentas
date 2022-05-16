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
	indextesoreria.php?sec=tesoreria/formulario_f&apli=<?php echo $apli; ?>&per=<?php echo $per; ?>&id=<?php echo $id; ?>	'/>	               
<?php	
   
    }
 if ($tipo=='j')
   {
?>						  
    <meta http-equiv='refresh' content='0;url=
	indextesoreria.php?sec=tesoreria/formulario_j&apli=<?php echo $apli; ?>&per=<?php echo $per; ?>&id=<?php echo $id; ?>	' />	               
<?php
    }
 if ($tipo=='o')
   {
?>						  
    <meta http-equiv='refresh' content='0;url=
	indextesoreria.php?sec=tesoreria/formulario_ao&apli=<?php echo $apli; ?>&per=<?php echo $per; ?>&id=<?php echo $id; ?>&id_saf=<?php echo $id_saf; ?>	' />	               
<?php
    }
?>

