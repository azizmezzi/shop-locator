<?php

session_start();
require ('config.php');

logged();


include ('logout.php');
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
while($donnees=$req->fetch())

{
?>
    <?php
    require ('header2.php');
    ?>

<h1>vous etes sur de suprime ce shop definitivement !!</h1>


<table border="1" style="margin: auto">
    <tr><td>TITRE</td>

        <td>TYPE</td>
        <td>ADRESSE</td>
        <td>code postal</td>
        <td>pays</td>
        <td>ville</td>
        <td>heur d'ouverture</td>
        <td>jour d'ouverture</td>


    </tr>

        <tr>
            <td> <?php echo($donnees['titre']); ?>    </td>
            <td> <?php echo ($donnees['type']);?> </td>
            <td> <?php echo($donnees['adresse']); ?>    </td>
            <td> <?php echo($donnees['code postal']); ?>    </td>
            <td> <?php echo ($donnees['pays']);?> </td>
            <td> <?php echo($donnees['ville']); ?>    </td>
            <td> <?php echo($donnees['heur ouverture']); ?>    </td>
            <td> <?php echo($donnees['jour ouverture']); ?>    </td>


        </tr>
    <?php } ?>


</table>
<form method="post" >
<input type="submit" name="supprime" value="supprime">
</form>
<?php
require ('footer.php');
?>