<?php
	require 'vendor/autoload.php';
	use Laminas\Ldap\Attribute;
	use Laminas\Ldap\Ldap;
	
	ini_set('display_errors', 0);
	#
	# Atribut a modificar --> Número d'idenficador d'usuari
	#
	if(isset($_POST['uid']) && isset($_POST['uo']) 
	    && isset($_POST['novaDada']) && isset($_POST['atribut'])) {
	    
	$atribut= $_POST['atribut']; # El número identificador d'usuar té el nom d'atribut uidNumber
	$nou_contingut= $_POST['novaDada'];
	#
	# Entrada a modificar
	#
	$uid = $_POST['uid'];
	$unorg = $_POST['uo'];
	
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
	# Modificant l'entrada
	#
	$ldap = new Ldap($opcions);
	$ldap->bind();
	$entrada = $ldap->getEntry($dn);
	if ($entrada){
		Attribute::setAttribute($entrada,$atribut,$nou_contingut);
		$ldap->update($dn, $entrada);
		echo "Atribut modificat"; 
	} else echo "<b>Aquesta entrada no existeix</b><br><br>";
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/css/bootstrap.min.css">
    <title>MODIFICADOR D'USUARIS LDAP</title>
</head>
<body>
    <div class="container mt-3">
        <h2 class="mb-3">Formulari d'eliminació d'usuaris</h2>
        <form action="modificar.php" method="POST">
            <div class="mb-3">
                <label for="uid" class="form-label">UID:</label>
                <input type="text" class="form-control" name="uid" id="uid">
            </div>
            <div class="mb-3">
                <label for="uo" class="form-label">Unitat organitzativa:</label>
                <input type="text" class="form-control" name="uo" id="uo">
            </div>
            <div class="mb-3">
                <label for="atribut" class="form-label">Atribut:</label>
                <select class="form-select" name="atribut" id="atribut">
                    <option value="uidNumber">uid Number</option>
                    <option value="gidNumber">gid Number</option>
                    <option value="homeDirectory">Directori Personal</option>
                    <option value="loginShell">Shell</option>
                    <option value="cn">cn</option>
                    <option value="sn">sn</option>
                    <option value="givenName">givenName</option>
                    <option value="postalAddress">PostalAdress</option>
                    <option value="mobile">mobile</option>
                    <option value="telephoneNumber">telephoneNumber</option>
                    <option value="title">title</option>
                    <option value="description">description</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="novaDada" class="form-label">Nova Dada:</label>
                <input type="text" class="form-control" name="novaDada" id="novaDada">
            </div>
            <div class="mb-3">
                <input type="submit" class="btn btn-primary" value="Modificar">
                <input type="reset" class="btn btn-secondary" value="Netejar">
				<button type="button" onclick="location.href='./menu.php'" class="btn btn-info">Torna menú</button>
            </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
</html>
