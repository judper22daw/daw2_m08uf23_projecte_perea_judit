<?php
    require 'vendor/autoload.php';
    use Laminas\Ldap\Attribute;
	use Laminas\Ldap\Ldap;
    
	ini_set('display_errors', 0);
	#Dades de la nova entrada
	#
	if(isset($_POST['uid']) && isset($_POST['uo']) && isset($_POST['uidNumber']) 
	    && isset($_POST['gidNumber']) && isset($_POST['directoriPersonal']) 
	    && isset($_POST['shell']) && isset($_POST['cn']) && isset($_POST['sn']) 
	    && isset($_POST['givenName']) && isset($_POST['mobile']) 
	    && isset($_POST['postalAdress']) && isset($_POST['telephoneNumber']) 
	    && isset($_POST['title']) && isset($_POST['description'])) {
	    // Código para crear el nuevo usuario
	    
	    
    	$uid= $_POST['uid'];
    	$unorg= $_POST['uo'];
    	$num_id= $_POST['uidNumber'];
    	$grup=$_POST['gidNumber'];
    	$dir_pers=$_POST['directoriPersonal'];
    	$sh=$_POST['shell'];
    	$cn=$_POST['cn'];
    	$sn=$_POST['sn'];
    	$nom=$_POST['givenName'];
    	$mobil=$_POST['mobile'];
    	$adressa=$_POST['postalAdress'];
    	$telefon=$_POST['telephoneNumber'];
    	$titol=$_POST['title'];
    	$descripcio=$_POST['description'];
    	$objcl=array('inetOrgPerson','organizationalPerson','person','posixAccount','shadowAccount','top');
    	#
    	#Afegint la nova entrada
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
    	$nova_entrada = [];
    	Attribute::setAttribute($nova_entrada, 'objectClass', $objcl);
    	Attribute::setAttribute($nova_entrada, 'uid', $uid);
    	Attribute::setAttribute($nova_entrada, 'uidNumber', $num_id);
    	Attribute::setAttribute($nova_entrada, 'gidNumber', $grup);
    	Attribute::setAttribute($nova_entrada, 'homeDirectory', $dir_pers);
    	Attribute::setAttribute($nova_entrada, 'loginShell', $sh);
    	Attribute::setAttribute($nova_entrada, 'cn', $cn);
    	Attribute::setAttribute($nova_entrada, 'sn', $sn);
    	Attribute::setAttribute($nova_entrada, 'givenName', $nom);
    	Attribute::setAttribute($nova_entrada, 'mobile', $mobil);
    	Attribute::setAttribute($nova_entrada, 'postalAddress', $adressa);
    	Attribute::setAttribute($nova_entrada, 'telephoneNumber', $telefon);
    	Attribute::setAttribute($nova_entrada, 'title', $titol);
    	Attribute::setAttribute($nova_entrada, 'description', $descripcio);
    	$dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
    	if($ldap->add($dn, $nova_entrada)) echo "Usuari creat";
	   }
?>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<title>
CREADOR D'USUARIS LDAP
</title>
</head>
<body>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>CREADOR D'USUARIS LDAP</title>
</head>
<body>
    <div class="container">
        <h2 class="mt-4 mb-4">Formulari de creació d'usuaris</h2>
        <form action="crear.php" method="POST">
            <div class="form-group">
                <label for="uid">Nom d'usuari (UID):</label>
                <input type="text" class="form-control" id="uid" name="uid" placeholder="exemple1" required>
            </div>
            <div class="form-group">
                <label for="uo">Unitat organitzativa:</label>
                <input type="text" class="form-control" id="uo" name="uo" placeholder="exemples" required>
            </div>
            <div class="form-group">
                <label for="uidNumber">Número d'UID:</label>
                <input type="number" class="form-control" id="uidNumber" name="uidNumber" placeholder="1000" required>
            </div>
            <div class="form-group">
                <label for="gidNumber">GIDNumber:</label>
                <input type="number" class="form-control" id="gidNumber" name="gidNumber" placeholder="100" required>
            </div>
            <div class="form-group">
                <label for="directoriPersonal">Directori personal:</label>
                <input type="text" class="form-control" id="directoriPersonal" name="directoriPersonal" placeholder="/home/exemple1" required>
            </div>
            <div class="form-group">
                <label for="shell">Shell:</label>
                <input type="text" class="form-control" id="shell" name="shell">
            </div>
            <div class="form-group">
                <label for="cn">Nom complet:</label>
                <input type="text" class="form-control" id="cn" name="cn" placeholder="John Doe" required>
            </div>
            <div class="form-group">
                <label for="sn">Cognom:</label>
                <input type="text" class="form-control" id="sn" name="sn" placeholder="Doe" required>
            </div>
			<div class="form-group">
                <label for="givenName">Nom de pila:</label>
                <input type="text" class="form-control" id="givenName" name="givenName" placeholder="John" required>
            </div>
			<div class="form-group">
                <label for="mobile">Mòbil:</label>
                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="6XXXXXXXX" required>
            </div>
			<div class="form-group">
                <label for="postalAdress">Adreça:</label>
                <input type="text" class="form-control" id="postalAdress" name="postalAdress" placeholder="C/Exemple 33" required>
            </div>
			<div class="form-group">
                <label for="telephoneNumber">Telefon:</label>
                <input type="text" class="form-control" id="telephoneNumber" name="telephoneNumber" placeholder="9XXXXXXXX" required>
            </div>
			<div class="form-group">
                <label for="title">Titol:</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="p.e. Informàtic" required>
            </div>
			<div class="form-group">
                <label for="description">Descripció:</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="Exemple" required>
            </div>
			<input type="submit" class="btn btn-primary" value="Enviar">
			<input type="reset" class="btn btn-secondary" value="Resetejar">
			<button class="btn btn-info" onclick="window.location.href='menu.php'">Torna al menú</button>
		</form>
	</div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>