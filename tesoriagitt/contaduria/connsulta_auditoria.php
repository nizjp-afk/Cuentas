<?php
error_reporting ( E_ERROR ); 
   $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];

    include('incluir_siempre.php');
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	//include('index.php');
	/*	
	if (isset($_POST['busca']) and !empty($_POST['busnom']))
	{
		$nom = $_POST['busnom'];
		$_pagi_sql =	"SELECT cuitl,apellido,nombre,razon_social,persona_tipo,
		id_beneficiario,fecha_aprobacion,saf FROM beneficiarios 
	    				WHERE cuitl='$nom' or apellido like '%$nom%' or  razon_social like '%$nom%' and alta <> 'S' ";
	}
	else 
	{*/
    	$_pagi_sql = "SELECT `movimiento`. * , `personas`.`apellido` , `personas`.`nombre` , `beneficiarios`.`apellido` , `beneficiarios`.`nombre` , `beneficiarios`.`razon_social`
FROM movimiento, personas, usuarios, beneficiarios
WHERE (
(
`movimiento`.`cuitl` = beneficiarios.cuitl
)
AND (
`personas`.`docnro` = usuarios.personas_docnro
)
AND (
`usuarios`.`userid` = movimiento.usuario
)
)
ORDER BY `movimiento`.`id_movi` ASC";
	//}
	/*if (isset($_POST['busca']))
    { 
		unset($_GET['_pagi_pg']);
		$_pagi_actual = 1;
	}*/

$_pagi_cuantos = 20;
$_pagi_nav_num_enlaces = 15;
$_pagi_nav_estilo="pag";
//definimos qué irá en el enlace a la página anterior
$_pagi_nav_anterior = "<img src='img/izq.png' border=0>";// podría ir un tag <img> o lo que sea
$_pagi_nav_primera = "<img src='img/izqfin.png' border=0>";
$_pagi_nav_ultima = "<img src='img/derfin.png' border=0>";
//definimos qué irá en el enlace a la página siguiente
$_pagi_nav_siguiente = "<img src='img/der.png' border=0>";// podría ir un tag <img> o lo que sea
include("paginator.inc.php");
?>

<div class="content">

<table width="90%"  border="1" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
	<tr>
    	<td height="30" colspan="5" align="center">
		     <form action="" method="post">
      		<input  name="busnom" type="text" id="busnom" size="30" maxlength="50" />
      		<input name="busca" type="submit" class="tabla_jugando" id="busca" value="Buscar" />
	  		</form>
		</td>
	</tr>
	<tr>
    	<td height="30" colspan="5" align="center">Consulta de Beneficiario</td>
	</tr>
    <tr>
    	<td width="114" align="center">Usuario</td>
		<td align="center">Accion</td>
		<td align="center">Tabla</td>
		<td align="center">Fecha</td>
		<td align="center">Cuit</td>
		<td align="center">Beneficiario</td>
		
		
	</tr>

<?
        $cant= mysql_num_rows($_pagi_result);
		$i=0; 
        $j=0; 
              while ($f_persona=mysql_fetch_array($_pagi_result))
		      { 
			  
	       $usuario=$f_persona['usuario'];
		   $accion=$f_persona['accion'];
		   $tabla=$f_persona['tabla'];
		   $fecha=$f_persona['fecha'];
		   $cuit=$f_persona['cuitl'];
?>                
        
		<td><?php echo $usuario; ?></td>
		<td><?php echo $accion; ?></td>
		<td><?php echo $tabla; ?></td>
		<td><?php echo $fecha; ?></td>
		<td><?php echo $cuit; ?></td>
<?php
              if($f_persona['razon_social']=='')
			     {
				  echo $f_persona['apellido'].", ".$f_persona['nombre'];
				 }
			   else
			     {	  
		          echo $f_persona['razon_social'];
				 }
?>
        </td>
		        
    </tr>
    <?php 
	    
	
		} 
	?>
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
<div class="clearer"><span></span></div>