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
<html>
<head>
<title>
MODIFICADOR D'USUARIS LDAP
</title>
</head>
<body>
<h2>Formulari d'eliminacio d'usuaris</h2>
<form action="modificar.php" method="POST">
UID: <input type="text" name="uid"><br>
Unitat organitzativa: <input type="text" name="uo"><br>
<input type="radio" id="uidNumber" name="atribut" value="uidNumber">
<label>uid Number</label>
<input type="radio" id="gidNumber" name="atribut" value="gidNumber">
<label>gid Number</label>
<input type="radio" id="directoriPersonal" name="atribut" value="homeDirectory">
<label>Directori Personal</label>
<input type="radio" id="Shell" name="atribut" value="loginShell">
<label>Shell</label>
<input type="radio" id="cn" name="atribut" value="cn">
<label>cn</label>
<input type="radio" id="sn" name="atribut" value="sn">
<label>sn</label>
<input type="radio" id="givenName" name="atribut" value="givenName">
<label>givenName</label>
<input type="radio" id="PostalAdress" name="atribut" value="postalAddress">
<label>PostalAdress</label>
<input type="radio" id="mobile" name="atribut" value="mobile">
<label>mobile</label>
<input type="radio" id="telephoneNumber" name="atribut" value="telephoneNumber">
<label>telephoneNumber</label>
<input type="radio" id="title" name="atribut" value="title">
<label>title</label>
<input type="radio" id="description" name="atribut" value="description">
<label>description</label>
<br>
Nova Dada: <input type="text" name="novaDada"><br>
<input type="submit"/>
<input type="reset"/>
</form>
</body>
</html>