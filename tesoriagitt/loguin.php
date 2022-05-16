<?php 
    session_start();
    echo $tipo = $_GET['tipo'];
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
    <title>Loguin</title>
    <link href="https://fonts.googleapis.com/css2?family=Muli:wght@400;700&display=swap" rel="stylesheet">
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
                <h2 class="title">Iniciar Sesion</h2>

                <form action="index-login2.php" method="post" class="the-form">
                    <input type="hidden" value="<?php echo $tipo ?>" name="tipo" id="tipo">

                    <label for="docnro">Usuario</label>
                    <input type="text" name="usuario" id="text" placeholder="Ingrese su usuario">

                     <label for="password">Contraseña</label>
                    <input type="password" name="contrasena" id="contrasena" placeholder="Ingresa tu constraseña">

                    <input type="submit" value="Ingresar">

                </form>

            </div><!-- FORM BODY-->

            <div class="form-footer">
                <div>
                    <span>¿No tienes una cuenta?</span><br><a href="crearcta.php">Presione aqui</a>
                </div>
            </div><!-- FORM FOOTER -->

        </div><!-- FORM CONTAINER -->
    </div>

</body>
</html>