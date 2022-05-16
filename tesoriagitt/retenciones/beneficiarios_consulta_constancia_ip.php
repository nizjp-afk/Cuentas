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
		
$d_fecha=date('Y-m-d');


	  
	  if (isset($_POST['busca']) and !empty($_POST['busnom']))
	{
		$nom = $_POST['busnom'];
		$fechaant = $_POST['fechaant'];
	    $fechahoy = $_POST['fechahoy']; 
		$_pagi_sql = "SELECT  p.fecha AS fecha_pago, b.apellido,b.nombre,b.nombre_f,razon_social, p.cuit,s.monto AS retnecion,s.id,s.numero
						FROM orden_pago_fp AS p, sicore_ib AS s, beneficiarios_aprobados as b
						WHERE (b.cuitl='$nom' or  b.apellido like '%$nom%' or  b.nombre_f like '%$nom%' or  b.razon_social like '%$nom%' or p.orden_pago='$nom')
						AND p.orden_pago = s.orden
						AND b.cuitl=p.cuit
						AND p.ejercicio = s.ejercicio
						AND p.saf = s.saf
						AND (p.fecha >='$fechaant' and p.fecha <= '$fechahoy')
						AND s.numero > '0'
						AND p.fecha = s.fecha_io 
						ORDER BY s.numero DESC";
	}
	 elseif ($_GET['_pagi_pg'] >1 and !empty($_GET['nom'])) 
	
	{
		$nom = $_GET['nom'];
		$fechaant = $_GET['firstinput'];
	     $fechahoy = $_GET['secondinput']; 
		$_pagi_sql = "SELECT  p.fecha AS fecha_pago, b.apellido,b.nombre,b.nombre_f,razon_social, p.cuit,s.monto AS retnecion,s.id,s.numero
						FROM orden_pago_fp AS p, sicore_ib AS s, beneficiarios_aprobados as b
						WHERE (b.cuitl='$nom' or  b.apellido like '%$nom%' or  b.nombre_f like '%$nom%' or  b.razon_social like '%$nom%' or p.orden_pago='$nom')
						AND p.orden_pago = s.orden
						AND b.cuitl=p.cuit
						AND p.ejercicio = s.ejercicio
						AND p.saf = s.saf
						AND (p.fecha >='$fechaant' and p.fecha <= '$fechahoy')
						AND s.numero > '0' 
						AND p.fecha = s.fecha_io
						ORDER BY s.numero DESC";
						
	    				
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
	
    	$_pagi_sql = "SELECT  p.fecha AS fecha_pago, b.apellido,b.nombre,b.nombre_f,razon_social, p.cuit,s.monto AS retnecion,s.id,s.numero
						FROM orden_pago_fp AS p, sicore_ib AS s, beneficiarios_aprobados as b
						WHERE p.orden_pago = s.orden
						AND b.cuitl=p.cuit
						AND p.ejercicio = s.ejercicio
						AND p.saf = s.saf
						AND (p.fecha >='$fechaant' and p.fecha <= '$fechahoy')
						AND s.numero > '0' 
						AND p.fecha = s.fecha_io
						ORDER BY s.numero DESC	  
					  
					  
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

<h4>CONSTANCIA DE RETENCION DEL IMPUESTO SOBRE LOS INGRESOS BRUTOS</h4><br />
<table width="90%"  border="1" align="CENTER" cellpadding="3" cellspacing="1" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
	<tr>
	
	     <td height="30" colspan="6" align="center"><b>Fondos Propios</b></td>
	  
	<td height="30" colspan="2" ><a title="Imprimir General Constancia" href="retenciones/imprimir_gral_i.php?firstinput=<?php echo $fechahoy; ?>&secondinput=<?php echo $fechaant; ?>" target="_blank"  ><img src="img/print_odp.jpg" width="35" align="" height="24" border="0"/></a>   
		</td>     		   
			   
	</tr>
	<tr>
    	<td height="30" colspan="8" align="center">
		     <form action="" method="post">
      		<input  name="busnom" type="text" id="busnom" size="30" maxlength="50" />
              <input type="hidden" name="fechahoy" value="<?php echo $fechahoy; ?>" /> 
               <input type="hidden" name="fechaant" value="<?php echo $fechaant; ?>" /> 
      		<input name="busca" type="submit" class="tabla_jugando" id="busca" value="Buscar" />
	  		</form>
		</td>
	</tr>

    <tr>
	   <td>NºConstancia</td>
    	<td width="114" align="center">FECHA DE PAGO</td>
		
		
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
			  $aux=trim($f_persona['numero']);
     if($i==1)
	   {
		  
		  $aux1=$aux;
    
?>
  	<tr bgcolor="#F3F3F3" > 
   
        <td><?php echo $f_persona['numero'];?></td>
		<td><?php echo $f_persona['fecha_pago'];?></td>
       
        
<?php
$estado=$f_persona['estado'];

?>		
        
		 <td colspan="4">&nbsp;<a href="retenciones/imprimir_i.php?id=<?php echo $f_persona['numero'];?>&firstinput=<?php echo $fechahoy; ?>&secondinput=<?php echo $fechaant; ?>" target="_blank"><img width="22" height="22" src="img/impresion1.jpg" border="0"/></a>&nbsp;</td>

    		
    </tr>


    <?php 
	   }
	 else if(!($aux==$aux1))
   {
	   $aux1=$aux;
	  
	  ?>
  	<tr bgcolor="#F3F3F3" > 
   
        <td><?php echo $f_persona['numero'];?></td>
		<td><?php echo $f_persona['fecha_pago'];?></td>
       
        
<?php
$estado=$f_persona['estado'];

?>		
        
		 <td colspan="4">&nbsp;<a href="retenciones/imprimir_i.php?id=<?php echo $f_persona['numero'];?>&firstinput=<?php echo $fechahoy; ?>&secondinput=<?php echo $fechaant; ?>" target="_blank"><img width="22" height="22" src="img/impresion1.jpg" border="0"/></a>&nbsp;</td>

    		
    </tr>
 
	
	
	<?php
		}
	
	} ?>
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