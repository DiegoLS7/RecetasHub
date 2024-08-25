<?php 
include ("connect.php");

if (isset($_POST["create"])) {
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $autor = mysqli_real_escape_string($conn, $_POST["autor"]);
    $type = mysqli_real_escape_string($conn, $_POST["type"]);
    $ingredientes = mysqli_real_escape_string($conn, $_POST["ingredientes"]);
  
    $checkAutorQuery = "SELECT * FROM autor WHERE autor = '$autor'";
    $checkAutorResult = mysqli_query($conn, $checkAutorQuery);

    if (mysqli_num_rows($checkAutorResult) == 0) {
        // El autor no existe
        die("Error: El autor no existe en la base de datos. Por favor, crea el autor primero.");
    }
    
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
      $imagenData = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
    } else {
      $imagenData = null; // No se subió ninguna imagen
    }
  
    $sql = "INSERT INTO receta (title, autor, type, ingredientes, imagen) VALUES ('$title', '$autor', '$type', '$ingredientes', '$imagenData')";
    if (mysqli_query($conn, $sql)) {
      session_start();
      $_SESSION["create"] = "Receta Agregada con éxito";
      header("location:index.php");
    } else {
      die("Hubo algún error en el proceso: " . mysqli_error($conn));
    }
  }
  

if (isset($_POST["edit"])) {
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $autor = mysqli_real_escape_string($conn, $_POST["autor"]);
    $type = mysqli_real_escape_string($conn, $_POST["type"]);
    $ingredientes = mysqli_real_escape_string($conn, $_POST["ingredientes"]);
    $id = mysqli_real_escape_string($conn, $_POST["id"]);

    $checkAutorQuery = "SELECT * FROM autor WHERE autor = '$autor'";
    $checkAutorResult = mysqli_query($conn, $checkAutorQuery);

    if (mysqli_num_rows($checkAutorResult) == 0) {
        echo "<script>
        alert('Error: El autor no existe en la base de datos. Por favor, crea el autor primero.');
        window.location.href = 'create.php';
        </script>";
    exit();
    }

    $sql = "UPDATE receta SET title = '$title', autor = '$autor', type = '$type', ingredientes = '$ingredientes' WHERE id = $id";
    if(mysqli_query($conn, $sql)){
        session_start();
        $_SESSION["edit"] = "Modificado con éxito";
        header("location:index.php");
    } else {
        die("Hubo algún error en el proceso: " . mysqli_error($conn));
    }
}

  if (isset($_POST["createautor"])) {
    $autor = mysqli_real_escape_string($conn, $_POST["autor"]);
    $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
    $edad = intval($_POST["edad"]);
    $tipo = mysqli_real_escape_string($conn, $_POST["tipo"]);

    if (strlen($nombre) < 5) {
        echo "<script>
        alert('Error: El Nombre debe tener al menos 5 letras.');
        window.location.href = 'usuario.php';
        </script>";
    exit();
    }

    if (!preg_match('/[A-Z]/', $nombre)) {
      echo "<script>
      alert('Error: El Nombre debe tener al menos una letra MAYUSCULA.');
      window.location.href = 'usuario.php';
      </script>";
      exit();
    }

    if ($edad <= 0) {
      if (!preg_match('/[A-Z]/', $nombre)) {
        echo "<script>
        alert('Error: Debe ser un numero MAYOR a 0');
        window.location.href = 'usuario.php';
        </script>";
        exit();
      }
    }

    $sql = "INSERT INTO autor (autor, nombre, edad, tipo) VALUES ('$autor', '$nombre', '$edad', '$tipo')";
    if (mysqli_query($conn, $sql)) {
      session_start();
      $_SESSION["createautor"] = "Autor Agregado con éxito";
      header("location:tablauser.php");
    } else {
      die("Hubo algún error en el proceso: " . mysqli_error($conn));
    }
  }

  if (isset($_POST["edituser"])) {
    $autor = mysqli_real_escape_string($conn, $_POST["autor"]);
    $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
    $edad = mysqli_real_escape_string($conn, $_POST["edad"]);  
    $tipo = mysqli_real_escape_string($conn, $_POST["tipo"]);
    $idautor = mysqli_real_escape_string($conn, $_POST["idautor"]);

    $sql = "UPDATE autor SET autor = '$autor', nombre = '$nombre', edad = '$edad', tipo = '$tipo' WHERE idautor = $idautor";
    if(mysqli_query($conn, $sql)){
        session_start();
        $_SESSION["edituser"] = "Modificado con éxito";
        header("location:tablauser.php");
    } else {
        die("Hubo algún error en el proceso: " . mysqli_error($conn));
    }
}

?>
