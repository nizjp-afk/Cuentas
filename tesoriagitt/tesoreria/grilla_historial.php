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
		$_pagi_sql = "SELECT cuitl,apellido,nombre,razon_social,persona_tipo,
		              id_beneficiario,inhi
					   FROM beneficiarios_aprobados 
	    				WHERE cuitl='$nom' or  apellido like '%$nom%' or  razon_social like '%$nom%' ";
	}
	else
	 {
	if ($tip =='')
	  {
	
    	$_pagi_sql = "SELECT cuitl,apellido,nombre,razon_social,persona_tipo,
		              id_beneficiario,inhi
					  FROM beneficiarios_aprobados ORDER BY id_beneficiario";
	  }
	
	
	if ($tip=='j')
	  {
	 $_pagi_sql = "SELECT cuitl,apellido,nombre,razon_social,persona_tipo,
	               id_beneficiario,inhi
				   FROM beneficiarios_aprobados where persona_tipo='j'  
				   ORDER BY id_beneficiario ";
	  }
	 
	 if ($tip=='f')
	  {
	 $_pagi_sql = "SELECT cuitl,apellido,nombre,razon_social,persona_tipo,
	               id_beneficiario,inhi
				   FROM beneficiarios_aprobados where persona_tipo='f'  
				   ORDER BY id_beneficiario";
	  } 
	 
	 if ($tip=='o')
	  {
	 $_pagi_sql = "SELECT cuitl,apellido,nombre,razon_social,persona_tipo,
	               id_beneficiario,inhi
				   FROM beneficiarios_aprobados where persona_tipo='o' 
				   ORDER BY id_beneficiario ";
	  }
	 }  
	  
	if (isset($_POST['busca']))
    { 
		unset($_GET['_pagi_pg']);
		$_pagi_actual = 1;
	}

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
<h1>Historial</h1>
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
	    <td width="15" align="center"> N� </td>
    	<td width="114" align="center">Cuit - Cuil</td>
		<td align="center">Apellido y Nombre o Razon Social</td>
		<td></td>
		
		
	</tr>

<?php
        $cant= mysqli_num_rows($_pagi_result);
		$i=0; 
        $j=0; 
              while ($f_persona=mysqli_fetch_array($_pagi_result))
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
				  echo $f_persona['apellido'].", ".$f_persona['nombre'];
				 }
			   else
			     {	  
		          echo $f_persona['razon_social'];
				 }
?>
        </td>
        <td>&nbsp;<a href="tesoreria/verhistorial2.php?id=<?php echo $f_persona['cuitl'];?>&tipo=<?php echo $f_persona['persona_tipo']; ?>" target="_blank" ><img src="img/b_inf.png" border="0"/></a>&nbsp;</td>
		
		
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
	<li><a href="indextesoreria.php?sec=tesoreria/grilla_historial&tipo=f&apli=tgpa&per=A">Beneficiario Persona Fisica</a></li>
    <li><a href="indextesoreria.php?sec=tesoreria/grilla_historial&tipo=j&apli=tgpa&per=A">Beneficiario Persona Juridica</a></li>

	<li><a href="indextesoreria.php?sec=tesoreria/grilla_historial&tipo=o&apli=tgpa&per=A">Beneficiarios Otras Personas</a></li>
	
	
	
</ul>
</div>
<div class="sidenav">
</div>
<div class="clearer"><span></span></div>