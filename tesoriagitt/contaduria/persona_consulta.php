<?php
error_reporting ( E_ERROR ); 
	//conexion
	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	
	if (isset($_POST['busca']) and !empty($_POST['busnom']))
	{
		$nom = $_POST['busnom'];
		$_pagi_sql =	"SELECT * FROM personas 
	    				WHERE apellido LIKE '%$nom%' OR docnro LIKE '%$nom%' 
			        	ORDER BY apellido";
	}
	else 
	{
    	$_pagi_sql = "SELECT * FROM personas ORDER BY apellido,nombre";
	}
	if (isset($_POST['busca']))
    { 
		unset($_GET['_pagi_pg']);
		$_pagi_actual = 1;
	}

$_pagi_cuantos = 10;
$_pagi_nav_num_enlaces = 15;
$_pagi_nav_estilo="pag";
//definimos qué irá en el enlace a la página anterior
$_pagi_nav_anterior = "<img src='../img/izq.png' border=0>";// podría ir un tag <img> o lo que sea
$_pagi_nav_primera = "<img src='../img/izqfin.png' border=0>";
$_pagi_nav_ultima = "<img src='../img/derfin.png' border=0>";
//definimos qué irá en el enlace a la página siguiente
$_pagi_nav_siguiente = "<img src='../img/der.png' border=0>";// podría ir un tag <img> o lo que sea
include("paginator.inc.php");
?>

<div class="content">

<table width="80%"  border="1" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
	<tr>
    	<td height="30" colspan="5" align="center">
		     <form action="" method="post">
      		<input  name="busnom" type="text" id="busnom" size="30" maxlength="50" />
      		<input name="busca" type="submit" class="tabla_jugando" id="busca" value="Buscar" />
	  		</form>
		</td>
	</tr>
	<tr>
    	<td height="30" colspan="5" align="center">Consulta de Personas</td>
	</tr>
    <tr>
    	<td width="114" align="center">Documento</td>
		<td width="420" align="center">Apellido y Nombre</td>
		<td></td>
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
?>

    <tr bgcolor="#F3F3F3" id="t<? echo $i; ?>" <? echo "onmouseover=' this.bgColor=\"#D6EDE9\"; quitarcolor(".$i.",".$cant.",this);'";?>> 
        <td><?php echo $f_persona['docnro'];?></td>
        <td><?php echo $f_persona['apellido'].", ".$f_persona['nombre'];?></td>
        <td>&nbsp;<a href="indextesoreria.php?sec=contaduria/modipersona&id=<?php echo $f_persona['id_personas'];?>"><img src="img/b_edit.png" width="16" height="16" 
                border="0"/></a>&nbsp;</td>
		<td align="center">&nbsp;<a href="indextesoreria.php?sec=contaduria/bajapersona&id=<?php echo $f_persona['id_personas'];?>"><img src="img/b_drop.png" width="16" height="16" 
                border="0"/></a>&nbsp;</td>
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
<div class="clearer"><span></span></div>