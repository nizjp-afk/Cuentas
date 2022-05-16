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
	//echo $permisos;

$b=0;
   for ($i=0; $i<strlen($permisos); $i++)
      {
        if (ereg(substr($permisos, $i, 1), 'D'))
        {
          $b = 1;
        }
      }
    // echo $b;

	$tip=$_GET['tipo'];
	
	if (isset($_POST['busca']) and !empty($_POST['busnom']))
	{
		$nom = $_POST['busnom'];
		$_pagi_sql = "SELECT cuitl,apellido,nombre,nombre_f,razon_social,persona_tipo,
		              id_beneficiario,inhi,estado,fecha_aprobacion,codigo_esidif
					   FROM beneficiarios_aprobados 
	    				WHERE cuitl='$nom' or  apellido like '%$nom%' or  nombre_f like '%$nom%' or  razon_social like '%$nom%' ";
	}
	 elseif ($_GET['_pagi_pg'] >1 and !empty($_GET['nom'])) 
	
	{
		$nom = $_GET['nom'];
		$_pagi_sql = "SELECT cuitl,apellido,nombre,nombre_f,razon_social,persona_tipo,
		              id_beneficiario,inhi,estado,fecha_aprobacion,codigo_esidif
					   FROM beneficiarios_aprobados 
	    				WHERE cuitl='$nom' or  apellido like '%$nom%' or  nombre_f like '%$nom%' or  razon_social like '%$nom%' ";
	}
	 
	else
	 {
	if ($tip =='')
	  {
	
    	$_pagi_sql = "SELECT cuitl,apellido,nombre,nombre_f,razon_social,persona_tipo,
		              id_beneficiario,inhi,estado,fecha_aprobacion,codigo_esidif
					  FROM beneficiarios_aprobados  ORDER BY id_beneficiario";
	  }
	
	
	if ($tip=='j')
	  {
	 $_pagi_sql = "SELECT cuitl,apellido,nombre,razon_social,persona_tipo,
	               id_beneficiario,inhi,estado,fecha_aprobacion,codigo_esidif
				   FROM beneficiarios_aprobados where persona_tipo='j'  
				   ORDER BY id_beneficiario ";
	  }
	 
	 if ($tip=='f')
	  {
	 $_pagi_sql = "SELECT cuitl,apellido,nombre,razon_social,persona_tipo,
	               id_beneficiario,inhi,estado,fecha_aprobacion,codigo_esidif
				   FROM beneficiarios_aprobados where persona_tipo='f' 
				   ORDER BY id_beneficiario";
	  } 
	 
	 if ($tip=='o')
	  {
	 $_pagi_sql = "SELECT cuitl,apellido,nombre,razon_social,persona_tipo,
	               id_beneficiario,inhi,estado,fecha_aprobacion,codigo_esidif
				   FROM beneficiarios_aprobados where persona_tipo='o'  
				   ORDER BY id_beneficiario ";
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
//definimos qu� ir� en el enlace a la p�gina anterior
$_pagi_nav_anterior = "<img src='img/izq.png' border=0>";// podr�a ir un tag <img> o lo que sea
$_pagi_nav_primera = "<img src='img/izqfin.png' border=0>";
$_pagi_nav_ultima = "<img src='img/derfin.png' border=0>";
//definimos qu� ir� en el enlace a la p�gina siguiente
$_pagi_nav_siguiente = "<img src='img/der.png' border=0>";// podr�a ir un tag <img> o lo que sea
include("paginator.inc.php");
?>

<link rel="stylesheet" href="thickbox/thickbox.css" type="text/css" />
<script type="text/javascript" src="thickbox/jquery.js"></script>
<script type="text/javascript" src="thickbox/thickbox.js"></script>
<div class="content">

<h1>Beneficiarios Aprobados</h1>
<table width="100%"  border="1" align="CENTER" cellpadding="3" cellspacing="1" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
	<tr>
	<?php if($tip=='j')
	       {
  	?>	   
    	<td height="30" colspan="7" align="center"><b>Consulta de Beneficiarios Aprobados Persona Juridica</b></td>
	    <?php
	       }
		 if($tip=='f')
	       {
  	?>	   
    	<td height="30" colspan="7" align="center"><b>Consulta de Beneficiarios Aprobados Persona Fisica</b></td>
	<?php
	       }  
		if($tip=='o')
	       {
  	?>	   
    	<td height="30" colspan="7" align="center"><b>Consulta de Beneficiarios Aprobados Otras Persona</b></td>
	<?php
	       }  
	     if ($tip=='')
		   {
	?>
	    <td height="30" colspan="7" align="center"><b>Consulta de Beneficiarios Aprobados</b></td>
	<?php
	      }
	?>	  		   
	</tr>
	<tr>
    	<td height="30" colspan="7" align="center">
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
		<td align="center">Aprobado</td>
       <td align="center">Situacion</td>
		<td colspan="3"></td>
         <td align="center">Esidif</td>
          <td align="center">C. I</td>
		<?php
		  if ($b==1)
		  {
			  ?>
		
		  <td align="center">&nbsp;</td>
		<?php
		  }
		
		 ?>
		<td align="center">&nbsp;</td>
		
		
	</tr>

<?php
        $cant= mysqlI_num_rows($_pagi_result);
		$i=0; 
        $j=0; 
              while ($f_persona=mysqlI_fetch_array($_pagi_result))
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
        </td>
<?php
$estado=$f_persona['estado'];
 $f_s=split("-",$f_persona['fecha_aprobacion']);
$f_a=$f_s[2].'-'.$f_s[1].'-'.$f_s[0];

?>
       <td><?php echo $f_a;?></td>
<?php 
if($estado=='A')
  {		
?>		 <td></td>
        <?php
  }
else
  {
?>  
    <td  align="center"><img src="img/baja.jpg" border="0" /></td>
    

<?php
  
  }  
 ?>   		 
 
           <td>&nbsp;<a href="indextesoreria.php?sec=tesoreria/verinformacion&id=<?php echo $f_persona['id_beneficiario'];?>&tipo=<?php echo $f_persona['persona_tipo']; ?>"><img src="img/b_inf.png" border="0"/></a>&nbsp;</td>
		   <td colspan="2">&nbsp;<a href="tesoreria/impresion.php?id=<?php echo $f_persona['id_beneficiario'];?>&tipo=<?php echo $f_persona['persona_tipo']; ?>&alta=<?php echo $f_persona['fecha_aprobacion']; ?>" target="_blank"><img width="22" height="22" src="img/impresion1.jpg" border="0"/></a>&nbsp;</td>

              <td><?php echo $f_persona['codigo_esidif'];?></td>
              <td align="center"><a href="tesoreria/impresion_ci.php?id=<?php echo $f_persona['id_beneficiario'];?>&apli=tgp&per=C&tipo=<?php echo $f_persona['persona_tipo']; ?>" target="_blank" > <img  width="22" height="22" src="css/img/favicon.gif" border="0"/></a>&nbsp;</td>

		  <?php
		  if ($b==1)
		  {
			  ?>
		  <td align="center" ><em><a title="Cargar Documentacion" href="tesoreria/archivo.php?apli=tgpa&per=A&id=<?php echo $f_persona['id_beneficiario']; ?>&cuit=<?php echo $f_persona['cuitl']; ?>&height=400&width=900&modal=true" class="thickbox"> <img src="img/cargar.png" width="30" height="30" border="0" title="Cargar documentacion" /></a>  </em></td>
		  <?php
		  }
				  ?>
		  <td align="center" ><em><a title="Descargar Archivo" href="tesoreria/descargar.php?apli=tgp&per=C&id=<?php echo $f_persona['id_beneficiario']; ?>&&cuit=<?php echo $f_persona['cuitl']; ?>&height=400&width=900&modal=true" class="thickbox"> <img src="img/icono-inventario.png"  title="Ver documentacion"   width="30" height="30" border="0" /></a>  </em></td>
 
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
	<li><a href="indextesoreria.php?sec=tesoreria/beneficiarios_consulta_aprobado&tipo=f&apli=tgp&per=C">Beneficiario Persona Fisica</a></li>
    <li><a href="indextesoreria.php?sec=tesoreria/beneficiarios_consulta_aprobado&tipo=j&apli=tgp&per=C">Beneficiario Persona Juridica</a></li>

	<li><a href="indextesoreria.php?sec=tesoreria/beneficiarios_consulta_aprobado&tipo=o&apli=tgp&per=C">Beneficiarios Otras Personas</a></li>
	
	
	
</ul>
</div>
<div class="sidenav">
</div>
<div class="clearer"><span></span></div>