<?php
$link = 'menu';
include('header.php');
include('./bd.php');
// Inicialización de variables
$msg = '';
$nombre = '';
$precio = '';
$urlImagen = '';
$val = true;
if($_GET){
	$id = $_GET["id"];
	if($_GET["accion"] === 'editar'){
		$query = "SELECT * FROM menus WHERE id = '$id'";
		$res = mysqli_query($conexion, $query);
		$menu = mysqli_fetch_assoc($res);
		$nombre = $menu["nombre"];
		$precio = $menu["precio"];
		$urlImagen = $menu["urlImagen"];
	}elseif($_GET["accion"] === 'eliminar'){
		$query = "DELETE FROM menus WHERE id = '$id'";
		$res = mysqli_query($conexion, $query);
		if($res){
			$msg = '
				<div class="alert alert-success" role="alert">
					Se elimino correctamente
				</div>
			';
		}else{
			$msg = '
				<div class="alert alert-danger" role="alert">
					No se pudo eliminar
				</div>
			';
		}
	}
}
if($_POST){
	$nombre = trim($_POST["nombre"]);
	$precio = floatval($_POST["precio"]);
	$urlImagen = trim($_POST["urlImagen"]);
	if($val){
		if($nombre === ''){
			$val = false;
			$msg = '
				<div class="alert alert-danger" role="alert">
					El nombre es necesario
				</div>
			';
		}else{ $val = true; }
	}
	if($val){
		if($precio === ''){
			$val = false;
			$msg = '
				<div class="alert alert-danger" role="alert">
					El precio es necesario
				</div>
			';
		}else{ $val = true; }
	}
	if($val){
		if(!is_numeric($precio)){
			$val = false;
			$msg = '
				<div class="alert alert-danger" role="alert">
					Error en el precio
				</div>
			';
		}else{ $val = true; }
	}
	if($val){
		if($urlImagen === ''){
			$val = false;
			$msg = '
				<div class="alert alert-danger" role="alert">
					La URL de la imagen es necesario
				</div>
			';
		}else{ $val = true; }
	}
	if($val){
		if(isset($_POST["crear"])){
			$query = "INSERT INTO menus (nombre, precio, urlImagen) VALUES ('$nombre', '$precio', '$urlImagen')";
			$mensaje = '
				<div class="alert alert-success" role="alert">
					Se registro correctamente el menú
				</div>
			';
		}elseif(isset($_POST["editar"])){
			$id = $_GET['id']; // Asegúrate de que $id esté definido
            $query = "UPDATE menus SET nombre='$nombre', precio='$precio', urlImagen='$urlImagen' WHERE id='$id'";
			$mensaje = '
				<div class="alert alert-success" role="alert">
					Se a actualizado correctamente
				</div>
			';
		}
		$res = mysqli_query($conexion, $query);
		if($res){
			$msg = $mensaje;
			$nombre = '';
			$precio = '';
			$urlImagen = '';
		}
	}
}
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">¡Menús!</h1>
</div>

<div class="container">
	<?php echo $msg; ?>
	<form class="row" method="post">
		<div class="col-10">
			<div class="mb-3">
				<input value="<?php echo $nombre ?>" type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre del platillo" required/>
			</div>
		</div>
		<div class="col-2">
			<div class="mb-3">
				<input value="<?php echo $precio ?>" type="number" class="form-control" name="precio" id="precio" aria-describedby="helpId" placeholder="Precio" min="1" required/>
			</div>
		</div>
		<div class="col-10">
			<div class="mb-3">
				<input value="<?php echo $urlImagen ?>" type="text" class="form-control" name="urlImagen" id="urlImagen" aria-describedby="helpId" placeholder="URL de la imagen del platillo" required />
			</div>
		</div>
		<div class="col-2">
			<?php
			if($_GET){ ?>
				<?php
					if($_GET["accion"] === 'editar'){ ?>
						<button name="editar" type="submit" class="btn btn-warning">Actualizar</button>
					<?php
					}
				?>
				<a href="./menus.php" class="btn btn-primary"><i class="fa-solid fa-plus"></i></a>
			<?php
			}else{ ?>
				<button name="crear" type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Agregar</button>
			<?php
			}
			?>
		</div>
	</form>
	<p class="my-2">Nuestros menus</p>
	<div class="contenedor-table">
		<table class="table">
			<thead class="table-dark">
				<tr>
					<th scope="col">N°</th>
					<th scope="col">Nombre</th>
					<th scope="col">Precio</th>
					<th scope="col">Imagen</th>
					<th scope="col">Acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$query = "SELECT * FROM menus ORDER BY id DESC";
				$res = mysqli_query($conexion, $query);
				$i = 1;
				while($fila = mysqli_fetch_assoc($res)){
				?>
				<tr>
					<th scope="row"><?php echo $i ?></th>
					<td><?php echo $fila["nombre"] ?></td>
					<td>S/ <?php echo $fila["precio"] ?></td>
					<td>
						<img style="max-height: 60px;" src="<?php echo $fila["urlImagen"] ?>" alt="">
					</td>
					<td>
						<a href="./menus.php?id=<?php echo $fila["id"] . '&accion=editar'?>" class="btn btn-outline-warning btn-sm"><i class="fa-solid fa-pen"></i></a>
						<a href="./menus.php?id=<?php echo $fila["id"] . '&accion=eliminar'?>" class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
					</td>
				</tr>
				<?php
					$i++;
				}
				?>
			</tbody>
		</table>
	</div>
</div>
<?php
include('footer.php');
?>