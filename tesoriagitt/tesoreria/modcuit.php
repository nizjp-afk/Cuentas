<?php
error_reporting ( E_ERROR ); 
   $idb=$_POST['id'];
?>  

<div class="content">
<table border="0" align="center">
	<tr>
		<td colspan="2"><h1>
			<?php 
				echo "Modificacion CUIT-CUIL";
			?>
		</h1></td>
	</tr>
	<tr height=30px>
		<td colspan="2"><hr></td>
	</tr>
	<tr>
		<td class="subtitle">Nro. CUIL | CUIT</td>
		<td>
<form action="indextesoreria.php?sec=tesoreria/validarcuit" method="POST">	
		<input type="text" name="cuitl_1" size="2" maxlength="2"> - 
    	<input type="text" name="cuitl_2" size="8" maxlength="8"> - 
		<input type="text" name="cuitl_3" size="1" maxlength="1" />
        <input type="hidden" name="id" value="<?php echo $idb; ?>" />
		
		<input type="submit" name="mcuit" value="Aceptar" />
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