<!DOCTYPE html>          
<html lang="es">          
<head>         
<meta charset="utf-8">          
<link rel="shortcut icon" href="img/check-list.png" />
<link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/admin.css" />   
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="img/check-list.png" />
<title>Administrados MakeAList</title>        
<meta name="viewport" content="width=device-width, initial-scale=1.0">         
<script type="text/javascript">
        window.history.forward();
        function noBack() {
            window.history.forward();
        }
</script>
</head>   
<body>    
      <div class="container">
      <?php
            echo "<div class='row text-center' id='indice'>
                  <div class='col-4'>
                    <form action='index.php' method='POST'> <p>Salir
                    <button id='salir'> <img src='img/poder.png' alt='edit' width='20' height='20'> 
                    </button></p>
                    </form>
                  </div>
                  </div>";
            echo "<h1> Panel del administrador </h1>";

            $conexion=mysqli_connect("localhost","id20907698_mariaroman","beyLDYM9*","id20907698_proyecto");
            mysqli_set_charset($conexion,"utf8");

            $sql= "SELECT nombre, apellido, dni, mail FROM usuarios WHERE nombre != 'Admin' ORDER BY nombre";
            $resultado = $conexion->query($sql); //OBTIENE NOMBRE DE LA LISTA

            

            echo "<div class='row'>
                  <div class='col-lg-9'>";

            if (mysqli_num_rows($resultado) <> 0){

                  while($row = $resultado->fetch_assoc()) {
                        extract($row);
                        $contadorItems = 0;
                        $sqlLISTA = "SELECT nombre_lista FROM listas INNER JOIN tiene_listas ON listas.id_lista=tiene_listas.id_lista 
                                    INNER JOIN usuarios ON tiene_listas.dni = usuarios.dni WHERE usuarios.nombre = '$nombre' ORDER BY nombre_lista";
                        $res = $conexion->query($sqlLISTA); 
                        echo "<div class='card'>";
                        echo "<li><b>".$nombre." $apellido. ($mail)"."</b><a href='borrar_user.php?nombre=$nombre&dni=$dni'><img src='img/borrar.png'  class='cerrars' alt='Icono cerrar' width='20' height='20'></a> <br>";

                        while($row = $res->fetch_assoc()) {
                              extract($row);  
                              $contadorItems++; 
                              echo "<div class=''>";
                              echo "<ul>".$contadorItems.". ".$nombre_lista."</ul>";
                              echo "</div>";
                        }

                        $compartido = "SELECT listas.nombre_lista, compartido.infoEmisor  FROM listas INNER JOIN compartido ON listas.id_lista = compartido.id_lista WHERE mailReceptor= '$mail'";
                        $res2 = $conexion->query($compartido); 

                        while($row = $res2->fetch_assoc()) {
                              extract($row);
                              $contadorItems++; 
                              echo "<div class=''>";
                              echo "<ul>".$contadorItems.". ".$nombre_lista.". Compartido por: $infoEmisor </ul>";
                              echo "</div>";
                        }
                        echo "</li>";
                        echo "</div>";
                  }
            }
            else
                  echo "<p> Actualmente no hay ningún usuario registrado... </p>";
            echo "</div>";
            echo "</div>";


      ?>
      </div>

</body>
</html>