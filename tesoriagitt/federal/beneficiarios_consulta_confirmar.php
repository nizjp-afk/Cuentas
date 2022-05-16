<?php
error_reporting (E_ERROR); 
   $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];


  include('incluir_siempre.php');
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	
	
 if (isset($_POST['busca']) and !empty($_POST['busnom']))
	{
		$nom = $_POST['busnom'];
		$_pagi_sql =	"SELECT cuitl,apellido,nombre,nombre_f,razon_social,persona_tipo,
		id_beneficiario,fecha_aprobacion,saf FROM beneficiarios 
	    				WHERE (cuitl='$nom' or apellido like '%$nom%' or nombre_f like '%$nom%' or  razon_social like '%$nom%' or  nombre_f like '%$nom%')
						and usuario_alta_f='$usuario'
						and alta <> 'S' ";
	}
	
	 elseif ($_GET['_pagi_pg'] >1 and !empty($_GET['nom'])) 
	
	{
		$nom = $_GET['nom'];
		$_pagi_sql =	"SELECT cuitl,apellido,nombre,nombre_f,razon_social,persona_tipo,
		id_beneficiario,fecha_aprobacion,saf FROM beneficiarios 
	    				WHERE (cuitl='$nom' or apellido like '%$nom%' or nombre_f like '%$nom%' or  razon_social like '%$nom%' or  nombre_f like '%$nom%')
						and usuario_alta_f='$usuario' 
						and alta <> 'S' ";
	}
	
	
	else 
	{
    	$_pagi_sql = "SELECT cuitl,apellido,nombre,nombre_f,razon_social,persona_tipo,id_beneficiario,fecha_aprobacion,saf FROM beneficiarios where alta <> 'S'
		and usuario_alta_f='$usuario'
		              ORDER BY apellido,nombre";
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
<h1>Beneficiarios a Aprobar</h1>
<table width="90%"  border="1" align="left" cellpadding="3" cellspacing="1" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
	<tr>
    	<td height="30" colspan="6" align="center"><b>Consulta de Beneficiarios a Aprobar</b></td>
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
    	<td width="114" align="center">CUIT - CUIL</td>
		<td align="center">Apellido y Nombre o Razon Social</td>
		<td align="center">SAF</td>
		<td colspan="3"></td>
		
	</tr>


<?
        $cant= mysql_num_rows($_pagi_result);
		$i=0; 
        $j=0; 
              while ($f_persona=mysql_fetch_array($_pagi_result))
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
        
<?php		
    	if ($f_persona['persona_tipo']=='o')
		   {
?>	        
        
		<td>&nbsp;<a href="tesoreria/impresion.php?cuitl=<?php echo $f_persona['cuitl'];?>&tipo=<?php echo $f_persona['persona_tipo']; ?>&alta=<?php echo $f_persona['alta']; ?>" target="_blank"><img width="22" height="22" src="img/impresion1.jpg" border="0" title="Imprimir"/></a>&nbsp;</td>
		<td>&nbsp;<a href="indextesoreria.php?sec=federal/formulariomodi&apli=C&per=F&id=<?php echo $f_persona['id_beneficiario'];?>&tipo=<?php echo $f_persona['persona_tipo']; ?>&id_saf=<?php echo $f_saf['id_saf']; ?>"><img src="img/b_edit.png" width="16" height="16" border="0"/></a>&nbsp;</td>

		
		<td>&nbsp;<a href="indextesoreria.php?sec=tesoreria/eliminar_saf&apli=tgp&per=O&id=<?php echo $f_persona['id_beneficiario'];?>&tipo=<?php echo $f_persona['persona_tipo']; ?>&id_saf=<?php echo $f_saf['id_saf']; ?>"><img src="img/b_drop.png"  width="16" height="16" border="0"/></a>&nbsp;</td>
<?php
		   }
else 
  {
?>
      
        
		<td>&nbsp;<a href="tesoreria/impresion.php?cuitl=<?php echo $f_persona['cuitl'];?>&tipo=<?php echo $f_persona['persona_tipo']; ?>&alta=<?php echo $f_persona['alta']; ?>" target="_blank"><img width="22" height="22" src="img/impresion1.jpg" border="0" title="Imprimir"/></a>&nbsp;</td>
		<td>&nbsp;<a href="indextesoreria.php?sec=tesoreria/formulariomodi&apli=tgp&per=M&id=<?php echo $f_persona['id_beneficiario'];?>&tipo=<?php echo $f_persona['persona_tipo']; ?>&id_saf=<?php echo $f_saf['id_saf']; ?>"><img src="img/b_edit.png" width="16" height="16" border="0"/></a>&nbsp;</td>

<?php		
    	if ($f_persona['persona_tipo']=='o')
		   {
?>		
		<td>&nbsp;<a href="indextesoreria.php?sec=tesoreria/eliminar_saf&apli=tgp&per=B&id=<?php echo $f_persona['id_beneficiario'];?>&tipo=<?php echo $f_persona['persona_tipo']; ?>&id_saf=<?php echo $f_saf['id_saf']; ?>"><img src="img/b_drop.png"  width="16" height="16" border="0"/></a>&nbsp;</td>
<?php
           }
		  else
		   {
?>		    		
		<td>&nbsp;<a href="indextesoreria.php?sec=tesoreria/eliminar_saf&apli=tgp&per=B&id=<?php echo $f_persona['id_beneficiario'];?>&tipo=<?php echo $f_persona['persona_tipo']; ?>&id_saf=<?php echo $f_saf['id_saf']; ?>"><img src="img/b_drop.png"  width="16" height="16" border="0"/></a>&nbsp;</td>

<?php 
            }
  }
		   
?>			        		        
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
<!--<h2>Tipo de Consulta</h2>
<ul>
	<li><a href="hacienda/beneficiarios_consulta_aprobado&tgpa&apli=h&per=C&tipo=f&apli=tgp&per=C">Beneficiario Persona Fisica</a></li>
    <li><a href="indextesoreria.php?sec=tesoreria/beneficiarios_consulta_aprobado&tipo=j&apli=tgp&per=C">Beneficiario Persona Juridica</a></li>

	<li><a href="indextesoreria.php?sec=tesoreria/beneficiarios_consulta_aprobado&tipo=o&apli=tgp&per=C">Beneficiarios Otras Personas</a></li>
	
	
	
</ul>-->
<ul>

 <li><a href="indextesoreria.php?sec=hacienda/index_fed&apli=bene&per=C">Regresar Menu</a></li>
 

 </ul>
</div>
<div class="sidenav">
</div>
<div class="clearer"><span></span></div>