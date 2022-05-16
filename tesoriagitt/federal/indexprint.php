<?php
error_reporting ( E_ERROR );
 $cuitl = $_GET['cuitl'];
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>

<script>
var a

function imprime() {
a=document.frames['iframeOculto'].location='beneficiario/formulario.php?cuitl='<?php echo $cuitl;?>  
}

</script>

</head>
