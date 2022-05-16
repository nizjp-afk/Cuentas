<?php
error_reporting ( E_ERROR ); 
  $id=$_GET['id'];
  $tipo=$_GET['tipo'];
  $id_saf=$_GET['id_saf'];
  $apli = $_GET['apli'];
  $per = $_GET['per']; 
  $estado = $_GET['estado'];

  if ($tipo=='f')
    {
?>						  
    <meta http-equiv='refresh' content='0;url=
	indextesoreria.php?sec=contaduria/baja_beneficiariosf&apli=<?php echo $apli; ?>&per=<?php echo $per; ?>&id=<?php echo $id; ?>&estado=<?php echo $estado; ?>'/>	               
<?php	
   
    }
 if ($tipo=='j')
   {
?>						  
    <meta http-equiv='refresh' content='0;url=
	indextesoreria.php?sec=contaduria/baja_beneficiariosj&apli=<?php echo $apli; ?>&per=<?php echo $per; ?>&id=<?php echo $id; ?>&estado=<?php echo $estado; ?>' />	               
<?php
    }
 if ($tipo=='o')
   {
?>						  
    <meta http-equiv='refresh' content='0;url=
	indextesoreria.php?sec=contaduria/baja_beneficiarioso&apli=<?php echo $apli; ?>&per=<?php echo $per; ?>&id=<?php echo $id; ?>&id_saf=<?php echo $id_saf; ?>&estado=<?php echo $estado; ?>' />	               
<?php
    }
?>

