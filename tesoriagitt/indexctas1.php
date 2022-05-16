<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tesoreria General de la Provincia</title>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="stylesctas.css">
</head>


<body>
    <div class="header"></div>
    <div class="content">
        <img src="./img/Banner superior.jpg">
        <hr class="hr">
        <!-- Content -->
        <div class="content">
                <img src="./img/horarios.png">
        </div>
        <div class="wrapper">
            <!-- NEWS CARDS -->
            <div class="news-cards">
                <div class="hover11 column">
                    <figure class="imghvr-stack-up">
                        <a class="animate__shakeX" href="indexctas.php?sec=cuentas_cta/grillacuentas">
                        
                            <img src="img/14.png" alt="" /></a>
                    </figure>
                </div>
                <div class="hover11 column">
                    <figure class="imghvr-stack-up">
                        <a class="ih-fade-up ih-delay-lg button" href="#"><img class="gi" src="img/18.png" alt="" /></a>
                    </figure>
                </div>
                <div class="hover11 column">
                    <figure class="imghvr-stack-up">
                        <a class="ih-fade-up ih-delay-lg button" href="#"><img class="gi" src="img/19.png" alt="" /></a>
                    </figure>
                </div>
            </div>
            <!-- Footer -->
            <?php include 'footer.php'; ?>
        </div>
    </div>
</body>
</html>