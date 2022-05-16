<script type="text/javascript">
function imprSelec(muestra)
{var ficha=document.getElementById(muestra);var ventimp=window.open(' ','popimpr');ventimp.document.write(ficha.innerHTML);ventimp.document.close();ventimp.print();ventimp.close();}
</script>

<?php

error_reporting ( E_ERROR );
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
?>
        <div id="muestra">

<?php		
	$i=0;
	$inhi='Cta Cerrada';
	$motivo='Informada por el Banco';
	echo $archivo= $_GET['arc'];

    $archivo = file("cuentas/".$archivo);
    $cuantos = count($archivo);
    for ($var=0;$var<$cuantos;$var++)
	{
	  $linea= $archivo[$var];   //TODO EN ARCHIVO EN UNA LINEA
		


	  //  $linea=  explode(";",$archivo[$var]);
	   
        
		
   	     $cbu=substr($linea,55,22); 
				 $nombre=substr($linea,25,30); 
		// $cbu= trim($linea[0]);
           // $nombre=trim($linea[1]);

		
	   $ssql = "SELECT * FROM `beneficiarios_aprobados` WHERE cbu='$cbu' and inhi=''";
     if (!($r_beneficiario= mysql_query($ssql, $conexion_mysql)))
    {
	
      //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar provincia";
      echo $cuerpo1;
      //.....................................................................
    }    
	 $f_beneficiario= mysql_fetch_array ($r_beneficiario);					
		$cant= mysql_num_rows($r_beneficiario);
		
		if($cant>0)
		{
		
	   $ssql = "UPDATE beneficiarios_aprobados SET inhi='$inhi',motivo='$motivo' WHERE cbu='$cbu'";
				 if (!($r_beneficiarios = mysql_query($ssql,$conexion_mysql)))
				 {
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar dar de alta un beneficiario";
					  echo $cuerpo1;
						   exit;
					  //.....................................................................
				 }
							
		 					
		
	     $cuitl = $f_beneficiario['cuitl'];
         $ape = $f_beneficiario['apellido']; 
		 $razon_social = $f_beneficiario['razon_social'];  
		 $nom = $f_beneficiario['nombre'];   
         $cbub=$f_beneficiario['cbu'];
	    
          if ($i==0)
		   {
			   ?>
            
   <table width="70%" height="89" border="1" >
               <tr bgcolor="#D6DFE3">
    <td colspan="3"><h3>Cuentas Inhabilitadas por el Banco </h3></td>
  </tr>
      <tr>
        <td width="110" height="28" align="center">CUIT</td>
        <td align="center" width="220">Apellido y nombre/ Razon Social</td>
        <td align="center" width="42">CBU</td>
       
      </tr>
      <tr>
        <td height="15"><?php echo $cuitl; ?>
        </td>
        <td><?php  if($razon_social=='') {echo $ape.' '.$nom; }else
	           	{echo $razon_social;} ?>
        </td>
        <td><?php echo $cbub; ?>
        
      </tr>
      <?php
		   $i=1;
		   }
		 else
		  {
			  ?>
               <tr>
      <tr>
        <td height="15"><?php echo $cuitl; ?>
        </td>
        <td><?php  if($razon_social=='') {echo $ape.' '.$nom; }else
	           	{echo $razon_social;} ?>
        </td>
        <td><?php echo $cbub; ?>
        
      </tr>
			  
			  <?php
			  
		  }
		}
	
		} 
	?>
    </table>
    </div>
    <?php   
if ($i==0)
	  {
		  ?>
          <div id="muestra_n">
           <table width="70%" height="89" border="1" >
               <tr bgcolor="#D6DFE3">
    <td colspan="3"><h3>Cuentas Inhabilitadas por el Banco </h3></td>
  </tr>
      <tr>
        <td colspan="3"  height="28" align="center">No hay Cuentas para MODIFICAR</td>
        
       
      </tr>
		</table>
        </div>
      <?php  
		  }	

?>
	
	
 
	<table width="60%" border="0" align="left">
     <tr>
     <td align="center">
     <center><h1>Guardando</h1></center>
	 <p class="Estilo2 style1 Estilo1"><img src="img/loader_guardando.gif" width="100" height="100" /></p>
      
      <p class="Estilo2 style1">
      <p>Sus datos fueron grabados con exito.</p><a <?php if ($i>0){?> href="javascript:imprSelec('muestra')">Imprimir Listado <?php } else { ?> href="javascript:imprSelec('muestra_n')">Imprimir Listado <?php } ?></a></center>
	  <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> Espere unos segundos el Sistema se Redirigir&aacute; automaticamente
	  <br><br>
      Gracias
	  </font>
	  </p>
	  </td>
     </tr>
   </table>
   