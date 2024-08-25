<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Lista de Recetas</title>
</head>

<body>
    <!-- Navbar -->
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
                        <a class="nav-link nav-menu" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Recetas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tablauser.php">Autores</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Container -->
    <div class="container mt-5">
        <header class="d-flex justify-content-between align-items-center mb-4">
            <div class="headertitulo">
                <h1>Lista de Recetas</h1>
            </div>
        </header>

        <container class="subtitulo">
            <div class="botonagregar">
                <a href="create.php" class="btn-segundary">Agregar Nuevo</a>
            </div>

            <div class="d-flex align-items-center">
                <input type="text" id="search" placeholder="Buscar receta por Titulo o Autor" class="form-control me-2">
                    <span class="input-group-text">
                            <i class="fas fa-search"></i> <!-- Ícono de lupa -->
                        </span>
                <div class="filtros">
                    <button class="btn btn-outline-info  ms-2 filter-btn" data-type="desayuno">Desayuno</button>
                    <button class="btn btn-outline-info  ms-2 filter-btn" data-type="almuerzo">Almuerzo</button>
                    <button class="btn btn-outline-info ms-2 filter-btn" data-type="postre">Postre</button>
                    <button class="btn btn-outline-info  ms-2 filter-btn" data-type="masas">Masas</button>
                    <button class="btn btn-outline-info  ms-2 filter-btn" data-type="todos">Todos</button>
                </div>
            </div>
        </container>

        <?php
        session_start();
        if (isset($_SESSION["create"])) {
        ?>
            <div class="alert alert-succes">
                <?php
                echo $_SESSION["create"];
                unset($_SESSION["create"]);
                ?>
            </div>
        <?php
        }

        if (isset($_SESSION["edit"])) {
        ?>
            <div class="alert alert-succes">
                <?php
                echo $_SESSION["edit"];
                unset($_SESSION["edit"]);
                ?>
            </div>
        <?php
        }

        if (isset($_SESSION["delete"])) {
        ?>
            <div class="alert alert-succes">
                <?php
                echo $_SESSION["delete"];
                unset($_SESSION["delete"]);
                ?>
            </div>
        <?php
        }
        ?>

        <div id="recipe-cards" class="row">
            <?php
            include("connect.php");
            $sql = "SELECT * FROM receta";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_array($result)) {
                $imagePath = $row["imagen"] ? 'data:image/jpeg;base64,' . base64_encode($row["imagen"]) : 'others/platosincomida.jpg';
            ?>

                <div class="col-md-4 recipe-card" data-type="<?php echo strtolower($row["type"]); ?>">
                    <div class="card">
                        <figure>
                            <img src="<?php echo $imagePath; ?>" class="card-img-top" alt="Imagen de Receta">
                        </figure>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row["title"]; ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">Autor: <?php echo $row["autor"]; ?></h6>
                            <p class="card-text"><strong>Tipo:</strong> <?php echo $row["type"]; ?></p>
                            <p class="card-text"><strong>Ingredientes:</strong> <?php echo $row["ingredientes"]; ?></p>
                            <a href="view.php?id=<?php echo $row["id"]; ?>" class="btn btn-info">Ver Completo</a>
                            <a href="edit.php?id=<?php echo $row["id"]; ?>" class="btn btn-warning">Editar</a>
                            <a href="delete.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger">Eliminar</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <script>

        document.querySelectorAll('.btn-danger').forEach(button => {
            button.addEventListener('click', function(event) {
                if (!confirm('¿Estás seguro de que deseas eliminar esta receta?')) {
                    event.preventDefault();
                }
            });
        });

        const searchInput = document.getElementById('search');
        searchInput.addEventListener('keyup', function() {
            const searchTerm = searchInput.value.toLowerCase();
            document.querySelectorAll('.recipe-card').forEach(card => {
                const title = card.querySelector('.card-title').textContent.toLowerCase();
                const author = card.querySelector('.card-subtitle').textContent.toLowerCase();
                if (title.includes(searchTerm) || author.includes(searchTerm)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Función de filtrado por tipo// 
        document.querySelectorAll('.filter-btn').forEach(button => {
        button.addEventListener('click', function() {
            const type = button.getAttribute('data-type').toLowerCase();
            document.querySelectorAll('.recipe-card').forEach(card => {
                if (type === 'todos' || card.getAttribute('data-type') === type) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.card').forEach(card => {
                card.classList.add('show');
            });
        });

    document.addEventListener('DOMContentLoaded', function () {
    const itemsPerPage = 12;
    const recipeCards = document.querySelectorAll('.recipe-card');
    const totalPages = Math.ceil(recipeCards.length / itemsPerPage);

    function showPage(page) {
        recipeCards.forEach((card, index) => {
            card.style.display = (index >= (page - 1) * itemsPerPage && index < page * itemsPerPage) ? '' : 'none';
        });
    }

    function createPagination() {
        const paginationContainer = document.createElement('div');
        paginationContainer.className = 'pagination-container d-flex justify-content-end mt-4';

        for (let i = 1; i <= totalPages; i++) {
            const pageButton = document.createElement('button');
            pageButton.className = 'page-link btn btn-outline-info';
            pageButton.textContent = i;
            pageButton.addEventListener('click', function () {
                showPage(i);
                document.querySelectorAll('.page-link').forEach(button => button.classList.remove('active'));
                pageButton.classList.add('active');
            });

            paginationContainer.appendChild(pageButton);
        }

        document.querySelector('.container').appendChild(paginationContainer);
        document.querySelector('.page-link').classList.add('active'); // Activa la primera página por defecto
    }

        showPage(1); // Mostrar la primera página por defecto
        createPagination();
    });


    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGzeytNfkkFStEGvFnD6rQW0E8S2TlgvK+amjsja0Q+B3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-XvVFaDlvcEAr8sjvWQJ3obEdlEGWghcrEnfrtifwZYA+PtnSx3rEAKPKzr4pOCz7" crossorigin="anonymous"></script>
</body>

</html>
