<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tablauser.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Lista de Autores</title>
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
                        <a class="nav-link" href="index.php">Recetas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="tablauser.php">Autores</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Container -->
    <div class="container mt-5">
        <header class="d-flex justify-content-between align-items-center mb-4">
            <div class="headertitulo">
                <h1>Lista de Autores</h1>
            </div>

            <div class="botonagregar">
                <a href="usuario.php" class="btn-segundary">Agregar Nuevo</a>
            </div>

        </header>

        <div class="d-flex align-items-center mb-4">
            <input type="text" id="search" placeholder="Buscar por Autor" class="form-control me-2">
                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i> <!-- Ícono de lupa -->
                    </span>
                </div>
        </div>

        <?php
        session_start();
        if (isset($_SESSION["createautor"])) {
            echo '<div class="alert alert-success">' . $_SESSION["createautor"] . '</div>';
            unset($_SESSION["createautor"]);
        }
        if (isset($_SESSION["edituser"])) {
            echo '<div class="alert alert-success">' . $_SESSION["edituser"] . '</div>';
            unset($_SESSION["edituser"]);
        }
        if (isset($_SESSION["deleteuser"])) {
            echo '<div class="alert alert-success">' . $_SESSION["deleteuser"] . '</div>';
            unset($_SESSION["deleteuser"]);
        }
        ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Edad</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <?php
                include("connect.php");
                $sql = "SELECT * FROM autor";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<th scope='row'>{$row["idautor"]}</th>";
                    echo "<td>{$row["autor"]}</td>";
                    echo "<td>{$row["nombre"]}</td>";
                    echo "<td>{$row["edad"]}</td>";
                    echo "<td>{$row["tipo"]}</td>";
                    echo "<td>
                            <a href='veruser.php?idautor={$row["idautor"]}' class='btn btn-info btn-sm'>Ver Completo</a>
                            <a href='edituser.php?idautor={$row["idautor"]}' class='btn btn-warning btn-sm'>Editar</a>
                            <a href='deleteuser.php?idautor={$row["idautor"]}' class='btn btn-danger btn-sm'>Eliminar</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <nav>
            <ul class="pagination justify-content-end" id="pagination"></ul>
        </nav>
    </div>

    <script>

    const searchInput = document.getElementById('search');
    const rows = document.querySelectorAll('tbody tr');
    const paginationLinks = document.querySelectorAll('.pagination li a');

    searchInput.addEventListener('keyup', function() {
        const searchTerm = searchInput.value.toLowerCase();

        rows.forEach(row => {
            const autorCell = row.querySelector('td:nth-child(2)');
            const autor = autorCell.textContent.toLowerCase();

            if (autor.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        updatePagination();
    });

    function updatePagination() {
        const visibleRows = Array.from(rows).filter(row => row.style.display === '');

        visibleRows.forEach((row, index) => {
            row.style.display = (index < 12) ? '' : 'none';
        });

        const totalPages = Math.ceil(visibleRows.length / 12);

        let paginationHTML = '';
        for (let i = 1; i <= totalPages; i++) {
            paginationHTML += `<li class="page-item"><a class="page-link" href="#">${i}</a></li>`;
        }

        document.querySelector('.pagination').innerHTML = paginationHTML;

        document.querySelectorAll('.pagination a').forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const page = parseInt(event.target.textContent);
                visibleRows.forEach((row, index) => {
                    row.style.display = (index >= (page - 1) * 12 && index < page * 12) ? '' : 'none';
                });
            });
        });
    }

    updatePagination(); 

    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGzeytNfkkFStEGvFnD6rQW0E8S2TlgvK+amjsja0Q+B3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-XvVFaDlvcEAr8sjvWQJ3obEdlEGWghcrEnfrtifwZYA+PtnSx3rEAKPKzr4pOCz7" crossorigin="anonymous"></script>
    
</body>

</html>
