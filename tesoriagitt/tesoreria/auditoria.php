<?php
error_reporting (E_ERROR); 
    $aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];

    include('incluir_siempre.php');
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	//include('index.php');
		
    $fechahoy = date("d/m/Y");
	$fecha=split("/",$fechahoy);
	$mes=$fecha[1];
	$año=$fecha[2];
	$dia=$fecha[0];
	
	$fechades=date("Y-m-d",strtotime("-30 days")); // Restamos 7 dias
	
	
	//$fechades=$año.'-'.$mes.'-'.'01';
	$fechahas=$año.'-'.$mes.'-'.$dia;
	
	if (isset($_POST['busca']) and !empty($_POST['busnom']))
	   {
		$nom = $_POST['busnom'];
		$_pagi_sql = "SELECT usuario, accion, tabla, movimiento.fecha, apellido, nombre, razon_social, personas.saf, count( usuario ) AS cantidad
		FROM `movimiento` , personas, usuarios
		WHERE movimiento.usuario = usuarios.userid
		AND usuarios.personas_docnro = personas.docnro
		AND  saf like '%$nom%'
		AND personas.saf != 'N'
		AND fecha >='$fechades' and fecha <= '$fechahas'
		AND (
		tabla = 'orden_pago'
		OR tabla = 'op_pendiente'
		)
		GROUP BY usuario, tabla
		ORDER BY saf ";
		
		
		 if (!($_pagi_result= mysql_query($_pagi_sql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo documento";
      echo $cuerpo1;
      //.....................................................................
    }
		
	}
	/* elseif ($_GET['_pagi_pg'] >1 and !empty($_GET['nom'])) 
	
	{
		$nom = $_GET['nom'];
		$_pagi_sql = "SELECT usuario, accion, tabla, movimiento.fecha, apellido, nombre, razon_social, personas.saf, count( usuario ) AS cantidad
		FROM `movimiento` , personas, usuarios
		WHERE movimiento.usuario = usuarios.userid
		AND usuarios.personas_docnro = personas.docnro
		AND  saf like '%$nom%'
		AND personas.saf != 'N'
		AND fecha >='$fechades' and fecha <= '$fechahas'
		AND (
		tabla = 'orden_pago'
		OR tabla = 'op_pendiente'
		)
		GROUP BY usuario, tabla
		ORDER BY saf  ";
	}*/
	 
	else
	 {

	
    	$_pagi_sql = "SELECT usuario, accion, tabla, movimiento.fecha, apellido, nombre, razon_social, personas.saf, count( usuario ) AS cantidad
FROM `movimiento` , personas, usuarios
WHERE movimiento.usuario = usuarios.userid
AND usuarios.personas_docnro = personas.docnro
AND personas.saf != 'N'
AND fecha >='$fechades' and fecha <= '$fechahas'
AND (
tabla = 'orden_pago'
OR tabla = 'op_pendiente'
OR tabla = 'orden_pago_fp'
OR tabla = 'op_pendiente_fp_ch'
)
GROUP BY usuario, tabla
ORDER BY saf";

 if (!($_pagi_result= mysql_query($_pagi_sql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar tipo documento";
      echo $cuerpo1;
      //.....................................................................
    }

	  }
	
	
	
	  
	  
	/*if (isset($_POST['busca']))
    { 
		unset($_GET['_pagi_pg']);
		$_pagi_actual = 1;
	}*/

/*$_pagi_cuantos = 10;
$_pagi_nav_num_enlaces = 15;
$_pagi_nav_estilo="pag";
$_pagi_propagar=array('sec','nom','apli','per');
//definimos qué irá en el enlace a la página anterior
$_pagi_nav_anterior = "<img src='img/izq.png' border=0>";// podría ir un tag <img> o lo que sea
$_pagi_nav_primera = "<img src='img/izqfin.png' border=0>";
$_pagi_nav_ultima = "<img src='img/derfin.png' border=0>";
//definimos qué irá en el enlace a la página siguiente
$_pagi_nav_siguiente = "<img src='img/der.png' border=0>";// podría ir un tag <img> o lo que sea
include("paginator.inc.php");*/

?>


<link rel="stylesheet" href="thickbox/thickbox.css" type="text/css" />
<script type="text/javascript" src="thickbox/jquery.js"></script>
<script type="text/javascript" src="thickbox/thickbox.js"></script>



<div class="content">
<table width="90%"  border="1" align="CENTER" cellpadding="3" cellspacing="1" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
<tr>
	<td height="30" colspan="6" align="center"><b>Auditorias</b></td>
</tr>	
    <tr>
    	<td height="30" colspan="6" align="center">
		     <form action="" method="post">
      		<input  name="busnom" type="text" id="busnom" size="30" maxlength="50" />
      		<input name="busca" type="submit" class="tabla_jugando" id="busca" value="Buscar" />
	  		</form>
		</td>
	</tr>

    <tr>
	  
    	<td width="114" align="center">Usuario</td>
        <td align="center">Apellido y Nombre </td>
		<td align="center">Saf </td>
        <td align="center">Tipo de Consulta </td>
        <td align="center">Tot Visitas </td>
		<td></td>
		
		
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
        <?php
		    if($f_persona['razon_social']=='')
			  {
		?>		  
        <td><?php echo $f_persona['apellido'].", ".$f_persona['nombre'];?></td>
        <?php
			  }
			else
			 {
		 ?>		 
			 <td><?php echo $f_persona['razon_social'];?></td>	 
		<?php	
             }
		?>	 
        
        <td><?php echo $f_persona['saf'];?></td>
        <td><?php echo $f_persona['accion'];?></td>
        <td><?php echo $f_persona['cantidad'];?></td>

	
        <td>&nbsp;<a href="tesoreria/box_auditoria.php?id=<?php echo $f_persona['usuario']; ?>&height=400&width=700&modal=true" title="VER DATOS" class="thickbox"><img src="img/b_inf.png" border="0"/></a>&nbsp;</td>
		
</tr>
    <?php } ?>
	<tr>
		<td align="center" colspan="8">
	<?php //Incluimos la barra de navegacion
        echo $_pagi_navegacion;
        ?>
		</td>
	</tr>
</table>
</div>
<div class="sidenav">

</div>
<div class="sidenav">
</div>
<div class="clearer"><span></span></div>