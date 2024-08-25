<?php 
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    include("connect.php");
    $sql = "DELETE FROM receta WHERE id =$id";
    if(mysqli_query($conn, $sql)) {
        session_start();
        $_SESSION["delete"] = "Se ha Eliminado con Exito";
        header("location:index.php");
    }else{
        echo "Se ha producido un error";
    }
}
?>