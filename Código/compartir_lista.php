<!DOCTYPE html>          
<html lang="es">          
<head>         
<meta charset="utf-8">          
<link rel="shortcut icon" href="img/check-list.png" />
<link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/compartir.css" />   
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="img/check-list.png" />
<title>Compartir Lista</title>        
<meta name="viewport" content="width=device-width, initial-scale=1.0">         
</head>   
<body>    
    <div class="container">
    <?php
        extract($_POST);
        $conexion=mysqli_connect("localhost","root","","proyecto");
        mysqli_set_charset($conexion, "utf8");
     
        if (isset($compartir)){
            echo "<h1>Compartir la lista: ".$nombre_lista."</h1>
            <form action='compartir_lista.php' name='share' method='POST'>
                <label> Mail del usuario: </label> <input type='text'  name='mail_compartir' placeholder='user@gmail.com' required> 
                <input type='hidden' name='nombre_lista' value='$nombre_lista'>
                <input type='hidden' name='mail' value='$mail'>
                <input type='submit'  class='share' name='share' value='Compartir lista'>
            </form>";
            echo "<a href='index_usuario.php?mail=$mail'>Volver a mis listas</a>";
        }


        if(isset($share)){
            // comprobar que el usuario a compartir escrito esta en la base de datos y que no posee la lista
            $comprobarExiste = "SELECT dni FROM usuarios WHERE mail = '$mail_compartir' AND mail != '$mail'";
            $comprobacion = mysqli_query($conexion, $comprobarExiste);

            if (mysqli_num_rows($comprobacion)==1){
                $sacarIDLista = "SELECT id_lista FROM listas WHERE nombre_lista ='$nombre_lista'";
                $comprobacion = mysqli_query($conexion, $sacarIDLista);
                $resultado = $comprobacion->fetch_assoc();
              
                // INSERTAR EN LA TABLA COMPARTIDO
                $sqlInsertCompartido = "INSERT INTO compartido VALUES('$mail', '$mail_compartir','$resultado[id_lista]')";

                // COMPRUEBA QUE  NO SE HA COMPARTIDO PREVIAMENTE
                $sqlDuplicado = "SELECT infoEmisor FROM compartido WHERE mailReceptor='$mail_compartir' AND id_lista ='$resultado[id_lista]' ";
                $duplicado = mysqli_query($conexion, $sqlDuplicado);

                if (mysqli_num_rows($duplicado)==1){
                    echo "<div id='alerta'>
                            <p>Este usuario ya posee esta lista</p>
                            <a href='index_usuario.php?mail=$mail'>Volver a mis listas</a>
                          </div>";           
                }else{
                   $introducir= mysqli_query($conexion, $sqlInsertCompartido);
                   header("Location:index_usuario.php?mail=$mail");
                }
            }else{
                echo "<div id='alerta'>
                        <p>La direccion de correo es incorrecta  o no existe</p>
                        <a href='index_usuario.php?mail=$mail'>Volver a mis listas</a>
                      </div>";
            }
        }
    ?>
</div>

</body>
</html>