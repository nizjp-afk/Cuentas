<?php
error_reporting ( E_ERROR ); 
$id  = $_GET['id'];
$m = $_GET['m'];


 include('incluir_siempre.php');
    include('../dgti-mysql-var_dgti-beneficiarios.php');
    include('../dgti-intranet-mysql_connect.php');  
    include('../dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	//include('index.php');
		
    $fechahoy = date("d/m/Y");
	$fecha=split("/",$fechahoy);
	$mes=$fecha[1];
	$año=$fecha[2];
	$dia=$fecha[0];
	
    
	$fechades=date("Y-m-d",strtotime("-30 days"));
	//$fechades=$año.'-'.$mes.'-'.'01';
	$fechahas=$año.'-'.$mes.'-'.$dia;
	
	$_pagi_sql = "SELECT usuario, accion, tabla, movimiento.fecha, apellido, nombre, razon_social, personas.saf,count( tabla ) AS cantidad
FROM `movimiento` , personas, usuarios
WHERE movimiento.usuario = usuarios.userid
AND movimiento.usuario = usuarios.userid
AND usuarios.personas_docnro = personas.docnro
AND usuarios.userid ='$id'
AND fecha >='$fechades' and fecha <= '$fechahas'
AND (
tabla = 'orden_pago'
OR tabla = 'op_pendiente'
OR tabla = 'orden_pago_fp'
OR tabla = 'op_pendiente_fp_ch'
)
GROUP BY fecha,tabla
ORDER BY fecha DESC , tabla";
 if (!($_pagi_result= mysql_query($_pagi_sql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "consulta movimiento";
      $cuerpo2  = "Base de datos                 = ".$mysql_basededatos.$emaillinea;
      $cuerpo2 .= "Sentencia sql                 = ".$ssql.$emaillinea;
      $asunto   = "[Error 3]";
      echo "error cie10";
      //.....................................................................
    }


?>
<html>
<body>

<table width="500"  border="1" align="CENTER" cellpadding="3" cellspacing="1" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
  <tr>
	  
    	<td width="114" align="center">Usuario</td>
        <td align="center">Apellido y Nombre </td>
		<td align="center">Fecha </td>
        <td align="center">Tipo de Consulta </td>
        <td align="center">Tot Visitas </td>
		
		
		
	</tr>

<?
        $cant= mysql_num_rows($_pagi_result);
		$i=0; 
        $j=0; 
              while ($f_persona=mysql_fetch_array($_pagi_result))
		{ 
		     $j=$i;  
             $i=$i+1;

  
?>	  <tr bgcolor="#F3F3F3">	    
       
		<td><?php echo $f_persona['usuario'];?></td>
        <td><?php echo $f_persona['apellido'].", ".$f_persona['nombre'];?></td>
        <td><?php echo $f_persona['fecha'];?></td>
        <td><?php echo $f_persona['accion'];?></td>
        <td><?php echo $f_persona['cantidad'];?></td>

	
       
</tr>
    <?php } ?>
</table>    
</body>
<html>	