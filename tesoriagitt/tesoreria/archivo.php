<?php
error_reporting (E_ERROR); 
  $aplicacion = $_GET['apli'];
  $permisosnecesarios = $_GET['per'];
 // include('../incluir_siempre.php');
 $beneficiario_id=$_GET['id'];
$cuit=$_GET['cuit'];


?>

<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Documentacion</title>
		<script src="js/jquery-3.2.1.min.js" ></script>
		<script src="js/bootstrap.min.js" ></script>
		
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<style>
			body {
			padding-top: 20px;
			padding-bottom: 20px;
			}
		</style>
	</head>
	
	<body>
		
		<div class="container">		
			<div class="panel panel-primary">
				<div class="panel-body">
					<form id="form1" name="form1" method="post" action="indextesoreria.php?sec=tesoreria/guardar_d&apli=tgp&per=C" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $beneficiario_id;?>"> 

					
						
						<h4 class="text-center">Carga de Multiple Documentacion</h4>
						
						<div class="form-group">
							<label class="col-sm-2 control-label"> Beneficiario <?php echo $cuit; ?></label>
							<div class="col-sm-8">
								<input type="file" class="form-control" id="archivo[]" name="archivo[]" multiple="">
							</div>
							
							<button type="submit" class="btn btn-primary">Cargar</button>
						</div>
						
					</form>
					
				</div>
			</div>
		</div>
	</body>
</html>