<?php
//conexion
error_reporting ( E_ERROR ); 
	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');

 $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];
  
 
  
  include('incluir_siempre.php');
       
         $ssql = "SELECT * FROM `nro_saf` order by numero ";
     if (!($r_saf= mysqli_query($conexion_mysql,$ssql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }    
	
	$ssql = "SELECT * FROM `saf_escritural` order by SAF,ESCRITURAL ";
     if (!($r_saf_e= mysqli_query($conexion_mysql,$ssql)))
    {
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }  





?>

<script>
  function mostrarContrasena(){
      var tipo = document.getElementById("encriptado");
      if(tipo.type == "encriptado"){
          tipo.type = "text";
      }else{
          tipo.type = "encriptado";
      }
  }
</script>

<script language='javascript' type='text/javascript'>

function slctr(texto,valor)
{
    this.texto = texto
    this.valor = valor
 }
</script>

<?php
        // Generando localidades deacuerdo a la provincia seleccionada  
 $f_saf_e=mysqli_fetch_array($r_saf_e);
 
	echo "<script language='javascript' type='text/javascript'>".chr(13).chr(10);
	$varaux='S'.$f_saf_e['SAF'];
	$cont=0;
	echo "var ".'S'.$f_saf_e['SAF']."=new Array()".chr(13).chr(10);
	echo 'S'.$f_saf_e['SAF']."[$cont] = new slctr('Seleccione Escritural','N')".chr(13).chr(10);
	$cont++;
	echo 'S'.$f_saf_e['SAF']."[$cont] = new slctr('".trim($f_saf_e['ESCRITURAL'])."','".$f_saf_e['GRUPO']."')";
	echo chr(13).chr(10);
	$cont++;
	while ($f_saf_e=mysqli_fetch_array($r_saf_e))
  	{
	  $saf='S'.$f_saf_e['SAF'];
		if ($saf==$varaux)
		{
			$vcod=$saf;
			echo $saf."[$cont] = new slctr('".trim($f_saf_e['ESCRITURAL'])."','".$f_saf_e['GRUPO']."')";
			echo chr(13).chr(10);
			$cont++;
		}
		else
		{
			$varaux='S'.$f_saf_e['SAF'];
			echo "var ".'S'.$f_saf_e['SAF']."=new Array()".chr(13).chr(10);
			$cont=0;
			echo 'S'.$f_saf_e['SAF']."[$cont] = new slctr('Seleccione Escritural','N')".chr(13).chr(10);
			$cont++;
			echo 'S'.$f_saf_e['SAF']."[$cont] = new slctr('".trim($f_saf_e['ESCRITURAL'])."','".$f_saf_e['GRUPO']."')";
			echo chr(13).chr(10);
			$cont++;
		}
	}
	echo "</script>";
	
?>

<script language='javascript' type='text/javascript'>
function slctryole(cual,donde)
{
	if(cual.selectedIndex != 0)
	{
		donde.length=0
		cual = eval(cual.value)
		for(m=0;m<cual.length;m++)
		{
			var nuevaOpcion = new Option(cual[m].texto);
			donde.options[m] = nuevaOpcion;
			if(cual[m].valor != null)
			{
				donde.options[m].value = cual[m].valor
			}
			else
			{
				donde.options[m].value = cual[m].texto
			}
		}
	}
}
</script>

<div class="content">
<form action="indextesoreria.php?sec=contaduria/altapersona1" method="post" >	
<table border="0" cellpadding="0" align="center">
	<tr>
		<td height="49" colspan="2"><h1>Alta Persona</h1></td>
	</tr>
	<tr height=10px>
		<td colspan="2"><hr></td>
	</tr>
        <tr>
          <td width="199" height="35" align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Tipo : </font></td>
          <td colspan="2"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <select name="doctipo" id="select">
              <option value="DNI" selected>Documento Nacional de Identidad</option>
              <option value="LE">Libreta de Enrolamiento</option>
              <option value="LC">Libreta C&iacute;vica</option>
              <option value="PAS">Pasaporte</option>
              <option value="CI">C&eacute;dula Polic&iacute;a Federal</option>
              <option value="CPP">C&eacute;dula Polic&iacute;a Provincial</option>
              <option value="CER">Certificado Polic&iacute;a Prov.</option>
              <option value="DEX">Documento extranjero</option>
            </select>
          </font></td>
          
        </tr>
        <tr>
          <td height="32" align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">N&uacute;mero : </font></td>
          <td colspan="2"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <input name="docnro" type="text" size="8" maxlength="8">
          </font></td>
        </tr>
        <tr>
          <td height="30" align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Apellido : </font></td>
          <td colspan="2"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <input name="apellido" type="text" id="apellido" size="25" maxlength="25">
          </font></td>
        </tr>
        <tr>
          <td height="30" align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Nombre/s : </font></td>
          <td colspan="2"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <input name="nombre" type="text" id="nombre" size="25" maxlength="25">
          </font></td>
        </tr>
        
        <tr>
          <td height="30" align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Razon Social : </font></td>
          <td colspan="2"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <input name="razon" type="text" id="razon" size="50" maxlength="50">
          </font></td>
        </tr>
		
		 <tr>
          <td height="32" align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Saf : </font></td>
          <td colspan="2"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
           <select name="saf" onchange="slctryole(this,this.form.escritural)">
					<option value="N" selected >Sin Especificar</option>
<?php     
       
                    while ($f_saf = mysqli_fetch_array ($r_saf))
                           {
							  // $esc_s=explode('-',$f_saf['ESCRITURAL']);
	                           //$escritural= $esc_s[1].''.$esc_s[0].''.$esc_s[2];
							   
                      
?>
<OPTION  value="S<?php echo $f_saf['numero']; ?>"> <?php echo $f_saf['numero'];?></OPTION>
               
             <?php
			      }
				  ?>
                </select>  
          </font></td>
        </tr>
		
        
<tr>
          <td height="28" align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Usuario : </font></td>
          <td colspan="2"><input name="userid" type="text" size="31" maxlength="35"></td>
      </tr>
        <tr>
          <td height="30" align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Contrase&ntilde;a : </font></td>
          <td colspan="2"><input name="encriptado" type="password" size="31" maxlength="32" pattern=".{6,}" >deber&aacute; contener 6 o m&aacute;s car&aacute;cteres</td>
        </tr>
	
	
        <tr>
          <td height="33" align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Repita contrase&ntilde;a  : </font></td>
          <td colspan="2"><input name="encriptado1" type="password" id="encriptado1" size="31" maxlength="32" pattern=".{6,}">deber&aacute; contener 6 o m&aacute;s car&aacute;cteres</td>
        </tr>				
        <tr>
          <td height="36" align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Fecha Alta :</font></td>
          <td colspan="2"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <select name="dia" id="dia">
              <?php
  $diahtml = "";
  for ($i=1; $i<32; $i++)
  {
    $diahtml = $i; if ($i<10) { $diahtml = "0".$i; }
    echo "<option value='$diahtml'";
    if ($i == 1) { echo " selected"; }
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
    if ($i == 1) { echo " selected"; }
    echo ">".$meses[$i-1]."</option>";
  }
?>
      </select>
      de
      
	  <select name="anio" id="anosol"  class="style11" onChange="calcular_fecha()">
                      <option  value="---">A&ntilde;o</option>
                      <?php
                        $fechaactual=strtotime('now');
                        $anioactual=substr(date('d/m/Y',$fechaactual),6,4);
                      //  $anioactual=$anioactual-18;
						echo "<option value='$anioactual'";
                        if($fechan[0] == $anioactual){ echo ' selected';}
                        echo ">".$anioactual."</option>";
                        
                        
						
?>
                     </select> 
          </font></td>
        </tr>
        
        <tr>
          <td height="33" align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Telefono : </font></td>
          <td colspan="2"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <input name="telefono" type="text" id="telefono" size="30" maxlength="30">
          </font></td>
        </tr>
<tr>
          <td height="35" align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">E-mail : </font></td>
          <td colspan="2"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">
            <input name="mail" type="text" size="30" >
          </font></td>
      </tr>
        <tr>
          <td colspan="3" align="center"><input type="submit" name="guardar" value="Guardar"></td>
        </tr>
  </table>
</form>
</div>

<div class="sidenav">
</div>

<div class="clearer"><span></span></div>
