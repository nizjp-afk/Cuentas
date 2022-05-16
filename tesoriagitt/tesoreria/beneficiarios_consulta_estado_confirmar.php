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
		
	//$tip=$_GET['tipo'];
	
	
	
    	$_pagi_sql = "SELECT cuitl,apellido,nombre,nombre_f,razon_social,persona_tipo,
		              id_beneficiario,inhi,estado
					  FROM beneficiarios_aprobados 
					  where valor_e ='A'
					  ORDER BY id_beneficiario";
	 
        if (!($estado= mysql_query($_pagi_sql, $conexion_mysql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
	
	  
	/*if (isset($_POST['busca']))
    { 
		unset($_GET['_pagi_pg']);
		$_pagi_actual = 1;
	}*/


?>

<div class="content">
<form action="tesoreria/imprimir_nota_a.php?apli=tgpc&per=A" method="post"  target="_blank">
<h1>Beneficiarios Dado de Baja</h1>
<table width="90%"  border="1" align="CENTER" cellpadding="3" cellspacing="1" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
	<tr>
	
	</tr>
	<tr>
    	<td height="30" colspan="6" align="center">
		    
      		Nro de Nota:<input  name="nota" type="text"  size="10" maxlength="50" />
            <input  name="usuario" type="hidden" value="<?php echo $usuario;?>"   size="10" maxlength="50" />
      		
	  		
		</td>
	</tr>

    <tr>
	    <td width="15" align="center">Nº</td>
    	<td width="114" align="center">CUIL - CUIL</td>
		<td align="center">Apellido y Nombre o Razon Social</td>
		<td></td>
		
		
	</tr>

<?
        $cant= mysql_num_rows($estado);
		$i=0; 
        $j=0; 
              while ($f_persona=mysql_fetch_array($estado))
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
		
        <td><a target="_parent" href="indextesoreria.php?sec=tesoreria/desconfirmar_estado_a&apli=tgpc&per=A&id=<?php echo $f_persona['id_beneficiario']; ?>"><img src="img/iconos_D.png" border="0" height="16" width="16"/></a></td>
 		
 		
    </tr>
    <?php } ?>
	<tr>
       <td height="43"  align="center" colspan="4" ><INPUT type="image" title="Aprobar" src="img/aprobado.png" name="grabar" class="tabla_jugando" > </td>
    </tr>
</table>
</form>
</div>
<div class="sidenav">

 <li><a href="indextesoreria.php?sec=tesoreria/beneficiarios_consulta_estado_a&apli=tgpai&per=A">Regresar Menu</a></li>
</div>
<div class="sidenav">
</div>
<div class="clearer"><span></span></div>