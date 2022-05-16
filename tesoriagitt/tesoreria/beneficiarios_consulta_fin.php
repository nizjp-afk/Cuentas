<?php
error_reporting (E_ERROR); 
  $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];
  $fecha = date("d/m/Y");
  $fechaa=split("/",$fecha); 
  $fecha=$fechaa[2].'-'.$fechaa[1].'-'.$fechaa[0];

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
	    				WHERE estado='A' and (cuitl='$nom' or  apellido like '%$nom%' or  razon_social like '%$nom%') and (duracion1 < '$fecha' and duracion1 !='0000-00-00'  OR duracion2 < '$fecha' and  duracion2 !='0000-00-00' OR duracion3 < '$fecha' and duracion3 !='0000-00-00' OR duracion4 < '$fecha' and duracion4 !='0000-00-00')";
	}
	else
	 {
	if ($tip =='')
	  {
	
    	$_pagi_sql = "SELECT cuitl,apellido,nombre,razon_social,persona_tipo,
		              id_beneficiario,inhi,estado
					  FROM beneficiarios_aprobados where estado='A' and (duracion1 < '$fecha' and duracion1 !='0000-00-00'  OR duracion2 < '$fecha' and  duracion2 !='0000-00-00' OR duracion3 < '$fecha' and duracion3 !='0000-00-00' OR duracion4 < '$fecha' and duracion4 !='0000-00-00')
					  ORDER BY apellido,razon_social";
	  }
	
	
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
<h1>Finalizacion de Estatuto / Contrato Social</h1>
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
	  		   
		   	   	
	</tr>
    <tr>
	    <td width="15" align="center"> N� </td>
    	<td width="114" align="center">Cuit - Cuil</td>
		<td align="center">Apellido y Nombre o Razon Social</td>
		<td></td>
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
        <td>&nbsp;<a href="indextesoreria.php?sec=tesoreria/verinformacion_j&id=<?php echo $f_persona['id_beneficiario'];?>&ban=f&tipo=<?php echo $f_persona['persona_tipo']; ?>"><img src="img/b_inf.png" border="0"/></a>&nbsp;</td>
		 <td>&nbsp;<a href="tesoreria/impresion.php?id=<?php echo $f_persona['id_beneficiario'];?>&tipo=<?php echo $f_persona['persona_tipo']; ?>&alta=<?php echo $f_persona['fecha_aprobacion']; ?>" target="_blank"><img width="22" height="22" src="img/impresion1.jpg" border="0"/></a>&nbsp;</td>
<?php
  }
else
  {
?>  
    <td colspan="2">Baja</td>
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
<h2>Mes a Notificar</h2>
<FORM name="sampleform" action="indextesoreria.php?sec=tesoreria/consulta_fin_estatuto&apli=tgpa&per=C" method="POST"  >
<?php 

$month = date("m");
$fecha_a = date("Y");
echo '<div style="margin-bottom: 3px;">
					
						<select  name="fecha_m" onChange="startCalendar($F(\'ccMonth\'), $F(\'ccYear\'))">';
						
						for($i=0; $i<=11; $i++)
						{
							$monthNumber = ($i+1);
						//	$monthMaker = mktime(0, 0, 0, $monthNumber, 1, 2002);
							
							if($month > 0) {
								if($month == $monthNumber) {
									$sel = 'selected';
								} else {
									$sel = '';
								}
							} 
							
							/* 	
							********************************************************************************************************
								Change the names in here to your language - DO NOT CHANGE ANYTHING ELSE UNLESS YOU UNDERSTAND IT
							********************************************************************************************************
							*/
$monthName = array('Enero',
												'Febrero',
												'Marzo',
												'Abril', 
												'Mayo',
												'Junio',
												'Julio',
												'Agosto',
												'Septiembre',
												'Octubre',
												'Noviembre',
												'Diciembre');
												

							echo '<option value="'. $monthNumber .'" '. $sel .'>'. $monthName[$i] .'</option>';
						}
						
				echo '</select>
						&nbsp;
						<select  name="fecha_a" >';
						
						
												$yStart ='2008';

						$yEnd = $fecha_a+1;
						
						for($i=$yStart; $i<$yEnd; $i++)
						{
							
								if($fecha_a == $i) 
								{
									$sel = 'selected';
								} else 
								{
									$sel = '';
								}
							echo '<option value="'. $i .'" '. $sel .'>'. $i .'</option>';
							}
							
						
						
				echo '</select>';
echo '</div>';
?>
<input type="submit" name="ver" value="VER" />

</FORM>
<h2></h2>
<ul>
    
	
    
      <li><a href="indextesoreria.php?sec=tesoreria/index1&apli=tgp&per=C">Regresar Menu</a></li>
	
	<!-- <li><a href="indextesoreria.php?sec=tesoreria/saf_consulta&apli=tgpc&per=A">Beneficiarios - SAF</a> </li>-->
</ul>

</div>
<div class="sidenav">
</div>
<div class="clearer"><span></span></div>