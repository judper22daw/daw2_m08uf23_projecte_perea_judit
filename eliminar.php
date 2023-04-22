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
<title>
ELIMINADOR D'USUARIS LDAP
</title>
</head>
<body>
<h2>Formulari d'eliminacio d'usuaris</h2>
<form action="eliminar.php" method="POST">
UID: <input type="text" name="uid"><br>
Unitat organitzativa: <input type="text" name="uo"><br>
<input type="submit"/>
<input type="reset"/>
</form>
</body>
</html>