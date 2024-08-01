<?php
$link = 'venta';
include('header.php');
include('bd.php');

// Icicialización
$msg = '';
$cliente = '';
$cantidad = '';
$val = true;
if($_GET){
	$id = isset($_GET["id"]) ? intval($_GET["id"]) : '';
    if($id !== ''){
		$query = "DELETE FROM ventas WHERE id = '$id'";
		$res = mysqli_query($conexion, $query);
		mysqli_next_result($conexion);
		$msg = '
			<div class="alert alert-success" role="alert">
				Se elimino la venta
			</div>
		';
	}
	// Volver al cliente
	$cliente = trim($_GET["cliente"]);
}
if($_POST){
	$cliente = trim(ucwords($_POST["cliente"]));
	$menu = intval($_POST["menu"]);
	$cantidad = intval($_POST["cantidad"]);
	// Validar
	if($val){
		if($cliente === ''){
			$val = false;
			$msg = '
				<div class="alert alert-danger" role="alert">
					El nombre del cliente es necesario
				</div>
			'; 
		}else{ $val = true; }
	}
	if($val){
		if($menu === ''){
			$val = false;
			$msg = '
				<div class="alert alert-danger" role="alert">
					No seleccionaste un menú
				</div>
			'; 
		}else{ $val = true; }
	}
	if($val){
		if(!is_numeric($cantidad)){
			$val = false;
			$msg = '
				<div class="alert alert-danger" role="alert">
					Error en la cantidad
				</div>
			'; 
		}else{ $val = true; }
	}
	if($val){
		// Obtener el precio - segun el menú
		$query = "SELECT * FROM menus WHERE id = '$menu'";
		$res = mysqli_query($conexion, $query);
		$menuData = mysqli_fetch_assoc($res);
		$precio = floatval($menuData["precio"]);
		mysqli_next_result($conexion);
		// Calculamos el subtotal
		$subTotal = $cantidad * $precio;
		// Insertamos el registro en ventas
		date_default_timezone_set('America/Lima');
		$fecha = isset($_GET["fecha"]) ? $_GET["fecha"] : date('Y-m-d');
		$query = "INSERT INTO ventas (cliente, id_menu, cantidad, subtotal, fecha) VALUES ('$cliente', '$menu', '$cantidad', '$subTotal', '$fecha')";
		$res = mysqli_query($conexion, $query);
		if($res){
			$msg = '
				<div class="alert alert-success" role="alert">
					¡Se registro la venta!
				</div>
			';
		}else{
			$msg = '
				<div class="alert alert-danger" role="alert">
					Sucedio un error en la venta
				</div>
			';
		}
	}
}
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">¡Registro de ventas!</h1>
</div>

<div class="container">
	<?php echo $msg; ?>
	<form method="post" class="row">
		<div class="col-4">
			<input value="<?php echo $cliente; ?>" type="text" class="form-control" name="cliente" id="cliente" aria-describedby="helpId" placeholder="Nombre del cliente" required />
		</div>
		<div class="col-4">
			<div class="mb-3">
				<select class="form-select form-control" name="menu" id="menu" required >
					<option selected>Seleciona un menu</option>
					<?php
					$i = 1;
					$query = "SELECT * FROM menus";
					$res = mysqli_query($conexion, $query);
					while($fila = mysqli_fetch_assoc($res)){
					?>
						<option value="<?php echo $fila["id"]; ?>"><?php echo $fila["nombre"] . ' - S/ ' . $fila["precio"] ?></option>
					<?php
						$i++;
					}
					?>
				</select>
			</div>
		</div>
		<div class="col-2">
			<input type="number" class="form-control" name="cantidad" id="cantidad" aria-describedby="helpId" placeholder="# de platos" required />
		</div>
		<div class="col-2">
			<button name="vender" style="width: 68%;" type="submit" class="btn btn-success"><i class="fa-solid fa-plus"></i> Vender</button>
			<a href="venta.php" title="Nueva venta" class="btn btn-danger"><i class="fa-solid fa-broom"></i></a>
		</div>
	</form>
	<p class="my-2">Venta</p>
	<div class="contenedor-table">
		<table class="table">
			<thead class="table-dark">
				<tr>
					<th scope="col">N°</th>
					<th scope="col">Nombre</th>
					<th scope="col">Menú</th>
					<th scope="col"># platos</th>
					<th scope="col">Precio</th>
					<th scope="col">SubTotal</th>
					<th scope="col">Acction</th>
				</tr>
			</thead>
			<tbody>
				<?php
				// Fecha actual
				date_default_timezone_set('America/Lima');
				$fecha = date('Y-m-d');
				$query = "SELECT ventas.*, menus.nombre, menus.precio FROM ventas INNER JOIN menus ON .ventas.id_menu = menus.id WHERE cliente = '$cliente' AND fecha = '$fecha'";
				$res = mysqli_query($conexion, $query);
				$numRows = mysqli_num_rows($res);
				if($numRows > 0){
					$i = 1;
					while($fila = mysqli_fetch_assoc($res)){ ?>
						<tr>
							<th scope="row"><?php echo $i ?></th>
							<td><?php echo $fila["cliente"]; ?></td>
							<td><?php echo $fila["nombre"]; ?></td>
							<td><?php echo $fila["cantidad"]; ?></td>
							<td>S/ <?php echo $fila["precio"]; ?></td>
							<td>S/ <?php echo $fila["subtotal"]; ?></td>
							<td>
								<form method="get">
									<input type="hidden" name="id" value="<?php echo $fila["id"] ?>">
									<input type="hidden" name="cliente" value="<?php echo $cliente; ?>">
									<button type="submit" class="btn btn-outline-danger btn-sm">
										<i class="fa-solid fa-trash"></i>
									</button>
								</form>
							</td>
						</tr>
				<?php
					$i++;
					}
				}else{ ?>
					<tr>
						<td colspan='7' style="text-align: center; background: #c1f1cb;">Añade la una nueva venta para este cliente 😁</td>
					</tr>
				<?php
				}
				?>
			</tbody>
		</table>
		<p style="text-align: right;">Total: S/ <b>
			<?php
			$query = "SELECT SUM(subtotal) AS 'total' FROM ventas WHERE cliente = '$cliente' AND fecha = '$fecha'";
			$res = mysqli_query($conexion, $query);
			$sumaVenta = mysqli_fetch_assoc($res);
			$total = isset($sumaVenta["total"]) ? $sumaVenta["total"] : 0;
			echo $total;
			?>
		</b></p>
		<div style="margin: auto;">
			<a href="pdf.php?cliente=<?php echo $cliente . "&fecha=" . $fecha; ?>" target="_blank" class="btn btn-danger btn-sm">
				<i class="fa-solid fa-file-pdf"></i> Imprimir PDF
			</a>
			<a href="excel.php?cliente=<?php echo $cliente . "&fecha=" . $fecha; ?>" target="_blank" class="btn btn-success btn-sm">
				<i class="fa-solid fa-file-excel"></i> Imprimir Excel
			</a>
		</div>
	</div>
</div>

<?php
include('footer.php');
?>