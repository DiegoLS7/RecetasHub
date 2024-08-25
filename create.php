<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Agregar Receta</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        h1 {
            color: #17a2b8;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .form-control,
        .form-select {
            border-radius: 0.25rem;
            padding: 10px;
        }

        .form-element {
            margin-bottom: 15px;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1>Agregar Nueva Receta</h1>
        </header>

        <form action="process.php" method="post" enctype="multipart/form-data">
            <div class="form-element">
                <input type="text" class="form-control" name="title" placeholder="Nombre de Receta:" required>
            </div>
            <div class="form-element">
                <input type="text" class="form-control" name="autor" placeholder="Autor" required>
            </div>
            <div class="form-element">
                <select name="type" class="form-select" required>
                    <option value="">Seleccionar tipo de receta</option>
                    <option value="Desayuno">Desayuno</option>
                    <option value="Almuerzo">Almuerzo</option>
                    <option value="Postre">Postre</option>
                    <option value="Masas">Masas</option>
                </select>
            </div>
            <div class="form-element">
                <input type="text" class="form-control" name="ingredientes" placeholder="Ingredientes" required>
            </div>
            <div class="form-element">
                <label for="image" class="form-label">Imagen (opcional):</label>
                <input type="file" class="form-control" name="imagen" id="image" accept="image/*">
            </div>
            <div class="form-element">
                <input type="submit" class="btn btn-success" name="create" value="Ingresar receta">
                <a href="index.php" class="btn btn-primary">Volver</a>
            </div>
        </form>

    </div>
</body>

</html>
