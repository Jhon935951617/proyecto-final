<?php
    include('bd.php');

    $USUARIO = isset($_POST['usuario']) ? $_POST['usuario'] : '';
    $PASSWORD = isset($_POST['password']) ? $_POST['password'] : '';

    $consulta = "SELECT* FROM inicio WHERE usuario = '$USUARIO' AND password = '$PASSWORD' ";
    $resultado = mysqli_query($conexion, $consulta);

    $filas = mysqli_num_rows($resultado);

    if($filas){
        header("location:dashboard.html");
    } else {
        include("index.html");
    }
    mysqli_free_result($resultado);
    mysqli_close($conexion);
?>