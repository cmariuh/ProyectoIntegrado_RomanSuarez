<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>  
    <link rel="stylesheet" type="text/css" href="css/index.css" />   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/check-list.png" />
    <title>Inicio MakeAList</title>
    <script type="text/javascript">
        window.history.forward();
        function noBack() {
            window.history.forward();
        }
    </script>
</head>

<body> 
   <div id="container">
        <h1> MakeAList organiza <br> todas  tus MEJORES ideas</h1>
        <hr>
        <div class="row">
            <div class="col-12 col-md-10 col-lg-4">
                <h3> Inicia sesión </h3>
                <form method="POST" action="comprobacion.php">
                    <label>Mail:  </label> <input type="text" class="mail" name="mail" required> <br>
                    <label>Password: </label> <input type="password" name="pass" required>
                    <input type="submit" class="button" id="iniciar" name="inicio" value="Iniciar">
                </form>
                <?php
                extract($_GET);
                if(isset($mensaje))
                    echo "<div class='mensaje'>$mensaje</div>";
                unset($mensaje);
                ?>
                <h3> ¿Eres nuev@? Regístrate </h3>
                <form name="registro" action="registro.php">
                    <input type="submit" name="registro" class="button" value="Registrarme ahora">
                </form>
            </div>
            <div class="col-11 col-md-11 col-lg-6">


            <div class="infoUser">
                <div id="carouselExampleControls" class="carousel slide w-100 h-100" data-bs-ride="carousel">
                <div class="carousel-inner ">
                    <div class="carousel-item active">
                    <img src="img/1.png" class="d-block w-100 h-100">
                    </div>
                    <div class="carousel-item">
                    <img src="img/2.png" class="d-block w-100 h-100">
                    </div>
                    <div class="carousel-item">
                    <img src="img/3.png" class="d-block w-100 h-100">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                </div>
            </div>

               
            </div>
        </div>
    
            <script >
                $( document ).ready(function(){
                $('.carousel').carousel({
                interval: 2000
                })});
                </script>  

</body>
</html>
