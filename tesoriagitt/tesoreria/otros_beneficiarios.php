<?php
error_reporting (E_ERROR); 
   $tipo=$_GET['valor'];
   $aplicacion = $_GET['apli'];
   $permisosnecesarios = $_GET['per'];

  include('incluir_siempre.php');
?>  

<div class="content">
<table border="0" align="center">
	<tr>
		<td colspan="2"><h1>
			<?php 
				echo "Alta Otros Beneficiarios";
			
			?>
		</h1></td>
	</tr>
	<tr height=30px>
		<td colspan="2"><hr></td>
	</tr>
	<tr>
		<td class="subtitle">Nro. CUIL | CUIT</td>
		<td>
<form action="tesoreria/validarcuit.php?apli=tgpc&per=A" method="POST">	
		<input type="text" name="cuitl_1" size="2" maxlength="2"> - 
    	<input type="text" name="cuitl_2" size="8" maxlength="8"> - 
		<input type="text" name="cuitl_3" size="1" maxlength="1" />
        <input type="hidden" name="valor" value="<?php echo $tipo; ?>" />
        <input type="submit" name="validar" value="Aceptar" />
</form>
		</td>
	</tr>
	<tr height=30px>
		<td colspan="2"><hr></td>
	</tr>
</table>
</div>
<div class="sidenav">
</div>
<div class="clearer"><span></span></div>