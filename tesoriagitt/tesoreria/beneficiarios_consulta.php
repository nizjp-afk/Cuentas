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
		$_pagi_sql =	"SELECT cuitl,apellido,nombre,nombre_f,razon_social,persona_tipo,
		id_beneficiario,fecha_aprobacion,saf FROM beneficiarios 
	    				WHERE cuitl='$nom' or apellido like '%$nom%' or nombre_f like '%$nom%' or  razon_social like '%$nom%' and alta <> 'S' ";
	}
	
	 elseif ($_GET['_pagi_pg'] >1 and !empty($_GET['nom'])) 
	
	{
		$nom = $_GET['nom'];
		$_pagi_sql =	"SELECT cuitl,apellido,nombre,nombre_f,razon_social,persona_tipo,
		id_beneficiario,fecha_aprobacion,saf FROM beneficiarios 
	    				WHERE cuitl='$nom' or apellido like '%$nom%' or nombre_f like '%$nom%' or  razon_social like '%$nom%' and alta <> 'S' ";
	}
	
	
	else 
	{
    	$_pagi_sql = "SELECT cuitl,apellido,nombre,nombre_f,razon_social,persona_tipo,id_beneficiario,fecha_aprobacion,saf FROM beneficiarios where alta <> 'S'
		              ORDER BY apellido,nombre";
	}

	if (!($result = mysqli_query($conexion_mysql,$_pagi_sql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar articulo";
     
      //.....................................................................
    }	

	/*if (isset($_POST['busca']))
    { 
		unset($_GET['_pagi_pg']);
		$_pagi_actual = 1;
	}*/
$_pagi_cuantos = 10;
$_pagi_nav_num_enlaces = 15;
$_pagi_nav_estilo="pag";
//definimos qu� ir� en el enlace a la p�gina anterior
$_pagi_nav_anterior = "<img src='img/izq.png' border=0>";// podr�a ir un tag <img> o lo que sea
$_pagi_nav_primera = "<img src='img/izqfin.png' border=0>";
$_pagi_nav_ultima = "<img src='img/derfin.png' border=0>";
//definimos qu� ir� en el enlace a la p�gina siguiente
$_pagi_nav_siguiente = "<img src='img/der.png' border=0>";// podr�a ir un tag <img> o lo que sea
include("paginator.inc.php");
?>

<div class="content">
<h1>Aprobacion de Beneficiarios</h1>
<table width="90%"  border="1" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
	<tr>
    	<td height="30" colspan="5" align="center">
		     <form action="" method="post">
      		<input  name="busnom" type="text" id="busnom" size="30" maxlength="50" />
      		<input name="busca" type="submit" class="tabla_jugando" id="busca" value="Buscar" />
	  		</form>
		</td>
	</tr>
	<tr>
    	<td height="30" colspan="5" align="center">Consulta de Beneficiario</td>
	</tr>
    <tr>
    	<td width="114" align="center">Cuit - Cuil</td>
		<td align="center">Apellido y Nombre o Razon Social</td>
		<td align="center">Saf</td>
		<td></td>
	</tr>

<?php
        $cant= mysqli_num_rows($_pagi_result);
		$i=0; 
        $j=0; 
              while ($f_persona=mysqli_fetch_array($_pagi_result))
		      { 
	       $cuit=$f_persona['cuitl'];
		   $fecha_a=$f_persona['fecha_aprobacion'];
        if($fecha_a=='0000-00-00')
           {
?>		   

    <tr bgcolor="#F3F3F3" > 
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
		<td><?php echo $f_persona['saf'];?></td>
		
        <td>
		&nbsp;
<?php 
    if($f_persona['persona_tipo']=='o')
      {
?>	  
		  		<a href="indextesoreria.php?sec=tesoreria/formulario&apli=tgpao&per=A&id=<?php echo $f_persona['id_beneficiario'];?>&tipo=<?php echo $f_persona['persona_tipo']; ?>"><img src="img/ok.png" width="32" height="32" border="0"/></a>&nbsp;
<?php	
	  }
	 
 
    else
	  {
?>	  	  		<a href="indextesoreria.php?sec=tesoreria/formulario&apli=tgpa&per=A&id=<?php echo $f_persona['id_beneficiario'];?>&tipo=<?php echo $f_persona['persona_tipo']; ?>"><img src="img/ok.png" width="32" height="32" border="0"/></a>&nbsp;
<?php
     }
?>
</td>
		        
    </tr>
    <?php 
	      }
	
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