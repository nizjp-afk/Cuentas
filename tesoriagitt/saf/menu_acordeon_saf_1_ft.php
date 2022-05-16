<?php
  error_reporting ( E_ERROR ); 

  $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];
  
   $mostrar=date('Y');
   $anterior=date('Y')-2;

   $accion='Consulta Ordenes Pendientes Fuente del Tesoro';
   $tabla='op_pendiente';
   include('agrego_movi.php'); 
   include('incluir_siempre.php');
  
   include('dgti-mysql-var_dgti-beneficiarios.php');
   include('dgti-intranet-mysql_connect.php');  
   include('dgti-intranet-mysql_select_db.php');


   	
  $ssql = "SELECT *  FROM `nro_saf` where saf_id='$saf_dir' order by numero";
     if (!($r_saf= mysql_query($ssql, $conexion_mysql)))
    {
      
	  //.....................................................................
      // informa del error producido
      $cuerpo1  = "al intentar buscar area";
     
      //.....................................................................
   }
  
?>  
<div class="glossymenu">
<a class="menuitem submenuheader" href="#">Otros Ejercicios</a>
<div class="submenu">
	
<ul> 

<?php     
       
                    while ($f_saf = mysql_fetch_array ($r_saf))
                           {
                      
?>
   <li><a href="pendientes/listado_ordenes_pendientes_bd.php?apli=s&per=C&valor=D&fecha_cons=2010&fecha_ant=<?php echo $anterior;?>&saf=<?php echo  $f_saf['numero']; ?> " target="_blank">Ordenes Pendientes de Pago <?php echo $f_saf['numero'] ?></a></li>
   <?php
						   }
?>
</ul>
</div>
<a class="menuitem submenuheader" href="#"><?php echo $mostrar -1;?>  </a>	
<div class="submenu">
<ul>
<?php  
 mysql_data_seek($r_saf,0);   
       
                    while ($f_saf = mysql_fetch_array ($r_saf))
                           {
                      
?> 
   <li><a href="pendientes/listado_ordenes_pendientes.php?apli=s&per=C&valor=D&consul=<?php echo $mostrar -1;?>&saf=<?php echo  $f_saf['numero']; ?>" target="_blank">Ordenes Pendientes de Pago <?php echo $f_saf['numero'] ?></a></li>
   <?php
						   }
?>
</ul>
</div>
<a class="menuitem submenuheader" href="#"><?php echo $mostrar ;?> </a>	
<div class="submenu">
<ul>
<?php  
 mysql_data_seek($r_saf,0);   
       
                    while ($f_saf = mysql_fetch_array ($r_saf))
                           {
                      
?> 
   <li><a href="pendientes/listado_ordenes_pendientes.php?apli=s&per=C&valor=D&consul=<?php echo $mostrar;?>&saf=<?php echo  $f_saf['numero']; ?>" target="_blank">Ordenes Pendientes de Pago <?php echo $f_saf['numero'] ?></a></li>
   <?php
						   }
?>
</ul>
</div>

</div>