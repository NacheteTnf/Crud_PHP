<?php
    include('conexion.php');

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "DELETE FROM productos WHERE id = $id";
        $result = mysqli_query($db, $query);
        if (!$result) {
            die("Query Failed");
           }

           $_SESSION['message'] = "Producto eliminado con exito";
           $_SESSION['message_type'] = "danger";

           header("Location: listado.php");
    }
?>