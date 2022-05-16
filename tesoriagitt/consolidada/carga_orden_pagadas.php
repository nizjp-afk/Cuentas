 <?php
//conexion
	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	$aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
	
	 $accion='Consulta Ordenes Pagadas Fondo Propios';
	 $tabla='orden_pago_fp';
	 include('agrego_movi.php'); 
	
	 $ssql = "SELECT * FROM nro_saf ";
     if (!($r_area= mysql_query($ssql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
	
	
  //  include('incluir_siempre.php');
	$ban=$_POST['bandera'];
	if ($ban=='P')
	   {
		$fechaant = $_POST['anod'].'-'.$_POST['mesd'].'-'.$_POST['diad'];
	    $fechahoy = $_POST['anoh'].'-'.$_POST['mesh'].'-'.$_POST['diah'];   
	   }
	else
	   {
		$fechaant = $_GET['fechaant'];
		$fechahoy = $_GET['fechahoy'];
	   }
	 
	if (isset($_POST['busca']) and !empty($_POST['busnom']))
		{
			$fechaant = $_POST['fechaant'];
		        $fechahoy = $_POST['fechahoy'];
		}
	
    $ssql = "SELECT  `beneficiarios_aprobados`.`cuitl` , beneficiarios_aprobados.documento_nro,`beneficiarios_aprobados`.`apellido` ,
	         `beneficiarios_aprobados`.`nombre` , `beneficiarios_aprobados`.`razon_social` ,
			 `ganancias`.`nombre` AS gan, `ingreso_bruto`.`nombre` AS inbru, 
			 `iva`.`nombre` AS siva, `regimen`.`nombre` AS reg, 
			 `seguridad_social`.`nombre` AS seguridad
			FROM `seguridad_social` , `beneficiarios_aprobados` , `ganancias` , `ingreso_bruto` ,
			`iva` , `regimen`
			WHERE  `beneficiarios_aprobados`.`cuitl` ='$usuario' ";
     if (!($r_situacion= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }    
	$f_situacion= mysql_fetch_array ($r_situacion);
	
  if (!($nrosaf=='N'))
     {
	   	 	
		 if (isset($_POST['busca']) and !empty($_POST['busnom']))
			{ //echo 'paso';
		 		
				$nom = $_POST['busnom'];
		 		$_pagi_sql = "SELECT `nro_saf`. * , `orden_pago_fp`. * , `beneficiarios_aprobados`.`apellido` , `beneficiarios_aprobados`.`nombre` , `beneficiarios_aprobados`.`razon_social`
FROM orden_pago_fp, nro_saf, beneficiarios_aprobados
			                  WHERE (orden_pago_fp.saf='$nrosaf' or orden_pago_fp.cuit='$usuario') and orden_pago.saf = numero
							  AND (orden_pago_fp ='$nom' or orden_pago_fp.cuit ='$nom')
							  and  fecha >='$fechaant' and fecha <= '$fechahoy'
							  AND beneficiarios_aprobados.cuitl = orden_pago_fp.cuit" ;
			}
		elseif ($_GET['_pagi_pg'] >1 and !empty($_GET['nom'])) 
		   {
			    $fechaant = $_GET['fechaant'];
		        $fechahoy = $_GET['fechahoy'];
			    $nom = $_GET['busnom'];
		 		$_pagi_sql = "SELECT `nro_saf`. * , `orden_pago_fp`. * , `beneficiarios_aprobados`.`apellido` , `beneficiarios_aprobados`.`nombre` , `beneficiarios_aprobados`.`razon_social`
FROM orden_pago_fp, nro_saf, beneficiarios_aprobados
			                  WHERE (orden_pago_fp.saf='$nrosaf' or orden_pago_fp.cuit='$usuario') and orden_pago_fp.saf = numero
							   AND (orden_pago_fp ='$nom' or orden_pago_fp.cuit ='$nom')
							  and  fecha >='$fechaant' and fecha <= '$fechahoy'
							  AND beneficiarios_aprobados.cuitl = orden_pago_fp.cuit" ;
		   }
		
		else
		  {
			   
			  // echo 'paso00000';
			   $_pagi_sql = "SELECT `nro_saf`. * , `orden_pago_fp`. * , `beneficiarios_aprobados`.`apellido` , `beneficiarios_aprobados`.`nombre` , `beneficiarios_aprobados`.`razon_social`
FROM orden_pago_fp, nro_saf, beneficiarios_aprobados
							  WHERE (orden_pago_fp.saf='$nrosaf' or orden_pago_fp.cuit='$usuario') and orden_pago_fp.saf = numero
							  and fecha >='$fechaant' and fecha <= '$fechahoy'
							  AND beneficiarios_aprobados.cuitl = orden_pago_fp.cuit
							  
							  ORDER BY ejercicio,`fecha` DESC,`orden_pago` ASC";
			  
			$nom='';
			}
	 }
else
    {
	 	 if (isset($_POST['busca']) and !empty($_POST['busnom']))
			{
		 		$fechaant = $_POST['fechaant'];
		        $fechahoy = $_POST['fechahoy']; 
				$nom = $_POST['busnom'];
		 		$_pagi_sql = "SELECT  *
			  				  FROM orden_pago_fp,nro_saf
			                  WHERE cuit='$usuario' and saf = numero AND orden_pago ='$nom'
							  and fecha >='$fechaant' and fecha <= '$fechahoy'" ;
			}
		
		elseif ($_GET['_pagi_pg'] >1 and !empty($_GET['nom'])) 
		   {
			     $fechaant = $_GET['fechaant'];
		        $fechahoy = $_GET['fechahoy'];
				$nom = $_GET['busnom'];
		 		$_pagi_sql = "SELECT  *
			  				  FROM orden_pago_fp,nro_saf 
			                  WHERE cuit='$usuario' and saf = numero AND orden_pago ='$nom'
							  and fecha >='$fechaant' and fecha <= '$fechahoy'" ;
		   }
		 
		else
		  {
			    $_pagi_sql = "SELECT  *
			  				  FROM orden_pago_fp,nro_saf 
			 				 WHERE cuit='$usuario' and saf = numero
							 and fecha >='$fechaant' and fecha <= '$fechahoy'
							 ORDER BY ejercicio,`fecha` DESC,`orden_pago` ASC";
			  
			}	
	}

$_pagi_cuantos = 10;
$_pagi_nav_num_enlaces = 15;
$_pagi_nav_estilo="pag";
$_pagi_propagar=array('sec','nom','fechahoy','fechaant','apli','per');
//definimos qué irá en el enlace a la página anterior
$_pagi_nav_anterior = "<img src='img/izq.png' border=0>";// podría ir un tag <img> o lo que sea
$_pagi_nav_primera = "<img src='img/izqfin.png' border=0>";
$_pagi_nav_ultima = "<img src='img/derfin.png' border=0>";
//definimos qué irá en el enlace a la página siguiente
$_pagi_nav_siguiente = "<img src='img/der.png' border=0>";// podría ir un tag <img> o lo que sea
include("paginator.inc.php");   

?>
<div class="content">
<table width="90%"  border="0" align="left" cellpadding="3" cellspacing="1" bordercolor="#EAEAEA" >
 
		<td height="49" colspan="2"><h2 align="center">Ordenes Pagadas</h2></td>
	</tr>
   <tr height=10px>
    <td colspan="2"><hr /></td>
  </tr>
   <TR>	  
      <td colspan="2" class="subtitle"><div align="center"><strong>
        <?php if ($f_situacion['razon_social']=='')
	               {
				    echo $f_situacion['apellido']; echo '&nbsp;'; echo $f_situacion['nombre']; 
								
					}
				else 
				   {
				    echo $f_situacion['razon_social']; }?>
        --- Nro. CUIL | CUIT:<?php echo $f_situacion['cuitl']; echo $f_beneficiario['cuitl']; ?></strong></div></td>
	  </TR>
   <tr height=10px>
    <td colspan="2"><hr /></td>
  </tr>
   
	

	
	
</table>
<br /> 
<table width="100%"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
<tr>
    	<td height="30" colspan="3" >
		     <form action="" method="post">
      		<input  name="busnom" type="text" id="busnom" size="30" maxlength="50" />
      		<input name="busca" type="submit" class="tabla_jugando" id="busca" value="Buscar" />
            <input type="hidden" name="fechahoy" value="<?php echo $fechahoy;?>" />
            <input type="hidden" name="fechaant" value="<?php echo $fechaant;?>" />
	  		</form>  
        </td>
        <td height="30" colspan="2" >   
		</td> 
        <td height="30" colspan="2" ><a title="Listado de Orden de Pago" href="consolidada/listado_ordenes.php?fechah=<?php echo $fechahoy; ?>&fehcaa=<?php echo $fechaant; ?>&dato=<?php echo $usuario; ?>&saf=<?php echo $nrosaf; ?>" target="_blank"  ><img src="img/print_odp.jpg" width="35" align="" height="24" border="0"/></a>   
		</td>     
    </tr>
</table>    
<table width="100%"  border="1" align="left" cellpadding="0" cellspacing="0" bgcolor="#DBE3E6" bordercolor="#EAEAEA">
  
    <tr class="fuframe" >
       <td width="10%"><strong>Saf</td> 
       <td width="19%"><strong>Nro de Orden</td>
       <td width="10%"><strong>Ejercicio</td>
       <td width="16%"><strong>Fecha</td>
       
       <td width="31%"><strong>Beneficiarios</td>
      <td width="31%"><strong>Concepto</td>
       <td width="18%"><strong>Total</strong></td>
   </tr>
 <?php
      while ($f_orden=mysql_fetch_array($_pagi_result))
	  {
?>	   
	     <tr bgcolor="#F3F3F3"  class="fuframe1" > 
            <td align="center" ><a title="<?php echo $f_orden['nombre']; ?>">
		  <?php echo $f_orden['saf'];?></a> </td>
            <td align="left">&nbsp;<?php echo $f_orden['orden_pago'];?></td>
            <td align="center"><?php echo $f_orden['ejercicio'];?></td>
            <td align="center"><?php echo $f_orden['fecha'];?></td>
            <td width="136" align="left"><?php echo $f_orden['apellido'].' '.$f_orden['nombre']; echo substr($f_orden['razon_social'],0,20);?></font></td>
           <td width="136" align="left"><?php echo substr($f_orden['concepto'],0,25);?></font></td>
               
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
<h2></h2>
<ul>
 
      <li><a href="indextesoreria.php?sec=saf/index1&apli=orden&per=C">Regresar Menu</a></li>
	
	<!-- <li><a href="indextesoreria.php?sec=tesoreria/saf_consulta&apli=tgpc&per=A">Beneficiarios - SAF</a> </li>-->
</ul>
</div>
<div class="clearer"><span></span></div>