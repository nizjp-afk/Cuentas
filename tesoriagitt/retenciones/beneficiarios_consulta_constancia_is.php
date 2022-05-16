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
		
		$_pagi_sql = "SELECT * FROM tem_sicore_ib_saf 
		              where saf='$nrosaf'
	    				AND (numero like '%$nom%' or orden='$nom' or razon_social like '%$nom%'  or apellido like '%$nom%') 
						AND numero > '0' 
						ORDER BY numero DESC ";
	}
	 elseif ($_GET['_pagi_pg'] >1 and !empty($_GET['nom'])) 
	
	{
		$nom = trim($_GET['nom']);
		
		 
		$_pagi_sql = "SELECT * FROM tem_sicore_ib_saf
		              where saf='$nrosaf'
	    				AND (numero like '%$nom%' or orden='$nom' or razon_social like '%$nom%'  or apellido like '%$nom%') 
							
						AND s.numero > '0' 
						ORDER BY s.numero DESC ";
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
		
        /* if($d >=15)
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
			
			$fechahoy=$y.'-'.$m.'-'.$d;   
			 }
		   }
		
		*/
	  $sql = "delete from `tem_sicore_ib_saf`  where saf='$nrosaf' " ;
	  	  
			if (!($r_codigo= mysqli_query($conexion_mysql,$sql)))
			{
			  //..informa del error producido...................
			  $cuerpo1  = "al buscar saf";
			  echo $cuerpo1;
			  //...............................................
			} 
			
			
	 $sql = "insert into tem_sicore_ib_saf SELECT  p.fecha AS fecha_pago, b.apellido,b.nombre,b.nombre_f,razon_social, p.cuit,s.monto AS retnecion,s.id,s.numero,p.orden_pago,p.saf
						FROM orden_pago AS p, sicore_ib AS s, beneficiarios_aprobados as b
						WHERE p.orden_pago = s.orden
						AND b.cuitl=p.cuit
							AND p.saf='$nrosaf'
						AND p.ejercicio = s.ejercicio
						AND p.saf = s.saf
						AND (p.fecha >='$fechaant' and p.fecha <= '$fechahoy')
						AND s.numero > '0' 
						AND p.fecha = s.fecha_io
						ORDER BY s.numero DESC,p.fecha " ;
	  	  
			if (!($r_codigo= mysqli_query($conexion_mysql,$sql)))
			{
			  //..informa del error producido...................
			  $cuerpo1  = "al buscar saft";
			  echo $cuerpo1;
			  //...............................................
			} 		
	   $sql = "insert into tem_sicore_ib_saf SELECT  p.fecha AS fecha_pago, b.apellido,b.nombre,b.nombre_f,razon_social, p.cuit,s.monto AS retnecion,s.id,s.numero,p.orden_pago,p.saf
						FROM orden_pago_fp AS p, sicore_ib AS s, beneficiarios_aprobados as b
						WHERE p.orden_pago = s.orden
						AND b.cuitl=p.cuit
						AND p.saf='$nrosaf'
						AND p.ejercicio = s.ejercicio
						AND p.saf = s.saf
						AND (p.fecha >='$fechaant' and p.fecha <= '$fechahoy')
						AND s.numero > '0' 
						AND p.fecha = s.fecha_io
						ORDER BY s.numero DESC,p.fecha " ;
	  	  
			if (!($r_codigo= mysqli_query($conexion_mysql,$sql)))
			{
			  //..informa del error producido...................
			  $cuerpo1  = "al buscar safp";
			  echo $cuerpo1;
			  //...............................................
			} 	
	 }
	
    	$_pagi_sql = "SELECT * FROM tem_sicore_ib_saf where saf='$nrosaf' order by numero DESC,fecha_pago";
	 
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
//definimos qu� ir� en el enlace a la p�gina anterior
$_pagi_nav_anterior = "<img src='img/izq.png' border=0>";// podr�a ir un tag <img> o lo que sea
$_pagi_nav_primera = "<img src='img/izqfin.png' border=0>";
$_pagi_nav_ultima = "<img src='img/derfin.png' border=0>";
//definimos qu� ir� en el enlace a la p�gina siguiente
$_pagi_nav_siguiente = "<img src='img/der.png' border=0>";// podr�a ir un tag <img> o lo que sea
include("paginator.inc.php");
?>

<div class="content">

    <h4>CONSTANCIA DE RETENCION DEL IMPUESTO SOBRE LOS INGRESOS BRUTOS</h4><br />
    <table width="90%" border="1" align="CENTER" cellpadding="3" cellspacing="1" bgcolor="#DBE3E6"
        bordercolor="#EAEAEA">
        <tr>


            <td height="30" colspan="6"><br />
            </td>

        </tr>
        <tr>
            <td height="30" colspan="8" align="center">
                <form action="" method="post">
                    <input name="busnom" type="text" id="busnom" size="30" maxlength="50" />
                    <input type="hidden" name="fechahoy" value="<?php echo $fechahoy; ?>" />
                    <input type="hidden" name="fechaant" value="<?php echo $fechaant; ?>" />
                    <input name="busca" type="submit" class="tabla_jugando" id="busca" value="Buscar" />
                </form>
            </td>
        </tr>

        <tr>
            <td>N�Constancia</td>
            <td width="114" align="center">FECHA DE PAGO</td>


            <td colspan="4"></td>

        </tr>

        <?php
        $cant= mysqli_num_rows($_pagi_result);
		$i=0; 
        $j=0; 
              while ($f_persona=mysqli_fetch_array($_pagi_result))
		{ 
		     $j=$i;  
             $i=$i+1;
			  $aux=trim($f_persona['numero']);
     if($i==1)
	   {
		  
		  $aux1=$aux;
    
?>
        <tr bgcolor="#F3F3F3">

            <td><?php echo $f_persona['numero'];?></td>
            <td><?php echo $f_persona['fecha_pago'];?></td>


            <?php
$estado=$f_persona['estado'];

?>

            <td colspan="4">&nbsp;<a
                    href="retenciones/imprimir_ib.php?id=<?php echo $f_persona['numero'];?>&firstinput=<?php echo $fechahoy; ?>&secondinput=<?php echo $fechaant; ?>"
                    target="_blank"><img width="22" height="22" src="img/impresion1.jpg" border="0" /></a>&nbsp;</td>


        </tr>


        <?php 
	   }
	 else if(!($aux==$aux1))
   {
	   $aux1=$aux;
	  
	  ?>
        <tr bgcolor="#F3F3F3">

            <td><?php echo $f_persona['numero'];?></td>
            <td><?php echo $f_persona['fecha_pago'];?></td>


            <?php
$estado=$f_persona['estado'];

?>

            <td colspan="4">&nbsp;<a
                    href="retenciones/imprimir_ib.php?id=<?php echo $f_persona['numero'];?>&firstinput=<?php echo $fechahoy; ?>&secondinput=<?php echo $fechaant; ?>"
                    target="_blank"><img width="22" height="22" src="img/impresion1.jpg" border="0" /></a>&nbsp;</td>


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

        <li><a href="indextesoreria.php?sec=retenciones_saf/index1&apli=orden&per=C">Regresar Menu</a></li>

        <!-- <li><a href="indextesoreria.php?sec=tesoreria/saf_consulta&apli=tgpc&per=A">Beneficiarios - SAF</a> </li>-->
    </ul>
</div>
<div class="clearer"><span></span></div>