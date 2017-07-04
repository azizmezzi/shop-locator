<!DOCTYPE html>
<html>
<head>
    <title>jointure</title>
</head>
<body>

<?php
$serveur="127.0.0.1";
$login="root";
$pass="root";
try{
    $connexion = new PDO("mysql:host=127.0.0.1;dbname=test3",$login,$pass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $jointure_int="
    SELECT inscrit.prenom, commentaire.commentaire
    FROM inscrit
    INNER JOIN commentaire
    ON inscrit.id=commentaire.id_inscrit  ";
    $requet=$connexion->prepare($jointure_int);
    $requet->execute();

    $resultat=$requet->fetchAll();
    echo'<pre>';
    print_r($resultat);
    echo'<pre>';


}
catch(PDOException $e){
    echo'<br/> echec';

}
?>
</body>
</html>