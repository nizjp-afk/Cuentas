<?php 

    //include ('conexion/mysql_connect_sigcom.php');   
    /////////////////CONEXION DB///////////////////
    include('dgti-mysql-var_dgti-beneficiarios.php');
    include('dgti-intranet-mysql_connect.php');  
    include('dgti-intranet-mysql_select_db.php');
    include('conexion/extras.php');
//////////////////////////////////////////////////
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://fonts.googleapis.com/css2?family=Muli:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style-with-prefix.css">
    <style>
        .srouce{
            text-align: center;
            color: #ffffff;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="heather-container">
        <!-- Navigation -->
       <nav class="nav-main">
        <ul class="nav-menu-right">
          <div class="button-container">
          <li class="BIS">
              <img src="img/Banner superior.jpg" class="BS">
          </li>
          </div>
        </ul>
      </nav>
      <!-- End-Navigation -->
    </div>
    <div class="main-container">
        <div class="form-container">
            <div class="form-body">
                <h2 class="title">Crear una nueva cuenta</h2>

                <form action="registrocta.php" method="post" class="the-form">
                    
                    <input type="hidden" value="<?php echo $tipo ?>" name="tipo" id="tipo">

                    <label for="docnro">Usuario</label>
                    <input type="text" name="usuario" id="text" placeholder="Ingrese su nombre de usuario">

                    <label for="password">Contraseña</label>
                    <input type="password" name="contrasena" id="contrasena" placeholder="Ingresa su constraseña">

                    <label for="dni">DNI</label>
                    <input type="text" name="personas_docnro" id="personas_docnro" placeholder="Ingrese su DNI">
                    
                    <label for="saf">SAF</label>
                    <select name="select" class="form-control">
                        <option value="value1"selected>Seleccione su saf</option>
                        <option value="value2" >Value 2</option>
                        <option value="value3">Value 3</option>
                    </select>

                    <input type="submit" value="Crear cuenta">

                </form>

            </div><!-- FORM BODY-->

            

        </div><!-- FORM CONTAINER -->
    </div>

</body>
</html>