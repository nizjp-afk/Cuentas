 <?php
//conexion
	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	$aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
	
	
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
		 		$nom = $_POST['busnom'];
		 		$_pagi_sql = "SELECT  *
			  				  FROM orden_pago,nro_saf 
			                  WHERE (saf='$nom' or orden_pago ='$nom') and saf = numero  
							  and  fecha >='$fechaant' and fecha <= '$fechahoy'" ;
			}
		elseif ($_GET['_pagi_pg'] >1 and !empty($_GET['nom'])) 
		   {
			    $fechaant = $_GET['fechaant'];
		        $fechahoy = $_GET['fechahoy'];
				$nom = $_GET['nom'];
		 		$_pagi_sql = "SELECT  *
			  				  FROM orden_pago,nro_saf
			                  WHERE (saf='$nom' or orden_pago ='$nom') and saf = numero
							  and  fecha >='$fechaant' and fecha <= '$fechahoy'" ;
		   }
		
		else 
			{ 
			    $_pagi_sql = "SELECT  *
				  		      FROM orden_pago,nro_saf 
							  WHERE  saf = numero
							  and fecha >='$fechaant' and fecha <= '$fechahoy'
							  ORDER BY ejercicio,`fecha` DESC,`orden_pago` ASC";
			  
			}
	 
	

$_pagi_cuantos = 10;
$_pagi_nav_num_enlaces = 15;
$_pagi_nav_estilo="pag";
$_pagi_propagar=array('sec','nom','fechahoy','fechaant','apli','per');
//definimos qu� ir� en el enlace a la p�gina anterior
$_pagi_nav_anterior = "<img src='img/izq.png' border=0>";// podr�a ir un tag <img> o lo que sea
$_pagi_nav_primera = "<img src='img/izqfin.png' border=0>";
$_pagi_nav_ultima = "<img src='img/derfin.png' border=0>";
//definimos qu� ir� en el enlace a la p�gina siguiente
$_pagi_nav_siguiente = "<img src='img/der.png' border=0>";// podr�a ir un tag <img> o lo que sea
include("paginator.inc.php");   

?>
<div class="content">
<table width="90%"  border="0" align="left" cellpadding="3" cellspacing="1" bordercolor="#EAEAEA" >
 
		<td height="49" colspan="2"><h2 align="center">Ordenes Pagadas</h2></td>
	</tr>
   <tr height=10px>
    <td colspan="2"><hr /></td>
  </tr>
   
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
	  		<input type="hidden" name="fechahoy" value="<?php echo $fechahoy;?>"
            <input type="hidden" name="fechaant" value="<?php echo $fechaant;?>"
            </form>  
        </td>
        <td height="30" colspan="2" ><a title="Listado de Saf" href="ordenes/listado_saf.php" target="_blank"  ><img src="img/print_saf.jpg" width="35" align="" height="24" border="0"/></a>   
		</td> 
        <td height="30" colspan="2" ><a title="Listado de Orden de Pago" href="ordenes/listado_ordenes.php?fechah=<?php echo $fechahoy; ?>&fehcaa=<?php echo $fechaant; ?>&dato=<?php echo $usuario; ?>&saf=<?php echo $nrosaf; ?>" target="_blank"  ><img src="img/print_odp.jpg" width="35" align="" height="24" border="0"/></a>   
		</td>     
    </tr>
</table>    
<table width="110%"  border="1" align="left" cellpadding="5" cellspacing="2" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
   <tr align="center">
       <td width="10%"><strong>Ejercicio</td>
       <td width="16%"><strong>Fecha</td>
       <td width="10%"><strong>Saf</td>
       <td width="19%"><strong>Nro de Orden</td>
       <td width="31%"><strong>Concepto</td>
       <td width="18%"><strong>Total</strong></td>
   </tr>
 <?php
      while ($f_orden=mysql_fetch_array($_pagi_result))
	  {
?>	   
	    <tr bgcolor="#F3F3F3" > 
           <td align="center"><?php echo $f_orden['ejercicio'];?></td>
          <td align="center"><?php echo $f_orden['fecha'];?></td>
          <td align="center" ><a title="<?php echo $f_orden['nombre']; ?>"><?php echo $f_orden['saf'];?></a> </td>
          <td align="left">&nbsp;<?php echo $f_orden['orden_pago'];?></td>
          
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
</div>
<div class="clearer"><span></span></div>