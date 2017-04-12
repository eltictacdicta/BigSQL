
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
<div class="container">
<h1 class="h1">Datos de connexión</h1>

<form id="dbform" action="./index.php" method="POST" enctype="multipart/form-data">
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="dbhost">DB host : </label>
					<input type="text" id="db_server" class="form-control input-lg" value = "<?php echo $db_server; ?>" name = "db_server" />
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label for="dbuser">DB user name : </label>
					<input type="text" id="db_username" class="form-control input-lg" value = "<?php echo $db_username; ?>" name = "db_username" />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="dbpass">DB password : </label>
					<input type="text" id="db_password" class="form-control input-lg" value = "<?php echo $db_password; ?>" name = "db_password" />
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label for="dbname">DB table : </label>
					<input type="text" id="db_name" class="form-control input-lg" value = "<?php echo $db_name; ?>" name = "db_name" />
				</div>
			</div>
		</div>
                <?php echo $mensaje; ?>
		<button type = "submit" name="enviar" value="enviar" class = "btn btn-primary">Enviar nuevos datos</button>
		<button type = "submit" name="config" value="config" type = "config" class = "btn btn-danger">Usar los del archivo config</button>
	</form>
</div>

