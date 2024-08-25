<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Editar Receta</title>

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
        <header class="d-flex justify-content-between my-4" >

            <h1>
                Editar Autor
            </h1>
        </header>

        <?php 
        if (isset($_GET["idautor"])) {
            $idautor = $_GET["idautor"];
            include ("connect.php");
            $sql = "SELECT * FROM autor WHERE idautor=$idautor";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
        
        ?> 
        <form action="process.php" method="post">
                    <div class="form-element my-4">
                        <input type="text" class="form-control" name="autor" value="<?php echo $row["autor"]; ?> " placeholder="Autor:">
                    </div>
                    <div class="form-element my-4">
                        <input type="text" class="form-control" name="nombre" value="<?php echo $row["nombre"]; ?> " placeholder="Nombre Completo">
                    </div>
                    <div class="form-element my-4">
                        <input type="number" class="form-control" name="edad" value="<?php echo $row["edad"]; ?>" placeholder="edad">
                    </div>
                    <div class="form-element my-4">
                        <select name="tipo">
                            <option value="">Modificar tipo de especialidad</option>
                            <option value="Desayuno" <?php  if($row['tipo']=="Desayuno"){echo "selected";} ?> >Desayuno</option>
                            <option value="Almuerzo" <?php  if($row['tipo']=="Almuerzo"){echo "selected";} ?> >Almuerzo</option>
                            <option value="Postre" <?php  if($row['tipo']=="Postre"){echo "selected";} ?> >Postre</option>
                            <option value="Masas" <?php  if($row['tipo']=="Masas"){echo "selected";} ?> >Masas</option>
                        </select>
                    </div>
                    <input type="hidden" name="idautor" value='<?php echo $row["idautor"]; ?>' >
                    <div class="form-element">
                        <input type="submit" class="btn btn-success" name="edituser" value="Modificar Autor">
                        <a href="tablauser.php" class="btn btn-primary" >Volver</a>
                    </div>


            </form>
        <?php 
         }
         ?>
       

    </div>
</body>
</html>