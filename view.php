<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="view.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles Receta</title>

</head>
<body>
    <div class="container">
        <header class="d-flex justify-content-between my-4" >
        <div class="btn-volver" >
            <a href="index.php" class="btn btn-primary" >Volver</a>
        </div>
        <class class="ttr">
            <h1 >
                Detalles de Recetas
            </h1>
        </class>

        </header>
        <div class="book-details my-4">
            <?php
                if (isset($_GET["id"])){
                    $id = $_GET["id"];
                    include "connect.php";
                    $sql = "SELECT * FROM receta WHERE id = $id";
                    $result  = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($result);
            ?>
            <h2>Titulo</h2>
            <p class="info-background"><?php echo $row["title"]; ?></p>
            <h2 class="title-background">Ingredientes</h2>
            <p class="info-background"><?php echo $row["ingredientes"]; ?></p>
            <h2>Tipo</h2>
            <p class="info-background"><?php echo $row["type"]; ?></p>
            <h2>Autor</h2>
            <p class="info-background"><?php echo $row["autor"]; ?></p>
            <?php
                }
                ?>
        </div>
    </div>
    
</body>
</html>