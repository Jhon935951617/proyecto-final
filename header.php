<?php
session_start();
if(!isset($_SESSION["logueado"])){
    header('location:./index.html');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Restaurante Calle 8</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/inicio.css">
    <!-- Iconos -->
    <script src="https://kit.fontawesome.com/6a4bedafcb.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?php echo $link === 'inicio' ? 'active' : '' ?>" href="./inicio.php">
                                <img src="img/casa-silueta-negra-sin-puerta.png" alt="Inicio"> Inicio 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $link === 'menu' ? 'active' : '' ?>" href="./menus.php">
                                <img src="img/tenedor-y-cuchillo.png" alt="Menús"> Menus
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $link === 'venta' ? 'active' : '' ?>" href="./venta.php">
                                <img src="img/carro.png" alt="Venta"> Venta
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $link === 'reporte' ? 'active' : '' ?>" href="./reporte.php">
                                <img src="img/archivo.png" alt="Reporte"> Reporte
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $link === 'receta' ? 'active' : '' ?>" href="./receta.php">
                                <i class="fa-solid fa-utensils" style="margin-right: 15px; color: #000000;"></i> Receta
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $link === 'admin' ? 'active' : '' ?>" href="./admin.php">
                                <i class="fa-solid fa-gear" style="margin-right: 15px; color: #000000;"></i> Admin
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $link === 'salir' ? 'active' : '' ?>" href="./salir.php">
                                <i class="fa-solid fa-circle-xmark" style="margin-right: 15px; color: #000000;"></i> Salir
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">