<!DOCTYPE html>          
<html lang="es">          
<head>         
<meta charset="utf-8">          
<link rel="shortcut icon" href="img/check-list.png" />
<link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/papelera.css" />   
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="img/check-list.png" />
<title>Papelera MakeAList</title>        
<meta name="viewport" content="width=device-width, initial-scale=1.0">         
</head>   
<body>    
      <div class="container">
      <?php
         $conexion=mysqli_connect("localhost","root","","proyecto");
         mysqli_set_charset($conexion,"utf8");
         extract($_POST);

         echo "<div class='row text-center' id='indice'>
                  <div class='col-sm-2 col-6'>
                  <a href='index_usuario.php?mail=$mail'>Volver a mis listas<button> <img src='img/check-list.png' alt='Icono listas' width='20' height='20'></a>
                  </div>
               </div>";

         $sqlDNI = "SELECT dni FROM usuarios WHERE mail = '$mail'";
         $resultado = $conexion->query($sqlDNI);
         $res = $resultado->fetch_assoc();

         $sqlLISTAS = "SELECT id_lista FROM en_papelera WHERE dni='$res[dni]'";
         $res = $conexion->query($sqlLISTAS); 

         if (mysqli_num_rows($res) <> 0){
            while($row = $res->fetch_assoc()) {
               extract($row);
               $sqlNOMBRE = "SELECT nombre_lista FROM listas WHERE id_lista ='$id_lista'";
               $resultado1 = $conexion->query($sqlNOMBRE);
               $res1 = $resultado1->fetch_assoc();
               extract($res1);
               echo "<div class='list'>
                     <p class='nombre'>".$nombre_lista."</p>
                     <a href='añadir_de_nuevo.php?mail=$mail&id_lista=$id_lista'> Añadir de nuevo a mis listas <img src='img/agregar.png' alt='Añadir' width='15' height='15'> </a> <br>
                     <a href='borrar_definitivamente.php?mail=$mail&id_lista=$id_lista' class='delete'>Borrar definitivamente <img src='img/cerrar.png' alt='Borrar' width='15' height='15'> </a>
                     </div>";
            }
         }
         else{
            echo "<p id='empty'> La papelera está vacía. </p>";
         }
    ?>
</div>

</body>
</html>