<?php
session_start();
include ('config.php');

logged();
$id= $_GET["numid"];

$req=$bdd->prepare("
SELECT * FROM shop WHERE `id`=:id    ");
$req->bindParam(":id",$id);
$req->execute();
$titre = $adresse = $type = $heur = $jour = $pays = $ville = $code = '';

while($donnees=$req->fetch())

{$titre = ($donnees["titre"]);
$adresse = ($donnees["adresse"]);
$type = ($donnees["type"]);
$code = ($donnees["code postal"]);
$pays = ($donnees["pays"]);
$ville = ($donnees["ville"]);
$heur = ($donnees["heur ouverture"]);
$jour = ($donnees["jour ouverture"]);}
?>

<?php
try {
if (isset($_POST['env'])){
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(!empty($_POST["titre"])) {$titre = test_input($_POST["titre"]);}
        if(!empty($_POST["adresse"])) {$adresse = test_input($_POST["adresse"]);}
        if(!empty($_POST["type"])){$type = test_input($_POST["type"]);}
        if(!empty($_POST["code"])){$code = test_input($_POST["code"]);}
        if(!empty($_POST["pays"])){$pays = test_input($_POST["pays"]);}
        if(!empty($_POST["ville"])){$ville = test_input($_POST["ville"]);}
        if(!empty($_POST["heur"])){$heur = test_input($_POST["heur"]);}
        if(!empty($_POST["jour"])){$jour = test_input($_POST["jour"]);}

    }
    $requet = $bdd->prepare("
    UPDATE `shop` 
    SET `titre`=:titre,
    `type`=:type,
    `adresse`=:adresse,
    `code postal`=:code ,
    `pays`=:pays,
    `ville`=:ville,
    `heur ouverture`=:heur ,
    `jour ouverture`=:jour
      WHERE `id`= :id ");
    $requet->bindParam(":titre",$titre);
    $requet->bindParam(":type",$type);
    $requet->bindParam(":adresse",$adresse);
    $requet->bindParam(":id",$id);
    $requet->bindParam(":code",$code);
    $requet->bindParam(":pays",$pays);
    $requet->bindParam(":ville",$ville);
    $requet->bindParam(":heur",$heur);
    $requet->bindParam(":jour",$jour);

    $requet->bindParam(":id",$id);
    $resultat=$requet->execute();
    if($resultat!=0){
        header("Location: principal.php?update=1");
    }
    }



}
catch(PDOException $e){
    echo 'echec'.$e->getMessage();
}





while($donnees=$req->fetch()) {
    $titre = ($donnees["titre"]);
    $adresse = ($donnees["adresse"]);
    $type = ($donnees["type"]);
    $code = ($donnees["code postal"]);
    $pays = ($donnees["pays"]);
    $ville = ($donnees["ville"]);
    $heur = ($donnees["heur ouverture"]);
    $jour = ($donnees["jour ouverture"]);

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>modification</title>
    <meta charset="UTF-8">

</head>
<body>
<fieldset>
    <legend>Modification</legend>
<?php include ('logout.php');
?>

<form  method="post"  >

    <p>  <label for="titre" >titre de shop</label>
        <input type="text" name="titre" placeholder="<?php echo $titre?>"id="titre">
    </p>
    <p><label for="type">type de shop</label>
        <select name="type" id="type">
            <option value="market" >market</option>
            <option value="express" >express</option>
            <option value="outlet"  >outlet</option>
        </select>
    </p>
    <p>  <label for="adresse">adresse de shop</label>
        <input type="text" name="adresse"  placeholder="<?php echo $adresse?>"id="adresse">
    </p>
    <p>  <label for="code">code postal de shop</label>
        <input type="text" name="code"  placeholder="<?php echo $code?>" id="code">
    </p>
    <p>  <label for="pays">pays de shop</label>
        <input type="text" name="pays"  placeholder="<?php echo $pays?>" id="pays">
    </p>
    <p>  <label for="ville">ville de shop</label>
        <input type="text" name="ville"  placeholder="<?php echo $ville?>" id="ville">
    </p>
    <p>  <label for="heur">heur ouverture de shop</label>
        <input type="text" name="heur"  placeholder="<?php echo $heur?>" id="heur">
    </p>
    <p>  <label for="jour">jour ouverture de shop</label>
        <select name="jour" id="jour">
            <option value="lundi"  >lundi</option>
            <option value="mardi"  >mardi</option>
            <option value="mercredi"  >mercredi</option>
            <option value="jeudi"  >jeudi</option>
            <option value="vendredi"  >vendredi</option>
            <option value="samdi"  >samdi</option>
            <option value="dimanche"  >dimanche</option>
        </select>

    </p>
    <p>
        <input type="submit" name="env" />
    </p>
</form>
</fieldset>
</body>
</html>