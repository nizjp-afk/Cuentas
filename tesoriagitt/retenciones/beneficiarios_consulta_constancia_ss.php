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
	$nom = trim($_POST['busnom']);
		$fechaant = $_POST['fechaant'];
	    $fechahoy = $_POST['fechahoy']; 
		
		$_pagi_sql = "SELECT * FROM tem_sicore_ss
		              where cuit='$usuario'
	    				AND (numero_ss like '%$nom%' or orden='$nom') 
							
						AND numero_ss > '0' 
						ORDER BY numero_ss DESC			  
					   ";
	}
	 elseif ($_GET['_pagi_pg'] >1 and !empty($_GET['nom'])) 
	
	{
		$nom = trim($_GET['nom']);
		$fechaant = $_GET['fechaant'];
	     $fechahoy = $_GET['fechahoy']; 
		 
		$_pagi_sql = "SELECT * FROM tem_sicore_ss
		              where cuit='$usuario'
	    				AND (numero_ss like '%$nom%' or orden='$nom') 
							
						AND numero_ss > '0' 
						ORDER BY numero_ss DESC			  
					   ";
	}
	 
	else
	 {
	 if ($_GET['_pagi_pg'] >=1)
		  {
			$fechaant = $_GET['fechaant'];
	     $fechahoy = $_GET['fechahoy'];
			  }
	else
		{
			$i = strtotime($d_fecha);
            

		 	 $ni=date(N,($i)); 
			if($ni==1)
			 {
			 $nuevaFecha= date('Y-m-d', strtotime('-5 day'));
			 
			 }
			else if($ni==2)
			 {
			 $nuevaFecha= date('Y-m-d', strtotime('-5 day'));
			 }
			 else if($ni==7)
			 {
			 $nuevaFecha= date('Y-m-d', strtotime('-4 day'));
			 }
			  else if($ni==6)
			 {
			 $nuevaFecha= date('Y-m-d', strtotime('-3 day'));
			 }
			else
			 {
			 $nuevaFecha= date('Y-m-d', strtotime('-3 day')); 
			 }
		 $fechahoy = $nuevaFecha;
	   
	  
		  $d=date('d');
		  $m=date('m');
		  $y=date('Y');
		  
		  if($m ==01 or $m ==03 or $m ==04 or $m ==02 )
		    {
				$yh=$y-2;
				$fechaant=$yh.'-'.'01'.'-'.'01';
			}
			else
			{
				$yh=$y-1;
				$fechaant=$yh.'-'.'01'.'-'.'01';
			}
		
      /*   if($d >=15)
		   {
			 
            $mes=date("n") ;
			$i=$mes-1;
			
			$nuevaFecha= date('Y-m-d', mktime(0, 0, 0, $i,  1, date("Y-m-d") ) ) ; // resta 1 mes
			$fecha_m=explode("-", $nuevaFecha); 
			$m=$fecha_m[1];
			$yr=$fecha_m[0];
			$d=31;
			if($y > $yr)
			 {
				$fechahoy=$yr.'-'.$m.'-'.$d;   
			 }
			 else
			 {
			
			$fechahoy=$y.'-'.$m.'-'.$d;   
			 }
			//echo $fechahoy=date ( 'Y-m-d' , $fechahoy );
		   }
		  else
		   {
			$nuevaFecha= date('Y-m-d', strtotime('-2 month')) ; // resta 1 mes
			$fecha_m=explode("-", $nuevaFecha); 
			$m=$fecha_m[1];
			$yr=$fecha_m[0];
			$d=31;
			if($y > $yr)
			 {
				$fechahoy=$yr.'-'.$m.'-'.$d;   
			 }
			 else
			 {
			
			echo $fechahoy=$y.'-'.$m.'-'.$d;   
			 }
		   }
		
		*/
		$accion='Consulta Retenciones Ingresos Brutos';
	 	$tabla='tem_sicore_ss';
	 	include('agrego_movi.php'); 
		 $sql = "delete from `tem_sicore_ss`  where cuit='$usuario' " ;
	  	  
			if (!($r_codigo= mysql_query($sql, $conexion_mysql)))
			{
			  //..informa del error producido...................
			  $cuerpo1  = "al buscar saf1";
			  echo $cuerpo1;
			  //...............................................
			}
	
    	 $sql = "insert into tem_sicore_ss SELECT p.fecha AS fecha_pago,b.apellido,b.nombre,b.nombre_f,razon_social, p.cuit,s.monto AS retnecion,s.id,s.numero_ss,r.codigo,p.orden_pago
						FROM orden_pago AS p, sicore_ss AS s, anexoss AS r,beneficiarios_aprobados as b
						WHERE p.orden_pago = s.orden
						AND b.cuitl=p.cuit
						AND b.cuitl='$usuario'
						AND p.ejercicio = s.ejercicio
						AND p.saf = s.saf
						AND r.id_ss = s.ss_id
						AND fecha_io = p.fecha
						AND (p.fecha >='$fechaant' and p.fecha <= '$fechahoy')
						AND s.numero_ss > '0' 
						ORDER BY s.numero_ss DESC		  
					  
					  
					  ";
					  
					   if (!($r_codigo= mysql_query($sql, $conexion_mysql)))
			{
			  //..informa del error producido...................
			  $cuerpo1  = "al buscar saf";
			  echo $cuerpo1;
			  //...............................................
			} 
			
			
			$sql = "insert into tem_sicore_ss SELECT p.fecha AS fecha_pago,b.apellido,b.nombre,b.nombre_f,razon_social, p.cuit, s.monto AS retnecion,s.id,s.numero_ss,r.codigo,p.orden_pago
						FROM orden_pago_fp AS p, sicore_ss AS s, anexoss AS r,beneficiarios_aprobados as b
						WHERE p.orden_pago = s.orden
						AND b.cuitl=p.cuit
						AND b.cuitl='$usuario'
						AND p.ejercicio = s.ejercicio
						AND p.saf = s.saf
						AND r.id_ss = s.ss_id
						AND fecha_io = p.fecha
						AND (p.fecha >='$fechaant' and p.fecha <= '$fechahoy')
						AND s.numero_ss > '0' 
						ORDER BY s.numero_ss DESC		  
					  
					  
					  ";
					  
					   if (!($r_codigo= mysql_query($sql, $conexion_mysql)))
			{
			  //..informa del error producido...................
			  $cuerpo1  = "al buscar saf2";
			  echo $cuerpo1;
			  //...............................................
			} 
			
		}
			$_pagi_sql = "SELECT * FROM tem_sicore_ss where cuit='$usuario' order by numero_ss desc,fecha_pago	";		  
	 
	 }  
	  
	/*if (isset($_POST['busca']))
    { 
		unset($_GET['_pagi_pg']);
		$_pagi_actual = 1;
	}*/

