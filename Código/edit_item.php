<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/edit_item.css" />   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/check-list.png" />
    <title>Editar item</title>
</head>
<body>
    <?php
        $conexion=mysqli_connect("localhost","root","","proyecto");
        mysqli_set_charset($conexion,"utf8");
        extract($_POST);

        $sqlDATOS = "SELECT * FROM item WHERE nombre_item='$nombre_item'";
        $resultado = $conexion->query($sqlDATOS);
        $res = $resultado->fetch_assoc();
        extract($res);
        base64_encode($imagen);

        echo "<h2>Editar el item: ".$nombre_item."</h2>";
        echo "<div class='col-12 col-md-10 col-lg-4'>";
        echo "<form method='POST' enctype='multipart/form-data' ><br>
                <label>Nombre:</label> <input type='text' name='nombre' value='$nombre_item' maxlength='20' size='30'><br>
                <label>Descripción:</label> <br><textarea    maxlength='150' size='40' class='descripcion' name='descripcion'>$descripcion</textarea><br>
                <label class='info'>Escoge una imagen (.jpg, .png, .jpeg, .gif):</label><br> 
                <input type='file'  name='imagen' accept='.jpg,.png,.jpeg,.gif' >
                <input type='hidden' name='nombre_item' value='$nombre_item'>
                <input type='hidden' name='mail' value='$mail'><br>
                <input type='submit' name='guardar' class='boton' id='guardar' value='Guardar datos'>
              </form>";
        // BORRAR ITEM
        echo "<form method='POST' action='borrar_item.php'>
                <input type='submit' name='borrar' id='borrar' class='boton' value='Borrar este item'>
                <input type='hidden' name='nombre_item' value='$nombre_item'>
                <input type='hidden' name='mail' value='$mail'>
              </form> <br>";
        echo "<div class='back'> <a href='index_usuario.php?mail=$mail'> Volver a mis listas </a> </div>";
        echo "</div>";

        if(isset($guardar)){
            extract($_POST);
            if(!empty($_FILES['imagen']['name'])) {
                $imagen = addslashes(file_get_contents($_FILES["imagen"]["tmp_name"]));
                $sql = "UPDATE item SET nombre_item='$nombre', descripcion='$descripcion', imagen='$imagen' WHERE nombre_item='$nombre_item'"; }
            else
                $sql = "UPDATE item SET nombre_item='$nombre', descripcion='$descripcion' WHERE nombre_item='$nombre_item'";
            
            if (mysqli_query($conexion, $sql))
                header("Location:index_usuario.php?mail=$mail");
        }

    ?>
</body>
</html>