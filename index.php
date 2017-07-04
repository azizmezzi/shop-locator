<?php 

$nom='aziz';
setcookie($nom,'aziz mezzi',time()+1,'/');

echo $_COOKIE['aziz'];
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>first</title>
    <meta charset="utf-8"/>
</head>
<body>
   
<form method="POST" action="formulaire.php">
<p>
	<label for="prenom">entre votre prenom:</label>
	<input type="text" name="prenom" id="prenom"/>
</p>
<p>
	<label for="nom">entre votre nom:</label>
	<input type="text" name="nom" id="nom"/>
</p>
<p>
	<label for="pseudo">entre votre pseudo:</label>
	<input type="text" name="pseudo" id="pseudo"/>
</p>
<p>
	<input type="submit" name="env"/>
</p>
<?php 
//variable superglobale $_SERVER
ECHO $_SERVER['PHP_SELF']	.'<br/>';
 
ECHO $_SERVER['SERVER_ADDR'].'<br/>';
 
ECHO $_SERVER['SERVER_NAME'].'<br/>';
 
ECHO $_SERVER['SCRIPT_NAME'].'<br/>';
 
ECHO $_SERVER['HTTP_HOST'].'<br/>';
 
//$_session
	$_session['prenom']='aziz';
	$_session['age']=20;
	$_session['sport']='foot';
include_once('index.class.php');
$visiteur=new visiteur;
$visiteur->setPrenom('aziz');
echo $visiteur->getPrenom();

$serveur="127.0.0.1";
$login="root";
$pass="root";
try{
$connexion = new PDO("mysql:host=127.0.0.1;dbname=test2",$login,$pass);
$connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


 }
 catch(PDOException $e){
 	echo'<br/> echec';

 }
 ?>
 <p><a href="login.php">login</a></p>
    <p><a href="chat.php">mini_chat</a></p>
    <p><a href="shopLocator/principal.php">princiapl</a></p>


</body>
</html>

