<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <title>Home Recetas</title>
</head>

<body>

<nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="others/cereal_10546084.png" alt="Recetas Hub" width="30" height="30" class="d-inline-block align-text-top">
                Recetas Hub
            </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Recetas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tablauser.php">Autores</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="bg-background text-foreground">
        <header class="py-8 md:py-12 lg:py-16">
            <div class="container">
                <h1 class="text-4xl font-bold tracking-tight md:text-5xl lg:text-6xl">
                    Menu de Recetas
                </h1>
                <p class="mt-4 max-w-3xl text-muted-foreground md:text-xl">
                    Descubra un mundo de delicias culinarias, donde cada parte es una obra maestra. Explora nuestra colección de
                    recetas y conoce a los talentosos chefs detrás de ellas.
                </p>
            </div>
        </header>

        <p class="lead text-muted text-center">
            "Encuentra inspiración para tu próxima comida con nuestras recetas más recientes. Desde clásicos atemporales hasta nuevas tendencias culinarias, cada receta está diseñada para deleitar tu paladar."
        </p>


        <section class="py-4">
            <div class="container">
                <h2 class="text-center mb-4">Ultimas Recetas</h2>
                <div class="btnvermas text-center mb-4">
                        <a href="index.php" class="btn btn-dark">
                            Ver más
                        </a>
                </div>

                <div class="row">
                    <?php
                    include("connect.php");

                    $sql = "SELECT * FROM receta ORDER BY id DESC LIMIT 3";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_array($result)) {
                        $imagePath = $row["imagen"] ? 'data:image/jpeg;base64,' . base64_encode($row["imagen"]) : 'others/platosincomida.jpg';
                    ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="<?php echo $imagePath; ?>" class="card-img-top" alt="Recipe Image">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row["title"]; ?></h5>
                                    <p class="card-text"><?php echo $row["ingredientes"]; ?></p>
                                </div>
                            </div>
                        </div>
                        
                    <?php
                    }
                    ?>
                </div>
            </div>
        </section>
        <footer class="footer mt-5 py-3">
        <div class="container text-center">
            <p class="mb-0">© 2024 Recetas Hub. Todos los derechos reservados.</p>
            <p class="mb-0">
                <a href="#" class="text-muted">Términos y Condiciones</a> |
                <a href="#" class="text-muted">Política de Privacidad</a>
            </p>
        </div>
    </footer>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGzeytNfkkFStEGvFnD6rQW0E8S2TlgvK+amjsja0Q+B3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-XvVFaDlvcEAr8sjvWQJ3obEdlEGWghcrEnfrtifwZYA+PtnSx3rEAKPKzr4pOCz7" crossorigin="anonymous"></script>
    

    </div>
</body>

</html>
