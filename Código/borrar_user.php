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
    <link rel="stylesheet" type="text/css" href="css/edit.css" />   
    <title>Borrar usuario</title>
</head>
<body>
    <div id="container">

        <?php 
            $conexion=mysqli_connect("localhost","root","","proyecto");
            mysqli_set_charset($conexion,"utf8");
            extract($_GET);
            extract($_POST);

            echo "<h2> ¿Quieres borrar al ususario ".$nombre."? </h2>
            <form  action='borrar_user.php' name='delete' method='POST'>
                <input type='hidden' name='dni' value='$dni'>
                <input type='hidden' name='nombre' value='$nombre'>
                <input type='submit'   class='delete' name='delete' value='Borrar usuario de forma definitiva'>
            </form>";
            echo "<a href='index_admin.php'>Cancelar proceso</a> ";

            
           
            if(isset($delete)){
                $sacarMail = "SELECT mail FROM usuarios WHERE dni = '$dni'";
                $resultado = $conexion->query($sacarMail);
                $res = $resultado->fetch_assoc();


                $borrarEnlaces="DELETE FROM tiene_listas WHERE dni='$dni'";
                $borrarUsuario = "DELETE FROM usuarios WHERE dni='$dni'";
                $borrarCompartidos="DELETE FROM compartido WHERE mailReceptor ='$res[mail]'";

                $probarCompartido = "SELECT * FROM compartido WHERE mailReceptor = '$res[mail]'";
                $res1 = $conexion->query($probarCompartido); 

                $probarTieneListas = "SELECT * FROM tiene_listas WHERE dni= '$dni'";
                $res2 = $conexion->query($probarTieneListas); 

                if (mysqli_num_rows($res2) <> 0){
                    if($conexion->query($borrarEnlaces) && $conexion->query($borrarUsuario)) 
                        header("Location:index_admin.php?mail=$mail");   

                if(mysqli_num_rows($res1) <> 0)
                    if($conexion->query($borrarCompartidos) && $conexion->query($borrarUsuario)) 
                        header("Location:index_admin.php?mail=$mail");

                else
                    if($conexion->query($borrarUsuario))
                        header("Location:index_admin.php?mail=$mail");
                }
            }

            
          
            
           
        ?>
    </div>
</body>
</html>
