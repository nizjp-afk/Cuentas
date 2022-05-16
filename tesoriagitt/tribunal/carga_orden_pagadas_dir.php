 <?php
 error_reporting ( E_ERROR ); 
//conexion
	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	$aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
	
	
	
	
    include('incluir_siempre.php');
	//$ban=;
	

	   

$saf_c = $_POST['saf'];	
	   
	
if ($saf_c=='N')
 {   
   if (isset($_POST['busca']) and !empty($_POST['busnom']))
			{  
				
				$fechaant = $_POST['fechaant'];
		        $fechahoy = $_POST['fechahoy']; 
		 		$nom = $_POST['busnom'];
		 		$_pagi_sql = "SELECT  *
			  				 FROM orden_pago as o,nro_saf as s,beneficiarios_aprobados as b
			                  WHERE (o.saf='$nom' or o.orden_pago ='$nom' or b.cuitl='$nom')
							   and b.cuitl=o.cuit
							   and o.saf = s.numero
							  and  fecha >='$fechaant' and fecha <= '$fechahoy'" ;
			}
		elseif ($_GET['_pagi_pg'] >1 and !empty($_GET['nom'])) 
		   { 
			    $fechaant = $_GET['fechaant'];
		        $fechahoy = $_GET['fechahoy'];
				$nom = $_GET['nom'];
		 		$_pagi_sql = "SELECT  *
			  				  FROM orden_pago as o,nro_saf as s,beneficiarios_aprobados as b
			                  WHERE (o.saf='$nom' or o.orden_pago ='$nom' or b.cuitl='$nom')
							   and b.cuitl=o.cuit
							   and o.saf = s.numero
							  and  fecha >='$fechaant' and fecha <= '$fechahoy'" ;
		   }
		
		else 
			{
			 
			 
			if ($_POST['bandera']=='P')
			   {
				 $fechaant = $_POST['firstinput'];
				 $fechahoy = $_POST['secondinput'];    
			   }
			else
			   {
				$fechaant = $_POST['fechaant'];
		        $fechahoy = $_POST['fechahoy'];
			   } 
			    $_pagi_sql = "SELECT  *
				  		      FROM orden_pago as o,nro_saf as s,beneficiarios_aprobados as b
							  WHERE  o.saf = s.numero
							  and b.cuitl=o.cuit
							  and fecha >='$fechaant' and fecha <= '$fechahoy'
							  ORDER BY ejercicio,`fecha` DESC,`orden_pago` ASC";
			  
			}
	 
 }
else
 {
	
	 
	   if (isset($_POST['busca']) and !empty($_POST['busnom']))
			{ 
				
				$fechaant = $_POST['fechaant'];
		        $fechahoy = $_POST['fechahoy']; 
				$saf_c = $_POST['saf'];
		 		$nom = $_POST['busnom'];
		 		$_pagi_sql = "SELECT  *
			  				 FROM orden_pago as o,nro_saf as s,beneficiarios_aprobados as b
			                 WHERE (o.orden_pago ='$nom' or b.cuitl='$nom')
							   and b.cuitl=o.cuit
							   and o.saf = s.numero
							    and o.saf = '$saf_c'
							  and  fecha >='$fechaant' and fecha <= '$fechahoy'" ;
			}
		elseif ($_GET['_pagi_pg'] >1 and !empty($_GET['nom'])) 
		   { 
			  
			    $fechaant = $_GET['fechaant'];
		        $fechahoy = $_GET['fechahoy'];
				 $saf_c = $_GET['saf'];
				$nom = $_GET['nom'];
		 		$_pagi_sql = "SELECT  *
			  				  FROM orden_pago as o,nro_saf as s,beneficiarios_aprobados as b
			                  WHERE (o.orden_pago ='$nom' or b.cuitl='$nom')
							   and b.cuitl=o.cuit
							   and o.saf = s.numero
							    and o.saf = '$saf_c'
							  and  fecha >='$fechaant' and fecha <= '$fechahoy'" ;
		   }
		
		else 
			{ 
			
			if ($_POST['bandera']=='P')
			   {
				 $fechaant = $_POST['firstinput'];
				 $fechahoy = $_POST['secondinput'];    
			   }
			else
			   {
				$fechaant = $_POST['fechaant'];
		        $fechahoy = $_POST['fechahoy'];
			   }    
	         $saf_c = $_POST['saf'];
			
			    $_pagi_sql = "SELECT  *
				  		      FROM orden_pago as o,nro_saf as s,beneficiarios_aprobados as b
							  WHERE  o.saf = s.numero
							   and o.saf = '$saf_c'
							  and b.cuitl=o.cuit
							  and fecha >='$fechaant' and fecha <= '$fechahoy'
							  ORDER BY ejercicio,`fecha` DESC,`orden_pago` ASC";
			  
			}
	 
	 
	 
 }

