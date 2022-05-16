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
		$_pagi_sql = "SELECT *
						FROM nota_retencion
	    				WHERE (numero='$nom')";
	}
	 elseif ($_GET['_pagi_pg'] >1 and !empty($_GET['nom'])) 
	
	{
		$nom = $_GET['nom'];
		$fechaant = $_GET['firstinput'];
	     $fechahoy = $_GET['secondinput']; 
		$_pagi_sql = "SELECT *
						FROM nota_retencion
	    				WHERE (numero='$nom')";
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
	
    	$_pagi_sql = "SELECT *
FROM nota_retencion
ORDER BY `id` DESC , `numero`";
	 
	 }  
	  
	/*if (isset($_POST['busca']))
    { 
		unset($_GET['_pagi_pg']);
		$_pagi_actual = 1;
	}*/

$_pagi_cuantos = 10;
$_pagi_nav_num_enlaces = 15;
$_pagi_nav_estilo="pag";
$_pagi_propagar=array('sec','busnom','apli','per','firstinput','secondinput');
//definimos qué irá en el enlace a la página anterior
$_pagi_nav_anterior = "<img src='img/izq.png' border=0>";// podría ir un tag <img> o lo que sea
$_pagi_nav_primera = "<img src='img/izqfin.png' border=0>";
$_pagi_nav_ultima = "<img src='img/derfin.png' border=0>";
//definimos qué irá en el enlace a la página siguiente
$_pagi_nav_siguiente = "<img src='img/der.png' border=0>";// podría ir un tag <img> o lo que sea
include("paginator.inc.php");
?>

<div class="content">

<h1>Consulta de Notas Enviadas por Mesa de Retencion</h1>
<table width="90%"  border="1" align="CENTER" cellpadding="3" cellspacing="1" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
	<tr>
	
	    
	    <td height="30" colspan="6" align="center"><b></b></td>

		</td>     		   
	</tr>
	<tr>
    	<td height="30" colspan="6" >
		     <form action="" method="post">
      		<input  name="busnom" type="text" id="busnom" size="30" maxlength="50" />
      		<input name="busca" type="submit" class="tabla_jugando" id="busca" value="Buscar" />
	  		</form>
		</td>
	</tr>

    <tr>
	   <td>Nº Nota</td>
    	<td width="114" align="center">Saf</td>
		<td align="center">Orden de Pago</td>
        <td align="center">Fecha</td>
		
		<td colspan="4"></td>
		
	</tr>

<?
        $cant= mysql_num_rows($_pagi_result);
		$i=0; 
        $j=0; 
              while ($f_persona=mysql_fetch_array($_pagi_result))
		{ 
		     $j=$i;  
             $i=$i+1;

    
?>
	  	<tr bgcolor="#F3F3F3" > 
   
        <td><?php echo $f_persona['numero'];?></td>
		<td><?php echo $f_persona['saf'];?></td>
        <td><?php echo $f_persona['orden'];?>     </td>
        <td><?php echo $f_persona['fecha'];?>     </td>
        
	
        
		 <td colspan="4">&nbsp;<a href="retenciones/imprimir_nota_e.php?id=<?php echo $f_persona['numero'];?>" target="_blank"><img width="22" height="22" src="img/impresion1.jpg" border="0"/></a>&nbsp;</td>

    		
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