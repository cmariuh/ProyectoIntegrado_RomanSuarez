<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/check-list.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>  
    <link rel="stylesheet" type="text/css" href="css/perfil.css" />   
    <title>Mi perfil</title>
</head>
<body>
    <div class="container">

        <?php 
            $conexion=mysqli_connect("localhost","root","","proyecto");
            mysqli_set_charset($conexion,"utf8");
            extract($_POST);

            $sql= "SELECT dni, nombre, apellido, contraseña FROM usuarios WHERE mail = '".$mail."'";
            $consulta=mysqli_query($conexion,$sql);
            $res = $consulta->fetch_assoc();  
            extract($res);
           
            echo "<div class='row ' id='indice'>
                    <div class='col-6 col-sm-6'>
                    <a href='index_usuario.php?mail=$mail'>Volver a mis listas<button id='salir'> <img src='img/check-list.png' alt='Icono listas' width='20' height='20'></a>
                    </div>
                </div>
    

                <div class='row text-left' id='indice'>
                <div class='col-10 col-lg-4'>
                    <form action='edit_user.php' name='edit_user' method='POST'>
                        <h2> Modifica tus datos </h2>
                        <label> Nombre: </label> <input type='text' class='nombre' name='nombre' value='$nombre' required> <br>
                        <label> Apellido: </label> <input type='text' class='apellido' name='apellido' value='$apellido' required> <br>
                        <label> Contraseña: </label> <input type='password' id='pass' class='contraseña' name='contraseña' value='$contraseña' required> <br>
                        <input type='hidden' name='mail' value='$mail'>
                        <input type='submit' class='actualizar' name='edit_user' value='Actualizar datos'>
                    </form>
                 </div>
                </div>";
        ?>
    </div>

</body>
</html>
