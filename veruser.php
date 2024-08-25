<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="view.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles Autores</title>

</head>
<body>
    <div class="container">
        <header class="d-flex justify-content-between my-4" >
        <div class="btn-volver" >
            <a href="tablauser.php" class="btn btn-primary" >Volver</a>
        </div>
        <class class="ttr">
            <h1 >
                Detalles de Autores
            </h1>
        </class>

        </header>
        <div class="book-details my-4">
            <?php
                if (isset($_GET["idautor"])){
                    $idautor = $_GET["idautor"];
                    include "connect.php";
                    $sql = "SELECT * FROM autor WHERE idautor = $idautor";
                    $result  = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($result);
            ?>
            <h2>Nombre</h2>
            <p class="info-background"><?php echo $row["autor"]; ?></p>
            <h2 class="title-background">Nombre Completo</h2>
            <p class="info-background"><?php echo $row["nombre"]; ?></p>
            <h2>Edad</h2>
            <p class="info-background"><?php echo $row["edad"]; ?></p>
            <h2>Tipo Especialidad</h2>
            <p class="info-background"><?php echo $row["tipo"]; ?></p>
            <?php
                }
                ?>
        </div>
    </div>
    
</body>
</html>