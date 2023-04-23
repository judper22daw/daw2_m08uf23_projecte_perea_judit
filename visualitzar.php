<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Ldap;
ini_set('display_errors',0);
if ($_GET['usr'] && $_GET['ou']){
    $domini = 'dc=fjeclot,dc=net';
    $opcions = [
        'host' => 'zend-jupela.fjeclot.net',
        'username' => "cn=admin,$domini",
        'password' => 'fjeclot',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net',
    ];
    $ldap = new Ldap($opcions);
    $ldap->bind();
    $entrada='uid='.$_GET['usr'].',ou='.$_GET['ou'].',dc=fjeclot,dc=net';
    $usuari=$ldap->getEntry($entrada);
    echo "<b><u>".$usuari["dn"]."</b></u><br>";
    foreach ($usuari as $atribut => $dada) {
        if ($atribut != "dn") echo $atribut.": ".$dada[0].'<br>';
    }
}
?>
<html>
<head>
<title>MOSTRANT DADES D'USUARIS DE LA BASE DE DADES LDAP</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h2>Formulari de selecció d'usuari</h2>
				<form action="visualitzar.php" method="GET">
					<div class="form-group">
						<label for="ou">Unitat organitzativa:</label>
						<input type="text" class="form-control" id="ou" name="ou">
					</div>
					<div class="form-group">
						<label for="usr">Usuari:</label>
						<input type="text" class="form-control" id="usr" name="usr">
					</div>
					<button type="submit" class="btn btn-primary">Enviar</button>
					<button type="reset" class="btn btn-default">Resetear</button>
                    <button type="button" onclick="location.href='./menu.php'" class="btn btn-info">Torna menú</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>