<?php
	require 'vendor/autoload.php';
	use Laminas\Ldap\Attribute;
	use Laminas\Ldap\Ldap;
	
	ini_set('display_errors', 0);
	#
	# Entrada a esborrar: usuari 3 creat amb el projecte zendldap2
	#
	if(isset($_POST['uid']) && isset($_POST['uo'])) {
	        // Código para eliminar el nuevo usuario
	        
	        
	$uid= $_POST['uid'];
	$unorg= $_POST['uo'];

	$dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
	#
	#Opcions de la connexió al servidor i base de dades LDAP
	$opcions = [
		'host' => 'zend-jupela.fjeclot.net',
		'username' => 'cn=admin,dc=fjeclot,dc=net',
		'password' => 'fjeclot',
		'bindRequiresDn' => true,
		'accountDomainName' => 'fjeclot.net',
		'baseDn' => 'dc=fjeclot,dc=net',		
	];
	#
	# Esborrant l'entrada
	#
	$ldap = new Ldap($opcions);
	$ldap->bind();
	try{
	    $ldap->delete($dn);
	    echo "<b>Entrada esborrada</b><br>"; 
	} catch (Exception $e){
	   echo "<b>Aquesta entrada no existeix</b><br>";
	}
	    }
?>
<html>
<head>
<title>ELIMINADOR D'USUARIS LDAP</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h2>Formulari d'eliminació d'usuaris</h2>
				<form action="eliminar.php" method="POST">
					<div class="form-group">
						<label for="uid">UID:</label>
						<input type="text" class="form-control" id="uid" name="uid">
					</div>
					<div class="form-group">
						<label for="uo">Unitat organitzativa:</label>
						<input type="text" class="form-control" id="uo" name="uo">
					</div>
					<button type="submit" class="btn btn-danger">Eliminar</button>
					<button type="reset" class="btn btn-default">Resetear</button>
					<button type="button" onclick="location.href='./menu.php'" class="btn btn-info">Torna menú</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>