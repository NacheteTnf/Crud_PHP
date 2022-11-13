<?php
include("conexion.php");
// Cuando presionas el boton de crear en listado te mandara para aqui
if(isset($_POST['save_product'])){
   $nombre = $_POST['nombre'];
   $descripcion = $_POST['descripcion'];
   $pvp = $_POST['pvp'];
   $tipo = $_POST['tipo'];
// ponemos el mismo nombre de la variable de la DB , luego hacemos la query para ponerlos en la DB
   $query = "INSERT INTO productos(nombre, descripcion, pvp, tipo) VALUES ('$nombre', '$descripcion', '$pvp', '$tipo')";
   $result = mysqli_query($db, $query);
   //si falla pintara el Query Fail
   if (!$result) {
    die("Query Failed");
   }

   //Guardamos el mensaje para posteriormente pintarlo
   $_SESSION['message'] = 'Producto guardado con exito';
   $_SESSION['message_type'] = 'success';

   header("Location: listado.php");
}
?>