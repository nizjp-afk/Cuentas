<?php
    error_reporting (E_ERROR); 
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	
	$aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];
  include('incluir_siempre.php');
		
	$tip=$_GET['tipo'];
	
	
	
	
	if ($tip=='j')
	  {
	 $_pagi_sql = "SELECT cuitl,apellido,nombre,razon_social,persona_tipo,
	               id_beneficiario,inhi,estado
				   FROM beneficiarios_aprobados where persona_tipo='j' and estado='A' 
				   ORDER BY id_beneficiario ";
	  }
	 
	 if ($tip=='f')
	  {
	 $_pagi_sql = "SELECT cuitl,apellido,nombre,razon_social,persona_tipo,
	               id_beneficiario,inhi,estado
				   FROM beneficiarios_aprobados where persona_tipo='f' and estado='A' 
				   ORDER BY id_beneficiario";
	  } 
	 
	 if ($tip=='o')
	  {
	 $_pagi_sql = "SELECT cuitl,apellido,nombre,razon_social,persona_tipo,
	               id_beneficiario,inhi,estado
				   FROM beneficiarios_aprobados where persona_tipo='o' and estado='A' 
				   ORDER BY id_beneficiario ";
	  }
	  
	  
	if (isset($_POST['busca']) and !empty($_POST['busnom']))
	{
		$nom = $_POST['busnom'];
		$_pagi_sql =	"SELECT cuitl,apellido,nombre,nombre_f,razon_social,persona_tipo,
		id_beneficiario,fecha_aprobacion,saf,inhi,estado FROM beneficiarios_aprobados 
	    				WHERE cuitl='$nom' or apellido like '%$nom%' or nombre_f like '%$nom%' or  razon_social like '%$nom%' and estado='A' ";
	}
	
	 elseif ($_GET['_pagi_pg'] >1 and !empty($_GET['nom'])) 
	
	{
		$nom = $_GET['nom'];
		$_pagi_sql =	"SELECT cuitl,apellido,nombre,nombre_f,razon_social,persona_tipo,
		id_beneficiario,fecha_aprobacion,saf,inhi,estado FROM beneficiarios_aprobados 
	    				WHERE cuitl='$nom' or apellido like '%$nom%' or nombre_f like '%$nom%' or  razon_social like '%$nom%' and estado='A' ";
	}
	
	
	else 
	{
    	$_pagi_sql = "SELECT cuitl,apellido,nombre,nombre_f,razon_social,persona_tipo,id_beneficiario,fecha_aprobacion,saf,inhi,estado FROM beneficiarios_aprobados where estado='A'
		              ORDER BY id_beneficiario";
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
<h1>Modificacion de Datos Generales</h1>
<table width="90%"  border="1" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
	<tr>
    	<td height="30" colspan="6" align="center">
		     <form action="" method="post">
      		<input  name="busnom" type="text" id="busnom" size="30" maxlength="50" />
      		<input name="busca" type="submit" class="tabla_jugando" id="busca" value="Buscar" />
	  		</form>
		</td>
	</tr>
	<tr>
	<?php if($tip=='j')
	       {
  	?>	   
    	<td height="30" colspan="6" align="center">Consulta de Beneficiario Persona Juridica</td>
	<?php
	       }
		 if($tip=='f')
	       {
  	?>	   
    	<td height="30" colspan="6" align="center">Consulta de Beneficiario Persona Fisica</td>
	<?php
	       }  
		if($tip=='o')
	       {
  	?>	   
    	<td height="30" colspan="5" align="center">Consulta de Beneficiario  Otras Persona </td>
	<?php
	       }  
	     if ($tip=='')
		   {
	?>
	    <td height="30" colspan="6" align="center">Consulta de Beneficiario</td>
	<?php
	      }
	?>	  		   
		   	   	
	</tr>
    <tr>
	    <td width="15" align="center"> Nº </td>
    	<td width="114" align="center">Cuit - Cuil</td>
		<td align="center">Apellido y Nombre o Razon Social</td>
		<td></td>
		
	</tr>

<?php
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
	  	<tr bgcolor="#F3F3F3" id="t<?php echo $i; ?>"> 
<?php
      }
	 else
	   {
?>
	  <tr  bgcolor="#C4EAE3" id="t<?php echo $i; ?>">
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

<?php		
$estado=$f_persona['estado'];
if($estado=='A')
  {		
?>

        </td>
        <td>&nbsp;<a href="indextesoreria.php?sec=contaduria/formulario&id=<?php echo $f_persona['id_beneficiario'];?>&tipo=<?php echo $f_persona['persona_tipo']; ?>&apli=tgpa&per=G"><img src="img/b_edit.png" width="16" height="16" border="0"/></a>&nbsp;</td>
<?php
  }
else
  {
 ?>
   <td>Baja</td>
 <?php
   }
 ?>    		
		
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
<h2>Tipo de Consulta</h2>
<ul>
	<li><a href="indextesoreria.php?sec=contaduria/beneficiarios_aprobado&tipo=f&apli=tgp&per=C">Beneficiario Persona Fisica</a></li>
    <li><a href="indextesoreria.php?sec=contaduria/beneficiarios_aprobado&tipo=j&apli=tgp&per=C">Beneficiario Persona Juridica</a></li>

	<li><a href="indextesoreria.php?sec=contaduria/beneficiarios_aprobado&tipo=o&apli=tgp&per=C">Beneficiarios Otras Personas</a></li>
	
	
	
</ul>
</div>
<div class="sidenav">
</div>
<div class="clearer"><span></span></div>