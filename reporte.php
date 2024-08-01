<?php
$link = 'reporte';
include('header.php');
include('bd.php');
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">¡Reportes!</h1>
</div>

<div class="container">
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th scope="col">N°</th>
                <th scope="col">Cliente</th>
                <th scope="col">Fecha</th>
                <th scope="col">Total</th>
                <th scope="col">Acction</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fecha actual
            date_default_timezone_set('America/Lima');
            $fecha = date('Y-m-d');
            $query = "SELECT cliente, fecha, SUM(subtotal) AS total FROM ventas GROUP BY cliente, fecha ";
            $res = mysqli_query($conexion, $query);
            $numRows = mysqli_num_rows($res);
            if($numRows > 0){
                $i = 1;
                while($fila = mysqli_fetch_assoc($res)){ ?>
                    <tr>
                        <th scope="row"><?php echo $i ?></th>
                        <td><?php echo $fila["cliente"]; ?></td>
                        <td><?php echo $fila["fecha"]; ?></td>
                        <td><?php echo $fila["total"]; ?></td>
                        <td>
                            <form action="excel.php" method="get">
                                <a href="venta.php?cliente=<?php echo $fila["cliente"] . "&fecha=" . $fila["fecha"]; ?>" class="btn btn-outline-warning btn-sm">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a target="_blank" href="pdf.php?cliente=<?php echo $fila["cliente"] . "&fecha=" . $fila["fecha"]; ?>" class="btn btn-outline-danger btn-sm" title="Exportar a PDF">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </a>
                                <input type="hidden" value="<?php echo $fila["cliente"]; ?>" name="cliente">
                                <input type="hidden" value="<?php echo $fila["fecha"]; ?>" name="fecha">
                                <button class="btn btn-outline-success btn-sm" title="Exportar a Excel">
                                    <i class="fa-solid fa-file-excel"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
            <?php
                $i++;
                }
            }else{ ?>
                <tr>
                    <td colspan='5' style="text-align: center; background: #c1f1cb;">No hay ninguna venta echa hasta la fecha 😁</td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

<?php
include('footer.php');
?>