<?php
error_reporting ( E_ERROR ); 
    $id= $_GET['id'];
 
//conexion
	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
        
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
         $doc_nro = $f_per['docnro'];

?>
<div class="content">
<form name="form1" method="post" action="indextesoreria.php?sec=contaduria/modpersona1">
      <table width="80%" border="0" cellpadding="2" cellspacing="2" bgcolor="#FFFFFF" class="tabla_jugando">
        <tr class="g_sup_centro_002b1">
			<td height="24" class="txt_blanco"><span class="Estilo1">Actualizar Personas </span></td>
			<td width="409"></td>
            <td width="12"><a href='javascript:window.history.back()' class="ciclo-lista-txt"><font size="+1">X</font></a></td>
        </tr>
		<tr>
          <td width="199" align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Tipo : </font></td>
          <td colspan="2"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <select name="doctipo" id="select">
<?php  if ($f_per['doctipo']=='DNI'){$s= " selected";}?>
              <option value="DNI" <?php echo $s;$s='';?>>Documento Nacional de Identidad</option>
<?php  if ($f_per['doctipo']=='LE'){$s= " selected";}?>
              <option value="LE" <?php echo $s;$s='';?>>Libreta de Enrolamiento</option>
<?php  if ($f_per['doctipo']=='LC'){$s= " selected";}?>
              <option value="LC" <?php echo $s;$s='';?>>Libreta C&iacute;vica</option>
<?php  if ($f_per['doctipo']=='PAS'){$s= " selected";}?>
              <option value="PAS" <?php echo $s;$s='';?>>Pasaporte</option>
<?php  if ($f_per['doctipo']=='CI'){$s= " selected";}?>
              <option value="CI" <?php echo $s;$s='';?>>C&eacute;dula Polic&iacute;a Federal</option>
<?php  if ($f_per['doctipo']=='CPP'){$s= " selected";}?>
              <option value="CPP" <?php echo $s;$s='';?>>C&eacute;dula Polic&iacute;a Provincial</option>
<?php  if ($f_per['doctipo']=='CER'){$s= " selected";}?>
              <option value="CER" <?php echo $s;$s='';?>>Certificado Polic&iacute;a Prov.</option>
<?php  if ($f_per['doctipo']=='DEX'){$s= " selected";}?>
              <option value="DEX" <?php echo $s;$s='';?>>Documento extranjero</option>
            </select>
          </font></td>
        </tr>
        <tr>
          <td align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">N&uacute;mero : </font></td>
          <td colspan="2"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <input name="docnro" type="text" size="8" maxlength="8" value="<?php echo $f_per['docnro'];?>">
          </font></td>
        </tr>
        <tr>
          <td align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Apellido : </font></td>
          <td colspan="2"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <input name="apellido" type="text" id="apellido" size="25" maxlength="25" value="<?php echo $f_per['apellido'];?>">
          </font></td>
        </tr>
        <tr>
          <td align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Nombre/s : </font></td>
          <td colspan="2"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <input name="nombre" type="text" id="nombre" size="25" maxlength="25" value="<?php echo $f_per['nombre'];?>">
          </font></td>
        </tr>
		<tr>
          <td align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Contrase&ntilde;a : </font></td>
          <td colspan="2"><input name="encriptado" type="password" size="31" maxlength="32"></td>
        </tr>
        <tr>
          <td align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Repita contrase&ntilde;a  : </font></td>
          <td colspan="2"><input name="encriptado1" type="password" id="encriptado1" size="31" maxlength="32"></td>
        </tr>	
        <tr>
          <td align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Fecha Nac. :</font></td>
          <td colspan="2"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <select name="dia" id="dia">
<?php
                 $dia = substr($f_per['fechanac'],8,2);
                 $mes = substr($f_per['fechanac'],5,2);
                 $ano = substr($f_per['fechanac'],0,4);
                 $diahtml = "";
                 for ($i=1; $i<32; $i++)
                  {
                      $diahtml = $i; if ($i<10) { $diahtml = "0".$i; }
                      echo "<option value='$diahtml'";
                      if ($diahtml == $dia) { echo " selected"; }
                      echo ">$diahtml</option>";
                  }
?>
            </select>
      de
      <select name="mes" id="mes">
<?php
                  $meses = array('Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic');
                  $meshtml = "";
                  for ($i=1; $i<13; $i++)
                     {
                        $meshtml = $i; if ($i<10) { $meshtml = "0".$i; }
                        echo "<option value='$meshtml'";
                        if ($meshtml == $mes) { echo " selected"; }
                        echo ">".$meses[$i-1]."</option>";
                     }
?>
      </select>
      de
	  <select name="anio" id="anio"  class="style11" onChange="calcular_fecha()">
                      <option  value="---">A&ntilde;o</option>
                      <?php
                        $fechaactual=strtotime('now');
                        $anioactual=substr(date('d/m/Y',$fechaactual),6,4);
                        $anioactual=$anioactual-18;
						for ($i=1;$i<90;$i++)
                        {
                       echo "<option value='$anioactual'";
                        if($ano == $anioactual){ echo ' selected';}
                        echo ">".$anioactual."</option>";
                        $anioactual=$anioactual-1;
                        }
						
?>
                     </select>
       
          </font></td>
        </tr>
        <tr>
          <td align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Sexo : </font></td>
          <td colspan="2"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <label>
<?php  if ($f_per['sexo']=='0'){$e= " checked";}?>
            <input name="sexo" type="radio" value="0" <?php echo $e;$e='';?>>
              Femenino</label>
               <label>
<?php  if ($f_per['sexo']=='1'){$e= " checked";}?>
            <input type="radio" name="sexo" value="1" <?php echo $e;$e='';?>>
              Masculino</label>
          </font></td>
        </tr>
        <tr>
          <td align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Telefono : </font></td>
          <td colspan="2"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <input name="telefono" type="text"  size="30" maxlength="30" value="<?php echo $f_per['telefono'];?>">
          </font></td>
        </tr>
<tr>
          <td align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">E-mail : </font></td>
          <td colspan="2"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <input name="mail" type="text"  size="30" maxlength="30" value="<?php echo $f_per['mail'];?>">
          </font></td>
        </tr>
        <tr>
          <td colspan="3" align="center"><INPUT type="image" src="../img/update.png" name="modi" value="Actualizar" class="tabla_jugando">
            <input type="hidden" name="hid" value="<?php echo $f_per['id_personas'];?>">
			<input type="hidden" name="doc" value="<?php echo $doc_nro;?>"></td>
        </tr>
      </table>
</form>
</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>