$_pagi_cuantos = 10;
$_pagi_nav_num_enlaces = 15;
$_pagi_nav_estilo="pag";
$_pagi_propagar=array('sec','nom','fechahoy','fechaant','apli','per','saf');
//definimos qué irá en el enlace a la página anterior
$_pagi_nav_anterior = "<img src='img/izq.png' border=0>";// podría ir un tag <img> o lo que sea
$_pagi_nav_primera = "<img src='img/izqfin.png' border=0>";
$_pagi_nav_ultima = "<img src='img/derfin.png' border=0>";
//definimos qué irá en el enlace a la página siguiente
$_pagi_nav_siguiente = "<img src='img/der.png' border=0>";// podría ir un tag <img> o lo que sea
include("paginator.inc.php");   

?>
<div class="content">
<table width="120%"  border="0" align="left" cellpadding="3" cellspacing="1" bordercolor="#EAEAEA" >
 
		<td height="49" colspan="4"><h2 align="center">Ordenes Pagadas</h2></td>
	</tr>
   <tr height=10px>
    <td colspan="2"><hr /></td>
  </tr>
   
   <tr height=10px>
    <td colspan="2"><hr /></td>
  </tr>
   
	

	
	
</table>
<br /> 
<table width="120%"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
<tr>
    	<td height="30" >
		    <form action="" method="post">
      		<input  name="busnom" type="text" id="busnom" size="30" maxlength="50" />
      		<input name="busca" type="submit" class="tabla_jugando" id="busca" value="Buscar" />
	  		<input type="hidden" name="fechahoy" value="<?php echo $fechahoy;?>" />
            <input type="hidden" name="fechaant" value="<?php echo $fechaant;?>" />
              <input type="hidden" name="saf" value="<?php echo $saf_c;?>" />
           
            </form>  
        </td>
        <td height="30" colspan="2" ><a title="Listado de Saf" href="tribunal/listado_saf.php" target="_blank"  ><img src="img/print_saf.jpg" width="35" align="" height="24" border="0"/></a>   
		</td> 
        <td height="30" colspan="2" ><a title="Listado de Orden de Pago" href="tribunal/listado_ordenes_dir.php?fechah=<?php echo $fechahoy; ?>&fehcaa=<?php echo $fechaant; ?>&nom=<?php echo $saf_c; ?>&cuit=<?php echo $nom; ?>" target="_blank"  ><img src="img/print_odp.jpg" width="35" align="" height="24" border="0"/></a>   
		</td>     
    </tr>
</table>    
<table width="120%"  border="1" align="left" cellpadding="5" cellspacing="2" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
   <tr align="center">
       <td width="10%"><strong>Ejercicio</td>
       <td width="16%"><strong>Fecha</td>
       <td width="10%"><strong>Saf</td>
       <td width="19%"><strong>Nro de Orden</td>
        <td width="19%"><strong>Beneficiarios</td>
       <td width="31%"><strong>Concepto</td>
       <td width="18%"><strong>Total</strong></td>
   </tr>
 <?php
      while ($f_orden=mysql_fetch_array($_pagi_result))
	  {
		   $nombre_be=$f_orden['nombre'];
	       $apellido=$f_orden['apellido'];
	       $razon=$f_orden['razon_social'];
		   if ($razon=='')
		     {   $benef=$apellido.','.$nombre_be;}
			else
			 {  $benef=$razon;} 
?>	   
	    <tr bgcolor="#F3F3F3" > 
           <td align="center"><?php echo $f_orden['ejercicio'];?></td>
          <td align="center"><?php echo $f_orden['fecha'];?></td>
          <td align="center" ><a title="<?php echo $f_orden['nombre']; ?>"><?php echo $f_orden[2];?></a> </td>
          <td align="left">&nbsp;<?php echo $f_orden['orden_pago'];?></td>
          <td><?php echo $benef;?></td>
          <td><?php echo $f_orden['concepto'];?></td>
          <td align="right" ><?php echo $f_orden['total'];?></td>
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
<ul>
 
      <li><a href="indextesoreria.php?sec=tribunal/index1&apli=tgpa&per=O">Regresar Menu</a></li>
	
	<!-- <li><a href="indextesoreria.php?sec=tesoreria/saf_consulta&apli=tgpc&per=A">Beneficiarios - SAF</a> </li>-->
</ul>
</div>
<div class="clearer"><span></span></div>