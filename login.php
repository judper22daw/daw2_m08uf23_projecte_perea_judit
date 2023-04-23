<html>
	<head>
		<title>AUTENTICANT AMB LDAP DE L'USUARI admin</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<form action="auth.php" method="POST">
						<div class="form-group">
							<label for="adm">Usuari amb permisos d'administració LDAP:</label>
							<input type="text" class="form-control" id="adm" name="adm">
						</div>
						<div class="form-group">
							<label for="cts">Contrasenya de l'usuari:</label>
							<input type="password" class="form-control" id="cts" name="cts">
						</div>
						<button type="submit" class="btn btn-primary">Envia</button>
						<button type="reset" class="btn btn-default">Neteja</button>
					</form>
				 </div>
			</div>
		</div>
	</body>
</html>
