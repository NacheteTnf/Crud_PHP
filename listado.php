<?php

//Autorizar user o no
function pedir()
{
    header('WWW-Authenticate: Basic Realm="Contenido Protegido"');
    header('HTTP/1.0 401 Unauthorized');
    echo "Datos Incorrectos o Usuario NO reconocido!!!";
    die();
}

if (!isset($_SERVER['PHP_AUTH_USER'])) {
    pedir();
} else {
    if (
        $_SERVER['PHP_AUTH_USER'] != 'gestor' & $_SERVER['PHP_AUTH_PW'] !=
        'secreto'
    ) {
        pedir();
    }
}

?>

<?php include("conexion.php") ?>
<!-- Separamos el header y footer a otro archivo aparte y lo llamamos por componentes para no tener muchisimo codigo junto y que sea leible -->
<?php include("includes/header.php") ?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4">
        <!-- Aqui es donde pintaremos el mensaje utilizando bootstrap -->
        <?php if (isset($_SESSION['message'])) {?>
            <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message']?>
                <button type="button" class="close" data-dismiss='alert' aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <!-- Cerramos con unset para que no veas el mensaje constantemente una vez cierras el pop alert de arriba -->
        <?php session_unset(); } ?>

            <div class="card card-body">
                    <form action="crear.php" method="POST">
                        <div class="form-group">
                            <input type="text" name="nombre" class="form-control" placeholder="Nombre del producto" autofocus>
                        </div>
                        <div class="form-group">
                            <textarea name="descripcion" rows="2" class="form-control" placeholder="Descripcion del producto"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="number" name="pvp" class="form-control" placeholder="Precio del producto" autofocus>
                        </div>
                        <div class="form-group">
                            <input type="text" name="tipo" class="form-control" placeholder="Tipo de producto" autofocus>
                        </div>
                        <input type="submit" class="btn btn-success btn-block" name="save_product" value="Guardar Producto">
                    </form>
            </div>
        </div>
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Precio</th>
                        <th>Tipo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $query = 'SELECT * FROM productos';
                    $result_products = mysqli_query($db , $query);

                    while ($row = mysqli_fetch_array($result_products)) { ?>
                        <tr>
                            <td><?php echo $row['nombre'] ?></td>
                            <td><?php echo $row['descripcion'] ?></td>
                            <td><?php echo $row['pvp'] ?></td>
                            <td><?php echo $row['tipo'] ?></td>
                            <td>
                                <!-- Accedemos al id directamente seleccionando el id en el href-->
                                <a href="actualizar.php?id=<?php echo $row['id']?>" class="btn btn-secondary mb-1">
                                    <i class="fas fa-marker"></i>
                                </a>
                                <a onclick="return confirm('Desea Eliminar este producto?')" href="borrar.php?id=<?php echo $row['id']?>" class="btn btn-danger">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                                <a href="detalle.php?id=<?php echo $row['id']?>" class="btn btn-info">
                                    <i class="fa fa-search"></i>
                                </a>
                            </td>
                        </tr>
                   <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>