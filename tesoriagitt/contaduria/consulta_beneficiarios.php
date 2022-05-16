<?php
error_reporting ( E_ERROR ); 
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
		              id_beneficiario,inhi,estado
					   FROM beneficiarios_aprobados 
	    				WHERE  cuitl='$nom' or  apellido like '%$nom%' or  razon_social like '%$nom%' ";
	}
	else
	 {
	  	$_pagi_sql = "SELECT cuitl,apellido,nombre,razon_social,persona_tipo,
		              id_beneficiario,inhi,estado
					  FROM beneficiarios_aprobados ORDER BY id_beneficiario";
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
<table width="90%"  border="1" align="CENTER" cellpadding="3" cellspacing="1" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
	<tr>
	<?php if($tip=='j')
	       {
  	?>	   
    	<td height="30" colspan="6" align="center"><b>Consulta de Beneficiarios Aprobados Persona Juridica</b></td>
	    <?php
	       }
		 if($tip=='f')
	       {
  	?>	   
    	<td height="30" colspan="6" align="center"><b>Consulta de Beneficiarios Aprobados Persona Fisica</b></td>
	<?php
	       }  
		if($tip=='o')
	       {
  	?>	   
    	<td height="30" colspan="5" align="center"><b>Consulta de Beneficiarios Aprobados Otras Persona</b></td>
	<?php
	       }  
	     if ($tip=='')
		   {
	?>
	    <td height="30" colspan="6" align="center"><b>Consulta de Beneficiarios Aprobados</b></td>
	<?php
	      }
	?>	  		   
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
	    <td width="15" align="center">N�</td>
    	<td width="114" align="center">CUIL - CUIL</td>
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
				  echo $f_persona['apellido'].", ".$f_persona['nombre'];
				 }
			   else
			     {	  
		          echo $f_persona['razon_social'];
				 }
?>
        </td>
<?php
$estado=$f_persona['estado'];
if($estado=='A')
  {		
?>		
        <td>&nbsp;<a href="indextesoreria.php?sec=contaduria/formulario_baja&id=<?php echo $f_persona['id_beneficiario'];?>&tipo=<?php echo $f_persona['persona_tipo']; ?>&apli=cgp&per=A&estado=B"><img src="img/b_drop.png" border="0"/></a>&nbsp;</td>
		
<?php
  }
else
  {
?>  
    <td colspan="2">&nbsp;<a href="indextesoreria.php?sec=contaduria/formulario_baja&id=<?php echo $f_persona['id_beneficiario'];?>&tipo=<?php echo $f_persona['persona_tipo']; ?>&apli=cgp&per=A&estado=A"><img src="img/ic_advertencia.gif" border="0"/></a>&nbsp;</td>
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

	
	
	
</ul>
</div>
<div class="sidenav">
</div>
<div class="clearer"><span></span></div>