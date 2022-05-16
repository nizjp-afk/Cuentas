<?php
error_reporting ( E_ERROR ); 
    $id= $_GET['id'];
 
/////////////////CONEXION DB///////////////////
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
//////////////////////////////////////////////////
    // Busca datos en la tabla barrios
      $ssql = "SELECT *  FROM personas WHERE id_personas='$id'";
      if (!($r_per = mysql_query($ssql, $conexion_mysql)))
       {
          //.....................................................................
          // informa del error producido
	             echo "ERROR DE LECTURA TABLA ";exit;
          //.....................................................................
       }
     
     $f_per = mysql_fetch_array($r_per);
?>

<div class="content">
<form name="form1" method="post" action="indextesoreria.php?sec=contaduria/bajapersona1">      
	  <table width="80%" align="center" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF" class="tabla_jugando">
                <tr class="g_sup_centro_002b1">
			<td height="24" class="txt_blanco"><span class="Estilo1">Baja de  Personas </span></td>
			<td width="500"></td>
            <td width="15"><a href='javascript:window.history.back()' class="ciclo-lista-txt"><font size="+1">X</font></a></td>
        </tr>

		<tr>
          <td width="199" align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Tipo : </font></td>
          <td colspan="2"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <select name="doctipo" disabled>
<?php  if ($f_per['doctipo']=='DNI'){$s= " select";}?>
              <option value="DNI" <?php echo $s;$s='';?>>Documento Nacional de Identidad</option>
<?php  if ($f_per['doctipo']=='LE'){$s= " select";}?>
              <option value="LE" <?php echo $s;$s='';?>>Libreta de Enrolamiento</option>
<?php  if ($f_per['doctipo']=='LC'){$s= " select";}?>
              <option value="LC" <?php echo $s;$s='';?>>Libreta C&iacute;vica</option>
<?php  if ($f_per['doctipo']=='PAS'){$s= " select";}?>
              <option value="PAS" <?php echo $s;$s='';?>>Pasaporte</option>
<?php  if ($f_per['doctipo']=='CI'){$s= " select";}?>
              <option value="CI" <?php echo $s;$s='';?>>C&eacute;dula Polic&iacute;a Federal</option>
<?php  if ($f_per['doctipo']=='CPP'){$s= " select";}?>
              <option value="CPP" <?php echo $s;$s='';?>>C&eacute;dula Polic&iacute;a Provincial</option>
<?php  if ($f_per['doctipo']=='CER'){$s= " select";}?>
              <option value="CER" <?php echo $s;$s='';?>>Certificado Polic&iacute;a Prov.</option>
<?php  if ($f_per['doctipo']=='DEX'){$s= " select";}?>
              <option value="DEX" <?php echo $s;$s='';?>>Documento extranjero</option>
            </select>
          </font></td>
        </tr>
        <tr>
          <td align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">N&uacute;mero : </font></td>
          <td colspan="2"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <?php echo $f_per['docnro'];?>
          </font></td>
        </tr>
        <tr>
          <td align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Apellido : </font></td>
          <td colspan="2"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <?php echo $f_per['apellido'];?>
          </font></td>
        </tr>
        <tr>
          <td align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Nombre/s : </font></td>
          <td colspan="2"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <?php echo $f_per['nombre'];?>
          </font></td>
        </tr>
        <tr>
          <td align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Fecha Nac. :</font></td>
          <td colspan="2"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
		  <?php
                 $dia = substr($f_per['fechanac'],8,2);
                 $mes = substr($f_per['fechanac'],5,2);
                 $ano = substr($f_per['fechanac'],0,4);
         ?>

          </font></td>
        </tr>
        <tr>
          <td align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Sexo : </font></td>
          <td colspan="2"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <label>
<?php  if ($f_per['sexo']=='0'){$e= " checked";}?>
            <input name="sexo" type="radio" value="0" <?php echo $e;$e='';?> disabled>
              Femenino</label>
               <label>
<?php  if ($f_per['sexo']=='1'){$e= " checked";}?>
            <input type="radio" name="sexo" value="1" <?php echo $e;$e='';?> disabled>
              Masculino</label>
          </font></td>
        </tr>
        <tr>
          <td align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Telefono : </font></td>
          <td colspan="2"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <input name="telefono" type="text"  size="30" maxlength="30" value="<?php echo $f_per['telefono'];?>" disabled>
          </font></td>
        </tr>
<tr>
          <td align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">E-mail : </font></td>
          <td colspan="2"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <input name="mail" type="text"  size="30" maxlength="30" value="<?php echo $f_per['mail'];?>" disabled>
      </font></td>
        </tr>
		
        <TR>
          <TD height="15" colspan="3" align="center"><table width="550" border="0" align="center" cellpadding="0" cellspacing="0">
              <TR>
                <TD width="247" height="23" align="center">&nbsp;</TD>
                <td colspan="3" align="center"><INPUT type="image" src="../img/update.png" name="modi" value="Eliminar" class="tabla_jugando">
				 <input type="hidden" name="hid" value="<?php echo $f_per['id_personas'];?>">
			<input type="hidden" name="doc" value="<?php echo $doc_nro;?>"></td>
                <TD width="207" align="center">&nbsp;</TD>
              </TR>
          </table></TD>
        </TR>
   </table>
</form>
</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>
