<?php 
if (isset($_GET["idautor"])) {
    $idautor = $_GET["idautor"];
    include("connect.php");
    $sql = "DELETE FROM autor WHERE idautor =$idautor";
    if(mysqli_query($conn, $sql)) {
        session_start();
        $_SESSION["deleteuser"] = "Se ha Eliminado con Exito";
        header("location:tablauser.php");
    }else{
        echo "Se ha producido un error";
    }
}
?>