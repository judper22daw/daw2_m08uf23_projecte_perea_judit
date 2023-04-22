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
<title>
CREADOR D'USUARIS LDAP
</title>
</head>
<body>
<h2>Formulari de creació d'usuaris</h2>
<form action="crear.php" method="POST">
UID: <input type="text" name="uid"><br>
Unitat organitzativa: <input type="text" name="uo"><br>
uidNumber: <input type="number" name="uidNumber"><br>
gidNumber: <input type="number" name="gidNumber"><br>
dir_pers: <input type="text" name="directoriPersonal"><br>
Shell: <input type="text" name="shell"><br>
cn: <input type="text" name="cn"><br>
sn: <input type="text" name="sn"><br>
nom: <input type="text" name="givenName"><br>
mobil: <input type="text" name="mobile"><br>
adressa: <input type="text" name="postalAdress"><br>
telefon: <input type="text" name="telephoneNumber"><br>
titol: <input type="text" name="title"><br>
descripcio: <input type="text" name="description"><br>
<input type="submit"/>
<input type="reset"/>
</form>
</body>
</html>