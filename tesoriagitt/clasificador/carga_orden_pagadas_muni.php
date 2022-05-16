 <?php
 error_reporting ( E_ERROR ); 
//conexion
	include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
	$aplicacion = $_GET['apli'];
    $permisosnecesarios = $_GET['per'];
	
	
	
	
  //  include('incluir_siempre.php');
	//$ban=;
	
 $ssql = "SELECT * FROM `clasificador` where codigo='M' order by codigo, concepto asc ";
     if (!($r_saf= mysqli_query($conexion_mysql,$ssql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
    }
	   


	   
	
  
   if (isset($_POST['busca']) and !empty($_POST['busnom']))
			{  
				//echo "paso 1";
				 $fechaant = $_POST['fechaant'];
				 $fechahoy = $_POST['fechahoy'];
		 		 $nom = $_POST['busnom'];
		 		$_pagi_sql = "SELECT *
				  		      FROM orden_pago
							  WHERE fecha >='$fechaant' and fecha <= '$fechahoy'
							  and (saf='$nom' or concepto like '%$nom%' or orden_pago like '%$nom%')
							  AND SAF='330'
							  ORDER BY ejercicio,`fecha` DESC,`saf` ASC";
			 
			 
			  if (!($r_clasi= mysqli_query($conexion_mysql,$_pagi_sql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}
			}
		elseif ($_GET['_pagi_pg'] >1 and !empty($_GET['nom'])) 
		   { 
		 //  echo "paso 2";
			    $fechaant = $_GET['fechaant'];
		        $fechahoy = $_GET['fechahoy'];
				$nom = $_GET['nom'];
		 		$_pagi_sql = "SELECT *
				  		      FROM orden_pago 
							  WHERE fecha >='$fechaant' and fecha <= '$fechahoy'
							  and (saf='$nom' or concepto like '%$nom%' or orden_pago like '%$nom%')
							  AND SAF='330'
							  ORDER BY ejercicio,`fecha` DESC,`saf` ASC";
			 
						 if (!($r_clasi= mysqli_query($conexion_mysql,$_pagi_sql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}	  
			                 
		   }
		
		else 
			{
			// echo "paso 3";
			 
			if ($_POST['bandera']=='P')
			   {
				 $fechaant = $_POST['firstinput'];
				 $fechahoy = $_POST['secondinput'];    
			   }
			else if ((isset($_POST['busca']) and empty($_POST['busnom'])))
			{  
				
				 $fechaant = $_POST['fechaant'];
				 $fechahoy = $_POST['fechahoy'];
			}
			else
			   {
				$fechaant = $_GET['fechaant'];
		        $fechahoy = $_GET['fechahoy'];
			   }
			   
			 
			    $_pagi_sql = "SELECT *
				  		      FROM orden_pago
							  WHERE fecha >='$fechaant' and fecha <= '$fechahoy'
							  AND SAF='330'
							  ORDER BY ejercicio,`fecha` DESC,`saf` ASC";
			 
				 if (!($r_clasi= mysqli_query($conexion_mysql,$_pagi_sql)))
					{
					  //.....................................................................
					  // informa del error producido
					  $cuerpo1  = "al intentar buscar area";
					 
					  //.....................................................................
					}
		 
			  
			}   


 

/*$_pagi_cuantos = 10;
$_pagi_nav_num_enlaces = 15;
$_pagi_nav_estilo="pag";
$_pagi_propagar=array('sec','nom','fechahoy','fechaant','apli','per','saf');
//definimos qu� ir� en el enlace a la p�gina anterior
$_pagi_nav_anterior = "<img src='img/izq.png' border=0>";// podr�a ir un tag <img> o lo que sea
$_pagi_nav_primera = "<img src='img/izqfin.png' border=0>";
$_pagi_nav_ultima = "<img src='img/derfin.png' border=0>";
//definimos qu� ir� en el enlace a la p�gina siguiente
$_pagi_nav_siguiente = "<img src='img/der.png' border=0>";// podr�a ir un tag <img> o lo que sea
include("paginator.inc.php");   
*/
?>

<div class="content">


<table width="100%"  border="0" align="left" cellpadding="3" cellspacing="1" bordercolor="#EAEAEA" >
 <tr>
		<td height="49" colspan="4"><h2 align="center">Clasificar Ordenes Pagadas</h2></td>
	</tr>
  
   
  
  
</table>

<br /> 
<form action="" method="post">

<table width="100%"  align="left" border="0" cellpadding="0" cellspacing="0"  >

     <tr class="fuframe1">
    	<td height="30" colspan="3" >Concepto /Saf
    	  <input  name="busnom" type="text" id="busnom" size="30" maxlength="50" />
      		<input name="busca" type="submit" id="busca" value="Buscar" />
            
	  		  <input type="hidden" name="fechahoy" value="<?php echo $fechahoy;?>" />
            <input type="hidden" name="fechaant" value="<?php echo $fechaant;?>" />
      </td>
         
         
   
    	
		 
         
    </tr>
</table>  
</form>

<form name="" action="indextesoreria.php?sec=clasificador/clasificador_m&apli=tgpa&per=T" method="post">  

 <input type="hidden" name="f_hoy" value="<?php echo $fechahoy;?>" />
            <input type="hidden" name="f_ant" value="<?php echo $fechaant;?>" />
               <input type="hidden" name="dato" value="<?php echo $nom;?>" />

<table width="100%"  align="left" border="1" cellpadding="0" cellspacing="0" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >

<!--<table width="120%"  border="1" align="left" cellpadding="5" cellspacing="2" bgcolor="#DBE3E6" bordercolor="#EAEAEA" >
-->     <tr>
     <td height="45" colspan="8" align="left" > 
          <font color="#333333" size="-2" face="Verdana, Arial, Helvetica, sans-serif">CLASIFICADOR: 
         <select name="clasificador" >
					<option value="N" selected >Sin Especificar</option>
<?php     
       
                    while ($f_saf = mysqli_fetch_array ($r_saf))
                           {
                      
?>
<OPTION  value="<? echo $f_saf['id'] ?>"> <?php echo $f_saf['concepto']?></OPTION>
               
             <?php
			      }
				  ?>
                  </select></font>
                   
                  <select name="fecha_m"  class="style11">
          <option  value="N">MES</option>
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
          <option  value="N">A&Ntilde;O</option>
          <?php
                        $fechaactual=strtotime('now');
                        $anioactual=substr(date('d/m/Y',$fechaactual),6,4);
                        $anioactual=$anioactual;
					    for ($i=1;$i<3;$i++)
                        {
                         echo "<option value='$anioactual'";
                        if($fechaip[0] == $anioactual){ echo ' selected';}
                        echo ">".$anioactual."</option>";
                        $anioactual=$anioactual-1;
                        }
 
                        ?>
        </select>
        </td>
       </tr> 
   <tr align="center" class="letra">
       <td width="20" ><strong>Ejer</td>
       <td  width="25"><strong>Fecha</td>
       <td width="25"><strong>Saf</td>
       <td width="30"><strong>Orden</td>
        <td width="70" ><strong>Beneficiarios</td>
       <td width="90" ><strong>Concepto</td>
       <td width="30" ><strong>Total</strong></td>
       <td width="20"  ><strong></strong></td>
   </tr>
 

 <?php
      while ($f_orden=mysqli_fetch_array($r_clasi))
	  {
		    $cuit=$f_orden['cuit'];
		  
		  $_pagi_sql1 = "SELECT b.nombre,b.apellido,b.razon_social
		FROM beneficiarios_aprobados as b
		WHERE cuitl='$cuit'";
								
		   
		   
		   if (!($res_cui= mysqli_query($conexion_mysql,$_pagi_sql1)))
			{
			  //.....................................................................
			  // informa del error producido
			  $cuerpo1  = "al intentar buscar tipo beneficiario";
			  echo $cuerpo1;
			  //.....................................................................
			} 
		  
		  $f_cui =  mysqli_fetch_array($res_cui);
		  
		  
		   $orden_pago=$f_orden['orden_pago'];
		   $saf=$f_orden['saf'];
		   $ejercicio=$f_orden['ejercicio'];
		   $nombre_be=$f_cui['nombre'];
	       $apellido=$f_cui['apellido'];
	       $razon=$f_cui['razon_social'];
		   $fecha=$f_orden['fecha'];
			 
		   $ssql = "SELECT *  FROM clasificacion_municipio where ejercicio='$ejercicio' and orden='$orden_pago' and saf='330' and fecha='$fecha' ";
				 if (!($r_clasificador= mysqli_query($conexion_mysql,$ssql)))
				{
				  
				  //.....................................................................
				  // informa del error producido
				  $cuerpo1  = "al intentar buscar area";
				 
				  //.....................................................................
				}
	  $cant = mysqli_num_rows($r_clasificador);  
	  if($cant ==0)
	   {
	
		 
		   if ($razon=='')
		     {   $benef=$apellido.','.$nombre_be;}
			else
			 {  $benef=$razon;} 
?>	
   
	    <tr bgcolor="#F3F3F3"    class="letra"> 
           <td align="center"><?php echo $f_orden['ejercicio'];?></td>
          <td align="center"><?php echo $f_orden['fecha'];?></td>
          <td align="center" ><a title="<?php echo $f_orden['nombre']; ?>"><?php echo $f_orden['saf'];?></a> </td>
          <td align="left">&nbsp;<?php echo $f_orden['orden_pago'];?></td>
          <td><font face="Verdana, Geneva, sans-serif" size="-3"> <?php echo substr($benef,0,80) ;?></font></td>
          <td><strong><font face="Verdana, Geneva, sans-serif" size="-2"> <?php echo substr($f_orden['concepto'],0,100);?></font></strong></td>
          <td align="right" ><?php echo $f_orden['total'];?></td>
          <td align="right" ><input type="checkbox" name="C<?php echo $f_orden['id'];?>" /></td>
<?php	   
       }
	   
	   
	  }
?>	   
</tr>

       <tr>        
              
      <td align="center" colspan="8"><INPUT type="image" title="Confirmar Devolucion" src="img/aprobar.png"  /></td>      
     
     
     </tr>  
   
</table>

</form>


</div>
<div class="sidenav">
  <ul>
 
      <li><a href="indextesoreria.php?sec=tesoreria/index1&apli=tgp&per=C">Regresar Menu</a></li>
	
	<!-- <li><a href="indextesoreria.php?sec=tesoreria/saf_consulta&apli=tgpc&per=A">Beneficiarios - SAF</a> </li>-->
</ul>
</div>
<div class="clearer"><span></span></div>