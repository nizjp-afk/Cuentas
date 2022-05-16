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
		

	if (isset($_POST['busca']) and !empty($_POST['busnom']))
	{
		$nom = $_POST['busnom'];
		$fechaant = $_POST['firstinput'];
	    $fechahoy = $_POST['secondinput']; 
		$_pagi_sql = "SELECT b.apellido,b.nombre,b.nombre_f,razon_social,r.codigo, p.cuit, p.fecha AS fecha_pago, s.monto AS retnecion,s.id,s.numero_ss
						FROM orden_pago_fp AS p, sicore_ss AS s, anexoss AS r,beneficiarios_aprobados as b
	    				WHERE (b.cuitl='$nom' or  b.apellido like '%$nom%' or  b.nombre_f like '%$nom%' or  b.razon_social like '%$nom%')
						p.orden_pago = s.orden
						AND b.cuitl=p.cuit
						AND p.ejercicio = s.ejercicio
						AND p.saf = s.saf
						AND r.id_ss = s.ss_id
						AND (p.fecha >='$fechaant' and p.fecha <= '$fechahoy')
						AND s.monto > '40' 
						AND s.numero_ss > '0' 
						AND p.fecha = s.fecha_io
						ORDER BY s.numero_ss ";
	}
	 elseif ($_GET['_pagi_pg'] >1 and !empty($_GET['nom'])) 
	
	{
		$nom = $_GET['nom'];
		$fechaant = $_GET['firstinput'];
	     $fechahoy = $_GET['secondinput']; 
		$_pagi_sql = "SELECT b.apellido,b.nombre,b.nombre_f,razon_social,r.codigo, p.cuit, p.fecha AS fecha_pago, s.monto AS retnecion,s.id,s.numero_ss
						FROM orden_pago_fp AS p, sicore_ss AS s, anexoss AS r,beneficiarios_aprobados as b
	    				WHERE (b.cuitl='$nom' or  b.apellido like '%$nom%' or  b.nombre_f like '%$nom%' or  b.razon_social like '%$nom%')
						p.orden_pago = s.orden
						AND b.cuitl=p.cuit
						AND p.ejercicio = s.ejercicio
						AND p.saf = s.saf
						AND r.id_ss = s.ss_id
						AND (p.fecha >='$fechaant' and p.fecha <= '$fechahoy')
						AND s.monto > '40'
						AND s.numero_ss > '0'
						AND p.fecha = s.fecha_io 
						ORDER BY s.numero_ss ";
	}
	 
	else
	 {
	 if ($_GET['_pagi_pg'] >=1)
		  {
			  $fechaant = $_GET['firstinput'];
	     $fechahoy = $_GET['secondinput'];
			  }
	else
		{	    
	    $fechaant = $_POST['firstinput'];
	    $fechahoy = $_POST['secondinput']; 
		}
	
    	$_pagi_sql = "SELECT b.apellido,b.nombre,b.nombre_f,razon_social,r.codigo, p.cuit, p.fecha AS fecha_pago, s.monto AS retnecion,s.id,s.numero_ss
						FROM orden_pago_fp AS p, sicore_ss AS s, anexoss AS r,beneficiarios_aprobados as b
						WHERE p.orden_pago = s.orden
						AND b.cuitl=p.cuit
						AND p.ejercicio = s.ejercicio
						AND p.saf = s.saf
						AND r.id_ss = s.ss_id
						AND (p.fecha >='$fechaant' and p.fecha <= '$fechahoy')
						AND s.monto > '40'
						AND s.numero_ss > '0' 
						AND p.fecha = s.fecha_io
						ORDER BY s.numero_ss			  
					  
					  
					  ";
	 
	 }  
	  
	/*if (isset($_POST['busca']))
    { 
		unset($_GET['_pagi_pg']);
		$_pagi_actual = 1;
	}*/

