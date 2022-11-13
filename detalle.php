<?php
include('conexion.php');
//obtenemos el id y con ese id pintamos ese unico producto
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM productos WHERE id = $id";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $nombre = $row['nombre'];
        $descripcion = $row['descripcion'];
        $pvp = $row['pvp'];
        $tipo = $row['tipo'];
    }
}


if(isset($_POST['listado'])){
    header("Location: listado.php");
}

?>

<?php include("includes/header.php") ?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Precio</th>
            <th>Tipo</th>
            <th>Atras</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $row['nombre'] ?></td>
            <td><?php echo $row['descripcion'] ?></td>
            <td><?php echo $row['pvp'] ?></td>
            <td><?php echo $row['tipo'] ?></td>
            <form method="POST">
            <td><button class="btn btn-danger" name="listado">Atras</button></td>
            </form>
        </tr>
    </tbody>
</table>

<?php include("includes/footer.php") ?>