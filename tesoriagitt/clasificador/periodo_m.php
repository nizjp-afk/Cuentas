<?php
error_reporting (E_ERROR); 
include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
	
//ini_set('display_errors', 1); 
     $aplicacion = $_GET['apli'];
     $permisosnecesarios = $_GET['per'];
//   include('incluir_siempre.php');


  $dato=$_GET['dato'];
  $fecha = date('Y-m-d', strtotime('-1 month'));
  $fechaip=explode("-",$fecha);
  
  $ssql = "SELECT b.nombre,b.apellido,b.razon_social,b.cuitl
		FROM beneficiarios_aprobados as b,clasificacion_municipio m
		WHERE b.cuitl=m.cuit
		group by m.cuit   ";
				 if (!($r_clasificador= mysqli_query($conexion_mysql,$ssql)))
				{
				  
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar buscar area";
				 
				  //.....................................................................
				}
				
				
	
  

  if($dato=='I')
  {
   ?>

<FORM name="form" action="clasificador/informe_detallado_municipio.php?&apli=tgpa&per=T" method="POST" target="_blank" >

<?php
}
if($dato=='C')
  {
   ?>
   <FORM name="form" action="clasificador/informe_detallado_municipio_comp.php?&apli=tgpa&per=T" method="POST" target="_blank" >
<?php
  }
  ?>
<input type="hidden" name="id" value="<?php echo $id; ?>">
<table border="0" cellpadding="0" align="center" width="80%">
	<tr>
		<td  colspan="3"><h1>Seleccionar Periodo a Informar</h1></td>
	</tr>
	<tr height=10px>
		<td colspan="3"><hr></td>
	</tr>
        
        <tr>
              <td align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Mes a Informar </font></td>
              <td>  <select name="fecha_m"  class="style11">
          <option  value="---">MES</option>
          <?php
                                 $meses= array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto',
                                        'Septiembre','Octubre','Noviembre','Diciembre');
                                $meshtml="";
								for ($i=1;$i<13;$i++)
                                {
                                $meshtml= $i; 
								if ($i<10) {$meshtml= "0".$i;$mesn=$meses{$i-1};}
                                echo "<option value='$meshtml'";
                                if($fechaip[1] == $meshtml){ echo ' selected';}
                                echo ">".$meses{$i-1}."</option>";
                                } ?>
        </select>
        <select name="fecha_a"   class="style11" onChange="calcular_fecha()">
          <option  value="---">A&Ntilde;O</option>
          <?php
                        $fechaactual=strtotime('now');
                        $anioactual=substr(date('d/m/Y',$fechaactual),6,4);
                        $anioactual=$anioactual-1;
					    for ($i=1;$i<3;$i++)
                        {
                         echo "<option value='$anioactual'";
                        if($fechaip[0] == $anioactual){ echo ' selected';}
                        echo ">".$anioactual."</option>";
                        $anioactual=$anioactual+1;
                        }
 
                        ?>
        </select></td>
             
        </tr>
        
          <tr>
              <td align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif">Municipio </font></td>
              <td>  
              
	
		 
		   
              <select name="municipio" >
					<option value="N" selected >Sin Especificar</option>
<?php     
       
                    while ($f_cui = mysqli_fetch_array ($r_clasificador))
                           {
							   $nombre_be=$f_cui['nombre'];
	                           $apellido=$f_cui['apellido'];
	                           $razon=$f_cui['razon_social'];
							   if ($razon=='')
		                            {   $benef=$apellido.','.$nombre_be;}
			                   else
			                         {  $benef=$razon;} 
                      
?>
<OPTION  value="<? echo $f_cui['cuitl'] ?>"> <?php echo $benef?></OPTION>
               
             <?php
			      }
				  ?>
                  </select></font>
       </td>
             
        </tr>
        
        <tr>
          <td height="30" align="right">&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
       
       
       
        
       

        <tr>
          <td colspan="3" align="center"><input type="submit" name="guardar" value="VER"></td>
        </tr>
  </table>
</form>

