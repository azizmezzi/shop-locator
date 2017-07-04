<!DOCTYPE html>
<html>
<head>
	<title>formulaire</title>
	    <meta charset="utf-8"/>

</head>
<body>
<P>BONJOUR </P>

<?php 	
function securisation($donnees){
$donnees=trim($donnees);
$donnees=stripcslashes($donnees);
$donnees=strip_tags($donnees);
return $donnees;

}
	echo securisation($_POST['prenom']) .'<br/>'. securisation($_POST['nom']);
?>
<p>Clique <a href="index.php">ici</a> pour reveneir au formualire</p>
<p><a href="mysql.php">mysql</a></p>
<?php
try {
    $connection = new PDO("mysql:host=127.0.0.1;dbname=test2", "root", "root");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $requet=$connection->prepare("SELECT prenom FROM visiteur WHERE sexe='H'");
 $requet->execute();
 $resul=$requet->fetchAll();
 echo '<pre>';
 print_r($resul);
 echo'</pre>';
}
catch(PDOException $e){
    echo 'echec ';
}
?>


</body>
</html>