<!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="utf-8">
            <title>Nuevo usuari@</title>
            <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap" rel="stylesheet">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>  
            <link rel="stylesheet" type="text/css" href="css/registro.css" /> 
            <link rel="shortcut icon" href="img/check-list.png" />
        </head>
        <body>
<?php


	if(isset($_POST['crear']))
	{			
        extract($_POST);
        $conexion=mysqli_connect("localhost","root","","proyecto");
        mysqli_set_charset($conexion,"utf8");

        if (empty($dni) ||empty($nombre) || empty($apellido) || empty($mail) || empty($pass)) {
            echo("<p>Debes rellenar todos los campos.  <a href='registro.php'> Vuelve a intentarlo. </a></p>");
            exit();
        }else {
            $sqlComprobacionUsuario = "SELECT nombre FROM usuarios WHERE dni='$dni' OR mail='$mail'";
            $comprobacion = mysqli_query($conexion, $sqlComprobacionUsuario);

            if (mysqli_num_rows($comprobacion)==0)
            {
                $sql="INSERT INTO usuarios VALUES ('$dni', '$nombre', '$apellido', '$mail', '$pass', 'U')";
                if (mysqli_query($conexion, $sql)) 
                    header("Location:index_usuario.php?mail=$mail");
            } 
            else {
                echo "<p class='info'> Usuario existente </p>";
                echo "<a href='registro.php'>  <button name='boton' id='boton'> Crear mi usuario </button> </a>";
                echo "<a href='index.php'>  <button name='boton' id='boton'> Inicia sesión con un usuario existente </button> </a>";
            }
        }
	}		
	else {
        echo '
           <div class="container">
            <h1> Crea tu usuario</h1>
            <div class="col-10 col-xl-6" >
            <form method="POST">
                <label>DNI: 
                </label> <input type="text" name="dni" pattern="^[0-9]{7,8}[A-Z]$" title="Todo junto, 8 dígitos y 1 letra mayúscula." placeholder="12345678X" maxlength="9" required /> <br>
                <label>Nombre: 
                </label> <input type="text" name="nombre"   placeholder="Nombre" title="Primera letra en mayúscula"  maxlength="20" required><br>
                <label>Apellido: </label> 
                <input type="text" name="apellido"  placeholder="Apellido" title="Primera letra en mayúscula"  maxlength="30" required><br>
                <label>Mail: </label> 
                <input type="text" name="mail" pattern="^[a-z\.\-_]+@[a-z\-_]+\.[a-z]{2,4}" placeholder="user@gmail.com" maxlength="40"  title="usuario@gmail.com" required /><br>
                <label>Contraseña: </label>  
                <input type="password" id="pass" name="pass" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" placeholder="*******" title="Mínimo 8 caracteres - Máximo 10, al menos una letra mayúscula, una letra minúscula y un número/c.especial" maxlength="10" required /><br>
                <p id="info"> *Introduce una contraseña con al menos: 1 mayúscula, 1 número y 8 carácteres. </p>

                <input type="submit" name="crear" class="crear" value="Crear"/>
            </form>
            <a href="index.php">  <input type="submit" class="crear" value="Inicia sesión ahora">  </a>
            </div>
           </div>';
      
   }
?>

  </body>
        </html>