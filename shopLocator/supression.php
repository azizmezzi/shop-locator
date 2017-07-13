<?php

session_start();
require ('config.php');
logged();

require ('header2.php');
$id=$_GET['numid'];
if (isset($_POST['supprime'])){
    $titre=$adresse=$type=$heur=$jour=$pays=$ville=$code='';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $titre = test_input($_POST["titre"]);
        $adresse=test_input($_POST["adresse"]);
        $type = test_input($_POST["type"]);
        $code = test_input($_POST["code postal"]);
        $pays=test_input($_POST["pays"]);
        $ville = test_input($_POST["ville"]);
        $heur=test_input($_POST["heur ouverture"]);
        $jour=test_input($_POST["jour ouverture"]);


    }
    try{
        $requet = $bdd->prepare("
    DELETE FROM shop WHERE `id`=:id ");
        $requet->bindParam(":id",$id);
        $requet->execute();
    }
    catch (PDOException $e2){
        echo "echec ".$e2->getMessage();
    }
    header("Location: principal.php?delete=1");}

$req=$bdd->prepare("
SELECT * FROM shop WHERE `id`=:id    ");
$req->bindParam(":id",$id);
$req->execute();
?>

<br/>
<br/>
<h1 style="text-align: center">Tous les donnees de ce Shop seront supprimé</h1>
<h1 style="text-align: center;">Cette operation est irreversible </h1>


<form method="post" >
<input class="btn btn-primary btn-lg"  type="submit" name="supprime" value="supprime"><a href="principal.php" class="col-sm-offset-9 btn btn-success btn-lg" >Retour Accueil</a>
</form>
<?php
require ('footer.php');
?>