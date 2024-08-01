<?php
header("Content-Type: application/xls");
header('Content-Disposition: attachment; filename=reporte_' . date('Y:m:d:m:d'). ".xls");
header('Pagina: no-cache');
if($_GET){
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imprimir exel</title>
</head>
<body>
    <h1>Reporte de venta</h1>
    <table>
        <thead>
            <tr>
                <th>N°</th>
                <th>Menu</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>SubTotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require 'bd.php';
			$fecha = $_GET["fecha"];
			$cliente = $_GET["cliente"];
			$query = "SELECT ventas.*, menus.nombre, menus.precio FROM ventas INNER JOIN menus ON .ventas.id_menu = menus.id WHERE cliente = '$cliente' AND fecha = '$fecha'";
			$res = mysqli_query($conexion, $query);
			$i = 1;
            while($fila = mysqli_fetch_assoc($res)){
            ?>
            <tr>
                <th scope="row"><?php echo $i; ?></th>
                <td><?php echo $fila["nombre"]; ?></td>
                <td><?php echo $fila["cantidad"]; ?></td>
                <td>S/ <?php echo $fila["precio"]; ?></td>
                <td>S/ <?php echo $fila["subtotal"]; ?></td>
            </tr>
            <?php
				$i++;
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
}
?>