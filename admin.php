<?php
$link = 'admin';
include('header.php');
include('./bd.php');

$msg = '';
$val = true;
if($_POST){
	$nombre = trim(ucwords($_POST["nombre"]));
	$apellidos = trim(ucwords($_POST["apellidos"]));
	$usuario = trim($_POST["usuario"]);
	$password = trim($_POST["password"]);

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
		if($apellidos === ''){
			$val = false;
			$msg = '
				<div class="alert alert-danger" role="alert">
					El apellido es necesario
				</div>
			';
		}else{ $val = true; }
	}
	if($val){
		if($usuario === ''){
			$val = false;
			$msg = '
				<div class="alert alert-danger" role="alert">
					El nombre de usuario es necesario
				</div>
			';
		}else{ $val = true; }
	}
	if($val){
		if($password === ''){
			$val = false;
			$msg = '
				<div class="alert alert-danger" role="alert">
					El contraseña de usuario es necesario
				</div>
			';
		}else{ $val = true; }
	}
	if($val){
		$query = "UPDATE inicio SET nombre = '$nombre', apellidos = '$apellidos', usuario = '$usuario', password = '$password' WHERE id = 1";
		$res = mysqli_query($conexion, $query);
		if($res){
			$msg = '
				<div class="alert alert-success" role="alert">
					Se actualizaron los datos del administrador
				</div>
			';
		}
	}
}

$query = "SELECT * FROM inicio WHERE id = 1";
$res = mysqli_query($conexion, $query);
$admin = mysqli_fetch_assoc($res);

?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">¡Datos de administrador!</h1>
</div>

<div class="container">
	<form method="post" action="">
		<?php echo $msg; ?>
		<div class="row">
			<div class="col-6">
				<div class="mb-3">
					<label for="" class="form-label">Nombre del administrador:</label>
					<input value="<?php echo $admin["nombre"]; ?>" type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre del administrador"/>
				</div>
			</div>
			<div class="col-6">
				<div class="mb-3">
					<label for="apellidos" class="form-label">Apellidos del administrador</label>
					<input value="<?php echo $admin["apellidos"]; ?>" type="text" class="form-control" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="Apellidos del administrador"/>
				</div>
			</div>
			<div class="col-6">
				<div class="mb-3">
					<label for="usuario" class="form-label">Nombre de usuario de usuario:</label>
					<input value="<?php echo $admin["usuario"]; ?>" type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre de usuario del administrador"/>
				</div>
			</div>
			<div class="col-6">
				<div class="mb-3">
					<label for="password" class="form-label">Contraseña de administrador:</label>
					<input value="<?php echo $admin["password"]; ?>" type="text" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Contraseña del administrador"/>
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-warning">Actualizar</button>
	</form>
</div>

<?php
include('footer.php');
?>