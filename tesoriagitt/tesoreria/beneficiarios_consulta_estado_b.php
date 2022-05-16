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
		
	$tip=$_GET['tipo'];
	
	if (isset($_POST['busca']) and !empty($_POST['busnom']))
	{
		$nom = $_POST['busnom'];
		$_pagi_sql = "SELECT cuitl,apellido,nombre,nombre_f,razon_social,persona_tipo,
		              id_beneficiario,inhi,estado
					   FROM beneficiarios_aprobados 
	    				WHERE (cuitl='$nom' or  apellido like '%$nom%' or  nombre_f like '%$nom%' or  razon_social like '%$nom%')
						AND estado ='A'
						AND valor_e ='N'";
	}
	 elseif ($_GET['_pagi_pg'] >1 and !empty($_GET['nom'])) 
	
	{
		$nom = $_GET['nom'];
		$_pagi_sql = "SELECT cuitl,apellido,nombre,nombre_f,razon_social,persona_tipo,
		              id_beneficiario,inhi,estado
					   FROM beneficiarios_aprobados 
	    				WHERE (cuitl='$nom' or  apellido like '%$nom%' or  nombre_f like '%$nom%' or  razon_social like '%$nom%')
						AND estado ='A'
						AND valor_e ='N'";
	}
	 
	else
	 {
	if ($tip =='')
	  {
	
    	$_pagi_sql = "SELECT cuitl,apellido,nombre,nombre_f,razon_social,persona_tipo,
		              id_beneficiario,inhi,estado
					  FROM beneficiarios_aprobados 
					  where estado ='A'
					  AND valor_e ='N'
					  ORDER BY id_beneficiario";
	  }
	
	
	 }

	
	  
	/*if (isset($_POST['busca']))
    { 
		unset($_GET['_pagi_pg']);
		$_pagi_actual = 1;
	}*/

$_pagi_cuantos = 10;
$_pagi_nav_num_enlaces = 15;
$_pagi_nav_estilo="pag";
$_pagi_propagar=array('sec','nom','apli','per');
//definimos qué irá en el enlace a la página anterior
$_pagi_nav_anterior = "<img src='img/izq.png' border=0>";// podría ir un tag <img> o lo que sea
$_pagi_nav_primera = "<img src='img/izqfin.png' border=0>";
$_pagi_nav_ultima = "<img src='img/derfin.png' border=0>";
//definimos qué irá en el enlace a la página siguiente
$_pagi_nav_siguiente = "<img src='img/der.png' border=0>";// podría ir un tag <img> o lo que sea
include("paginator.inc.php");
?>

<div class="content">

<h1>Beneficiarios de Alta</h1>
<table width="90%"  border="1" align="CENTER" cellpadding="3" cellspacing="1" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
	<tr>
	
	</tr>
	<tr>
    	<td height="30" colspan="6" align="center">
		     <form action="" method="post">
      		<input  name="busnom" type="text" id="busnom" size="30" maxlength="50" />
      		<input name="busca" type="submit" class="tabla_jugando" id="busca" value="Buscar" />
	  		</form>
		</td>
	</tr>

    <tr>
	    <td width="15" align="center">Nº</td>
    	<td width="114" align="center">CUIL - CUIL</td>
		<td align="center">Apellido y Nombre o Razon Social</td>
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

    if($f_persona['inhi']=='')
	  {
?>
	  	<tr bgcolor="#F3F3F3" id="t<? echo $i; ?>"> 
<?php
      }
	 else
	   {
?>
	  <tr  bgcolor="#C4EAE3" id="t<? echo $i; ?>">
<?php
       }
?>	   	    
        <td><?php echo $f_persona['id_beneficiario'];?></td>
		<td><?php echo $f_persona['cuitl'];?></td>
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
		
        <td><a target="_parent" href="indextesoreria.php?sec=tesoreria/confirmar_estado_b&apli=tgpc&per=A&id=<?php echo $f_persona['id_beneficiario']; ?>"><img src="img/iconos_CB.png" border="0" height="16" width="16"/></a></td>
 		
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
<h2>Ver Nota</h2>
<FORM name="sampleform" action="tesoreria/imprimir_nota_a_b.php?apli=tgpai&per=A" method="POST" target="_blank" >
<input type="text" name="firstinput" size=20 readonly> <small><a href="javascript:showCal('Calendar1')"><img src="img/calendar.png" width="22" height="22" border="0" align="absbottom" /></a></small>
 <input type="submit" name="Submit" value="   Ver   "  onClick="Validar(this.form)">
</FORM>

    

<h2></h2>
<ul>
    
	
    <li><a href="indextesoreria.php?sec=tesoreria/beneficiarios_consulta_estado_confirmar_b&apli=tgpai&per=A">Confirmar</a></li>
      <li><a href="indextesoreria.php?sec=tesoreria/index1&apli=tgp&per=C">Regresar Menu</a></li>
	
	<!-- <li><a href="indextesoreria.php?sec=tesoreria/saf_consulta&apli=tgpc&per=A">Beneficiarios - SAF</a> </li>-->
</ul>

</div>
<div class="sidenav">
</div>
<div class="clearer"><span></span></div>