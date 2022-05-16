<?php
error_reporting ( E_ERROR ); 
    include('conexion/extras.php');
	$bandera=$_GET['ban'];
    $cuitl_1=$_GET['c1'];
   $cuitl_2=$_GET['c2'];
   $cuitl_3=$_GET['c3'];
?>
<div class="content">
<?php
     if($bandera==1)
	    {
?>		
<center><h1>Error!</h1></center>
<meta http-equiv='refresh' content='10;url=javascript:window.history.back()'>
<center><img src="img/messagebox_critical.png" width="128" height="128" />
<p>Se ha detectado un error.
Ud. ingreso el <b>Nro. de CUIT | CUIL</b> incorrectamente.</p></center>
<code>&#8226; No deje el campo en blanco.
&#8226; Debe ingresar solo datos num&eacute;ticos.</code>
<code>Espere unos segundos el Sistema se redirigir&aacute; automaticamente.
O haga click <a href='javascript:window.history.back()'>aqu&iacute;</a>.</code>
<?php
		}
       if($bandera==2)
	    {
?>				
<center><h1>Error!</h1></center>
<center><img src="img/messagebox_critical.png" width="128" height="128" />
<p>Se ha detectado un error.</p></center>
<code>Por favor, <b>comuniquese</b> con la Contaduria General de la Provincia.
&#8226; Direccion: San Nicolas de Bari (Oeste) y 25 de Mayo.
&#8226; Telefono: [03822] 453121</code>
<code>Haga click <a href='index.php'>aqu&iacute;</a> para regresar.</code>
<?php
        }
?>	
<?php
     if($bandera==3)
	    {
?>		
<center><h1>Error!</h1></center>
<center><img src="img/messagebox_critical.png" width="128" height="128" />
<p>Se ha detectado un error.
Ud. ingreso el <b>Nro. de CUIT | CUIL</b> incorrectamente.</p></center>
<code>&#8226; Nro. de CUIT | CUIL no es Valido.</code>
<code>Si se verifico y es correcto, <b>Por favor</b></code>
<code>Haga click <a href='indextesoreria.php?sec=tesoreria/alta_otros&c1=<?php echo $cuitl_1; ?>&c2=<?php echo $cuitl_2; ?>&c3=<?php echo $cuitl_3; ?>'>aqu&iacute;</a> </code>
<code>Espere unos segundos el Sistema se redirigir&aacute; automaticamente.
O haga click <a href='javascript:window.history.back()'>aqu&iacute;</a>.</code>
<?php
		}
	
    if($bandera==7)
	    {
?>		
<center><h1>Error!</h1></center>
<meta http-equiv='refresh' content='10;url=javascript:window.history.back()'>
<center><img src="img/messagebox_critical.png" width="128" height="128" />
<p>Se ha detectado un error.
Ud. ingreso el <b>Nro. de CBU</b> incorrectamente.</p></center>
<code>&#8226; Cuenta ya existente
&#8226; Debe ingresar otra cuenta.</code>
<code>Espere unos segundos el Sistema se redirigir&aacute; automaticamente.
O haga click <a href='javascript:window.history.back()'>aqu&iacute;</a>.</code>
 
<?php
     }
?>	 			
</div>
<div class="sidenav">
</div>
<div class="clearer"><span></span></div>   