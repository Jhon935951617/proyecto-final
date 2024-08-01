<?php
$link = 'inicio';
include('header.php');
include('bd.php');
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">¡TE DAMOS LA BIENVENIDA AL RESTAURANTE CALLE 8!</h1>
</div>

<div class="row">
    <?php
    $cantidad = 3;
    $query = "SELECT * FROM menus ORDER BY RAND() LIMIT $cantidad";
    $res = mysqli_query($conexion, $query);
    while($fila = mysqli_fetch_assoc($res)){
    ?>
    <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
            <img style="max-height: 190px; object-fit: cover;" class="card-img-top" src="<?php echo $fila["urlImagen"]; ?>" alt="<?php echo $fila["nombre"]; ?>">
            <div class="card-body">
                <p class="card-text"><?php echo $fila["nombre"]; ?></p>
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">Precio: <b><?php echo $fila["precio"]; ?></b></small>
                </div>
            </div>
        </div>
    </div>
    <?php 
    }
    ?>
</div>

<?php
include('footer.php');
?>