$_pagi_cuantos = 10;
$_pagi_nav_num_enlaces = 15;
$_pagi_nav_estilo="pag";
$_pagi_propagar=array('sec','nom','apli','per','fechaant','fechahoy');
//definimos qué irá en el enlace a la página anterior
$_pagi_nav_anterior = "<img src='img/izq.png' border=0>";// podría ir un tag <img> o lo que sea
$_pagi_nav_primera = "<img src='img/izqfin.png' border=0>";
$_pagi_nav_ultima = "<img src='img/derfin.png' border=0>";
//definimos qué irá en el enlace a la página siguiente
$_pagi_nav_siguiente = "<img src='img/der.png' border=0>";// podría ir un tag <img> o lo que sea
include("paginator.inc.php");
?>

<div class="content">

<h4>CONSTANCIA DE RETENCION CONTRIBUCIONES PATRONALES </h4><br />
<table width="90%"  border="1" align="CENTER" cellpadding="3" cellspacing="1" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
	<tr>
	
	    
	    <td height="30" colspan="6" >Razon Social:<?php echo $nombre; echo $razon; ?><br />
        CUIT : <?php echo $usuario;?></td>
			   
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
       <td>Orden</td>
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
 $aux=trim($f_persona['numero_ss']);
     if($i==1)
	   {
		  
		  $aux1=$aux;
    
?>
  	<tr bgcolor="#F3F3F3" > 
   
        <td><?php echo $f_persona['numero_ss'];?></td>
        <td><?php echo $f_persona['orden'];?></td>
		<td><?php echo $f_persona['fecha_pago'];?></td>
       
        
<?php
$estado=$f_persona['estado'];

?>		
        
		 <td colspan="4">&nbsp;<a href="retenciones/imprimir.php?id=<?php echo $f_persona['numero_ss'];?>&firstinput=<?php echo $fechahoy; ?>&secondinput=<?php echo $fechaant; ?>" target="_blank"><img width="22" height="22" src="img/impresion1.jpg" border="0"/></a>&nbsp;</td>

    		
    </tr>
     <?php
     }
	 else if(!($aux==$aux1))
   {
	   $aux1=$aux;
	  ?>
  	<tr bgcolor="#F3F3F3" > 
   
        <td><?php echo $f_persona['numero_ss'];?></td>
            <td><?php echo $f_persona['orden'];?></td>
		<td><?php echo $f_persona['fecha_pago'];?></td>
       
        
<?php
$estado=$f_persona['estado'];

?>		
        
		 <td colspan="4">&nbsp;<a href="retenciones/imprimir.php?id=<?php echo $f_persona['numero_ss'];?>&firstinput=<?php echo $fechahoy; ?>&secondinput=<?php echo $fechaant; ?>" target="_blank"><img width="22" height="22" src="img/impresion1.jpg" border="0"/></a>&nbsp;</td>

    		
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
 
      <li><a href="indextesoreria.php?sec=ordenes/index_r1&apli=orden&per=C">Regresar Menu</a></li>
	
	<!-- <li><a href="indextesoreria.php?sec=tesoreria/saf_consulta&apli=tgpc&per=A">Beneficiarios - SAF</a> </li>-->
</ul>
</div>
<div class="clearer"><span></span></div>