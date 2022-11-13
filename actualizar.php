<?php
    include('conexion.php');

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
// una vez presionamos el boton Editar actualizamos la DB con los nuevos valores y nos redirige a la pagina principal
    if (isset($_POST['update'])) {
        $id = $_GET['id'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $pvp = $_POST['pvp'];
        $tipo = $_POST['tipo'];

        $query = "UPDATE productos SET nombre = '$nombre', descripcion = '$descripcion', pvp = '$pvp', tipo = '$tipo' WHERE id = $id";
        mysqli_query($db, $query);
        
        $_SESSION['message'] = "Producto editado con exito";
        $_SESSION['message_type'] = "warning";

        header("Location: listado.php");
    }

    if(isset($_POST['listado'])){
        header("Location: listado.php");
    }
?>

<?php include("includes/header.php") ?>
<!-- Creamos un formulario con los valores actuales -->
<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="actualizar.php?id=<?php echo $_GET['id'] ?>" method="POST">
                    <div class="form-group">
                        <input type="text" name="nombre" value="<?php echo $nombre; ?>" class="form-control" placeholder="Editar nombre">
                    </div>
                    <div class="form-group">
                        <textarea name="descripcion" rows="2" class="form-control" placeholder="Editar descripcion"><?php echo $descripcion; ?></textarea>
                    </div>
                    <div class="form-group">
                        <input type="number" name="pvp" value="<?php echo $pvp; ?>" class="form-control" placeholder="Editar precio">
                    </div>
                    <div class="form-group">
                        <input type="text" name="tipo" value="<?php echo $tipo; ?>" class="form-control" placeholder="Editar tipo">
                    </div>
                    <div class="d-flex justify-content-between">
                    <button class="btn btn-success" name="update">Editar</button>
                    <button class="btn btn-danger" name="listado">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>