$_pagi_cuantos = 10;
$_pagi_nav_num_enlaces = 15;
$_pagi_nav_estilo="pag";
$_pagi_propagar=array('sec','nom','apli','per','firstinput','secondinput');
//definimos qué irá en el enlace a la página anterior
$_pagi_nav_anterior = "<img src='img/izq.png' border=0>";// podría ir un tag <img> o lo que sea
$_pagi_nav_primera = "<img src='img/izqfin.png' border=0>";
$_pagi_nav_ultima = "<img src='img/derfin.png' border=0>";
//definimos qué irá en el enlace a la página siguiente
$_pagi_nav_siguiente = "<img src='img/der.png' border=0>";// podría ir un tag <img> o lo que sea
include("paginator.inc.php");
?>

<div class="content">

<h1>Consulta Beneficiarios</h1>
<table width="90%"  border="1" align="CENTER" cellpadding="3" cellspacing="1" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
	<tr>
	
	    
	    <td height="30" colspan="5" align="center"><b>Consulta de Beneficiarios Aprobados</b></td>
	<td height="30" colspan="3" ><a title="Imprimir Constancia de Seguridad Social " href="retenciones/imprimir_gral_fp.php?firstinput=<?php echo $fechahoy; ?>&secondinput=<?php echo $fechaant; ?>" target="_blank"  ><img src="img/pdf.png" width="35" align="" height="24" border="0"/></a>  
    
     <a title="Descargar Constancias" href="retenciones/constancia_ss_xls.php?firstinput=<?php echo $fechahoy; ?>&secondinput=<?php echo $fechaant; ?>" target="_blank"  ><img src="img/xls.jpg"  width="35" align="" height="24" border="0"/></a> 
		</td>     		   
	</tr>
	<tr>
    	<td height="30" colspan="8" align="center">
		     <form action="" method="post">
      		<input  name="busnom" type="text" id="busnom" size="30" maxlength="50" />
      		<input name="busca" type="submit" class="tabla_jugando" id="busca" value="Buscar" />
	  		</form>
		</td>
	</tr>

    <tr>
	   <td>NºConstancia</td>
    	<td width="114" align="center">CUIL - CUIL</td>
		<td align="center">Apellido y Nombre o Razon Social</td>
		
		<td colspan="4"></td>
		
	</tr>

<?php
        $cant= mysql_num_rows($_pagi_result);
		$i=0; 
        $j=0; 
              while ($f_persona=mysql_fetch_array($_pagi_result))
		{ 
		     $j=$i;  
             $i=$i+1;

    
?>
	  	<tr bgcolor="#F3F3F3" > 
   
        <td><?php echo $f_persona['numero_ss'];?></td>
		<td><?php echo $f_persona['cuit'];?></td>
        <td>
<?php
              if($f_persona['razon_social']=='')
			     {
					 if($f_persona['nombre_f']=='')
					   {
						   echo $f_persona['apellido'].", ".$f_persona['nombre'];
					   }
					 else 
					   {
						   echo $f_persona['apellido'].", ".$f_persona['nombre']."       ' ".$f_persona['nombre_f']." '";
					   }
				 }
			   else
			     {	  
		          echo $f_persona['razon_social'];
				 }
?>
        </td>
        
<?php
$estado=$f_persona['estado'];

?>		
        
		 <td colspan="4">&nbsp;<a href="retenciones/imprimir.php?id=<?php echo $f_persona['numero_ss'];?>&firstinput=<?php echo $fechahoy; ?>&secondinput=<?php echo $fechaant; ?>" target="_blank"><img width="22" height="22" src="img/impresion1.jpg" border="0"/></a>&nbsp;</td>

    		
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
<h2></h2>
<ul>
 
      <li><a href="indextesoreria.php?sec=tesoreria/index1&apli=tgp&per=C">Regresar Menu</a></li>
	
	<!-- <li><a href="indextesoreria.php?sec=tesoreria/saf_consulta&apli=tgpc&per=A">Beneficiarios - SAF</a> </li>-->
</ul>
</div>
<div class="clearer"><span></span></div>